@extends('layouts.aside')
@section('content')

<div class="bg-white card-box border-20 mt-40 mb-20">
    <h4 class="dash-title-three">Current Plan</h4>

    <div class="user-avatar-setting d-flex align-items-center mb-30">
       
     @if($last_transaction && $last_transaction->monthly_subscription == 1) 
     @if($last_transaction->amount == 120)
     
     <pre>Individual ($ 0.12 per credit)
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span></pre>
     
     @elseif($last_transaction->amount == 499)
     
     <pre>Pro ($ 0.10 per credit)
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span></pre>
     
     @elseif($last_transaction->amount == 999)

     <pre>Elite ($ 0.05 per credit) 
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>

     @elseif($last_transaction->amount == 1999)

     <pre>Enterprise ($ 0.04 per credit) 
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>
     
     @elseif($last_transaction->amount == 3499)

     <pre>Titanium ($ 0.035 per credit) 
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>
     
     @elseif($last_transaction->amount == 4999)

     <pre>Diamond ($ 0.02 per credit) 
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>

     @endif
     <form id="cancelForm" method="post" action="{{route('cancelSubscription')}}">
        @csrf
        <input type="hidden" name="subscription_id" value="{{$last_transaction->payment_id}}"/>
        <input type="hidden" name="email" value="{{$user->id}}"/>
        <input type="hidden" name="name" value="{{$user->name}}"/>
        <button type="button" class="dash-btn-two tran3s mb-20 cancel-modal" style="margin-left:20px">Cancel</button>
        </form>
        @else
        No Subcription 
        @endif
    </div>
</div>
<div class="bg-white card-box border-20 mt-10 mb-20">
    <h4 class="dash-title-three">Upload Profile Image</h4>

    <div class="user-avatar-setting d-flex align-items-center mb-30">
        <img id="imagePreview"
            src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : url('web/assets/dashboard/images/icon/icon03.svg') }}"
            alt="User Avatar" class="user-img">

        <div class="upload-btn position-relative tran3s ms-4 me-3">
            Upload new photo
            <input type="file" id="uploadImg" name="uploadImg" placeholder="" onchange="previewImage(event)">
        </div>
        <button class="dash-btn-two tran3s me-3 save-btn d-none" onclick="uploadImage()">Save</button>
        <button class="dash-cancel-btn tran3s delete-btn d-none" onclick="deleteImage()">Cancel</button>

        <button class="dash-cancel-btn tran3s remove-img-btn d-none" onclick="removeImage()">Delete</button>
    </div>
</div>
<div class="bg-white card-box border-20">

    <!-- /.user-avatar-setting -->
    <div class="row">
        <div class="col-md-12">
            <div class="dash-input-wrapper mb-30">
                <label for="">Username*</label>
                <span class="username-error text-danger d-none">Username Required</span>
                <input type="hidden" value="{{$user->id}}" name="user_id">
                <input type="text" placeholder="Enter User Name" name="user_name" value="{{$user->user_name}}">
            </div>
            <!-- /.dash-input-wrapper -->
        </div>

        <div class="col-sm-6">
            <div class="dash-input-wrapper mb-30">
                <label for="" name="position">Position*</label>
                <span class="position-error text-danger d-none">Select Position </span>
                <select class="nice-select" name="position">
                    <option disabled @if(!$user->position) selected @endif value="">Select Position</option>
                    <option @if(!$user->position == 'Agent') selected @endif value="Agent">Agent</option>

                    <option @if(!$user->position == 'Agency') selected @endif value="Agency">Agency</option>
                </select>
            </div>
            <!-- /.dash-input-wrapper -->
        </div>

        <div class="col-sm-6">
            <div class="dash-input-wrapper mb-30">
                <label for="">Website*</label>
                <span class="website-error text-danger d-none">Website Required </span>
                <span class="website-string-error text-danger d-none">URL not valid </span>

                <input type="text" placeholder="Enter URL" name="website" value="{{$user->website}}">
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
        <div class="col-12">
            <div class="dash-input-wrapper">
                <label for="">About*</label>
                <span class="about-error text-danger d-none">Tell us more about yourself! It helps us personalize your
                    experience.</span>
                <span class="about-space-error text-danger d-none">Tell us more about yourself- It helps us personalize
                    your experience.</span>
                <textarea class="size-lg" name="about_description"
                    placeholder="I am working for the last 4 years as a web designer, graphics designer and well as UI/UX designer.............">
                                @if($user->about_description)
                                    {{ $user->about_description }}
                                @else
                                @endif
                            </textarea>
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
    </div>
