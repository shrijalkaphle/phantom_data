@extends('layouts.aside')
@section('content')

<style>
    .custom-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        /* Allow items to wrap on smaller screens */
        justify-content: center;
        /* Center content on smaller screens */
        position: relative;
        /* Needed for the absolute positioning of timeDisplay */
    }

    #seekbar {
        width: 380px;
        max-width: 100%;
        /* Ensure it doesn't overflow on smaller screens */
    }

    #volumeControl {
        width: 100px;
        max-width: 100%;
        /* Ensure it doesn't overflow on smaller screens */
    }

    /* Add some styling to buttons and sliders */
    button {
        padding: 5px 10px;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="range"] {
        height: 5px;
        background: #ddd;
        border-radius: 5px;
        width: 100%;
        /* Make range inputs take full width of their container */
    }

    /* Position the time display */
    #timeDisplay {
        position: absolute;
        right: 0;
        padding-left: 10px;
        font-size: 16px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .custom-controls {
            flex-direction: column;
            /* Stack elements vertically on smaller screens */
        }

        #seekbar,
        #volumeControl {
            width: 100%;
            /* Make sliders full width on small screens */
        }

        button {
            font-size: 14px;
            /* Adjust button size for smaller screens */
        }

        #timeDisplay {
            position: static;
            /* Let it flow with the rest of the elements */
            padding-left: 0;
            margin-top: 10px;
            /* Add margin for spacing in stacked layout */
        }
    }

    @media (max-width: 480px) {
        button {
            padding: 5px 8px;
            /* Smaller button padding for very small screens */
            font-size: 12px;
            /* Smaller button font for very small screens */
        }
    }
</style>


<div class="bg-white border-20">
    <div class="row">
        <div class="col-md-12">
            <div class="dash-card-one border-30 position-relative mb-15 skew-none">

                <!-- <video width="100%" height="auto" controls>
                    <source src="{{ url('/stream-video?video=your-video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video> -->

                <!-- FOR .htaccess
                <Files "loom-video.mp4">
                    Header set Content-Disposition "inline"
                </Files> -->
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <video style="box-shadow: 0px 0px 10px 1px rgba(211, 151, 248,0.8);border-radius:10px"
                                id="video" src="{{ url('/stream-video?video=loom-video.mp4') }}">
                                Your browser does not support the video tag.
                            </video>

                            <div class="custom-controls">
                                <!-- Play/Pause button -->
                                <button id="playPauseBtn"><i style="color:#9152FF;"
                                        class="fa-solid fa-circle-play fa-xl"></i></button>

                                <!-- Progress bar -->
                                <input type="range" id="seekbar" value="0" max="100" step="1">

                                <!-- Time display -->
                                <span id="timeDisplay">0:00 / 7:21</span>

                                <!-- Volume control -->
                                <input type="range" id="volumeControl" value="100" max="100" step="1">

                                <!-- Mute toggle -->
                                <button id="muteBtn"><i style="color:#9152FF;"
                                        class="fa-solid fa-volume-off fa-xl"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3 d-none">
                            <span>Jump to Sections</span>
                            <div class="progress-bar d-none" id="progressBar">
                                <div class="progress-filled" id="progressFilled"></div>
                            </div>
                            <div class="controls d-none">
                                <button id="playPause">Play</button>
                                <span id="currentTime">0:00</span> / <span id="duration">0:00</span>
                            </div>
                            <div class="timestamps">
                                <div class="container">
                                    <div class="row p-2">
                                        <button class="timestamp btn btn-one-sm" data-time="0">Introduction</button>
                                    </div>
                                    <div class="row p-2">
                                        <button class="timestamp btn btn-one-sm" data-time="115">Downloading
                                            Data</button>
                                    </div>
                                    <div class="row p-2">
                                        <button class="timestamp btn btn-one-sm" data-time="196">Uploading To
                                            Phantom</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-none">
                            <br>
                            <hr>
                            <h5>Summary</h5>
                            <span>In this video, I guide you through using phantom data to find, upload, and download
                                files. I demonstrate how to obtain homeowner information, skip trace for mobile numbers,
                                and clean up data for CSV files. No action requested from viewers.</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const video = document.getElementById('video');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const seekbar = document.getElementById('seekbar');
    const timeDisplay = document.getElementById('timeDisplay');
    const volumeControl = document.getElementById('volumeControl');
    const muteBtn = document.getElementById('muteBtn');

    // Play/Pause functionality
    playPauseBtn.addEventListener('click', () => {
        if (video.paused) {
            video.play();
            playPauseBtn.innerHTML = '<i style="color:#9152FF;" class="fa-solid fa-circle-pause fa-xl"></i>';

        } else {
            video.pause();
            playPauseBtn.innerHTML = '<i style="color:#9152FF;" class="fa-solid fa-circle-play fa-xl"></i>';
        }
    });

    // Toggle Play/Pause on video click
    video.addEventListener('click', () => {
        if (video.paused) {
            video.play();
            playPauseBtn.innerHTML = '<i style="color:#9152FF;" class="fa-solid fa-circle-pause fa-xl"></i>';
        } else {
            video.pause();
            playPauseBtn.innerHTML = '<i style="color:#9152FF;" class="fa-solid fa-circle-play fa-xl"></i>';
        }
    });

    // Update the seekbar and time display as the video plays
    video.addEventListener('timeupdate', () => {
        const value = (video.currentTime / video.duration) * 100;
        seekbar.value = value;

        // Update the time display
        const minutes = Math.floor(video.currentTime / 60);
        const seconds = Math.floor(video.currentTime % 60);
        const durationMinutes = Math.floor(video.duration / 60);
        const durationSeconds = Math.floor(video.duration % 60);

        // Display current time and total duration in the format "mm:ss / mm:ss"
        timeDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds} / ${durationMinutes}:${durationSeconds < 10 ? '0' : ''}${durationSeconds}`;
    });

    // Allow the user to seek the video using the progress bar
    seekbar.addEventListener('input', () => {
        const newTime = (seekbar.value / 100) * video.duration;
        video.currentTime = newTime;
    });

    // Handle volume control
    volumeControl.addEventListener('input', () => {
        video.volume = volumeControl.value / 100;
    });

    // Handle mute functionality
    muteBtn.addEventListener('click', () => {
        if (video.muted) {
            video.muted = false;
            muteBtn.innerHTML = '<i style="color:#9152FF;" class="fa-solid fa-volume-off fa-xl"></i>';
        } else {
            video.muted = true;
            muteBtn.innerHTML = '<i style="color:#9152FF;" class="fa-solid fa-volume-high fa-xl"></i>';
        }
    });

    // Jump to a specific time when clicking a timestamp
    const timestampButtons = document.querySelectorAll('.timestamp');
    timestampButtons.forEach(button => {
        button.addEventListener('click', () => {
            const time = parseInt(button.getAttribute('data-time'), 10); // Get the timestamp time in seconds
            video.currentTime = time; // Jump to the specified time
            video.play(); // Optionally, start playing when the timestamp is clicked
            playPauseBtn.innerHTML = '<i style="color:#9152FF;" class="fa-solid fa-circle-pause fa-xl"></i>'; // Update play/pause button text
        });
    });
</script>

@stop