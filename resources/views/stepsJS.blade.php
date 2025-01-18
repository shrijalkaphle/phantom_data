
@extends('layouts.app')

@section('content')

    <title>Responsive Form Steps with Progress Bar</title>
    <style>
    .steps-content {
        position: relative;
        overflow: hidden;
    }

    .steps-content .current {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 100%; /* Start outside the viewport */
        transition: left 0.5s ease;
    }

    .steps-content .current.prev-step {
        left: 0; /* Slide into view */
    }

    .steps-content .current.next-step {
        left: -100%; /* Slide out of view */
    }.steps ul {
    display: none;
}
 
</style>

    <div class="container mt-5">
    
        <form id="contact" action="#">
            <div>
                <h3>Account</h3>
                <section>
                    <div class="form-group">
                        <label for="userName">User name *</label>
                        <input id="userName" name="userName" type="text" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input id="password" name="password" type="password" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="confirm">Confirm Password *</label>
                        <input id="confirm" name="confirm" type="password" class="form-control required">
                    </div>
                    <p>(*) Mandatory</p>
                </section>
                <h3>Profile</h3>
                <section>
                    <div class="form-group">
                        <label for="name">First name *</label>
                        <input id="name" name="name" type="text" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="surname">Last name *</label>
                        <input id="surname" name="surname" type="text" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input id="email" name="email" type="email" class="form-control required email">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input id="address" name="address" type="text" class="form-control">
                    </div>
                    <p>(*) Mandatory</p>
                </section>
                <h3>Finish</h3>
                <section>
                    <div class="form-group">
                        <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required">
                        <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                    </div>
                </section>
            </div>
        </form>
    </div>

   
 
<script>
    $(document).ready(function() {
    var form = $("#contact");
    var progressBar = $("#progress-bar");

    // Count the number of steps
    var totalSteps = form.find("section").length;
    var $steps = form.find("section");

    // Initialize steps
    $steps.each(function(index) {
        $(this).addClass('step');
        if (index > 0) {
            $(this).addClass('hidden');
        }
    });

    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "none", // Disable default transition
        onStepChanging: function (event, currentIndex, newIndex) {
            // Only validate if moving forward
            if (newIndex > currentIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            }
            return true; // Skip validation when moving backward
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            var stepIndex = currentIndex;
            var percentComplete = ((stepIndex + 1) / totalSteps) * 100;
            progressBar.css("width", percentComplete + "%").attr("aria-valuenow", percentComplete);

            // Add sliding effect
            var currentStep = $steps.eq(currentIndex);
            var nextStep = $steps.eq(newIndex);

            currentStep.removeClass('next prev hidden');
            nextStep.removeClass('next prev hidden').addClass('next');

            // Show both current and next steps briefly before hiding the previous one
            setTimeout(function() {
                currentStep.addClass('hidden');
                nextStep.removeClass('next');
            }, 10);
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            alert("Submitted!");
        },
        onInit: function (event, currentIndex) {
            // Add classes to buttons
            $('.actions a[href="#previous"]').addClass('btn-two w-100 text-uppercase d-block mt-20');
            $('.actions a[href="#next"]').addClass('btn-two w-100 text-uppercase d-block mt-20');
            $('.actions a[href="#next"]').addClass('btn-two w-100 text-uppercase d-block mt-20');
        }
    });
});

</script>
@stop