</div>
<div class="bg-white card-box border-20 mt-40 d-none">
    <h4 class="dash-title-three">Social Media</h4>

    <div class="dash-input-wrapper mb-20">
        <label for="">Network 1</label>
        <input type="text" placeholder="https://www.facebook.com/zubayer0145">
    </div>
    <!-- /.dash-input-wrapper -->
    <div class="dash-input-wrapper mb-20">
        <label for="">Network 2</label>
        <input type="text" placeholder="https://twitter.com/FIFAcom">
    </div>
    <!-- /.dash-input-wrapper -->
    <a href="#" class="dash-btn-one"><i class="bi bi-plus"></i> Add more link</a>
</div>
<div class="bg-white card-box border-20 mt-40 d-none">
    <h4 class="dash-title-three">Address & Location</h4>
    <div class="row">
        <div class="col-12">
            <div class="dash-input-wrapper mb-25">
                <label for="">Address*</label>
                <input type="text" placeholder="19 Yawkey Way">
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
        <div class="col-lg-3">
            <div class="dash-input-wrapper mb-25">
                <label for="">Country*</label>
                <select class="nice-select">
                    <option>Afghanistan</option>
                    <option>Albania</option>
                    <option>Algeria</option>
                    <option>Andorra</option>
                    <option>Angola</option>
                    <option>Antigua and Barbuda</option>
                    <option>Argentina</option>
                    <option>Armenia</option>
                    <option>Australia</option>
                    <option>Austria</option>
                    <option>Azerbaijan</option>
                    <option>Bahamas</option>
                    <option>Bahrain</option>
                    <option>Bangladesh</option>
                    <option>Barbados</option>
                    <option>Belarus</option>
                    <option>Belgium</option>
                    <option>Belize</option>
                    <option>Benin</option>
                    <option>Bhutan</option>
                </select>
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
        <div class="col-lg-3">
            <div class="dash-input-wrapper mb-25">
                <label for="">City*</label>
                <select class="nice-select">
                    <option>Boston</option>
                    <option>Tokyo</option>
                    <option>Delhi</option>
                    <option>Shanghai</option>
                    <option>Mumbai</option>
                    <option>Bangalore</option>
                </select>
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
        <div class="col-lg-3">
            <div class="dash-input-wrapper mb-25">
                <label for="">Zip Code*</label>
                <input type="number" placeholder="1708">
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
        <div class="col-lg-3">
            <div class="dash-input-wrapper mb-25">
                <label for="">State*</label>
                <select class="nice-select">
                    <option>Maine</option>
                    <option>Tokyo</option>
                    <option>Delhi</option>
                    <option>Shanghai</option>
                    <option>Mumbai</option>
                    <option>Bangalore</option>
                </select>
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
        <div class="col-12">
            <div class="dash-input-wrapper mb-25">
                <label for="">Map Location*</label>
                <div class="position-relative">
                    <input type="text" placeholder="XC23+6XC, Moiran, N105">
                    <button class="location-pin tran3s"><img src="../images/lazy.svg" data-src="images/icon/icon_16.svg"
                            alt="" class="lazy-img m-auto"></button>
                </div>
                <div class="map-frame mt-30">
                    <div class="gmap_canvas h-100 w-100">
                        <iframe class="gmap_iframe h-100 w-100"
                            src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=dhaka collage&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
            <!-- /.dash-input-wrapper -->
        </div>
    </div>
</div>

<!----------------------    CONFIRM MODAL     -------------------------->

<div class="modal fade" id="confirm-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-triangle-exclamation" style="font-size:60px;color:#d9534f"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>Are you sure you want Cancel Current Subscription?</span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-sm" data-bs-dismiss="modal">
                    <span style="color:#d9534f">No</span>
                </button>
            <button type="button" class="btn btn-sm form-submit-btn">
                    <span style="color:#9152FF">Yes</span>
                </button>
               
            </div>
        </div>
    </div>
</div>


