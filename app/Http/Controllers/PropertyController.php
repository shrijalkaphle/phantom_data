<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;




class PropertyController extends Controller
{

    public function sendPropertyData(Request $request)
    {

        $userData=DB::table('users')->where('id',$request->user_id)->first();
        $userTotalCredits = DB::table('transactions')->where('email', $userData->email)->latest()->value('obtained_credits');
        $currentCredits = $userData->credit;
        $usedCredits = $userTotalCredits - $currentCredits;
        $creditsPercentage = ($usedCredits / $userTotalCredits) * 100;
        if (floor($creditsPercentage) == $creditsPercentage) {
            $creditsPercentage = number_format($creditsPercentage, 0);
        } else {
            $creditsPercentage = number_format($creditsPercentage, 1);
        }
        $creditsPercentageSign = $creditsPercentage . "%";

        $propertyData = $request->input('properties');
        //dd($propertyData);
        $userCredits = $userData->credit;
        $perSearchablePropertyPrice = 1;
        $errorResponse = [];
        if (!isset($propertyData['mail_address'], $propertyData['mail_city'], $propertyData['mail_state'])) {
            return response()->json([
                'file_error' => 'Header Are Missing',
                'status' => 400,
            ]);
        }
        $verify_Properties = DB::table('properties')
            ->where('user_id', $userData->id)
            ->where('mail_address', $propertyData['mail_address'])
            ->where('mail_city', $propertyData['mail_city'])
            ->where('mail_state', $propertyData['mail_state'])
            ->first();

        if ($verify_Properties) {
            return response()->json([
                'success_message' => 'Skipping',
                'status' => 200,
            ]);
        }
        if ($userCredits >= $perSearchablePropertyPrice) {

            $accessProfileName = "Phantom";
            $accessProfilePassword = "9235d046ee8943588fec458601d12dbe";
            $searchType = "DevAPIAddressID";
            $url = "https://devapi.endato.com/Address/Id";

            $headers = [
                "galaxy-ap-name" => $accessProfileName,
                "galaxy-ap-password" => $accessProfilePassword,
                "galaxy-search-type" => $searchType,
                "Content-Type" => "application/json",
            ];



            $payload = [
                "AddressLine1" => $propertyData['mail_address'],
                "AddressLine2" => $propertyData['mail_city'] . ', ' . $propertyData['mail_state'],
                "ExactMatch" => "CurrentOwner",
            ];

            try {


                $response = Http::withHeaders($headers)->post($url, $payload);
                $responseData = $response->json();

                if (isset($responseData['message']) && $responseData['message'] === 'No strong matches') {
                    return response()->json([
                        'property' => $propertyData,
                        'message' => 'No strong matches found.',
                        'status' => 404,
                    ]);
                }

                $persons = $responseData['persons'] ?? [];
                $details_in_this_property = count($persons);
                $personDetails = [];
                $firstName = '';
                $lastName = '';
                $bestPhone = null;
                $newCredits = $userCredits;
                if (!empty($persons)) {

                    $uniqueUsers = []; // To track unique users based on name
                    $personDetails = []; // To store the final result

                    foreach ($persons as $person) {
                        $firstName = $person['name']['firstName'] ?? '';
                        $lastName = $person['name']['lastName'] ?? '';

                        // Create a unique key for the user
                        $uniqueKey = strtolower($firstName . '_' . $lastName);

                        // Initialize $bestPhone to an empty string if this is the first record for the user
                        if (!isset($uniqueUsers[$uniqueKey])) {
                            $uniqueUsers[$uniqueKey] = ''; // Initialize the bestPhone for this user
                        }

                        // If the user already has a wireless phone saved, skip further processing
                        if ($uniqueUsers[$uniqueKey] !== '') {
                            continue;
                        }

                        // Find the first wireless phone
                        foreach ($person['phones'] as $phone) {
                            if ($phone['type'] === 'Wireless') {
                                $uniqueUsers[$uniqueKey] = $phone['number']; // Save the first wireless number
                                break; // Exit the loop after finding the first wireless number
                            }
                        }
                    }

                    // Format the results into the $personDetails array
                    foreach ($uniqueUsers as $key => $bestPhone) {
                        if ($bestPhone !== '') {
                            list($firstName, $lastName) = explode('_', $key);
                            $personDetails[] = [
                                'first_name' => ucfirst($firstName),
                                'last_name' => ucfirst($lastName),
                                'best_phone' => $bestPhone,
                            ];
                        }
                    }


                    $newCredits = $userCredits - count($personDetails);
                    $updateUserData = ['credit' => $newCredits];
                    DB::table('users')->where('id', $userData->id)->update($updateUserData);


                }

                // Save the property response to the database
                $propertyResponse = new Property();
                $propertyResponse->user_id = $userData->id;
                $propertyResponse->mail_address = $propertyData['mail_address'];
                $propertyResponse->mail_city = $propertyData['mail_city'];
                $propertyResponse->mail_state = $propertyData['mail_state'];
                $propertyResponse->mail_zip = 'N/A';
                $propertyResponse->response = json_encode($persons);
                $propertyResponse->property_address = $propertyData['mail_address'];
                $propertyResponse->property_city = $propertyData['mail_city'];
                $propertyResponse->property_state = $propertyData['mail_state'];
                $propertyResponse->property_zip = 'No Property ZIP';
                $propertyResponse->personal_details = json_encode($personDetails);
                $propertyResponse->file_no = $request->fileNumber;
                $propertyResponse->complete_response = $response;
                $propertyResponse->save();
                return response()->json([
                    'newCredits' => $newCredits,
                    'property_id' => $propertyResponse->id, // Return the inserted property ID
                    'creditsPercentageSign' => $creditsPercentageSign, // Return the inserted property ID
                    'success_message' => 'Success',
                    'status' => 200,
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error processing property data.',
                    'error' => $e->getMessage(),
                    'status' => 500,
                ]);
            }

        } else {
            // Fill the errorResponse array when insufficient credits
            $errorResponse = [
                'error_message' => 'Insufficient credits to process this property.',
                'status' => 402,
            ];
            return response()->json($errorResponse);
        }

    }



