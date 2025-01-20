<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>PhantomData </title>

    <!-- Favicon -->
    <link rel="icon"
          type="image/png"
          sizes="32x32"
          href="/images/logo.png">

    <link href="{{ mix('css/app.css') }}"
          rel="stylesheet">
</head>

<body>
    <header class="fixed w-full">
        <nav class="bg-white border-gray-200 py-3 dark:bg-gray-900">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                <a href="#"
                   class="flex items-center">
                    <img src="./images/logo.png"
                         class="h-6 mr-3 sm:h-9"
                         alt="PhantomData Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">PhantomData</span>
                </a>
                <div class="flex items-center lg:order-2">

                    <button
                            class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Get
                        started</button>
                    <div class="w-4"></div>
                    <button
                            class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Login</button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero -->
    <section class="bg-white dark:bg-gray-900 bg-bottom bg-contain bg-repeat-x"
             style="background-image: url('http://3.128.39.28/web/assets/images/assets/ils_01.svg');">

        <div
             class="grid max-w-screen-xl min-h-[80vh] px-4 pt-20 pb-20 mx-auto lg:gap-8 xl:gap-0 lg:py-32 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
                    Know Your Property <br>
                    Inside Out — Instantly!
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-700 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Get accurate, real-time data on any home in just seconds. From property values to ownership history,
                    unlock the insights you need with ease.
                </p>
                <div class="flex gap-4">
                    <button
                            class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Get
                        started</button>

                    <button
                            class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Watch
                        demo</button>
                </div>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <!-- <img src="./images/phantom_hero.png"
                     alt="hero image"> -->
            </div>
        </div>
    </section>

    <!-- about -->
    <section class="bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-24 lg:px-6">
            <!-- Row -->
            <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
                <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        Skiptrace the easiest way possible
                    </h2>
                    <p class="mb-8 font-light lg:text-xl">
                        Simplify skip tracing with our hassle-free process. Just upload your data in the specified
                        format, and we'll handle the rest. With fast, accurate results, we save you time and effort, so
                        you can focus on what matters most.
                    </p>
                    <!-- List -->
                    <ul role="list"
                        class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
                        <li class="flex space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">
                                Upload your file</span>
                        </li>
                        <li class="flex space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Wait for the
                                process to complete</span>
                        </li>
                        <li class="flex space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">
                                Download skiptraced data
                            </span>
                        </li>
                    </ul>
                    <p class="mb-8 font-light lg:text-xl">We're here to save you time and effort. Skip tracing has never
                        been easier!</p>
                </div>
                <img class="hidden w-full mb-4 rounded-lg lg:mb-0 lg:flex"
                     src="./images/feature-1.png"
                     alt="dashboard feature image">
            </div>
            <!-- Row -->
            <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
                <img class="hidden w-full mb-4 rounded-lg lg:mb-0 lg:flex"
                     src="./images/feature-2.png"
                     alt="feature image 2">
                <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        Flexible, Usage-Based Pricing
                    </h2>
                    <p class="mb-8 font-light lg:text-xl">
                        With our credit-based system, you're in control. Purchase credits on our platform and use them
                        exclusively for skip tracing. No hidden fees, no confusing pricing—just pay for the services you
                        use.
                    </p>
                    <!-- List -->
                    <ul role="list"
                        class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
                        <li class="flex space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Purchase
                                credits</span>
                        </li>
                        <li class="flex space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Use credits
                                for skip-tracking</span>
                        </li>
                        <li class="flex space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">
                                Get detailed insights on how credits were used
                            </span>
                        </li>
                    </ul>
                    <p class="font-light lg:text-xl">Experience a transparent, hassle-free way to manage your skip
                        tracing needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="bg-white dark:bg-gray-900">
        <div
             class="items-center max-w-screen-xl px-4 py-8 mx-auto lg:grid lg:grid-cols-4 lg:gap-16 xl:gap-24 lg:py-24 lg:px-6">
            <div class="col-span-2 mb-8">
                <p class="text-lg font-medium text-purple-600 dark:text-purple-500">A product you can trust</p>
                <h2 class="mt-3 mb-4 text-3xl font-extrabold tracking-tight text-gray-900 md:text-3xl dark:text-white">
                    Trusted by over xxx users and YYY Realtors</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Our rigorous security and compliance
                    standards are at the heart of all we do. We work tirelessly to protect you and your skip-traced
                    data.</p>
            </div>
            <div class="col-span-2 space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0">
                <div>
                    <svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500"
                         fill="currentColor"
                         viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 11-2 0 1 1 0 012 0zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 11-2 0 1 1 0 012 0z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">99.99% uptime</h3>
                    <p class="font-light text-gray-500 dark:text-gray-400">
                        A system that runts 24 hour
                    </p>
                </div>
                <div>
                    <svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500"
                         fill="currentColor"
                         viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                              d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                        </path>
                    </svg>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">XXX Users</h3>
                    <p class="font-light text-gray-500 dark:text-gray-400">Trusted by over XXX users </p>
                </div>
                <div>
                    <svg class="w-8 h-8 mb-2 text-purple-600 md:w-10 md:h-10 dark:text-purple-500"
                         viewBox="0 0 600 600"
                         version="1.1"
                         id="svg9724"
                         sodipodi:docname="database.svg"
                         inkscape:version="1.2.2 (1:1.2.2+202212051550+b0a8486541)"
                         width="119px"
                         height="119px"
                         xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                         xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                         xmlns="http://www.w3.org/2000/svg"
                         xmlns:svg="http://www.w3.org/2000/svg"
                         fill="#7e3af2"
                         stroke="#7e3af2">
                        <g id="SVGRepo_bgCarrier"
                           stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <defs id="defs9728"></defs>
                            <sodipodi:namedview id="namedview9726"
                                                pagecolor="#ffffff"
                                                bordercolor="#666666"
                                                borderopacity="1.0"
                                                inkscape:showpageshadow="2"
                                                inkscape:pageopacity="0.0"
                                                inkscape:pagecheckerboard="0"
                                                inkscape:deskcolor="#d1d1d1"
                                                showgrid="true"
                                                inkscape:zoom="0.42059316"
                                                inkscape:cx="148.59966"
                                                inkscape:cy="296.01052"
                                                inkscape:window-width="1920"
                                                inkscape:window-height="1009"
                                                inkscape:window-x="0"
                                                inkscape:window-y="1080"
                                                inkscape:window-maximized="1"
                                                inkscape:current-layer="svg9724"
                                                showguides="true">
                                <inkscape:grid type="xygrid"
                                               id="grid9972"
                                               originx="0"
                                               originy="0"></inkscape:grid>
                                <sodipodi:guide position="300,-90"
                                                orientation="1,0"
                                                id="guide385"
                                                inkscape:locked="false"></sodipodi:guide>
                                <sodipodi:guide position="140,100"
                                                orientation="0,-1"
                                                id="guide1388"
                                                inkscape:locked="false"></sodipodi:guide>
                                <sodipodi:guide position="140,100"
                                                orientation="0,-1"
                                                id="guide2256"
                                                inkscape:locked="false"></sodipodi:guide>
                                <sodipodi:guide position="0,475"
                                                orientation="0,-1"
                                                id="guide1920"
                                                inkscape:locked="false"></sodipodi:guide>
                            </sodipodi:namedview>
                            <path id="path3428"
                                  style="color:7e3af2;fill:7e3af2;stroke-linejoin:round;-inkscape-stroke:none;paint-order:stroke fill markers"
                                  d="M 300 0 C 221.30245 0 150.09841 8.0113158 97.068359 21.535156 C 70.553346 28.297076 48.605538 36.277916 31.677734 46.484375 C 16.579982 55.587421 3.2445893 67.928721 0.53125 85 L 0 85 L 0 90 C 0 95.160045 3.6392602 102.94345 17.03125 112.83789 C 30.423241 122.73233 52.11942 133.00486 79.691406 141.62109 C 134.83535 158.85361 213.32376 170 300 170 C 386.67624 170 465.16467 158.85361 520.30859 141.62109 C 547.8806 133.00486 569.57675 122.73233 582.96875 112.83789 C 596.36075 102.94345 600 95.160045 600 90 L 599.87305 90 C 599.19452 70.318664 584.84711 56.447884 568.32227 46.484375 C 551.39442 36.277916 529.44664 28.297076 502.93164 21.535156 C 449.90159 8.0113158 378.69755 0 300 0 z M 0 149.67969 L 0 234.10742 C 0.70499641 239.21983 4.6599347 246.30446 16.722656 255.2168 C 30.11466 265.11125 51.810798 275.38376 79.382812 284 C 134.52681 301.23251 213.01506 312.37891 299.69141 312.37891 C 386.36774 312.37891 464.85602 301.23251 520 284 C 547.57201 275.38376 569.26815 265.11125 582.66016 255.2168 C 596.05215 245.32235 599.69141 237.53895 599.69141 232.37891 L 600 232.37891 L 600 149.67969 C 581.93283 161.57337 559.1282 171.3983 532.24023 179.80078 C 471.56758 198.761 390.05399 210 300 210 C 209.94601 210 128.43244 198.761 67.759766 179.80078 C 40.871811 171.3983 18.067172 161.57337 0 149.67969 z M 600 291.79688 C 590.25148 298.2521 579.18165 304.12941 566.75 309.46875 C 556.06951 314.05598 544.44003 318.27081 531.93164 322.17969 C 471.2589 341.13992 389.74549 352.37891 299.69141 352.37891 C 209.63733 352.37891 128.12391 341.13993 67.451172 322.17969 C 40.720883 313.82647 18.016718 304.0712 0 292.27148 L 0 380 C 0 385.16005 3.6392334 392.94343 17.03125 402.83789 C 30.423267 412.73235 52.119364 423.00484 79.691406 431.62109 C 134.83545 448.85363 213.32358 460 300 460 C 386.67642 460 465.16455 448.85363 520.30859 431.62109 C 547.88068 423.00484 569.57666 412.73235 582.96875 402.83789 C 596.36074 392.94343 600 385.16005 600 380 L 600 291.79688 z M 0 439.67969 L 0 508.59375 L 0 515 L 0.53125 515 C 3.2445947 532.0713 16.579952 544.41257 31.677734 553.51562 C 48.605572 563.7221 70.553292 571.70292 97.068359 578.46484 C 150.09851 591.98873 221.30229 600 300 600 C 378.69771 600 449.90149 591.98873 502.93164 578.46484 C 529.4467 571.70292 551.3944 563.7221 568.32227 553.51562 C 583.42003 544.41257 596.7554 532.0713 599.46875 515 L 600 515 L 600 508.59375 L 600 439.67969 C 581.93278 451.57339 559.1283 461.39828 532.24023 469.80078 C 471.56747 488.76104 390.05417 500 300 500 C 209.94583 500 128.43256 488.76104 67.759766 469.80078 C 40.871757 461.39828 18.067208 451.57339 0 439.67969 z ">
                            </path>
                        </g>
                    </svg>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">YYY+ data</h3>
                    <p class="font-light text-gray-500 dark:text-gray-400"> Skiptraced by our customers</p>
                </div>
                <div>
                    <svg class="w-10 h-10 mb-2"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier"
                           stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M2 14C2 10.2288 2 8.34315 3.17157 7.17157C4.34315 6 6.22876 6 10 6H14C17.7712 6 19.6569 6 20.8284 7.17157C22 8.34315 22 10.2288 22 14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14Z"
                                  stroke="#7E3AF2"
                                  stroke-width="1.5"></path>
                            <path d="M16 6C16 4.11438 16 3.17157 15.4142 2.58579C14.8284 2 13.8856 2 12 2C10.1144 2 9.17157 2 8.58579 2.58579C8 3.17157 8 4.11438 8 6"
                                  stroke="#7E3AF2"
                                  stroke-width="1.5"></path>
                            <path d="M12 17.3333C13.1046 17.3333 14 16.5871 14 15.6667C14 14.7462 13.1046 14 12 14C10.8954 14 10 13.2538 10 12.3333C10 11.4129 10.8954 10.6667 12 10.6667M12 17.3333C10.8954 17.3333 10 16.5871 10 15.6667M12 17.3333V18M12 10V10.6667M12 10.6667C13.1046 10.6667 14 11.4129 14 12.3333"
                                  stroke="#7E3AF2"
                                  stroke-width="1.5"
                                  stroke-linecap="round"></path>
                        </g>
                    </svg>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">ZZZ+ Credits</h3>
                    <p class="font-light text-gray-500 dark:text-gray-400">Spent till today</p>
                </div>
            </div>
        </div>
    </section>

    <!-- testimonials -->
    <section class="bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-24 lg:px-6">
            <figure class="max-w-screen-md mx-auto">
                <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600"
                     viewBox="0 0 24 27"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                          fill="currentColor" />
                </svg>
                <blockquote>
                    <p class="text-xl font-medium text-gray-900 md:text-2xl dark:text-white">"I've been using it for a
                        month now, and the quality of data it provides has been a game-changer. It's helped me secure
                        some amazing real estate deals with ease. Highly recommended!"</p>
                </blockquote>
                <figcaption class="flex items-center justify-center mt-6 space-x-3">
                    <img class="w-6 h-6 rounded-full"
                         src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png"
                         alt="profile picture">
                    <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                        <div class="pr-3 font-medium text-gray-900 dark:text-white">John Doe</div>
                        <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">Real State Agent</div>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>

    <!-- pricing -->
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-24 lg:px-6">
            <div class="max-w-screen-md mx-auto mb-8 text-center lg:mb-12">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Designed for
                    professionals like you</h2>
                <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">
                    We offer a wide range of pricing models designed to fit your needs. Select the one that works best
                    to ensure a perfect match for your workflow and budget!
                </p>
            </div>
            <div class="space-y-8 flex flex-wrap justify-center sm:gap-6 xl:gap-10 lg:space-y-0">

                <!-- Pricing Card -->
                <div
                     class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Individual</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">$0.12 per credit</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold">$120</span>
                    </div>
                    <a href="#"
                       class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">
                        1000 Credits</a>
                </div>

                <div
                     class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Pro</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">$0.10 per credit</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold">$499</span>
                    </div>
                    <a href="#"
                       class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">
                        5000 Credits</a>
                </div>

                <div
                     class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Elite</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">$0.05 per credit</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold">$999</span>
                    </div>
                    <a href="#"
                       class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">
                        20,000 Credits</a>
                </div>

                <div
                     class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Enterprise</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">$0.04 per credit</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold">$1999</span>
                    </div>
                    <a href="#"
                       class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">
                        50,000 Credits</a>
                </div>

                <div
                     class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Titanium</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">$0.035 per credit</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold">$3499</span>
                    </div>
                    <a href="#"
                       class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">
                        100,000 Credits</a>
                </div>

                <div
                     class="flex flex-col max-w-lg p-6 text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Diamond</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">$0.02 per credit</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold">$4999</span>
                    </div>
                    <a href="#"
                       class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">
                        250,000 Credits</a>
                </div>

                <div
                     class="flex flex-col max-w-lg p-6 text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Business</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">$0.12 per credit</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-2xl font-extrabold">Request a <br> Personalized Quote</span>
                    </div>
                    <a href="#"
                       class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">
                        Contact Us</a>
                </div>


            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-24 lg:px-6 ">
            <h2
                class="mb-6 text-3xl font-extrabold tracking-tight text-center text-gray-900 lg:mb-8 lg:text-3xl dark:text-white">
                Frequently asked questions</h2>
            <div class="max-w-screen-md mx-auto">
                <div id="accordion-flush"
                     data-accordion="collapse"
                     data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                     data-inactive-classes="text-gray-500 dark:text-gray-400">
                    <h3 id="accordion-flush-heading-1">
                        <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-900 bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                                data-accordion-target="#accordion-flush-body-1"
                                aria-expanded="true"
                                aria-controls="accordion-flush-body-1">
                            <span>How can I benefit from PhantomData?</span>
                            <svg data-accordion-icon=""
                                 class="w-6 h-6 rotate-180 shrink-0"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-1"
                         class=""
                         aria-labelledby="accordion-flush-heading-1">
                        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente officia necessitatibus
                                repellat quaerat, debitis quam totam facere minima et veniam amet sed voluptatibus
                                repellendus sequi aspernatur saepe labore asperiores doloremque.

                            </p>
                            <p class="text-gray-500 dark:text-gray-400">Check out this video to learn how to <a href="#"
                                   class="text-purple-600 dark:text-purple-500 hover:underline">use the platform</a> and
                                grow your business.</p>
                        </div>
                    </div>
                    <h3 id="accordion-flush-heading-2">
                        <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                data-accordion-target="#accordion-flush-body-2"
                                aria-expanded="false"
                                aria-controls="accordion-flush-body-2">
                            <span>Is there a free version available?</span>
                            <svg data-accordion-icon=""
                                 class="w-6 h-6 shrink-0"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-2"
                         class="hidden"
                         aria-labelledby="accordion-flush-heading-2">
                        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate asperiores debitis
                                fugiat commodi, ullam quis tenetur amet accusamus, similique magni veniam soluta. Velit
                                dolor consectetur quisquam aperiam quasi exercitationem quos.
                            </p>
                        </div>
                    </div>
                    <h3 id="accordion-flush-heading-3">
                        <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                data-accordion-target="#accordion-flush-body-3"
                                aria-expanded="false"
                                aria-controls="accordion-flush-body-3">
                            <span>What are credits?</span>
                            <svg data-accordion-icon=""
                                 class="w-6 h-6 shrink-0"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-3"
                         class="hidden"
                         aria-labelledby="accordion-flush-heading-3">
                        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non voluptatibus inventore
                                sequi molestias voluptas quisquam sapiente quaerat, perferendis nobis quos, nam beatae
                                voluptates aliquid qui eligendi? Fugit amet excepturi tempore.
                            </p>
                            <ul class="pl-5 text-gray-500 list-disc dark:text-gray-400">
                                <li><a href="#"
                                       class="text-purple-600 dark:text-purple-500 hover:underline">Plan 1</a>
                                </li>
                                <li><a href="#"
                                       class="text-purple-600 dark:text-purple-500 hover:underline">Plan 2</a></li>
                            </ul>
                        </div>
                    </div>
                    <h3 id="accordion-flush-heading-4">
                        <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                data-accordion-target="#accordion-flush-body-4"
                                aria-expanded="false"
                                aria-controls="accordion-flush-body-4">
                            <span>Do you also provide support?</span>
                            <svg data-accordion-icon=""
                                 class="w-6 h-6 shrink-0"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-4"
                         class="hidden"
                         aria-labelledby="accordion-flush-heading-4">
                        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam corrupti facere
                                cupiditate. Excepturi, possimus nemo. Quo eos ipsa cum, quasi tenetur consequuntur quos,
                                totam quibusdam architecto nesciunt minima explicabo suscipit!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- get started -->
    <section class="bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
            <div class="max-w-screen-sm mx-auto text-center">
                <h2 class="mb-4 text-3xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white">
                    Get started</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">
                    Get accurate, real-time data on any home in just seconds!
                </p>
                <a href="#"
                   class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Sign
                    Up</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800">
        <div class="max-w-screen-xl p-4 py-6 mx-auto lg:py-16 md:p-8 lg:p-10">
            <div class="text-center">
                <a href="#"
                   class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img src="./images/logo.png"
                         class="h-6 mr-3 sm:h-9"
                         alt="PhantomData Logo" />
                    PhantomData
                </a>
                <span class="block text-sm text-center text-gray-500 dark:text-gray-400">© 2025 PhantomData™. All
                    Rights Reserved.
                </span>
            </div>
        </div>
    </footer>
    
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
</body>

</html>