<div class="button-group d-inline-flex align-items-center mt-30">
    <button class="dash-btn-two tran3s me-3 save-profile">Save</button>
    <a href="{{route('dashboard')}}" class="dash-cancel-btn tran3s">Cancel</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

    $(document).ready(function () {
        var userImage = "{{ $user->profile_image}}";
        console.log(userImage)
        if (userImage) {
            $('.remove-img-btn').removeClass('d-none');
        }
        $('#phone').inputmask('+56 9 9999 9999', {
            showMaskOnFocus: true,
            showMaskOnHover: false,
            numericInput: false
        });

        $(".save-profile").click(function () {
            validateData();
        });
        $(".cancel-modal").click(function () {
            openCancelModal();
        });

        $('.form-submit-btn').click(function(){
            console.log("Form Submitted ..... ")
            $('#cancelForm').submit();
        });


        function openCancelModal()
        {
            $('#confirm-modal').modal('show')
        }
        function validateData() {
            var urlPattern = /^https:\/\/([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,})(\/[^\s]*)?$/;
            var spacePattern = /^\s*$/;
            var user_id = $('input[name="user_id"]').val();
            var user_name = $('input[name="user_name"]').val();
            var position = $('select[name="position"]').val();
            var website = $('input[name="website"]').val().trim();
            var about_description = $('textarea[name="about_description"]').val();

            var phoneRegex = /^[+ \d]+$/;

            if (user_id && user_name && position && website && urlPattern.test(website) && about_description && !spacePattern.test(about_description)) {
                submitContactForm();
            } else {
                // $('html, body').animate({scrollTop: 0}, 'fast');
                if (user_name == "") {
                    $(".username-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".username-error").addClass('d-none');
                    }, 5000);

                }
                if (position == null) {
                    $(".position-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".position-error").addClass('d-none');
                    }, 5000);

                }
                if (website === "") {
                    $(".website-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".website-error").addClass('d-none');
                    }, 5000);
                } else if (!urlPattern.test(website)) {
                    $(".website-string-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".website-string-error").addClass('d-none');
                    }, 5000);
                }

                if (about_description === "") {
                    $(".about-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".about-error").addClass('d-none');
                    }, 5000);
                }
                if (spacePattern.test(about_description)) {
                    $(".about-space-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".about-space-error").addClass('d-none');
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
            var user_name = $('input[name="user_name"]').val();
            var position = $('select[name="position"]').val();
            var website = $('input[name="website"]').val();
            var about_description = $('textarea[name="about_description"]').val();


            var jsonData = JSON.stringify({
                'user_id': user_id,
                'user_name': user_name,
                'position': position,
                'website': website,
                'about_description': about_description,
            });

            console.log(jsonData)
            $.ajax({
                type: 'POST',
                url: '{{route('update-profile')}}',
                data: jsonData,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Profile Updated.',
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
<script>
    function previewImage(event) {
        $('.delete-btn').removeClass('d-none');
        $('.save-btn').removeClass('d-none');
        $('.remove-img-btn').addClass('d-none');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imagePreview = document.getElementById('imagePreview');
                const imagePreviewtwo = document.getElementById('imagePreview2');
                imagePreview.src = e.target.result;
                imagePreviewtwo.src = e.target.result;
                document.getElementById('imagePreviewContainer').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    function deleteImage() {
        document.getElementById('uploadImg').value = '';
        document.getElementById('imagePreview').src = "{{ $user->profile_image ? asset('storage/' . $user->profile_image) : url('web/assets/dashboard/images/icon/icon03.svg') }}";
        document.getElementById('imagePreview2').src = "{{ $user->profile_image ? asset('storage/' . $user->profile_image) : url('web/assets/dashboard/images/icon/icon03.svg') }}";
        $('.delete-btn').addClass('d-none');
        $('.save-btn').addClass('d-none');
    }

    function uploadImage() {
        $('.delete-btn').addClass('d-none');
        $('.save-btn').addClass('d-none');


        const fileInput = document.getElementById('uploadImg');
        const file = fileInput.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('uploadImg', file);
            formData.append('user_id', '{{$user->id}}');

            // Replace 'your_upload_url' with the actual URL of your upload endpoint
            const uploadUrl = '{{route('upload.avatar')}}';

            fetch(uploadUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add this line if you are using Laravel
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('.remove-img-btn').removeClass('d-none');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Image Uploaded.',
                        });
                        // Perform any additional actions if needed, such as updating the image preview
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Alert!',
                            text: 'Something Went Wrong.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error uploading image:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: 'Something Went Wrong.',
                    });

                });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Alert!',
                text: 'No Image Selected.',
            });
        }
    }

    function removeImage() {
        fetch('{{ route('remove.avatar',['user_id'=>$user->id]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Image Removed.',
                    });
                    // Set the default image
                    document.getElementById('imagePreview').src = "{{  url('web/assets/dashboard/images/icon/icon03.svg') }}";
                    document.getElementById('imagePreview2').src = "{{  url('web/assets/dashboard/images/icon/icon03.svg') }}";
                    $('.remove-img-btn').addClass('d-none');
                    $('.delete-btn').addClass('d-none');
                    $('.save-btn').addClass('d-none');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: 'Something Went Wrong.',
                    });
                }
            })
            .catch(error => {
                console.error('Error removing image:', error);
                alert('Error removing image');
            });
    }
</script>

@stop