    public function requestPropertyData(Request $request)
    {
        $userTotalCredits = DB::table('transactions')->where('email', auth()->user()->email)->latest()->value('obtained_credits');
        $currentCredits = auth()->user()->credit;
        $usedCredits = $userTotalCredits - $currentCredits;
        $creditsPercentage = ($usedCredits / $userTotalCredits) * 100;
        if (floor($creditsPercentage) == $creditsPercentage) {
            $creditsPercentage = number_format($creditsPercentage, 0);
        } else {
            $creditsPercentage = number_format($creditsPercentage, 1);
        }
        $creditsPercentageSign = $creditsPercentage . "%";
        $propertyIds = $request->input('property_ids');
        if ($propertyIds) {
            $properties = DB::table('properties')
                ->where('user_id', Auth::user()->id)
                ->whereIn('id', $propertyIds)
                ->get();

            return response()->json([
                'properties' => $properties,
                'creditsPercentage' => $creditsPercentageSign,
                'message' => 'Property data processed successfully.',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'error_message' => 'Properties Already Uploaded',
                'status' => 200,
            ]);
        }
    }




    public function getPropertiesTemp()
    {
        $properties = Property::all();

        foreach ($properties as $row) {
            $response = json_decode($row->response, true);
            if (is_array($response) && isset($response['persons'])) {
                foreach ($response['persons'] as $person) {
                    echo "<br><pre>";
                    echo 'Name : ' . $person['name']['firstName'] . ' ' . $person['name']['middleName'] . ' ' . $person['name']['lastName'];
                    echo '<br>Age : ' . $person['age'];
                    echo '<br>Addresses :<br>';

                    foreach ($person['addresses'] as $location) {
                        echo 'Location : ' . $location['houseNumber'] . ' , ' . $location['street'] . ' -> ' . $location['unit'] . ' - ' . $location['city'] . ' , ' . $location['state'] . '|' . $location['zip'] . '<br>';
                        echo 'firstReportedDate : ' . $location['firstReportedDate'] . '<br>';
                        echo 'lastReportedDate : ' . $location['lastReportedDate'] . '<br><br>';
                    }

                    echo "</pre>";
                }
            }
        }
    }

