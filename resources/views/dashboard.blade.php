@extends('layouts.aside')
@section('content')
<style> 
.pricing-section-two .pr-column-wrapper .pr-header {
        border-bottom: none;
        padding: 30px;
        background-color: white;
    }

    .pricing-section-two .pr-column-wrapper {
        background-color: white;
    }

    .price-container {
        font-family: Arial, sans-serif;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
    }

    .price-container .currency-symbol {
        margin-right: 5px;
    }

    .price-container input {
        border: none;
        border-bottom: 1px solid #333;
        outline: none;
        font-weight: 600;
        color: #333;
        padding: 0;
        width: 200px;
        background: transparent;
    }

    .price-container input::placeholder {
        font-size: 15px;
        /* Set placeholder font size */
        color: #999;
        /* Optional: Lighter color for the placeholder text */
    }
    .modal-body .centered-elements {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .scrollable-table-container {
        width: 90%;
        max-height: 500px;
        /* Adjust this height as needed */
        overflow-y: auto;
        margin: 0 auto;
        /* Center the container horizontally */
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-left: 2px solid #B95CF4;
        border-bottom: 2px solid #B95CF4;
    }

    /* WebKit scrollbar styles */
    .scrollable-table-container::-webkit-scrollbar {
        width: 12px;
        /* Width of the scrollbar */
    }

    .scrollable-table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Track color */
    }

    .scrollable-table-container::-webkit-scrollbar-thumb {
        background: #B95CF4;
        /* Scrollbar color */

        /* Optional: rounded corners */
    }

    .scrollable-table-container::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Optional: darker color on hover */
    }

    .scrollable-table-container thead th {
        position: -webkit-sticky;
        /* For Safari */
        position: sticky;
        top: 0;
        background-color: #B95CF4;
        /* Set background color to green */
        color: #fff;
        /* Set text color to white for contrast */
        z-index: 1;
        /* Ensure the header is on top of the table body */
    }

    /* Apply border radius only to the first and last th in the thead */
    .scrollable-table-container thead th:first-child {
        border-top-left-radius: 10px;
    }

    .scrollable-table-container thead th:last-child {
        border-top-right-radius: 10px;
    }

    .scrollable-table-container table tbody td {
        font-size: 12px
    }

    .upload-csv-file {
        color: #B95CF4;
    }

    .upload-csv-file:hover {
        color: #B95CF4;
        border: 1px solid #B95CF4;
    }

    .upload-csv-file:disabled {
        color: grey;
        border: 1px solid grey;
    }
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        flex-direction: column;
        /* Stacks items vertically */
        justify-content: center;
        align-items: center;
        z-index: 999999;
        text-align: center;
        /* Centers text alignment */
        backdrop-filter: blur(7px);
        /* Adds blur effect */
    }

    .loading-text {
        margin-top: 20px;
        /* Space between spinner and text */
        font-size: 24px;
        /* Adjust font size as needed */
        color: #333;
        /* Text color */
    }

    .pay-btn {
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pay-as-you-go-div {
   
    padding: 20px;
    width: 46%;
    border-radius: 20px;
    box-shadow: 0px 0px 20px 0px rgba(145, 82, 255, 1);
}
</style>

<div class="loading-screen d-none">
    <i class="fa-solid fa-spinner fa-spin-pulse" style="font-size: 100px; color: #B95CF4;"></i>
    <div class="loading-text">
        <span style="font-size:16px;">Loading</span>
        <br>
        Updating Credits ....
    </div>
</div>

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div class="bg-white p-0 border-20 mt-20 mb-50 drop-file-area" style="cursor:pointer">
    <div id="drop-zone" class="drop-zone">
        <p>Drop file here</p>
    </div>
    <input type="file" id="file-input" class="file-input" style="display: none;" accept=".csv">
</div>

<!-- Loading Bar Container -->
<div id="loading-bar-container" class="d-none">
Row(s): <span class="completed-rows-count-bar">1</span>/<span class="total-rows-count-bar"></span>
    <div class="progress mt-20 mb-10 loading-bar-bg">
        <div id="loading-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
            style="width: 0%;">0%</div>
    </div>
    <span style="display: block; text-align: center;" class="loadind-text"></span>
</div>
<div class="bg-white p-0 border-20 mt-20 mb-50 scrapper-completed d-none" style="width:100%;height:200px;">
    <div class="container h-100">
        <div class="row pt-10 pb-10 ms-10 h-100 align-items-center">
            <div class="col-12 mb-2 ms-3">
                Rows in File: <span class="scrapper-completed-total-rows"></span>
            </div>
            <div class="col-12 text-center mb-5 ms-3" style="font-size:20px">
                Status: <span class="scrapper-completed-status">Processing</span>
            </div>
        
            <div class="col text-center scrapper-completed-button d-none">
                <button class="btn btn-one" onclick="location.reload();">New File</button>
                <a class="btn btn-two my-properties">Properties</a>
            </div>
        </div>
    </div>
</div>




<!-- Updated show-file-area with DataTable -->
<!-- Updated show-file-area with DataTable, initially hidden with 'd-none' -->
<div class="bg-white card-box p0 border-20 mt-20 mb-50 show-file-area d-none">
    <div class="table-responsive pt-25 pb-25 pe-4 ps-4">
        <table id="data-table" class="table property-list-table sampleTable justify-content-center">
            <thead>
                <tr>
                    <th>first name</th>
                    <th>last name</th>
                    <th> Address</th>
                    <th> City</th>
                    <th> State</th>
                    <th> Zip</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="border-0">
                <!-- DataTables will populate this section -->
            </tbody>
        </table>
    </div>
</div>



<!-- Modal Structure -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Personal Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Mini table will be inserted here -->
                <div id="modalContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-------------------------------- ERROR MODAL(START) -> SCRAPPER NOT WORKING -------------------------------------->
<div class="modal fade" id="scrapper-error-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-triangle-exclamation" style="font-size:60px;color:#d9534f"></i>
                <br>
                <span style="font-size:35px;">Failed!</span><br>
                <span>Oops! Something Went Wrong.<br>Try Again Later</span>
            </div>
        </div>
    </div>
</div>
<!-------------------------------- ERROR MODAL(END) -> SCRAPPER NOT WORKING -------------------------------------->

<!-------------------------------- ERROR MODAL(START) -> UPLOAD CSV FILE -------------------------------------->
<div class="modal fade" id="csv-error-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-circle-exclamation" style="font-size:60px;color:#f0ad4e"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>Upload CSV file.</span>
            </div>
        </div>
    </div>
</div>
<!-------------------------------- ERROR MODAL(END) -> UPLOAD CSV FILE -------------------------------------->


<!-------------------------------- ERROR MODAL(START) -> INSUFFICIENT CREDITS -------------------------------------->
<div class="modal fade" id="credits-error-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-circle-exclamation" style="font-size:60px;color:#f0ad4e"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>Insufficient credits to process this file.</span>
            </div>
        </div>
    </div>
</div>
<!-------------------------------- ERROR MODAL(END) -> INSUFFICIENT CREDITS -------------------------------------->

<!-------------------------------- ERROR MODAL(START) -> CSV HEADER -------------------------------------->
<div class="modal fade" id="csv-header-error-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-circle-exclamation" style="font-size:60px;color:#f0ad4e"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>CSV Header Not Valid</span>
            </div>
        </div>
    </div>
</div>
<!-------------------------------- ERROR MODAL(END) -> CSV HEADER -------------------------------------->

<!-------------------------------- ERROR MODAL(START) -> PROPERTY DUPLICATE -------------------------------------->
<div class="modal fade" id="error-property-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-circle-exclamation" style="font-size:60px;color:#f0ad4e"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>Property already in List</span>
            </div>
        </div>
    </div>
</div>
<!-------------------------------- ERROR MODAL(END) -> PROPERTY DUPLICATE -------------------------------------->

<!-------------------------------- CSV MODAL(START) -> CSV HEADER -------------------------------------->

<div class="modal fade" id="csv-file-modal" tabindex="-1" aria-labelledby="csvexampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="location.reload();" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body step-csv-one ">
                <div class="text-center mt-10 mb-10">
                    Map columns in your file to contact field properties.
                </div>
                <div class="scrollable-table-container">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:10%">Matched</th>
                                <th style="width:15%">Headers</th>
                                <th>Information</th>
                                <th>Field To Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated here -->
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-10 mb-10">
                    <p class="data-row-count"></p>
                </div>
            </div>
            <div class="modal-body m-10 step-csv-two d-none" style="height:550px; position:relative">
                <div class="text-center mt-10 mb-10" style="background-color:#9152FF;border-radius:20px">
                    <p style="color:white;font-size:30px">Are you sure you want to upload File?</p>
                </div>
                <div class="container mt-10 mb-10"
                    style="background-color:#F5EDFA; border-radius:20px; border:1px solid #5406e5; padding:20px 40px 0px 40px;height:400px;">
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-6 text-start">
                            <u style="font-size:25px;">File Information:</u>
                            <br>
                            <span class="available-credits"></span>
                            <br>
                            <span class="total-rows-count"></span>
                            <br>
                            <span style="font-size:12px;color:red" class="required-credits"></span>
                            <div style="margin-top: 44px; margin-bottom: 40px;">
                                <!-- <span style="padding: 13px; color: white; background: #9152FF; font-weight: bold;"
                                    class="total-cost"></span> -->
                            </div>

                            <div class="term_and_condition_div d-none" style="padding:10px 0px 20px 10px">
                            <input type="checkbox" id="termsCheckbox" name="terms_and_conditions" />
                            <span> I agree to <b><a style="text-decoration:underline" href="{{ route('term-and-conditions') }}" target="_blank">terms and conditions</a></b></span>

                        </div>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6 text-start">
                            <div class="text-center text-danger" style="background-color:#d9534f; border-radius:20px;">
                                <span style="color:white; font-size:20px;" class="no-credits-error"></span>
                            </div>
                            <div class="pay-btn d-none text-center">
                                <div class="pr-column-wrapper pay-as-you-go-div">
                                    <div class="pr-header text-center">
                                        <!-- Adjusted margin-bottom -->
                                        <div class="plan color-dark fw-500">
                                            <span style="color:#D38BFF;font-size:12px;font-weight:500">(Pay as you
                                                go)</span><br>
                                            <span style="font-weight:500">Business</span>
                                        </div>
                                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                                            style="width: 65px;" />
                                        <span style="font-size:15px" class="pricePerCreditSpan"></span>

                                        <div class="plan color-dark fw-600">
                                            <div class="price-container">
                                                <input name="totalRowsData" type="hidden">
                                                <span class="currency-symbol">$</span>
                                                <input id="amountInput" name="amountInput" type="number"
                                                    placeholder="Enter Amount" style="width:100%;" oninput="updateCredits()">
                                            </div>
                                            <span class="invalid-amount d-none" style="font-size:12px;font-weight:600;color:red">Enter valid Amount To Continue</span>
                                        </div>
                                    </div>
                                    <!-- /.pr-header -->
                                    <div class=" text-white text-center pb-10">
                                        <!-- Adjusted margin-top -->
                                        
                                        <button id="creditsDisplay" class="btn btn-one-sm" style="font-size:15px;margin-top:10px"
                                            onclick="showStripe()">Get Credits</button>

                                    </div>
                                </div>
                                <div class="stripe-form-div d-none">
                                    <p class="total-payable"></p>
                                    <form class="pt-20" action="{{ route('manuall-payment') }}" method="post" id="payment-form">
                                        @csrf
                                        <div class="form-row pb-60">
                                            <input type="hidden" name="price_id" />
                                            <input type="hidden" id="card_holder_name"
                                                name="card_holder_name" required>
                                            <input type="hidden" id="total_amount" name="total_amount" required>
                                            <input type="hidden" id="obtained_credits" name="obtained_credits" required>
                                            <input type="hidden" id="card_holder_email" 
                                                name="card_holder_email" required>
                                            <input type="hidden" name="subscription_id"/>
                                            <div class="form-row pb-60">
                                                <label for="card-element">
                                                    Credit or debit card
                                                </label>
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                        <button class="btn btn-one-sm" style="font-size:15px"
                                        onclick="showAmountInput()">Back</button>
                                        <button type="submit" class="btn btn-one-sm">Get Credits</button>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="modal-footer">
                <div></div>
                <button type="button" class="btn btn-two-sm" data-bs-dismiss="modal" style="color:red"
                    onclick="location.reload();">
                    <strong>Cancel</strong>
                </button>
                <button type="button" id="continueButton" disabled class="btn upload-csv-file"><strong>Continue</strong></button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------- CSV MODAL(END) -> CSV HEADER -------------------------------------->

<!-------------------------------- ERROR MODAL(START) -> CSV DUPLICATE HEADER -------------------------------------->
<div class="modal fade" id="csv-duplicate-header-error-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-circle-exclamation" style="font-size:60px;color:#f0ad4e"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>Contact Field Already Mapped</span>
            </div>
        </div>
    </div>
</div>

<!-------------------------------- ERROR MODAL(END) -> CSV DUPLICATE HEADER -------------------------------------->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    
    $('#termsCheckbox').on('change', function() {
        if ($(this).is(':checked')) {
            $('#continueButton').attr('disabled',false); // Enable button
        } else {
            $('#continueButton').attr('disabled', 'disabled'); // Disable button
        }
    });
</script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {

        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                errorElement.classList.add('error');
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });
    function stripeTokenHandler(token) {
        document.querySelector('.loading-screen').classList.remove('d-none');
        document.querySelector('.required-credits').classList.add('d-none');
        var form = document.getElementById('payment-form');
        var formData = new FormData(form);
        formData.append('stripeToken', token.id);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('data ====> ',data)
                    document.querySelector('.loading-screen').classList.add('d-none');
                    document.querySelector('.term_and_condition_div').classList.remove('d-none');
                    document.querySelector('.no-credits-error').classList.add('d-none');
                    document.querySelector('.pay-btn').classList.add('d-none');
                    document.querySelector('.upload-csv-file').classList.add('confirm-successful');
                    document.querySelector('.available-credits').innerHTML = 'Available Credits: <b>' + data.obtained_credits + '</b>';
                } else {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = data.error;
                    errorElement.classList.add('error');
                }
            })
            .catch(error => {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = 'An error occurred. Please try again.';
                errorElement.classList.add('error');
            });
    }

    function updateCredits() {
        
        const costPerCredit = localStorage.getItem('pricePerCredit');
        const amountInput = document.getElementById('amountInput');
        const creditsDisplay = document.getElementById('creditsDisplay');
        const amount = parseFloat(amountInput.value);
        if (!isNaN(amount) && amount > 0) {
            const credits = Math.floor(amount / costPerCredit);
            creditsDisplay.textContent = `Get ${credits} Credits`;
            $('input[name="obtained_credits"]').val(credits);
            $('input[name="total_amount"]').val(amount);
            $('.total-payable').html('Total Amount: $ ' + amount);
        } else {
            creditsDisplay.textContent = 'Credits';
        }
    }
