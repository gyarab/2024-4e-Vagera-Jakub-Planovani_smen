<!--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>-->
<!--  https://bbbootstrap.com/snippets/bootstrap-5-search-bar-microphone-icon-inside-12725910#-->
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5"
        rel="stylesheet"> <!--load all styles -->
    <link href="{{ asset('CSS/search.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/notification.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/graph.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/card.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock2.css') }}" rel="stylesheet">




    <style>
        .hover_side:hover {
            color: yellow;
        }
    </style>
  <style id="clock-animations"></style>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!--<div class="container-fluid bg-light">-->
        <!--<header class="fixed-top">
            <div class="row flex-nowrap border-bottom bg-white" style="height: 50px">
                <div class="col-auto col-2 ">
                    <div class="ps-3 mt-0 ml-2 align-middle">
                        <div class="row">

                            <div class="col-12">
                                <img src="{{ URL('images/logo2.png') }}" class="img-fluid d-none d-sm-inline"
                                    style="width:17em; height:3em;">
                            </div>
                            <div class="text-center">
                                <img src="{{ URL('images/new_icon.png') }}" alt="hugenerd" width="40" height="40"
                                    class="rounded-circle d-inline d-sm-none align-center mt-1 ml-1">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-8 col-sm-6 ">
                    <div class="mt-1">
                        <div class="form">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control form-input" placeholder="Search anything...">
                            <span class="left-pan"><i class="fa fa-microphone"></i></span>
                        </div>

                    </div>
                </div>
                <div class="col-auto col-0 col-sm-3 ">
                    <div class="dropdown d-none d-sm-inline" style="float: left; padding: 13px">

                        <a id="dropdownMenu1" href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            style="float: right" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
                            </i>
                        </a>
                        <span class="badge badge-danger">10</span>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenu1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>

                    <div style="float: right">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle d-none d-sm-inline mt-2"
                            style="float: right" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                            <img src="{{ URL('images/person.jpg') }}" alt="hugenerd" width="30" height="30"
                                class="rounded-circle mx-2 mt-1" style="aspect-ratio: auto;">
                            <div class="row d-inline">
                                <div class="col-12 d-inline">
                                    <span class="d-none d-sm-inline mx-2 text-black">Moje jmeno</span>

                                    <span class="d-none d-sm-inline text-black"><small>Admin</small></span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                            aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-1">
                    <div class="dropdown">
                        <a data-mdb-dropdown-init class="dropdown-toggle" href="#" id="Dropdowns"
                            role="button" data-mdb-toggle="dropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="flag-united-kingdom flag m-0"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="Dropdowns">
                            <li>
                                <a class="dropdown-item" href="#"><i
                                        class="flag-united-kingdom flag"></i>English <i
                                        class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i
                                        class="flag-portugal flag"></i>Português</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>-->
        <div class="row flex-nowrap">

            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white  border border-right-1 border-top-0">
                <div class="d-inline d-sm-none">

                    <br>

                </div>
                <div
                    class="flex-column align-items-center sticky-top align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pt-50 pb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>

                    <ul class="nav nav-wrapper nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <div class="row " style="display:flex;">
                            <div class="col-12">
                                <li class="nav-item " style="width: auto">
                                    <div class="d-block">
                                        <a href="#" class="nav-link align-middle px-0 text-black ">
                                            <i class="fs-4 bi-house"></i> <span
                                                class="ms-1 d-none d-sm-inline ">Home</span>
                                        </a>
                                    </div>
                                </li>
                            </div>
                        </div>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-speedometer2"></i> <span
                                    class="ms-1 d-none d-sm-inline hover_side ">Dashboard</span> </a>
                            <ul class="collapse nav flex-column ms-1 text-black hover_side" id="submenu1"
                                data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 1 </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 2 </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-table"></i> <span
                                    class="ms-1 d-none d-sm-inline text-black">Orders</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-bootstrap text-black"></i> <span
                                    class="ms-1 d-none d-sm-inline text-black">Bootstrap</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-grid"></i> <span
                                    class="ms-1 d-none d-sm-inline text-black">Products</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 2</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 3</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown d-inline d-sm-none">
                                <br>
                                <br>
                                <hr>
                            </div>
                            <div class="dropdown d-inline d-sm-none" style="float: right; padding-top: 18px">

                                <a id="dropdownMenu2" href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    style="float: right" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
                                    </i>
                                </a>
                                <span class="badge badge-danger">10</span>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownMenu2">
                                    <li><a class="dropdown-item" href="#">New project...</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4 d-inline d-sm-none">
                        <a href="#"
                            class="d-flex align-items-center text-decoration-none dropdown-toggle text-black"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle text-black">
                            <span class="d-none d-sm-inline mx-1 text-black">loser</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow text-black"
                            aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <br>
                <br>
                <div class="row" style="margin-right:1%">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="card p-3 mb-2">
                                    <div class="row ">
                                        <div class="col-12 col-md-7 ">
                                            <div>
                                            <div class="mb-0 ">
                                                <p id="weekday" style="margin-bottom: 0px; display: inline"></p>
                                                <p id="timezone" style="margin-bottom: 0px; display: inline"></p>
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

                                        <div class="col-12 col-md-5">
                                            <div class="d-none d-md-block justify-content-center">
                                            <div class="clock-wrapper" >
                                          
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
                                <div class="card p-3 mb-2">
                                    <div class="row">
                                        <div class="col-12 col-md-10 mb-2">
                                            <h3 class="heading mb-3">Login panel</h3>
                                            <textarea name="textarea1" id="textarea1" style="width: 100%"  maxlength="300"
                                                placeholder="Add comment..." autofocus></textarea>
                                                
                                            <div id="textcount" >
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
                                            <input class="btn btn-primary" type="button" style="float: right" value="Log in">
                                            <input class="btn btn-danger" type="button" style="float: left" value="Log out">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card p-3 mb-2 pb-2" style="height: 98%">
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
                                            <div class="mt-3"> <span class="text1">32 Applied <span
                                                        class="text2">of 50 capacity</span></span> </div>
                                        </div>
                                    </div>-->
                                    <?php $have_yesterday = 0;
                                    $have_today = 0; 
                                    $have_tommorow = 0;?>
                                    <h5 class="heading mb-2">Upcoming shifts</h5>
                                    <div class=" c-details">
                                        <h6>Yeasterday</h6>
                                   
                                    </div>
                                    @foreach($yesterday as $y)
                                    <?php $have_yesterday = 1 ?>
                                    <div class="col-12">
                                        <div class="card_shift radius-10 border-top border-bottom border-end" style="border:10px solid {{$y->color}}">
                                           <div class="card-body">
                                               <div class="d-flex align-items-center">
                                                   <div>
                                                       <p class="mb-0 text-secondary">{{$y->object_name}} - {{$y->shift_name}}</p>
                                                       <h4 class="my-1  ">{{substr($y->saved_from, 0, -3)}} - {{substr($y->saved_to, 0, -3)}}</h4>
                                                   </div>
                                                   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-shopping-cart"></i>
                                                   </div>
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!--<div class="col-12">
                                        <div class="card_shift radius-10 border-top border-bottom border-end" style="border:10px solid red">
                                           <div class="card-body">
                                               <div class="d-flex align-items-center">
                                                   <div>
                                                       <p class="mb-0 text-secondary">Floor 1 - Manager</p>
                                                       <h4 class="my-1  ">16:00 - 22:00</h4>
                                                       <!--<p class="mb-0 font-13">+2.5% from last week</p>-->
                                                   <!--</div>
                                                   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-shopping-cart"></i>
                                                   </div>
                                               </div>
                                           </div>
                                        </div>
                                    </div>-->
                                    <?php if($have_yesterday == 0){ ?>
                                    <div class="col-12">
                                        <div class="card_shift radius-10 border-top border-bottom " style="border:10px solid #dc3545">
                                           <div class="card-body">
                                               <div class=" align-items-center">
                                                   <div>
                                                    <div class="card p-3 mb-1 bg-danger w-100" >
                                                        <div class="d-flex">
                                                        <i class=" bi bi-x h3 mb-0 d-inline text-white"></i> <h4 class="mb-0 text-secondary text-white d-inline" style="width: 100%">No shift planned</h4>
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
                                    @foreach($today as $t)
                                    <?php $have_today = 1 ?>
                                    <div class="col-12">
                                        <div class="card_shift radius-10 border-top border-bottom border-end" style="border:10px solid {{$t->color}}">
                                           <div class="card-body">
                                               <div class="d-flex align-items-center">
                                                   <div>
                                                       <p class="mb-0 text-secondary">{{$t->object_name}} - {{$t->shift_name}}</p>
                                                       <h4 class="my-1  ">{{substr($t->saved_from, 0, -3)}} - {{substr($t->saved_to, 0, -3)}}</h4>
                                                   </div>
                                                   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-shopping-cart"></i>
                                                   </div>
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                    @endforeach
                       

                                    <?php if($have_today == 0){ ?>
                                        <div class="col-12">
                                            <div class="card_shift radius-10 border-top border-bottom " style="border:10px solid #dc3545">
                                               <div class="card-body">
                                                   <div class=" align-items-center">
                                                       <div>
                                                        <div class="card p-3 mb-1 bg-danger w-100" >
                                                            <div class="d-flex">
                                                            <i class=" bi bi-x h3 mb-0 d-inline text-white"></i> <h4 class="mb-0 text-secondary text-white d-inline" style="width: 100%">No shift planned</h4>
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
                                
                                @foreach($tommorow as $to)

                                <?php $have_tommorow = 1 ?>
                                <div class="col-12">
                                    <div class="card_shift radius-10 border-top border-bottom border-end" style="border:10px solid {{$to->color}}">
                                       <div class="card-body">
                                           <div class="d-flex align-items-center">
                                               <div>
                                                   <p class="mb-0 text-secondary">{{$to->object_name}} - {{$to->shift_name}}</p>
                                                   <h4 class="my-1  ">{{substr($to->saved_from, 0, -3)}} - {{substr($to->saved_to, 0, -3)}}</h4>
                                               </div>
                                               <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-shopping-cart"></i>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                                @endforeach
                   

                                <?php if($have_tommorow == 0){ ?>
                                    <div class="col-12">
                                        <div class="card_shift radius-10 border-top border-bottom " style="border:10px solid #dc3545">
                                           <div class="card-body">
                                               <div class=" align-items-center">
                                                   <div>
                                                    <div class="card p-3 mb-1 bg-danger w-100" >
                                                        <div class="d-flex">
                                                        <i class=" bi bi-x h3 mb-0 d-inline text-white"></i> <h4 class="mb-0 text-secondary text-white d-inline" style="width: 100%">No shift planned</h4>
                                                        </div>
                                                    </div>
                                                       <!--<p class="mb-0 font-13">+2.5% from last week</p>-->
                                                   </div>
                                               
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
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
                                            <div class="mt-3"> <span class="text1">32 Applied <span
                                                        class="text2">of 50 capacity</span></span> </div>
                                        </div>
                                    </div>-
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6">
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
    <!--</div>-->
</body>

</html>
