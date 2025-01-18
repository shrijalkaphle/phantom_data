@extends('layouts.aside')
@section('content')



<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<style>
    .transparent-table {
        background-color: rgba(255, 255, 255, 1);
        /* White with 50% transparency */
        border: none;
        /* Remove the border for transparency */
    }

    .transparent-table th,
    .transparent-table td {
        border: none;
        /* Remove borders from cells */
        background-color: rgba(255, 255, 255, 0);
        /* Match the background for cells */
    }

    .transparent-table th {
        color: white;
        /* Change header text color for better visibility */
    }

    .transparent-table tbody tr {
        transition: background-color 0.3s;
        /* Smooth transition for hover effect */
    }

    .transparent-table tbody tr:hover {
        background-color: #d6c2f9;
        /* Slightly darker on hover */
    }

    .transparent-table .table-primary {
        background-color: rgba(0, 123, 255, 0.5);
        /* Bootstrap primary color with transparency */
        color: white;
        /* Ensure text is readable */
    }

    .header-row {
        background-color: #9152FF;
    }

    .header-row th:first-child {
        border-top-left-radius: 10px;
        /* Rounded top-left corner */
        border-bottom-left-radius: 10px;
        /* Rounded bottom-left corner */
    }

    .header-row th:last-child {
        border-top-right-radius: 10px;
        /* Rounded top-left corner */
        border-bottom-right-radius: 10px;
        /* Rounded bottom-left corner */
    }
</style>
<div style="height:100%;max-height: 600px; overflow-y: auto;">

    <table class="table transparent-table ">
        <thead>
            <tr class="header-row">
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Row(s)</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">1</td>
                <td>Total Properties List</td>
                <td>{{$totalProperties}}</td>
                <td>
                    <button class="btn btn-sm border-primary export-all" @if($totalProperties < 1) disabled @endif><i
                            class="fa-solid fa-file-csv" style="color:#9152FF"></i> Export All</button>
                </td>
            </tr>
            @foreach($properties as $property)
                <tr>
                    <td scope="row">{{ $loop->iteration + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($property->created_at)->format('d F Y | h:i A') }}</td>
                    <td>{{$property->count}}</td>
                    <td>
                        <button class="btn btn-sm border-primary export-csv-by-date"
                            data-file-no="{{ $property->file_no }}">
                            <i class="fa-solid fa-file-csv" style="color:#9152FF"></i>
                            Export {{ $property->count }} Row(s) Csv
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        var user_data = localStorage.getItem('user_details')
        if (!user_data) {
            window.location.href = '{{ route('welcome') }}';
        }
        let currentUrl = window.location.href;
        let match = currentUrl.match(/my-properties\/(\d+)/);
        let userId = match[1];
        //console.log("User ID:", userId);
        user_data = JSON.parse(user_data);
        var user_id = user_data.id
        if (userId != user_id) {
            window.location.href = '{{ route('welcome') }}';
        }


        $(document).on('click', '.export-all', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('export-properties-csv')}}',
                type: 'GET',
                data: {user_id:user_id},
                success: function (response) {
                    const blob = new Blob([response], { type: 'text/csv' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'properties_backup.csv';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                },
                error: function (xhr, status, error) {
                    console.error('Error exporting CSV:', error);
                }
            });
        });

        $(document).on('click', '.export-csv', function (e) {
            e.preventDefault();
            $('#exportCsvModal').modal('show');
        });

        $(document).on('click', '.export-csv-by-date', function (e) {
            e.preventDefault(); // Prevent the default action of the button
            var fileNo = $(this).data('file-no'); // Get the file_no from the data attribute
            console.log(fileNo); // Log it to the console

            // AJAX request
            $.ajax({
                url: '{{route('export-csv-by-date')}}',
                method: 'GET',
                data: {
                    file_no: fileNo,
                    user_id:user_id,
                },
                success: function (response) {
                    const blob = new Blob([response.csv_content], { type: 'text/csv' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = response.filename;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);

                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error('Error:', error);
                }
            });
        });

    });
</script>
</body>
</html>

@stop