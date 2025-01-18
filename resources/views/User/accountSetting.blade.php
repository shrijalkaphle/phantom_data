@extends('layouts.aside')
@section('content')
<div class="position-relative">
<h2 class="main-title d-block d-lg-none">Account Settings</h2>

<div class="bg-white card-box border-20">
    <h4 class="dash-title-three">Edit & Update</h4>

        <div class="row">
            <div class="col-lg-6">
                <div class="dash-input-wrapper mb-20">
                    <label for="">First Name <span class="text-danger name-error d-none"><b>Name Required</b></span></label>

                    <input type="hidden" placeholder="First Name" name="user_id" value="{{$user->id}}">
                    <input type="text" placeholder="First Name" name="name" value="{{$user->name}}">
                </div>
                <!-- /.dash-input-wrapper -->
            </div>
            <div class="col-lg-6">
                <div class="dash-input-wrapper mb-20">
                    <label for="">Last Name <span class="text-danger last_name-error d-none"><b>Last Name Required</b></span></label>
                    <input type="text" placeholder="Enter Last Name" name="last_name" value="{{$user->last_name}}">
                </div>
                <!-- /.dash-input-wrapper -->
            </div>
            <div class="col-12">
                <div class="dash-input-wrapper mb-20">
                    <label for="">Email
                         <span class="text-danger email-error d-none"><b>Email Required</b></span>
                         <span class="text-danger email-regex-error d-none"><b>Email Not Valid</b></span>
                        </label>
                    <input type="email" placeholder="Enter Email" name="email" value="{{$user->email}}" disabled>
                </div>
                <!-- /.dash-input-wrapper -->
            </div>
            <div class="col-12">
                <div class="dash-input-wrapper mb-20">
                    <label for="">Phone Number 
                        <span class="text-danger phone-error d-none"><b>Phone Number Required</b></span>
                        <span class="text-danger phone-digit-error d-none"><b>Phone Number Not Valid</b></span>
                        <span class="text-danger phone-regex-error d-none"><b>Phone Number Incorrect</b></span>
                </label>
                    <input type="tel" placeholder="+810 321 889 021" name="phone" value="{{$user->phone}}" id="phone">
                </div>
                <!-- /.dash-input-wrapper -->
            </div>
            <div class="col-12">
                <div class="dash-input-wrapper mb-20">
                    <label for="">Password
                    <span class="text-danger password-error d-none"><b>Password Required</b></span>
                    <span class="text-danger incorrect-password-error d-none"><b>Incorrect Password</b></span>
                    </label>
                    <input type="password" name="password" >

                    <div class="info-text d-sm-flex align-items-center justify-content-between mt-5">
                        <p class="m0">Want to change the password? <a href="{{route('password-update',['user_id'=>$user->id])}}">Click here</a></p>
                        <a href="{{route('password-update',['user_id'=>$user->id])}}" class="chng-pass">Change Password</a>
                    </div>
                </div>
                <!-- /.dash-input-wrapper -->
            </div>
        </div>

        <div class="button-group d-inline-flex align-items-center mt-30">
            <button class="dash-btn-two tran3s me-3 update-account-setting">Save</button>
            <a href="{{route('dashboard')}}" class="dash-cancel-btn tran3s">Cancel</a>
        </div>	

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
 
            $(document).ready(function () {
                $('#phone').inputmask('+1 999 999 9999', {
                    showMaskOnFocus: true,
                    showMaskOnHover: false,
                    numericInput: false
                });

                $(".update-account-setting").click(function () {
                    validateData();
                });

                function validateData() {
                    var user_id = $('input[name="user_id"]').val();
                    var name = $('input[name="name"]').val();
                    var last_name = $('input[name="last_name"]').val();
                    var phone = $('input[name="phone"]').val();
                    var email = $('input[name="email"]').val();
                    var password = $('input[name="password"]').val();
                    var phoneRegex = /^[+\d\s()-]+$/;

                    if (user_id && name && last_name && phone && phone.length == 15 && phone.match(phoneRegex) && email && isValidEmail(email) && password) {
                        submitContactForm();
                    } else {

                        if (name == "") {
                            $(".name-error").removeClass('d-none')
                            setTimeout(function () {
                                $(".name-error").addClass('d-none');
                            }, 5000);

                        }
                        if (last_name == "") {
                            $(".last_name-error").removeClass('d-none')
                            setTimeout(function () {
                                $(".last_name-error").addClass('d-none');
                            }, 5000);

                        }
                        if (phone === "") {
                            $(".phone-error").removeClass('d-none');
                            setTimeout(function () {
                                $(".phone-error").addClass('d-none');
                            }, 5000);
                        } else if (phone.length != 15) {
                            $(".phone-digit-error").removeClass('d-none');
                            setTimeout(function () {
                                $(".phone-digit-error").addClass('d-none');
                            }, 5000);
                        } else if (!phone.match(phoneRegex)) {
                            $(".phone-regex-error").removeClass('d-none');
                            setTimeout(function () {
                                $(".phone-regex-error").addClass('d-none');
                            }, 5000);
                        }

                        if (email == "") {
                            $(".email-error").removeClass('d-none')
                            setTimeout(function () {
                                $(".email-error").addClass('d-none');
                            }, 5000);

                        } else if (!isValidEmail(email)) {
                            $(".email-regex-error").removeClass('d-none');
                            setTimeout(function () {
                                $(".email-regex-error").addClass('d-none');
                            }, 5000);
                        }
                        if (password == "") {
                            $(".password-error").removeClass('d-none')
                            setTimeout(function () {
                                $(".password-error").addClass('d-none');
                            }, 5000);

                        } 
                       

                    }

                }

                function isValidEmail(email) {
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }

                function submitContactForm() {
                    $('.submit-form').prop('disabled', true);
                    var token = $('meta[name="csrf-token"]').attr('content');
                    var user_id = $('input[name="user_id"]').val();
                    var name = $('input[name="name"]').val();
                    var last_name = $('input[name="last_name"]').val();
                    var phone = $('input[name="phone"]').val();
                    var email = $('input[name="email"]').val();
                    var password = $('input[name="password"]').val();
                    

                    var jsonData = JSON.stringify({
                        'user_id': user_id,
                        'name': name,
                        'last_name': last_name,
                        'phone': phone,
                        'email': email,
                        'password': password,
                    });

                    console.log(jsonData)
                    $.ajax({
                        type: 'POST',
                        url: '{{route('update-account-setting')}}',
                        data: jsonData,
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function (response) {
                        if(response.incorrectPassword){
                            $(".incorrect-password-error").removeClass('d-none')
                            setTimeout(function () {
                                $(".incorrect-password-error").addClass('d-none');
                            }, 5000);
                        }
                        if (response.success) {
                            $('input[name="password"]').val("");
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Profile Updated !',
                                });
                            }
                           
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }


            });

    </script>
@stop