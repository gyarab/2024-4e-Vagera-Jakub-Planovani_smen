<!DOCTYPE html>
<html lang="en">
<!--<html lang="en" data-bs-theme="dark">-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link href="{{ asset('CSS/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/search.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/notification.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/graph.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/card.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock2.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">

    <title>Document</title>
</head>

<body id="body-pd">
    <style>
        @media (max-width: 767px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        /* medium and up screens */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-end.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(25%);
            }

            .carousel-inner .carousel-item-start.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-25%);
            }
        }

        .carousel-inner .carousel-item-end,
        .carousel-inner .carousel-item-start {
            transform: translateX(0);
        }
    </style>
    <style id="clock-animations"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <header class="header bg-white" id="header">
        <div class="header_toggle "> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-10 col-sm-8 ">
                    <div class="mt-0 px-3">
                        <div class="form">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control form-input" placeholder="Search anything...">
                            <span class="left-pan" id="startButton"><i class="fa fa-microphone"></i></span>

                            <div id="output"></div>
                            <script>
                                const startButton = document.getElementById('startButton');
                                const outputDiv = document.getElementById('output');

                                const recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition ||
                                    window.msSpeechRecognition)();
                                recognition.lang = 'en-US';

                                recognition.onstart = () => {
                                    startButton.textContent = 'Listening...';
                                };

                                recognition.onresult = (event) => {
                                    const transcript = event.results[0][0].transcript;
                                    outputDiv.textContent = transcript;
                                };

                                recognition.onend = () => {
                                    startButton.textContent = 'Start Voice Input';
                                };

                                startButton.addEventListener('click', () => {
                                    recognition.start();
                                });
                            </script>
                        </div>

                    </div>
                </div>
                <div class="col-auto col-0 d-none d-sm-inline col-sm-3 ">
                    <div class="dropdown d-none d-sm-inline mt-0" style="float: left;">

                        <a id="dropdownMenu1" href="#"
                            class="d-flex text-white text-decoration-none dropdown-toggle mt-2"
                            style="float: right;position:absolute" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
                            </i>
                        </a>
                        <span class="badge badge-danger" style="position:absolute">10</span>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow mt-2 "
                            aria-labelledby="dropdownMenu1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>

                    <div
                        style="float: right;max-width: 70%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle d-none d-sm-inline mt-1"
                            id="dropdownUser1" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <img src="{{ URL('images/person.jpg') }}" alt="hugenerd" width="30" height="30"
                                class="rounded-circle mx-2 mt-1"
                                style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;">

                            <div class="row d-inline d-none d-lg-inline">
                                <div class="col-12 d-inline"
                                    style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                                    @foreach ($parameters as $p)
                                        <h6 class="d-none d-sm-inline mx-2 text-black"
                                            style="max-width: 300px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                                            {{ $p->first_name }} {{ $p->middle_name }} {{ $p->last_name }}</h6>


                                        <span class="d-none d-sm-inline text-black"><small> Admin</small></span>
                                    @endforeach
                                </div>

                            </div>

                        </a>


                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow mt-2"
                            aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" :href="route('logout')"
                                        onclick="event.preventDefault();this.closest('form').submit();">Sign out</a>



                                </form>
                            </li>
                        </ul>


                        <!--<div class="dropdown mt-2" style="float: right">
    
                            <ul class="dropdown-menu" aria-labelledby="dropdownUser1">
                                <li>
                                    <a class="dropdown-item" href="#"><span class="fi fi-gb"></span>&nbsp; English
                                        <i class="fa fa-check text-success ms-2"></i></a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"><span class="fi fi-cz"></span>
                                        </i>&nbsp;Czech</a>
                                </li>
    
                                <li>
                                    <a class="dropdown-item" href="#"><span
                                            class="fi fi-de"></span></i>&nbsp;Deutsch</a>
                                </li>
    
                            </ul>
                        </div>-->
                    </div>
                </div>
                <div class="col-2 col-md-1">
                    <div class="dropdown mt-2" style="float: right">
                        <a data-mdb-dropdown-init class="dropdown-toggle " href="#" id="Dropdowns"
                            role="button" data-mdb-toggle="dropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="fi fi-gb" style="font-size: 1.3em;"></span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="Dropdowns">
                            <li>
                                <a class="dropdown-item" href="#"><span class="fi fi-gb"></span>&nbsp; English
                                    <i class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><span class="fi fi-cz"></span>
                                    </i>&nbsp;Czech</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#"><span
                                        class="fi fi-de"></span></i>&nbsp;Deutsch</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>-->
    </header>
    @include('admin.sidebar')
    <!--<div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div id="menu">
                <div>

                    <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon text-dark'></i>
                        <span class="nav_logo-name text-dark">BBBootstrap</span> </a>
                    <div class="nav_list">
                        <a href="#" class="nav_link active mb-1 text-dark link-secondary"><i
                                class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                        <a href="#" class="nav_link mb-1 text-dark link-secondary"> <i
                                class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a>
                        <a href="/admin/shift-model/create-model-shift" class="nav_link mb-1 text-dark link-secondary"> <i
                                class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Create
                                shift</span>
                        </a> <a href="#" class="nav_link mb-1 text-dark link-secondary"> <i
                                class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Bookmark</span>
                        </a> <a href="#" class="nav_link mb-1 text-dark link-secondary"
                            class=" nav_link nav-link px-0 mx-0 align-middle"> <i class='bx bx-folder nav_icon'
                                data-bs-parent="#menu"></i> <span class="nav_name">Files</span> </a>

                        <li class="mx-0">
                            <a href="#submenu6" class="nav_link mb-1 text-dark link-secondary"
                                data-bs-toggle="collapse" class=" nav_link nav-link px-0 mx-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span
                                    class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu6" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav_link mb-1 text-dark link-secondary"
                                        class="nav-link px-0"> 1 <span class="d-none d-sm-inline">Item</span></a>
                                </li>
                                <li>
                                    <a href="#" class="nav_link mb-1 text-dark link-secondary"
                                        class="nav-link px-0"> 2 <span class="d-none d-sm-inline">Item</span> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="mx-0">
                            <a href="#submenu7" class="nav_link mb-1 text-dark link-secondary"
                                data-bs-toggle="collapse" class=" nav_link nav-link px-0 mx-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span
                                    class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu7" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav_link mb-1 text-dark link-secondary"
                                        class="nav-link px-0"> 1<span class="d-none d-sm-inline">Item</span> </a>
                                </li>
                                <li>
                                    <a href="#" class="nav_link mb-1 text-dark link-secondary"
                                        class="nav-link px-0"> 2 <span class="d-none d-sm-inline">Item</span></a>
                                </li>
                            </ul>
                        </li>


                        <div id="asd"><a href="#" class="nav_link  mb-1 text-dark link-secondary"> <i
                                    class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span>
                            </a>
                        </div>



                    </div>







                </div>
                <div class="dropdown pb-4 d-inline d-sm-none " style="overflow-x: visible;" id="ne">
                    <a href="#" class=" align-items-center text-decoration-none text-black"
                        style="margin-left: 20px" id="dropdownUser4" data-bs-toggle="dropdown" aria-expanded="false"
                        style="overflow-x: visible;">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                            class="rounded-circle text-black">
                        <span class="d-none d-sm-inline mx-1 text-black">loser</span>
                    </a>

                    <ul id="drop_menu" class="dropdown-menu dropdown-menu-dark text-small shadow text-black;"
                        style="overflow-x: visible;" aria-labelledby="dropdownUser4" data-toggle="dropdown">
                        <li style="overflow-x: visible;"><a class="dropdown-item" style="overflow-x: visible;"
                                href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
            <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>-->
    <!--</nav>

    </div>-->




    </div>
    <script>
        /*   $('#ne').click(function(e){
                  e.stopPropagation();
                  $('#drop_menu').dropdown('toggle');
                });*/
    </script>
    <!--Container Main start-->
    <div class="height-100 bg-light">

        <script>
            document.getElementById("asd").addEventListener("click", clicker);

            function clicker() {
                document.getElementById("links").classList.remove("d-none");
                // alert("ds");
            }
        </script>
        <div class="container-fluid">

            <div class="col py-3">
                <div class="row mx-2" style="margin-right:1%">
                    <div class="col-12 col-md-6 ">
                        <div class="row" style="max-height: 59vh">
                            <div class="col-12 col-lg-6  ">
                                <div class="row ">
                                    <div class="card p-3 mb-2">
                                        <div class="row ">
                                            <div class="col-7 ">
                                                <div>
                                                    <div class="mb-0 ">
                                                        <p id="weekday" style="margin-bottom: 0px; display: inline">
                                                        </p>
                                                        <p id="timezone" style="margin-bottom: 0px; display: inline">
                                                        </p>
                                                    </div>
                                                    <div class="clock mb-2">
                                                        <div class="hours">
                                                            <div class="first">
                                                                <div class="number">0</div>
                                                            </div>
                                                            <div class="second">
                                                                <div class="number">0</div>
                                                            </div>
                                                        </div>
                                                        <div class="tick" style="margin-top: 19px">:</div>
                                                        <div class="minutes">
                                                            <div class="first">
                                                                <div class="number">0</div>
                                                            </div>
                                                            <div class="second">
                                                                <div class="number">0</div>
                                                            </div>
                                                        </div>
                                                        <div class="tick" style="margin-top: 19px">:</div>
                                                        <div class="seconds">
                                                            <div class="first">
                                                                <div class="number">0</div>
                                                            </div>
                                                            <div class="second infinite">
                                                                <div class="number">0</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- https://codepen.io/patrickwestwood/pen/gPPywv-->

                                                <script>
                                                    const date = new Date();

                                                    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                                    var currentDayOfWeek = daysOfWeek[date.getDay()];
                                                    document.getElementById("weekday").textContent = currentDayOfWeek;
                                                    document.getElementById("timezone").textContent = "(" + (new Date().toString().match(/([A-Z]+[\+-][0-9]+)/)[1]) +
                                                        ")";
                                                </script>

                                                <script>
                                                    var hoursContainer = document.querySelector('.hours')
                                                    var minutesContainer = document.querySelector('.minutes')
                                                    var secondsContainer = document.querySelector('.seconds')
                                                    var tickElements = Array.from(document.querySelectorAll('.tick'))

                                                    var last = new Date(0)
                                                    last.setUTCHours(-1)

                                                    //var tickState = true

                                                    function updateTime() {
                                                        var now = new Date

                                                        var lastHours = last.getHours().toString()
                                                        var nowHours = now.getHours().toString()
                                                        if (lastHours !== nowHours) {
                                                            updateContainer(hoursContainer, nowHours)
                                                        }

                                                        var lastMinutes = last.getMinutes().toString()
                                                        var nowMinutes = now.getMinutes().toString()
                                                        if (lastMinutes !== nowMinutes) {
                                                            updateContainer(minutesContainer, nowMinutes)
                                                        }

                                                        var lastSeconds = last.getSeconds().toString()
                                                        var nowSeconds = now.getSeconds().toString()
                                                        if (lastSeconds !== nowSeconds) {
                                                            //tick()
                                                            updateContainer(secondsContainer, nowSeconds)
                                                        }

                                                        last = now
                                                    }

                                                    function tick() {
                                                        //tickElements.forEach(t => t.classList.toggle('tick-hidden'))
                                                    }

                                                    function updateContainer(container, newTime) {
                                                        var time = newTime.split('')

                                                        if (time.length === 1) {
                                                            time.unshift('0')
                                                        }


                                                        var first = container.firstElementChild
                                                        if (first.lastElementChild.textContent !== time[0]) {
                                                            updateNumber(first, time[0])
                                                        }

                                                        var last = container.lastElementChild
                                                        if (last.lastElementChild.textContent !== time[1]) {
                                                            updateNumber(last, time[1])
                                                        }
                                                    }

                                                    function updateNumber(element, number) {
                                                        //element.lastElementChild.textContent = number
                                                        var second = element.lastElementChild.cloneNode(true)
                                                        second.textContent = number

                                                        element.appendChild(second)
                                                        element.classList.add('move')

                                                        setTimeout(function() {
                                                            element.classList.remove('move')
                                                        }, 990)
                                                        setTimeout(function() {
                                                            element.removeChild(element.firstElementChild)
                                                        }, 990)
                                                    }

                                                    setInterval(updateTime, 100)
                                                </script>
                                                <!--<textarea class="form-control" id="txtfield" name="txtfield" rows="3" cols="18"></textarea>-->
                                            </div>

                                            <div class="col-5">
                                                <div class=" justify-content-center">
                                                    <div class="clock-wrapper">

                                                        <div class="clock-base">
                                                            <div class="clock-dial">
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                                <div class="clock-indicator"></div>
                                                            </div>
                                                            <div class="clock-hour"></div>
                                                            <div class="clock-minute"></div>
                                                            <div class="clock-second"></div>
                                                            <div class="clock-center"></div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="card p-3 mb-2">
                                        <div class="row">
                                            <div class="col-12 col-md-10 mb-2">
                                                <h3 class="heading mb-3">Login panel</h3>
                                                <textarea name="textarea1" id="textarea1" style="width: 100%" maxlength="300" placeholder="Add comment..."
                                                    autofocus></textarea>

                                                <div id="textcount">
                                                    <div style="float: right">
                                                        <span id="current">0</span>
                                                        <span id="maximum">/ 300</span>
                                                    </div>
                                                </div>

                                                <script>
                                                    $(function() {
                                                        $('#textarea1').keyup(function() {


                                                            var characterCount = $(this).val().length,
                                                                current = $('#current'),
                                                                maximum = $('#maximum'),
                                                                theCount = $('#textcount');

                                                            current.text(characterCount);


                                                            if (characterCount < 70) {
                                                                current.css('color', '#666');
                                                            }
                                                            if (characterCount > 70 && characterCount < 90) {
                                                                current.css('color', '#6d5555');
                                                            }
                                                            if (characterCount > 90 && characterCount < 100) {
                                                                current.css('color', '#793535');
                                                            }
                                                            if (characterCount > 100 && characterCount < 120) {
                                                                current.css('color', '#841c1c');
                                                            }
                                                            if (characterCount > 120 && characterCount < 139) {
                                                                current.css('color', '#8f0001');
                                                            }

                                                            if (characterCount >= 140) {
                                                                maximum.css('color', '#8f0001');
                                                                current.css('color', '#8f0001');
                                                                theCount.css('font-weight', 'bold');
                                                            } else {
                                                                maximum.css('color', '#666');
                                                                theCount.css('font-weight', 'normal');
                                                            }


                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-10 mt-2">
                                                <input class="btn btn-primary" type="button" style="float: right"
                                                    value="Log in">
                                                <input class="btn btn-danger" type="button" style="float: left"
                                                    value="Log out">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="card p-3 mb-2" style="min-height: 100%">

                                        <h5 class="heading mb-2">Commnets on sheduled shift</h5>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-6 ">
                                <div class="row m-lg-auto ">

                                    <div class="card p-3 pb-2 mb-2 mb-sm-0" style="height: 100%">

                                        <?php $have_yesterday = 0;
                                        $have_today = 0;
                                        $have_tommorow = 0; ?>
                                        <h5 class="heading mb-2">Upcoming shifts</h5>
                                        <div class=" c-details">
                                            <h6>Yeasterday</h6>

                                        </div>
                                        @foreach ($yesterday as $y)
                                            <?php $have_yesterday = 1; ?>
                                            <div class="col-12">
                                                <div class="card_shift radius-10 border-top border-bottom border-end"
                                                    style="border:10px solid {{ $y->color }}">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <p class="mb-0 text-secondary">
                                                                    {{ $y->object_name }} -
                                                                    {{ $y->shift_name }}</p>
                                                                <h4 class="my-1  ">
                                                                    {{ substr($y->saved_from, 0, -3) }} -
                                                                    {{ substr($y->saved_to, 0, -3) }}</h4>
                                                            </div>
                                                            <div
                                                                class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <?php if($have_yesterday == 0){ ?>
                                        <div class="col-12">
                                            <div class="card_shift radius-10 border-top border-bottom "
                                                style="border:10px solid #dc3545">
                                                <div class="card-body">
                                                    <div class=" align-items-center">
                                                        <div>
                                                            <div class="card p-3 mb-1 bg-danger w-100">
                                                                <div class="d-flex">
                                                                    <i
                                                                        class=" bi bi-x h3 mb-0 d-inline text-white"></i>
                                                                    <h4 class="mb-0 text-secondary text-white d-inline"
                                                                        style="width: 100%">No shift planned</h4>
                                                                </div>
                                                            </div>
                                                            <!--<p class="mb-0 font-13">+2.5% from last week</p>-->
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="mt-2 c-details">
                                            <h6>Today</h6>
                                        </div>
                                        @foreach ($today as $t)
                                            <?php $have_today = 1; ?>
                                            <div class="col-12">
                                                <div class="card_shift radius-10 border-top border-bottom border-end"
                                                    style="border:10px solid {{ $t->color }}">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <p class="mb-0 text-secondary">
                                                                    {{ $t->object_name }} -
                                                                    {{ $t->shift_name }}</p>
                                                                <h4 class="my-1  ">
                                                                    {{ substr($t->saved_from, 0, -3) }} -
                                                                    {{ substr($t->saved_to, 0, -3) }}</h4>
                                                            </div>
                                                            <div
                                                                class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                        <?php if($have_today == 0){ ?>
                                        <div class="col-12">
                                            <div class="card_shift radius-10 border-top border-bottom "
                                                style="border:10px solid #dc3545">
                                                <div class="card-body">
                                                    <div class=" align-items-center">
                                                        <div>
                                                            <div class="card p-3 mb-1 bg-danger w-100">
                                                                <div class="d-flex">
                                                                    <i
                                                                        class=" bi bi-x h3 mb-0 d-inline text-white"></i>
                                                                    <h4 class="mb-0 text-secondary text-white d-inline"
                                                                        style="width: 100%">No shift planned</h4>
                                                                </div>
                                                            </div>
                                                            <!--<p class="mb-0 font-13">+2.5% from last week</p>-->
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="mt-2 c-details">
                                            <h6>Tommorow</h6>
                                        </div>

                                        @foreach ($tommorow as $to)
                                            <?php $have_tommorow = 1; ?>
                                            <div class="col-12">
                                                <div class="card_shift radius-10 border-top border-bottom border-end"
                                                    style="border:10px solid {{ $to->color }}">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <p class="mb-0 text-secondary">
                                                                    {{ $to->object_name }} -
                                                                    {{ $to->shift_name }}</p>
                                                                <h4 class="my-1  ">
                                                                    {{ substr($to->saved_from, 0, -3) }} -
                                                                    {{ substr($to->saved_to, 0, -3) }}</h4>
                                                            </div>
                                                            <div
                                                                class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                        <?php if($have_tommorow == 0){ ?>
                                        <div class="col-12">
                                            <div class="card_shift radius-10 border-top border-bottom "
                                                style="border:10px solid #dc3545">
                                                <div class="card-body">
                                                    <div class=" align-items-center">
                                                        <div>
                                                            <div class="card p-3 mb-1 bg-danger w-100">
                                                                <div class="d-flex">
                                                                    <i
                                                                        class=" bi bi-x h3 mb-0 d-inline text-white"></i>
                                                                    <h4 class="mb-0 text-secondary text-white d-inline"
                                                                        style="width: 100%">No shift planned</h4>
                                                                </div>
                                                            </div>
                                                            <!--<p class="mb-0 font-13">+2.5% from last week</p>-->
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        @foreach ($worked as $w)
                                            @foreach ($planned1 as $p1)
                                                @foreach ($planned2 as $p2)
                                                    <div class="progress mt-2">
                                                        <?php $r = 5; 
                                            if($w == 0 || ($p1+ $p2) == 0 ){ ?>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: 0%" aria-valuenow="{{ $w }}"
                                                            aria-valuemin="0" aria-valuemax="{{ $p1 + $p2 }}">
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ ($w / $p1 + $p2) * 100 }}%"
                                                            aria-valuenow="{{ $w }}" aria-valuemin="0"
                                                            aria-valuemax="10"></div>
                                                        <?php } ?>

                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                        <div class="mt-2"> <span class="text1" style="float: right">
                                                @foreach ($worked as $w)
                                                    {{ $w }}
                                                @endforeach
                                                &nbsp;worked&nbsp;
                                                <span class="text2" style="float: right">of
                                                    @foreach ($planned1 as $p1)
                                                        @foreach ($planned2 as $p2)
                                                            {{ $p1 + $p2 }}
                                                        @endforeach
                                                    @endforeach
                                                    planned
                                                </span>
                                            </span> </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row m-md-auto">
                            <div class="card p-3 mb-2" style="height: 650px">
                                <!--<div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0">Mailchimp</h6> <span>1 days ago</span>
                                </div>
                            </div>
                            <div class="badge"> <span>Design</span> </div>
                        </div>
                        <div class="mt-5">
                            <h3 class="heading">Senior Product<br>Designer-Singapore</h3>
                            <div class="mt-5">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50
                                            capacity</span></span> </div>
                            </div>
                        </div>-->


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!--<div id="MultiCarouselInsert">
    
                    </div>-->
                    <div class="row mx-auto my-auto justify-content-center">
                        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div id="content_i">


                                    @php
                                        $counter = 0;

                                    @endphp
                                    @foreach ($board as $b)
                                        @php
                                            $counter++;
                                            $inside = str_replace("\n", '<br>', $b->content);
                                            $inside = str_replace(' ', '&nbsp;', $inside);
                                        @endphp
                                        @if ($counter == 1)
                                            <div class="carousel-item active">
                                            @else
                                                <div class="carousel-item">
                                        @endif
                                        <div class="col-12 col-md-3">
                                            <div class="card p-2">
                                                <div class="card">
                                                    <div class="card-header"
                                                        style="background-color:{{ $b->color }}; height: 25px">
                                                    </div>
                                                    @php

                                                        if ($b->image_link != null) {
                                                            $imageUrl = Storage::url($b->image_link);
                                                            $img_exists = 1;
                                                        } else {
                                                            $imageUrl = '';
                                                            $img_exists = 0;
                                                        }
                                                    @endphp
                                                    @if ($img_exists == 1)
                                                        <img height="150" class="object-fit-cover img-responsive"
                                                            style="aspect-ratio: auto;white-space: nowrap;"
                                                            src="{{ $imageUrl }}">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <center>{{ $b->caption }} </center>
                                                        </h5>
                                                        <hr>
                                                        <p class="card-text" id="id_board_{{ $b->id_board }}"
                                                            style="overflow: hidden visible;text-overflow: ellipsis;white-space: normal; max-height: 200px">

                                                            {!! nl2br(e($b->content)) !!}
                                                        </p>
                                                        <script></script>
                                                        <!-- <hr>
                                                        <p style="float: left"><strong>For : {{ $counter }} </strong>
                                                        </p>-->
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                @php
                                                                    /*$fetch_img = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$b->created_by'");
                                                                $supress = $fetch_img[0]->count;
                                                                if ($supress > 0) {
                                                                    $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$b->created_by'");
                                                                    $link_image = "";
                                                                    foreach ($fetch_link as $result_link) {
                                                                        $link_image = $result_link->image_link;
                                                                    }
                                                                    $imageUrl = Storage::url($link_image);
                                                                } else {
                                                                    $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
                                                                }*/
                                                                @endphp
                                                                <!-- <img src="" alt='hugenerd' width='40'
                                                                height="40" class="rounded-circle object-fit-cover img-responsive mr-3"
                                                                style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline;float: left">
                                                            
                                               
                                                            <h5 class="mt-2" style="display: inline;float: left">&nbsp;&nbsp;&nbsp;</h5>-->
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-sm "
                                                                    style="float: left" data-bs-toggle="modal"
                                                                    data-bs-target="#modalVer">Details</button>
                                                                <small class="mt-1"
                                                                    style="float:right">{{ substr($b->created_at, 0, -8) }}</small>
                                                            </div>
                                                            <!--<div class="col-12">
                                                                <center>
                                                                    <button class="btn btn-primary">
                                                                        Edit
                                                                    </button>
                                                                </center>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                    <!--<div class="card-img">
                                                        <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="card-img-overlay"> {{ $counter }} </div>-->
                                                </div>
                                            </div>
                                        </div>



                                       </div>
                                @endforeach

                                <!--<div class="carousel-item active">
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-img">
                                                    <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2"
                                                        class="img-fluid">
                                                </div>
                                                <div class="card-img-overlay">Slide 1</div>
                                            </div>
                                        </div>
                                    </div>-->

                                <!--<div class="carousel-item">
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-img">
                                                    <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2"
                                                        class="img-fluid">
                                                </div>
                                                <div class="card-img-overlay">Slide 2</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-img">
                                                    <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2"
                                                        class="img-fluid">
                                                </div>
                                                <div class="card-img-overlay">Slide 2</div>
                                            </div>
                                        </div>
                                    </div>-->
                                 </div>





                            </div>

                        <a class="carousel-control-prev bg-transparent w-aut text-dark" href="#recipeCarousel"
                            role="button" data-bs-slide="prev">
                            <span class="text-dark" style="font-size: 55px" aria-hidden="true">
                                < </span>
                        </a>
                        <a class="carousel-control-next bg-transparent w-aut text-dark" href="#recipeCarousel"
                            role="button" data-bs-slide="next">
                            <span class="text-dark" style="font-size: 55px" aria-hidden="true"> > </span>
                        </a>

                        </div>
                </div>
            </div>

                <div class="row m-md-auto">
                    <div class="col-12">
                        <div class="card p-3 mb-2">

                            <!--<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                                    <div class="MultiCarousel-inner">
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="pad15">
                                                <p class="lead">Multi Item Carousel</p>
                                                <p>₹ 1</p>
                                                <p>₹ 6000</p>
                                                <p>50% off</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary leftLst"><</button>
                                    <button class="btn btn-primary rightLst">></button>
                                </div>-->

                        </div>
                    </div>
                    <script>
                       /* $(document).ready(function() {
                            var itemsMainDiv = ('.MultiCarousel');
                            var itemsDiv = ('.MultiCarousel-inner');
                            var itemWidth = "";

                            $('.leftLst, .rightLst').click(function() {
                                var condition = $(this).hasClass("leftLst");
                                if (condition)
                                    click(0, this);
                                else
                                    click(1, this)
                            });

                            ResCarouselSize();




                            $(window).resize(function() {
                                ResCarouselSize();
                            });

                            //this function define the size of the items
                            function ResCarouselSize() {
                                var incno = 0;
                                var dataItems = ("data-items");
                                var itemClass = ('.item');
                                var id = 0;
                                var btnParentSb = '';
                                var itemsSplit = '';
                                var sampwidth = $(itemsMainDiv).width();
                                var bodyWidth = $('body').width();
                                $(itemsDiv).each(function() {
                                    id = id + 1;
                                    var itemNumbers = $(this).find(itemClass).length;
                                    btnParentSb = $(this).parent().attr(dataItems);
                                    itemsSplit = btnParentSb.split(',');
                                    $(this).parent().attr("id", "MultiCarousel" + id);


                                    if (bodyWidth >= 1200) {
                                        incno = itemsSplit[3];
                                        itemWidth = sampwidth / incno;
                                    } else if (bodyWidth >= 992) {
                                        incno = itemsSplit[2];
                                        itemWidth = sampwidth / incno;
                                    } else if (bodyWidth >= 768) {
                                        incno = itemsSplit[1];
                                        itemWidth = sampwidth / incno;
                                    } else {
                                        incno = itemsSplit[0];
                                        itemWidth = sampwidth / incno;
                                    }
                                    $(this).css({
                                        'transform': 'translateX(0px)',
                                        'width': itemWidth * itemNumbers
                                    });
                                    $(this).find(itemClass).each(function() {
                                        $(this).outerWidth(itemWidth);
                                    });

                                    $(".leftLst").addClass("over");
                                    $(".rightLst").removeClass("over");

                                });
                            }


                            //this function used to move the items
                            function ResCarousel(e, el, s) {
                                var leftBtn = ('.leftLst');
                                var rightBtn = ('.rightLst');
                                var translateXval = '';
                                var divStyle = $(el + ' ' + itemsDiv).css('transform');
                                var values = divStyle.match(/-?[\d\.]+/g);
                                var xds = Math.abs(values[4]);
                                if (e == 0) {
                                    translateXval = parseInt(xds) - parseInt(itemWidth * s);
                                    $(el + ' ' + rightBtn).removeClass("over");

                                    if (translateXval <= itemWidth / 2) {
                                        translateXval = 0;
                                        $(el + ' ' + leftBtn).addClass("over");
                                    }
                                } else if (e == 1) {
                                    var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                                    translateXval = parseInt(xds) + parseInt(itemWidth * s);
                                    $(el + ' ' + leftBtn).removeClass("over");

                                    if (translateXval >= itemsCondition - itemWidth / 2) {
                                        translateXval = itemsCondition;
                                        $(el + ' ' + rightBtn).addClass("over");
                                    }
                                }
                                $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
                            }

                            //It is used to get some elements from btn
                            function click(ell, ee) {
                                var Parent = "#" + $(ee).parent().attr("id");
                                var slide = $(Parent).attr("data-slide");
                                ResCarousel(ell, Parent, slide);
                            }

                        });*/
                    </script>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card p-3 mb-2">

                            <script>
                                /* https://codepen.io/HughDai/pen/MKKXJp/*/
                                (function() {

                                    //generate clock animations
                                    var now2 = new Date(),
                                        hourDeg = now2.getHours() / 12 * 360 + now2.getMinutes() / 60 * 30,
                                        minuteDeg = now2.getMinutes() / 60 * 360 + now2.getSeconds() / 60 * 6,
                                        secondDeg = now2.getSeconds() / 60 * 360,
                                        stylesDeg = [
                                            "@-webkit-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (
                                                hourDeg + 360) + "deg);}}",
                                            "@-webkit-keyframes rotate-minute{from{transform:rotate(" + minuteDeg +
                                            "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
                                            "@-webkit-keyframes rotate-second{from{transform:rotate(" + secondDeg +
                                            "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}",
                                            "@-moz-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (
                                                hourDeg + 360) + "deg);}}",
                                            "@-moz-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" +
                                            (minuteDeg + 360) + "deg);}}",
                                            "@-moz-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" +
                                            (secondDeg + 360) + "deg);}}"
                                        ].join("");

                                    document.getElementById("clock-animations").innerHTML = stylesDeg;

                                })();
                            </script>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Mailchimp</h6> <span>1 days ago</span>
                                    </div>
                                </div>
                                <div class="badge"> <span>Design</span> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">Senior Product<br>Designer-Singapore</h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50
                                                capacity</span></span> </div>
                                </div>
                            </div>-
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-right:1%">

                    <div class="col-12">

                        <div class="card p-3 mb-2 d-none">

                            <div style="margin-left:3%">

                                <div class="graph justify-content-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" data-mdb-toggle="dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            2024
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                    <ul class="months ">
                                        <li>Jan</li>
                                        <li>Feb</li>
                                        <li>Mar</li>
                                        <li>Apr</li>
                                        <li>May</li>
                                        <li>Jun</li>
                                        <li>Jul</li>
                                        <li>Aug</li>
                                        <li>Sep</li>
                                        <li>Oct</li>
                                        <li>Nov</li>
                                        <li>Dec</li>
                                    </ul>
                                    <ul class="days ">
                                        <li>Sun</li>
                                        <li>Mon</li>
                                        <li>Tue</li>
                                        <li>Wed</li>
                                        <li>Thu</li>
                                        <li>Fri</li>
                                        <li>Sat</li>
                                    </ul>
                                    <ul class="squares">
                                        <!-- added via javascript -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <script>
                    const squares = document.querySelector('.squares');
                    for (var i = 1; i < 365; i++) {
                        const level = Math.floor(Math.random() * 3);
                        squares.insertAdjacentHTML('beforeend', `<li data-level="${level}"></li>`);
                    }
                </script>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <script>
        var closeds = 0;
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')

                    })

                }

            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>
</body>

</html>
