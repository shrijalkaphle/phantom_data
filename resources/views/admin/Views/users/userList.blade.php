@extends('admin.layouts.aside')
@section('content')
    <style>
        .height-680 {
            height: 680px;
        }

        .dataTables_filter {
            display: flex;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-bottom: 2px solid #A020F0;
            border-top: 0px;
            border-left: 0px solid #A020F0;
            border-right: 0px solid #A020F0;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <div class="bg-white card-box p0 border-20 mt-20 mb-50 show-file-area">
        <div class="table-responsive pt-25 pb-25 pe-4 ps-4">
            <table id="websitesTable" class="table property-list-table sampleTable justify-content-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Subscription</th>
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody class="border-0">
                    <!-- DataTables will populate this section -->
                </tbody>
            </table>
        </div>
    </div>



    <!-- Full-page Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bg-white card-box p0 border-20 mt-20 mb-50 show-file-area">
                        <div class="table-responsive pt-25 pb-25 pe-4 ps-4">
                            <table id="userDetailsTable" class="table table-striped">
                                <thead>
                                    <tr>

                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Property</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!------------------------------   ADD CREDITS      ------------------------------------>

    <!-- Add Credits Modal -->
    <div class="modal fade" id="addCreditsModal" tabindex="-1" aria-labelledby="addCreditsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md"> <!-- Added modal-lg class for large modal -->
            <div class="modal-content" style="background-color: #FFFFFF;"> <!-- Custom background color -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addCreditsModalLabel">Add Credits</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="userId" name="userId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="credits" class="form-label"><span style="font-size:15px">Credits</span></label>
                        <input type="number" class="form-control-sm form-control" id="credits"
                            placehoder="Enter Credits Amount" name="credits" required>
                    </div>
                    <button type="button" class="btn update-credits form-control form-control-sm"><span
                            style="color:#A020F0">Update
                            Credits</span></button>
                </div>
            </div>
        </div>
    </div>

    {{-- delete user modal --}}
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md"> <!-- Added modal-lg class for large modal -->
            <div class="modal-content" style="background-color: #FFFFFF;"> <!-- Custom background color -->
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete user?</p>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="userId" name="userId" readonly>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn form-control form-control-sm"
                            data-bs-dismiss="modal" aria-label="Close"><span>Cancel</span></button>
                        <button type="button" class="btn form-control form-control-sm"><span
                                style="color:#A020F0">Delete</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="credits-update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center mb-20">
                    <i class="fa-solid fa-circle-check" style="font-size:60px;color:#29D259"></i>
                    <br>
                    <span style="font-size:35px;">Success !</span><br>
                    <span>Credits Updated</span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="invalid-credits-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center mb-20">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size:60px;color:#d9534f"></i>
                    <br>
                    <span style="font-size:35px;">Alert!</span><br>
                    <span>Please enter a valid number of credits.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm form-control" data-bs-dismiss="modal">
                        <span style="color:#d9534f">Ok</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label" style="font-size:12px">First Name</label>
                            <span class="name-error d-none" style="font-size:10px;color:#d9534f;font-weight:500"></span>
                            <input type="text" class="form-control form-control-sm" id="firstName" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label" style="font-size:12px">Last Name</label>
                            <span class="last_name-error d-none"
                                style="font-size:10px;color:#d9534f;font-weight:500"></span>
                            <input type="text" class="form-control form-control-sm" id="lastName" name="last_name">

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label" style="font-size:12px">Phone</label>
                        <span class="phone-error d-none" style="font-size:10px;color:#d9534f;font-weight:500"></span>
                        <input type="text" class="form-control form-control-sm" id="phone" name="phone">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-size:12px">Email</label>
                        <span class="email-error d-none" style="font-size:10px;color:#d9534f;font-weight:500"></span>
                        <input type="email" class="form-control form-control-sm" id="email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-size:12px">Password</label>
                        <span class="password-error d-none" style="font-size:10px;color:#d9534f;font-weight:500"></span>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-sm" id="password"
                                name="user_password" autocomplete="off">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword1" style="cursor: pointer;font-size:10px"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label" style="font-size:12px">Confirm Password</label>
                        <span class="confirm-password-error d-none"
                            style="font-size:10px;color:#d9534f;font-weight:500"></span>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-sm" id="confirm_password"
                                name="user_confirm_password" autocomplete="off">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword2" style="cursor: pointer;font-size:10px"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="select-rate" class="form-label" style="font-size:12px">Pas As Yoy Go (Rate)</label>
                        <span class="credits-error d-none" style="font-size:10px;color:#d9534f;font-weight:500"></span>
                        <select id="select-rate" class="form-select form-select-sm" name="credits_rate"
                            style="font-size:12px">
                            <option value="" selected disabled>Select Credits Rate</option>
                            <option value="0.02">$ 0.02</option>
                            <option value="0.03">$ 0.03</option>
                            <option value="0.04">$ 0.04</option>
                            <option value="0.05">$ 0.05</option>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-one-sm form-control create-user"><span
                                style="color:#a020f0">Create
                                User</span></button>
                        <!-- <button type="button"  data-bs-dismiss="modal" class="btn btn-sm form-control"><span style="color:#d9534f">Cancel</span></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user-created-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center mb-20">
                    <i class="fa-solid fa-circle-check" style="font-size:60px;color:#29D259"></i>
                    <br>
                    <span style="font-size:35px;">Success !</span><br>
                    <span>User Created</span>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="userUpdatedSuccess" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center mb-20">
                    <i class="fa-solid fa-circle-check" style="font-size:60px;color:#29D259"></i>
                    <br>
                    <span style="font-size:35px;">Success !</span><br>
                    <span>User Updated</span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="user_info_id" value="" />
                        <label for="email" class="form-label" style="font-size:12px">Email</label>
                        <span class="email-error d-none" style="font-size:10px;color:#d9534f;font-weight:500"></span>
                        <input type="email" readonly class="form-control form-control-sm" id="email"
                            name="email">
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="username" class="form-label" style="font-size:12px">Username</label>
                            <input type="text" class="form-control form-control-sm" id="username" name="username">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_phone" class="form-label" style="font-size:12px">Phone</label>
                        <span class="edit-phone-error d-none">Invalid Phone Number</span>
                        <input type="text" class="form-control form-control-sm" id="edit_phone" name="edit_phone">
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label" style="font-size:12px">Position*</label>
                        <br>
                        <select class="form-select-sm form-control" name="position">
                            <option disabled selected value="">Select Position</option>
                            <option value="Agent">Agent</option>
                            <option value="Agency">Agency</option>
                        </select>
                    </div>

                    <div class="mb-3 update-credit-div d-none">
                        <label for="user_source" class="form-label" style="font-size:12px">Credits (Rate)</label>
                        <br>
                        <select class="form-select-sm form-control" name="user_source">
                            <option disabled selected value="">Select Credits Rate</option>
                            <option value="0.02">0.02</option>
                            <option value="0.03">0.03</option>
                            <option value="0.04">0.04</option>
                            <option value="0.05">0.05</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm border border-primary edit-user-btn"><span
                                style="color:#a020f0">Update
                                User</span></button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm border border-danger">
                            <span style="color:#d9534f">Cancel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="edit-phone-error" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center mb-20">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size:60px;color:#d9534f"></i>
                    <br>
                    <span style="font-size:35px;">Error !</span><br>
                    <span>Invalid Phone Number</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        document.getElementById('togglePassword1').addEventListener('click', function(e) {
            const passwordInput = document.getElementById('password');
            const icon = e.target;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        document.getElementById('togglePassword2').addEventListener('click', function(e) {
            const confirmPasswordInput = document.getElementById('confirm_password');
            const icon = e.target;
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#phone').inputmask('+1 999 999 9999', {
                showMaskOnFocus: true,
                showMaskOnHover: false,
                numericInput: false
            });
            $('#edit_phone').inputmask('+1 999 999 9999', {
                showMaskOnFocus: true,
                showMaskOnHover: false,
                numericInput: false
            });
            getAllUsers();
            $(".create-user").click(function() {
                validateDataStepOne();

            });

        });

        function getAllUsers() {

            if ($.fn.DataTable.isDataTable('#websitesTable')) {
                $('#websitesTable').DataTable().clear().destroy();
            }

            $('#websitesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('get-users-data') }}',
                columns: [

                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: 'credit',
                        name: 'credit',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: 'subscription',
                        name: 'subscription',
                        render: function(data, type, row) {
                            if (!data.monthly_subscription) {
                                return "No Transaction";
                            } else if (data.monthly_subscription == 1) {
                                if (data.amount == 120) {
                                    return '<div style="background-color:#D0F3DA;color:#29A54C;width:70px;text-align:center;border-radius:20px"><span>Active</span></div>';
                                } else if (data.amount == 499) {
                                    return '<div style="background-color:#D0F3DA;color:#29A54C;width:70px;text-align:center;border-radius:20px"><span>Active</span></div>';
                                } else if (data.amount == 999) {
                                    return '<div style="background-color:#D0F3DA;color:#29A54C;width:70px;text-align:center;border-radius:20px"><span>Active</span></div>';
                                } else if (data.amount == 1999) {
                                    return '<div style="background-color:#D0F3DA;color:#29A54C;width:70px;text-align:center;border-radius:20px"><span>Active</span></div>';
                                } else if (data.amount == 3499) {
                                    return '<div style="background-color:#D0F3DA;color:#29A54C;width:70px;text-align:center;border-radius:20px"><span>Active</span></div>';
                                } else if (data.amount == 4999) {
                                    return '<div style="background-color:#D0F3DA;color:#29A54C;width:70px;text-align:center;border-radius:20px"><span>Active</span></div>';
                                }
                            } else {
                                return '<div style="background-color:#f4bcbc;color:#d11f1f;width:70px;text-align:center;border-radius:20px"><span>Inactive</span></div>';
                            }
                        }
                    },
                    {
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {

                            return '<div class="action-dots float-center">' +
                                '<button class="action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">' +
                                '<span></span>' +
                                '</button>' +
                                '<ul class="dropdown-menu dropdown-menu-end">' +
                                '<li><a class="dropdown-item view-user" href="#" data-id="' + row.id +
                                '"><img src="{{ url('web/assets/dashboard/images/icon/icon_18.svg') }}" alt="" class="lazy-img">Properties</a></li>' +
                                '<li><a class="dropdown-item add-credits" href="#" data-id="' + row.id +
                                '"><img src="{{ url('web/assets/dashboard/images/icon/icon_20.svg') }}" alt="" class="lazy-img">Add credits</a></li>' +
                                '<li><a class="dropdown-item edit-user" href="#" data-id="' + row.id +
                                '"><img src="{{ url('web/assets/dashboard/images/icon/icon_28.svg') }}" alt="" class="lazy-img">Edit</a></li>' +
                                '<li><a class="dropdown-item delete-user" href="#" data-id="' + row.id +
                                '"><img src="{{ url('web/assets/dashboard/images/icon/icon_29.svg') }}" alt="" class="lazy-img">Delete</a></li>' +
                                '</ul>' +
                                '</div>';
                        }
                    }
                ]
            });
        }

        function registerUser() {
            var token = $('meta[name="csrf-token"]').attr('content');
            var name = $('input[name="name"]').val();
            var last_name = $('input[name="last_name"]').val();
            var phone = $('input[name="phone"]').val();
            var email = $('input[name="email"]').val();
            var password = $('input[name="user_password"]').val();
            var credits_rate = $('select[name="credits_rate"]').val();

            var jsonData = JSON.stringify({
                'name': name,
                'last_name': last_name,
                'phone': phone,
                'email': email,
                'credits_rate': credits_rate,
                'password': password,
            });

            //console.log(jsonData)
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.add-user') }}',
                data: jsonData,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {

                    $('#user-created-modal').modal('show')
                    $('input[name="name"]').val('');
                    $('input[name="last_name"]').val('');
                    $('input[name="phone"]').val('');
                    $('input[name="email"]').val('');
                    $('input[name="user_password"]').val('');
                    $('input[name="user_confirm_password"]').val('');
                    $('#userModal').modal('hide')
                    $('#addCreditsModal').modal('hide');
                    setTimeout(function() {
                        $('#user-created-modal').modal('hide');
                        location.reload();
                    }, 1000);

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function validateDataStepOne() {
            var phoneRegex = /^[+\d\s()-]+$/;
            var name = $('input[name="name"]').val();
            var last_name = $('input[name="last_name"]').val();
            var phone = $('input[name="phone"]').val();
            var email = $('input[name="email"]').val();
            var credits_rate = $('select[name="credits_rate"]').val();
            var password = $('input[name="user_password"]').val();
            var confirm_password = $('input[name="user_confirm_password"]').val();


            if (name && last_name && phone && phone.length == 15 && phone.match(phoneRegex) && email && isValidEmail(
                    email) && password && password.length >= 8 && confirm_password && password == confirm_password &&
                credits_rate) {
                // submitContactForm();
                validateEmailFromDataBase()


            } else {

                if (name == "") {
                    $(".name-error").removeClass('d-none')
                    $(".name-error").text('First Name is required.')
                    setTimeout(function() {
                        $(".name-error").addClass('d-none');
                    }, 5000);
                }

                if (last_name == "") {
                    $(".last_name-error").removeClass('d-none')
                    $(".last_name-error").text('Last Name is required.')
                    setTimeout(function() {
                        $(".last_name-error").addClass('d-none');
                    }, 5000);
                }

                if (phone === "") {
                    $(".phone-error").removeClass('d-none');
                    $(".phone-error").text('Phone Number is required.')
                    setTimeout(function() {
                        $(".phone-error").addClass('d-none');
                    }, 5000);
                } else if (phone.length != 15) {
                    $(".phone-error").removeClass('d-none');
                    $(".phone-error").text('Phone Number is invalid.')
                    setTimeout(function() {
                        $(".phone-error").addClass('d-none');
                    }, 5000);
                } else if (!phone.match(phoneRegex)) {
                    $(".phone-error").removeClass('d-none');
                    $(".phone-error").text('Phone Number is invalid (REGEX).')
                    setTimeout(function() {
                        $(".phone-error").addClass('d-none');
                    }, 5000);
                }

                if (email == "") {
                    $(".email-error").removeClass('d-none')
                    $(".email-error").text('Email is required.')
                    setTimeout(function() {
                        $(".email-error").addClass('d-none');
                    }, 5000);
                } else if (!isValidEmail(email)) {
                    $(".email-error").removeClass('d-none')
                    $(".email-error").text('Email is Not Valid.')
                    setTimeout(function() {
                        $(".email-error").addClass('d-none');
                    }, 5000);
                }

                if (password == "") {
                    $(".password-error").removeClass('d-none')
                    $(".password-error").text('Password is required')
                    setTimeout(function() {
                        $(".password-error").addClass('d-none');
                    }, 5000);

                } else if (password.length < 8) {
                    $(".password-error").removeClass('d-none')
                    $(".password-error").text('Password is too short.Atleast 8 charecters')
                    setTimeout(function() {
                        $(".password-error").addClass('d-none');
                    }, 5000);
                }
                if (confirm_password == "") {
                    $(".confirm-password-error").removeClass('d-none')
                    $(".confirm-password-error").text('Confirm Your Password')
                    setTimeout(function() {
                        $(".confirm-password-error").addClass('d-none');
                    }, 5000);
                } else if (password != confirm_password) {
                    $(".confirm-password-error").removeClass('d-none')
                    $(".confirm-password-error").text('Password not match')
                    setTimeout(function() {
                        $(".confirm-password-error").addClass('d-none');
                    }, 5000);
                }

                if (!credits_rate) {

                    $(".credits-error").removeClass('d-none')
                    $(".credits-error").text('Select credits rate.')
                    setTimeout(function() {
                        $(".credits-error").addClass('d-none');
                    }, 5000);
                }

            }

        }

        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validateEmailFromDataBase() {
            var token = $('meta[name="csrf-token"]').attr('content');
            var email = $('input[name="email"]').val();
            var jsonData = JSON.stringify({
                'email': email,
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('verify-email') }}',
                data: jsonData,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    if (response.success) {
                        registerUser()
                        //console.log('Create User')
                    } else if (response.duplicateEntry) {
                        $(".email-error").removeClass('d-none')
                        $(".email-error").text('Email already registered')
                        setTimeout(function() {
                            $(".email-error").addClass('d-none');
                        }, 5000);

                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).on('click', '.view-user', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');

            // Clear the previous table data
            $('#userDetailsTable').DataTable().clear().destroy();

            // AJAX call to get user properties
            $.ajax({
                url: "{{ route('get-user-properties', ['user_id' => ':userId']) }}".replace(':userId',
                    userId),
                method: 'GET',
                success: function(response) {
                    console.log(response); // Debug the response to check what is returned

                    $('#userDetailsTable').DataTable({
                        data: response.data, // Data should come from the "data" property
                        columns: [{
                                data: 'first_name'
                            },
                            {
                                data: 'last_name'
                            },
                            {
                                data: 'best_phone'
                            },
                            {
                                data: 'property_address'
                            },
                            {
                                data: 'property_city'
                            },
                            {
                                data: 'property_state'
                            },

                        ]
                    });

                    // Show the modal
                    $('#viewModal').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        });


        // Show modal and set user ID
        $(document).on('click', '.add-credits', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            $('#addCreditsModal #userId').val(userId);
            var addCreditsModal = new bootstrap.Modal(document.getElementById('addCreditsModal'));
            addCreditsModal.show();
        });

        $(document).on('click', '.update-credits', function(e) {
            e.preventDefault();
            var user_id = $('input[name="userId"]').val();
            var credits = $('input[name="credits"]').val();
            var token = $('meta[name="csrf-token"]').attr('content');

            // Validate that credits is a positive whole number
            if (!credits || credits <= 0 || !Number.isInteger(parseFloat(credits))) {
                $('#invalid-credits-modal').modal('show')
                return;
            }

            // AJAX POST request
            $.ajax({
                url: '{{ route('admin.update-credits') }}',
                type: 'POST',
                data: {
                    user_id: user_id,
                    credits: credits,
                    token: token,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    // Handle success response
                    //console.log('Success:', response);

                    $('#credits-update-modal').modal('show');
                    $('#addCreditsModal').modal('hide');
                    setTimeout(function() {
                        $('#credits-update-modal').modal('hide');
                        location.reload();
                    }, 1000);

                },
                error: function(error) {
                    // Handle error response
                    console.error('Error:', error);
                    //lert('Failed to add credits. Please try again.');
                }
            });
        });

        $(document).on('click', '.edit-user', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{ route('admin.get-user-info') }}',
                type: 'get',
                data: {
                    user_id: userId,
                    token: token,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    if (response.message === 'success') {
                        var userInfo = response.userInfo;
                        $('input[name="user_info_id"]').val(userInfo.id)
                        $('input[name="email"]').val(userInfo.email)
                        $('input[name="username"]').val(userInfo.user_name)
                        $('input[name="edit_phone"]').val(userInfo.phone)

                        if (userInfo.position === "Agent" || userInfo.position === "Agency") {
                            $('select[name="position"]').val(userInfo.position);
                        } else {
                            $('select[name="position"]').val(''); // Default "Select Position"
                        }

                        if (userInfo.user_source == 'Register') {
                            $('.update-credit-div').addClass('d-none')
                        } else {
                            $('.update-credit-div').removeClass('d-none')
                            if (userInfo.user_source == 0.02 || userInfo.user_source == 0.03 || userInfo
                                .user_source == 0.04 || userInfo.user_source == 0.05) {
                                $('select[name="user_source"]').val(userInfo.user_source);
                            }
                        }
                        $('#editUser').modal('show');
                    } else if (response.message === 'error') {
                        console.log(response.message);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $(document).on('click', '.delete-user', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            $('#deleteUserModal #userId').val(userId);
            var deleteUserModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
            deleteUserModal.show();
        })

        $(document).on('click', '.edit-user-btn', function(e) {
            var phoneRegex = /^[+\d\s()-]+$/;
            e.preventDefault();

            var user_id = $('input[name="user_info_id"]').val();
            var user_name = $('input[name="username"]').val();
            var edit_phone = $('input[name="edit_phone"]').val();
            var position = $('select[name="position"]').val();
            var user_source = $('select[name="user_source"]').val();
            if (edit_phone && !edit_phone.match(phoneRegex)) {
                $('#edit-phone-error').modal('show')
                setTimeout(function() {
                    $('#edit-phone-error').modal('hide');
                }, 3000);
                //alert('Invalid Phone Number ')
            } else {
                var token = $('meta[name="csrf-token"]').attr('content');
                var jsonData = JSON.stringify({
                    'user_id': user_id,
                    'user_name': user_name,
                    'position': position,
                    'phone': edit_phone,
                    'user_source': user_source,
                });
                console.log(jsonData)
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.update-user-info') }}',
                    data: jsonData,
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        if (response.message == 'success') {
                            $('#editUser').modal('hide');
                            $('#userUpdatedSuccess').modal('show')
                            setTimeout(function() {
                                $('#userUpdatedSuccess').modal('hide');
                                location.reload()
                            }, 1000);
                        } else {
                            $('#userUpdatedError').modal('show')
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>


@stop