</script>


<script>
    
    $(document).ready(function () {
        
        var user_data=localStorage.getItem('user_details')
        if(!user_data)
    {
        window.location.href = '{{ route('welcome') }}';
    }
    user_data = JSON.parse(user_data);
        var user_id=user_data.id
        var email=user_data.email 
         
    const newUrl = `my-properties/${user_id}`;
    $('.my-properties').attr('href', newUrl);
        $('input[name="card_holder_name"]').val(user_data.name);            
        $('input[name="card_holder_email"]').val(email);            

        //----------------------- AJAX TO GET FILE NO ------------------------//
       
        $.ajax({
            type: 'GET',
            url: '{{route('getUserFileNumber')}}',
            data: {
                'email': email,
                'user_id': user_id,
            },
            contentType: 'application/json',
           
            success: function (response) {
                if(response.status)
            {
                localStorage.setItem('file_no',response.file_no);
                localStorage.setItem('availableCredits',response.userAvailableCredits);
                localStorage.setItem('pricePerCredit',response.pricePerCredit);
                $('.pricePerCreditSpan').text('$ '+response.pricePerCredit+' per credit');
                var last_transaction=response.last_transaction?response.last_transaction.payment_id:'';
                $('input[name="subscription_id"]').val(last_transaction);            
            }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        var csvPropertyIds=[];
        updateBarColor()
        //  const staticPropertyIds = [1, 2,3,4,5,6];
        //  getPropertiesData(staticPropertyIds);
        $('.srapper-error-x-btn, .srapper-error-close-btn').on('click', function () {
            location.reload();
        });
    });

    function showStripe() {
        var amount=$('input[name="amountInput"]').val();
         var totalRowsData=$('input[name="totalRowsData"]').val()
         var obtained_credits=$('input[name="obtained_credits"]').val();
         console.log('totalRowsData ====>',totalRowsData)
         console.log('obtained_credits ====>',obtained_credits)
         console.log('amount ====>',amount)
        if (amount && parseInt(amount) > 0 && parseInt(obtained_credits) >= parseInt(totalRowsData)) {
            $('.pay-as-you-go-div').addClass('d-none')
            $('.stripe-form-div').removeClass('d-none')
        } else {
            $('.invalid-amount').removeClass('d-none')
            setTimeout(() => {
                $('.invalid-amount').addClass('d-none');
            }, 2000);
        }
    }
    function showAmountInput()
    {
        $('.pay-as-you-go-div').removeClass('d-none')
        $('.stripe-form-div').addClass('d-none')
    }
    const availableCredits = localStorage.getItem('availableCredits');
    var totalRowsData = 0;
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const loadingBarContainer = document.getElementById('loading-bar-container');
    const loadingBar = document.getElementById('loading-bar');
    const dataTableContainer = document.querySelector('.show-file-area');
    let totalProperties = 0;
    let csvData = null;

    // Handle drag events
    dropZone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropZone.classList.remove('dragover');

        const files = event.dataTransfer.files;
        if (files.length > 0) {
            if (files[0].type === 'text/csv' || files[0].name.endsWith('.csv')) {
                parseCSV(files[0]).then(parsedData => {
                    csvData = parsedData;
                    showConfirmation();
                }).catch(error => {
                    console.error('Error parsing CSV:', error);
                });
            } else {
                $('#csv-error-modal').modal('show');
            }
        }
    });

    dropZone.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        if (files.length > 0) {
            if (files[0].type === 'text/csv' || files[0].name.endsWith('.csv')) {
                parseCSV(files[0]).then(parsedData => {
                    csvData = parsedData;
                    showConfirmation();
                }).catch(error => {
                    console.error('Error parsing CSV:', error);
                });
            } else {
                $('#csv-error-modal').modal('show');
            }
        }
    });

    async function startProcessing() {
        $('.drop-file-area').addClass('d-none');
        $('#loading-bar-container').removeClass('d-none');
        try {
            totalProperties = csvData.data.length;
            console.log(csvData.data)
            processPropertyData(csvData.data);
        } catch (error) {
            console.error('Error processing CSV:', error);
        }
    }


    const matchedHeaders = ['mail_address', 'mail_city', 'mail_state']; // Required headers
    let headerChanges = {}; // To store selected fields for headers
    let originalHeaders = {}; // Store original CSV headers and their mapped values
    let originalValues = {}; // To store original header values

    function checkIfAllHeadersMatched() {
        const selectedFields = Object.values(headerChanges);
        const allMatched = matchedHeaders.every(header => {
            return selectedFields.includes(header); // Check if all matched headers are selected
        });

        if (allMatched) {
            $('.upload-csv-file').removeAttr('disabled');
        } else {
            $('.upload-csv-file').attr('disabled', true);
        }
    }


    function showConfirmation() {

        const tbody = $('#csv-file-modal tbody');
        tbody.empty();

        let alreadyMappedHeaders = 0;
        var availableCreditsAgain =localStorage.getItem('availableCredits')
        if (csvData) {
            csvData.headers.forEach(header => {
                const isMatched = matchedHeaders.includes(header)
                    ? '<i class="fa-solid fa-circle-check" style="font-size:20px;color:#5cb85c"></i>'
                    : '<i class="fa-solid fa-triangle-exclamation" style="font-size:20px;color:#d9534f"></i>';
                const dataForHeader = csvData.data.slice(0, 2).map(rowData => rowData[header] || '').join('<br>');
                totalRowsData = csvData.data.length;
                // Create table row
                $('.available-credits').html('Available Credits: <b>' + availableCreditsAgain + '</b>')
                $('.total-rows-count').html('Total Data to Search: <b>' + csvData.data.length + '</b> Row(s)')
                $('.total-rows-count-bar').text(csvData.data.length)
                $('.scrapper-completed-total-rows').text(csvData.data.length)
                if(availableCreditsAgain < totalRowsData)
            {
                var requiredCredits=totalRowsData - availableCreditsAgain;
                $('.required-credits').html('Required <b>' + requiredCredits + '</b> Credits More')
            }
                $('.data-row-count').html('File has <b>' + totalRowsData + '</b> row(s)')
                $('input[name="totalRowsData"]').val(totalRowsData);

                $('.total-cost').html('Total Credits: <b>' + csvData.data.length * 1 + '</b>')
                $('.total-amount').html('Total Amount: <b>' + csvData.data.length * 1 + '</b>')
                const row = $('<tr>');
                row.append(`<td class="text-center">${isMatched}</td>`); // Matched status
                row.append(`<td><strong>${header}</strong></td>`); // Header
                row.append(`<td><strong>${dataForHeader}</strong></td>`); // Information
                row.append(`<td>
                <select class="form-select select-field" data-header="${header}">
                    <option disabled selected>Select contact field</option>
                    <option class="mail_address" value="mail_address">Property Address</option>
                    <option class="mail_city" value="mail_city">City</option>
                    <option class="mail_state" value="mail_state">State</option>
                    <option class="Reset d-none" value="Reset">Reset</option>
                </select>
                <span class="selected-field text-success mt-2"></span> <!-- Display selected field -->
                <span class="text-danger ms-2 duplicate-header-error d-none"><strong>Header Already Selected</strong></span>
            </td>`); // Dropdown + Display selected field
                tbody.append(row);

                // Store original value
                originalValues[header] = header;

                // Check if the current header is already a matched header
                if (matchedHeaders.includes(header)) {
                    headerChanges[header] = header;
                    originalHeaders[header] = header;
                    alreadyMappedHeaders++;
                    row.find('.selected-field').text(`Selected: ${header}`);
                    row.find('.select-field').val(header);
                }
            });

            if (alreadyMappedHeaders >= matchedHeaders.length) {

                $('.upload-csv-file').removeAttr('disabled');
            }

            $(document).on('change', '.select-field', function () {
                const selectedField = $(this).val();
                const header = $(this).data('header');
                const row = $(this).closest('tr');

                // Collect all selected fields except the reset
                const allSelectedValues = $('.select-field').map(function () {
                    return $(this).val();
                }).get();

                // Detect duplicate selections
                const hasDuplicate = allSelectedValues.filter(value => value !== 'Reset').length !== new Set(allSelectedValues.filter(value => value !== 'Reset')).size;

                if (hasDuplicate) {
                    $('.upload-csv-file').attr('disabled', true);
                    $(this).siblings('.duplicate-header-error').removeClass('d-none');
                    row.find('.selected-field').text('');
                } else {
                    $(this).siblings('.duplicate-header-error').addClass('d-none'); // Hide error if no duplicates
                    $(this).siblings('.selected-field').text(`Selected: ${selectedField}`);
                    headerChanges[header] = selectedField;

                    // Check if selected field is part of matched headers and update the icon accordingly
                    const isMatched = matchedHeaders.includes(selectedField)
                        ? '<i class="fa-solid fa-circle-check" style="font-size:20px;color:#5cb85c"></i>'
                        : '<i class="fa-solid fa-triangle-exclamation" style="font-size:20px;color:#d9534f"></i>';

                    // Update the first <td> in the current row (which contains the icon)
                    row.find('td:first-child').html(isMatched);

                    checkIfAllHeadersMatched(); // Check headers again
                }
            });


        }

        $('#csv-file-modal').modal('show');
    }

    $(document).on('click', '.upload-csv-file', () => {
        csvVerificationStepTwo()
        // $('#csv-file-modal').modal('hide');
        // startProcessing();
    });
    function csvVerificationStepTwo() {
        var availableCreditsTwice=localStorage.getItem('availableCredits')
        $('.step-csv-one').addClass('d-none');
        $('.step-csv-two').removeClass('d-none');
        if (availableCreditsTwice >= totalRowsData) {
            $('.term_and_condition_div').removeClass('d-none')
            $('.upload-csv-file').attr('disabled', true);
            $('.upload-csv-file').addClass('confirm-successful')
        } else {
            $('.no-credits-error').html('No Enough Credits to proccess this file')
            $('.pay-btn').removeClass('d-none')
            $('.upload-csv-file').attr('disabled', true);
        }

    }

    $(document).on('click', '.confirm-successful', () => {
        $('#csv-file-modal').modal('hide');
        startProcessing();
    });



    // Update loading bar progress
    function updateLoadingBar(percent) {
        loadingBar.style.width = percent + '%';
        loadingBar.textContent = percent + '%';
    }

    // Parse CSV file to JSON
    function parseCSV(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsText(file);
            reader.onload = function (event) {
                const csvData = event.target.result;
                const parsedData = csvToJson(csvData);
                resolve(parsedData);
            };
            reader.onerror = function () {
                reject('Error reading file');
            };
        });
    }

    // Convert CSV string to JSON
