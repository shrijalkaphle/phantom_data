@extends('layouts.aside')
@section('content')
<h2 class="main-title d-block d-lg-none">Change Password</h2>

				<div class="bg-white card-box border-20">
                        <div class="row">
                            <div class="col-12">
                                <div class="dash-input-wrapper mb-20">
                                    <label for="currentPassword">Old Password*</label>
                                    <span class="text-danger currentPassword-error d-none"><b>Old Password Required</b></span>
                                    <span class="text-danger incorrect-password-error d-none"><b>Password Incorrect</b></span>
                                    <input name="currentPassword" type="password" placeholder="Type current password">
                                </div>
                                <!-- /.dash-input-wrapper -->
                            </div>
                            <div class="col-12">
                                <div class="dash-input-wrapper mb-20">
                                    <label for="newPassword">New Password*</label>
                                    <span class="text-danger newPassword-error d-none"><b>New Password Required</b></span>
                                    <span class="text-danger newPassword-length-error d-none"><b>Password must be at least 8 characters long</b></span>
                                    <input name="newPassword" type="password" placeholder="Confirm your new password">
                                </div>
                                <!-- /.dash-input-wrapper -->
                            </div>
							<div class="col-12">
                                <div class="dash-input-wrapper mb-20">
                                    <label for="">Confirm Password*</label>
                                    <span class="text-danger confirmPassword-error d-none"><b>Confirm Your Password</b></span>
                                    <span class="text-danger password-match-error d-none"><b>Password Not Match</b></span>
                                    
                                    <input name="confirmPassword" type="password" placeholder="Confirm your new password">
                                </div>
                                <!-- /.dash-input-wrapper -->
                            </div>
                        </div>

                        <div class="button-group d-inline-flex align-items-center">
                            <button class="dash-btn-two tran3s update-password-btn">
                                    <span class="btn-text">Save & Updated</span>
                                    <span class="btn-loader d-none"><i class="fa-solid fa-spinner fa-spin-pulse"></i></span>
                            </button>
                        </div>	
                
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
        $(document).ready(function () {
            $(".update-password-btn").click(function () {
                validateData();
            });
            function validateData() {

                
				var currentPassword = $('input[name="currentPassword"]').val();
				var newPassword = $('input[name="newPassword"]').val();
				var confirmPassword = $('input[name="confirmPassword"]').val();
               

                if ( currentPassword && newPassword && newPassword.length>=8 && confirmPassword && newPassword == confirmPassword) {
                    submitContactForm();
                } else {

                   

                    if (currentPassword == "") {
                        $(".currentPassword-error").removeClass('d-none')
                        setTimeout(function () {
                            $(".currentPassword-error").addClass('d-none');
                        }, 5000);

                    } 

                    if (newPassword == "") {
                        $(".newPassword-error").removeClass('d-none')
                        setTimeout(function () {
                            $(".newPassword-error").addClass('d-none');
                        }, 5000);

                    }else if(newPassword.length <8)
					{
						$(".newPassword-length-error").removeClass('d-none')
                        setTimeout(function () {
                            $(".newPassword-length-error").addClass('d-none');
                        }, 5000);
					}
                    if (confirmPassword == "") {
                        $(".confirmPassword-error").removeClass('d-none')
                        setTimeout(function () {
                            $(".confirmPassword-error").addClass('d-none');
                        }, 5000);

                    }else if(newPassword != confirmPassword){
                        $(".password-match-error").removeClass('d-none')
                        setTimeout(function () {
                            $(".password-match-error").addClass('d-none');
                        }, 5000);
                    }
					

                }

            }
            function isValidEmail(email) {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function submitContactForm() {
                $('.update-password-btn').prop('disabled', true);
				$('.btn-text').addClass('d-none');
                $('.btn-loader').removeClass('d-none');


                var token = $('meta[name="csrf-token"]').attr('content');
                var user_id ={{$user->id}};
                var currentPassword = $('input[name="currentPassword"]').val();
				var newPassword = $('input[name="newPassword"]').val();
				var confirmPassword = $('input[name="confirmPassword"]').val();

                var jsonData = JSON.stringify({
                    'user_id':user_id,
                    'currentPassword': currentPassword,
                    'newPassword': newPassword,
                    'confirmPassword': confirmPassword,
                });

                console.log(jsonData);
				$.ajax({
                    type: 'POST',
                    url: '{{route('update-password')}}',
                    data: jsonData,
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function (response) {
                        if (response.success) {	
							window.location.href = '{{route('account-setting',['user_id'=>$user->id])}}';
                        }
						if(response.incorrectPassword)
						{
							$(".incorrect-password-error").removeClass('d-none')
                        setTimeout(function () {
                            $(".incorrect-password-error").addClass('d-none');
                        }, 5000);
                        $('.update-password-btn').prop('disabled', false);
                        $('.btn-text').removeClass('d-none');
                        $('.btn-loader').addClass('d-none');
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