    public function myProperties(Request $request)
    {
        $user_id=$request->user_id;
        $properties = DB::table('properties')
            ->where('user_id', $user_id)
            ->select('file_no', DB::raw('MIN(created_at) as created_at'), DB::raw('COUNT(*) as count'))
            ->groupBy('file_no')
            ->get();
        $totalProperties = DB::table('properties')->count();
        return view('User.myProperties', compact('properties', 'totalProperties'));
    }


    // In your controller
    public function getPropertiesData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('properties')
                ->where('user_id', Auth::user()->id)
                ->select(['properties.*']);

            return DataTables::of($data)
                ->addColumn('personal_details', function ($row) {
                    return $row->personal_details; // Encode personal details to JSON
                })
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }



    public function exportPropertiesCsv(Request $request)
    {
        $properties = DB::table('properties')->where('user_id', $request->user_id)->get();

        // Updated CSV header with the correct order
        $csvContent = "ID,First Name,Last Name,Phone,ZIP,Address,City,State\n";

        foreach ($properties as $property) {
            // Decode the response JSON column
            $response = json_decode($property->response, true);

            if ($response && is_array($response)) {
                // Loop through each person in the response
                foreach ($response as $person) {
                    $firstName = $person['name']['firstName'] ?? 'N/A';
                    $lastName = $person['name']['lastName'] ?? 'N/A';

                    // Find the most recent phone number
                    $latestPhone = 'N/A';
                    if (isset($person['phones']) && is_array($person['phones'])) {
                        foreach ($person['phones'] as $phone) {
                            $latestPhone = $phone['number'] ?? 'N/A';
                        }
                    }

                    // Find the most recent ZIP code from addresses
                    $latestZip = 'N/A';
                    if (isset($person['addresses']) && is_array($person['addresses'])) {
                        $latestDate = null;
                        foreach ($person['addresses'] as $address) {
                            $lastReportedDate = strtotime($address['lastReportedDate'] ?? null);
                            if ($lastReportedDate && ($latestDate === null || $lastReportedDate > $latestDate)) {
                                $latestDate = $lastReportedDate;
                                $latestZip = $address['zip'] ?? 'N/A';
                            }
                        }
                    }

                    // Get Address, City, and State from property columns
                    $propertyAddress = $property->property_address ?? 'N/A';
                    $propertyCity = $property->property_city ?? 'N/A';
                    $propertyState = $property->property_state ?? 'N/A';

                    // Append the data in CSV format
                    $csvContent .= "{$property->id},$firstName,$lastName,$latestPhone,$latestZip,$propertyAddress,$propertyCity,$propertyState\n";
                }
            } else {
                // If the response is empty or invalid, add a single row with N/A
                $csvContent .= "{$property->id},N/A,N/A,N/A,N/A,{$property->property_address},{$property->property_city},{$property->property_state}\n";
            }
        }

        $csvFilename = 'properties_backup.csv';

        // Return the CSV as a downloadable response
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$csvFilename}",
        ]);
    }


    public function exportCurrentProperties(Request $request)
    {
        // Get the property IDs from the request
        $propertyIds = $request->input('property_ids');

        // Validate that propertyIds is an array
        if (!is_array($propertyIds) || empty($propertyIds)) {
            return response()->json(['error' => 'No property IDs provided'], 400);
        }

        // Fetch properties that match the IDs and belong to the authenticated user
        $properties = DB::table('properties')
            ->whereIn('id', $propertyIds)
            ->where('user_id', Auth::user()->id)
            ->get();

        // Updated CSV header with the correct order
        $csvContent = "ID,First Name,Last Name,Phone,ZIP,Address,City,State\n";

        foreach ($properties as $property) {
            // Decode the response JSON column
            $response = json_decode($property->response, true);

            if ($response && is_array($response)) {
                // Loop through each person in the response
                foreach ($response as $person) {
                    $firstName = $person['name']['firstName'] ?? 'N/A';
                    $lastName = $person['name']['lastName'] ?? 'N/A';

                    // Find the most recent phone number
                    $latestPhone = 'N/A';
                    if (isset($person['phones']) && is_array($person['phones'])) {
                        foreach ($person['phones'] as $phone) {
                            $latestPhone = $phone['number'] ?? 'N/A';
                        }
                    }

                    // Find the most recent ZIP code from addresses
                    $latestZip = 'N/A';
                    if (isset($person['addresses']) && is_array($person['addresses'])) {
                        $latestDate = null;
                        foreach ($person['addresses'] as $address) {
                            $lastReportedDate = strtotime($address['lastReportedDate'] ?? null);
                            if ($lastReportedDate && ($latestDate === null || $lastReportedDate > $latestDate)) {
                                $latestDate = $lastReportedDate;
                                $latestZip = $address['zip'] ?? 'N/A';
                            }
                        }
                    }

                    // Get Address, City, and State from property columns
                    $propertyAddress = $property->property_address ?? 'N/A';
                    $propertyCity = $property->property_city ?? 'N/A';
                    $propertyState = $property->property_state ?? 'N/A';

                    // Append the data in CSV format
                    $csvContent .= "{$property->id},$firstName,$lastName,$latestPhone,$latestZip,$propertyAddress,$propertyCity,$propertyState\n";
                }
            } else {
                // If the response is empty or invalid, add a single row with N/A
                $csvContent .= "{$property->id},N/A,N/A,N/A,N/A,{$property->property_address},{$property->property_city},{$property->property_state}\n";
            }
        }

        // Dynamic filename: "properties_count(IDs)_created_at.csv"
        $csvFilename = 'properties_' . count($propertyIds) . '_row(s)_' . now()->format('Y-m-d_H-i-s') . '.csv';

        // Return the CSV as a downloadable response
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$csvFilename}",
        ]);
    }


    public function exportCsvByDate(Request $request)
    {
       
        $user_id=$request->user_id;
        $properties = DB::table('properties')
            ->where('user_id', $request->user_id)
            ->where('file_no', $request->file_no)
            ->get();

        // Updated CSV header
        $csvContent = "ID,First Name,Last Name,Phone,ZIP,Address,City,State\n";

        foreach ($properties as $property) {
            // Decode the personal_details JSON column
            $response = json_decode($property->personal_details, true);

            if ($response && is_array($response)) {
                // Loop through each person in the personal_details array
                foreach ($response as $person) {
                    $firstName = $person['first_name'] ?? 'N/A';
                    $lastName = $person['last_name'] ?? 'N/A';
                    $bestPhone = $person['best_phone'] ?? 'N/A';

                    // Get Address, City, and State from property columns
                    $propertyAddress = $property->property_address ?? 'N/A';
                    $propertyCity = $property->property_city ?? 'N/A';
                    $propertyState = $property->property_state ?? 'N/A';

                    // Append the data in CSV format
                    $csvContent .= "{$property->id},$firstName,$lastName,$bestPhone,N/A,$propertyAddress,$propertyCity,$propertyState\n";
                }
            } else {
                // If the response is empty or invalid, add a single row with N/A
                $csvContent .= "{$property->id},N/A,N/A,N/A,N/A,{$property->property_address},{$property->property_city},{$property->property_state}\n";
            }
        }

        $lineCount = count(explode("\n", $csvContent)) - 2; // Subtracting header and empty last line
        $date = now()->format('d-F-Y');
        $csvFilename = $date . '_' . $lineCount . '_row(s).csv';

        // Return the CSV as a downloadable response
        return response()->json([
            'csv_content' => $csvContent,
            'filename' => $csvFilename,
            'message' => 'CSV generated successfully.',
        ]);
    }


}