function csvToJson(csvData) {
    const lines = csvData.split('\n').map(line => line.trim()).filter(line => line.length > 0);
    const headers = lines[0].split(',').map(header => header.trim());
    const data = [];

    for (let i = 1; i < lines.length; i++) {
        const dataLine = lines[i].split(',').map(cell => cell.trim());
        
        // Check for empty cells
        if (dataLine.some(cell => cell === '')) {
            console.log(`Row ${i + 1} data is missing, so the row is removed: ${JSON.stringify(dataLine)}`); // Log removed row
            continue; // Skip this row if any cell is empty
        }

        const obj = {};
        headers.forEach((header, index) => {
            obj[header] = dataLine[index] || '';
        });
        data.push(obj);
    }

    return { headers, data };
}


    function processPropertyData(data) {
    const url = "{{route('upload-property-data')}}";
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let processedCount = 0;
    const insertedPropertyIds = [];
    let stopProcess = false;
    var fileNumber = localStorage.getItem('file_no');

    // Determine if headers meet requirements
    const requiredHeaders = ['mail_address', 'mail_city', 'mail_state'];
    const headersPresent = requiredHeaders.every(header => data.some(property => property.hasOwnProperty(header)));
    var totalCreditsUsed=0;
    // Function to handle data submission
    function submitData(properties, headersUpdated = false) {
        return new Promise((resolve, reject) => { 
            var user_data=localStorage.getItem('user_details')
        user_data = JSON.parse(user_data);
        var user_id=user_data.id 
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: JSON.stringify({ properties, headersUpdated, fileNumber,user_id }), // Send both properties and headersUpdated
                contentType: 'application/json',
                success: function (response) {
                    $('.scrapper-completed').removeClass('d-none');
                            
                    if (response && response.success_message) {
                        if (response.success_message === "Success") {
                            $('.loadind-text').text('Processing');
                            $('.credit-value-text').text(response.creditsPercentage);
                            $('.credit-value-bar').css('width', response.creditsPercentage);
                            $('.update-user-credits').text(response.newCredits);
                            $('.scrapper-completed-status').removeClass('badge bg-warning');
                            $('.scrapper-completed-status').addClass('badge bg-primary');
                            $('.scrapper-completed-status').text('Processing...');
                            
                            insertedPropertyIds.push(response.property_id);

                        }
                        if (response.success_message === "Skipping") {
                            $('.loadind-text').text('Duplicate');
                            $('.scrapper-completed-status').addClass('badge bg-warning');
                            $('.scrapper-completed-status').text('Duplicate');
                        }
                        processedCount++;
                        $('.completed-rows-count-bar').text(processedCount)
                       // console.log(processedCount);
                    //    insertedPropertyIds.push(response.property_id);
                        const percent = Math.round((processedCount / totalProperties) * 100);
                        updateLoadingBar(percent);
                        if (percent === 100) {
                            if (!stopProcess) {
                            if (insertedPropertyIds.length == 0) {
                                $('#loading-bar-container').addClass('d-none');
                                $('.scrapper-completed').addClass('d-none');
                                $('#error-property-modal').modal('show');

                                return;
                            }else{
                        
                              setTimeout(() => {
                                $('.progress-bar').removeClass('progress-bar-striped progress-bar-animated')
                            $('.progress-bar').css('background-color','#29d259')
                            $('.loadind-text').css('color','#29d259').text('Completed');
                            //$('.scrapper-completed').removeClass('d-none');
                            $('.scrapper-completed-status').removeClass('badge bg-warning');
                            $('.scrapper-completed-status').removeClass('badge bg-primary');
                            $('.scrapper-completed-status').addClass('badge bg-success');
                            $('.scrapper-completed-status').text('Completed');
                            $('.scrapper-completed-button').removeClass('d-none');
                            

                            }, 1000);
                        }
                    }
                            //-------- this will show scrapped properties --------//
                            // setTimeout(() => {
                            //     $('#loading-bar-container').addClass('d-none');
                            //     csvPropertyIds = insertedPropertyIds;
                            //     getPropertiesData(insertedPropertyIds);
                            // }, 500);
                        }
                    }
                    if (response && response.file_error) {
                        stopProcess = true;
                        $('#csv-header-error-modal').modal('show');
                        reject(new Error("File error")); // Reject promise
                        return;
                    }
                    if (response && response.error_message) {
                        if (!stopProcess) {
                            $('#credits-error-modal').modal('show');
                            if (insertedPropertyIds.length > 0) {
                                $('#loading-bar-container').addClass('d-none');
                                getPropertiesData(insertedPropertyIds);
                                return;
                            }
                        }
                        stopProcess = true;
                        $('#loading-bar-container').addClass('d-none');
                        $('.drop-file-area').removeClass('d-none');
                        $('.show-file-area').addClass('d-none');
                        reject(new Error("Error message received")); // Reject promise
                        return;
                    }
                    resolve(); // Resolve promise on success
                },
                error: function (xhr, status, error) {
                    console.error('Error uploading data:', error);
                    stopProcess = true;
                    $('#scrapper-error-modal').modal('show');
                    reject(new Error("AJAX error")); // Reject promise
                }
            });
        });
    }

    // Function to process properties with delay
    async function processProperties(properties) {
        for (const property of properties) {
            if (stopProcess) {
                return;
            }

            let updatedProperty = { ...property };

            // Replace headers using the headerMappings if headers need updating
            if (!headersPresent) {
                Object.keys(headerChanges).forEach(originalHeader => {
                    const newHeader = headerChanges[originalHeader];
                    if (updatedProperty.hasOwnProperty(originalHeader)) {
                        updatedProperty[newHeader] = updatedProperty[originalHeader];
                        delete updatedProperty[originalHeader]; // Remove the old header
                    }
                });
            }

            // Ensure all headers, including those not updated, are preserved
            const allHeaders = Object.keys(property);
            allHeaders.forEach(header => {
                if (!updatedProperty.hasOwnProperty(header)) {
                    updatedProperty[header] = property[header];
                }
            });

            // Submit each property and wait for completion
            try {
                await submitData(updatedProperty, !headersPresent); // Wait for the promise to resolve
                await new Promise(resolve => setTimeout(resolve, 300)); // 3-second delay
            } catch (error) {
                console.error(error);
                break; // Stop processing on error
            }
        }
    }

    // Start processing properties
    processProperties(data);
}


    function decodeHtmlEntities(text) {
        const textArea = document.createElement('textarea');
        textArea.innerHTML = text;
        return textArea.value;
    }
    $('.upload-again').on('click', function () {
        location.reload();
    });
    $('.export-current-csv').on('click', function () {
        exportCurrentCsv(csvPropertyIds)
    });

    function exportCurrentCsv(csvPropertyIds)
    {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const url = "{{ route('export-current-properties') }}";
        const insertedPropertyIds = csvPropertyIds;
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                property_ids: insertedPropertyIds
            },
            success: function (response, status, xhr) {
            // Get filename from the 'Content-Disposition' header
            const disposition = xhr.getResponseHeader('Content-Disposition');
            let filename = "export.csv";  // Default filename if header is not set

            if (disposition && disposition.indexOf('filename=') !== -1) {
                filename = disposition.split('filename=')[1].replace(/['"]/g, '');
            }

            // Create a blob from the response and trigger download
            const blob = new Blob([response], { type: 'text/csv' });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;  // Use the filename from the header
            document.body.appendChild(link);
            link.click();  // Trigger the download
            document.body.removeChild(link);  // Clean up after download
        },
        error: function (xhr, status, error) {
            console.error('CSV export failed:', error);
        }
        });
    }

    function getPropertiesData(insertedPropertyIds) {
        const url = "{{ route('request-property-data') }}";
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                property_ids: insertedPropertyIds
            },
            success: function (response) {
                if (response && response.error_message) {
                    //alert(response.error_message);
                    $('#error-property-modal').modal('show')
                    //location.reload();
                } else {
                    $('.show-file-area').removeClass('d-none');
                    $('.upload-again').removeClass('d-none');
                    $('.export-current-csv').removeClass('d-none');
                    $('.credit-value-text').text(response.creditsPercentage);
                    $('.credit-value-bar').css('width', response.creditsPercentage);
                    updateBarColor();

                    const table = $('.sampleTable').DataTable();
                    table.clear();

                    // Expand rows for each personal detail entry and include first_name, last_name
                    response.properties.forEach((property, index) => {
                        const decodedDetails = decodeHtmlEntities(property.personal_details);
                        let personalDetails = [];

                        try {
                            personalDetails = JSON.parse(decodedDetails) || [];
                        } catch (e) {
                            console.error('Error parsing personal_details:', e);
                        }

                        // If there are personal details, create separate rows for each entry
                        if (personalDetails.length > 0) {
                            personalDetails.forEach((detail) => {
                                const actionHtml = `
                                <a class="dropdown-item toggle-details-btn" data-index="${index}" href="#">
                                    <span class="toggle-text"><i class="fa-solid fa-eye"></i> View</span>
                                </a>
                            `;

                                // Add a row for each personal detail, including first_name and last_name
                                table.row.add([
                                    detail.first_name || 'N/A',          // First Name
                                    detail.last_name || 'N/A',           // Last Name
                                    property.property_address,           // Property Address
                                    property.property_city,              // Property City
                                    property.mail_state,                 // Mail State
                                    property.mail_zip,                   // Mail Zip
                                    actionHtml                          // Action (View button)
                                ]).draw();
                            });
                        } else {
                            // If no personal details, add one row with no details
                            const actionHtml = `
                            <a class="dropdown-item toggle-details-btn" data-index="${index}" href="#">
                                <span class="toggle-text"><i class="fa-solid fa-eye"></i> View</span>
                            </a>
                        `;

                            // Add a row without personal details
                            table.row.add([
                                'N/A',                    // No First Name
                                'N/A',                    // No Last Name
                                property.property_address,
                                property.property_city,
                                property.mail_state,
                                property.mail_zip,
                                actionHtml
                            ]).draw();
                        }
                    });

                    // Event handler for the toggle-details-btn
                    $('.sampleTable').on('click', '.toggle-details-btn', function (e) {
                        e.preventDefault();
                        const index = $(this).data('index');

                        let personalDetailsTable = '';

                        try {
                            const decodedDetails = decodeHtmlEntities(response.properties[index].personal_details);
                            const personalDetails = JSON.parse(decodedDetails) || [];

                            if (personalDetails.length > 0) {
                                personalDetailsTable = `
                                <div class="mini-table-container">
                                    <table class="table mini-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Best Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${personalDetails.map(detail => `
                                                <tr>
                                                    <td>${(detail.first_name || 'N/A') + ' ' + (detail.last_name || 'N/A')}</td>
                                                    <td>${detail.best_phone || 'N/A'}</td>
                                                </tr>`).join('')}
                                        </tbody>
                                    </table>
                                </div>`;
                            } else {
                                personalDetailsTable = '<p>No personal details available.</p>';
                            }
                        } catch (e) {
                            console.error('Error parsing personal_details:', e);
                            personalDetailsTable = '<p>Error parsing details.</p>';
                        }

                        // Insert mini table or message into modal content
                        $('#modalContent').html(personalDetailsTable);

                        // Open the modal
                        $('#detailsModal').modal('show');
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }

    // Function to decode HTML entities
    function decodeHtmlEntities(text) {
        const textArea = document.createElement('textarea');
        textArea.innerHTML = text;
        return textArea.value;
    }


    function updateBarColor() {
        var valueText = $('.credit-value-text').text();
        valueText = valueText.replace('%', '');
        valueText = parseFloat(valueText);
        //console.log(valueText);
        if (valueText < 50) {
            $('.credit-value-text').css('color', '#5CB85C')
            $('.inner-line').css('background-color', '#5CB85C')
        } else if (valueText >= 50 && valueText < 80) {
            $('.credit-value-text').css('color', '#F7C600')
            $('.inner-line').css('background', '#F7C600')
        } else if (valueText >= 80 && valueText <= 99.9) {
            $('.credit-value-text').css('color', 'orange')
            $('.inner-line').css('background', 'orange')
        } else if (valueText >= 100) {
            $('.credit-value-text').css('color', '#D9534F')
            $('.inner-line').css('background', '#D9534F')
        }
    }
</script>


</body>

</html>
@stop