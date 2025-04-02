<!DOCTYPE html>
<html lang="en">

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link href="{{ asset('CSS/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/search.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/notification.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/graph.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/card.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock2.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>


</head>

<body id="body-pd">
    <script></script>
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
    <style>
        .in {
            border-radius: 100%;
            height: 30px;
            width: 30px;
            border: solid #aaa;
        }
    </style>
    <style id="clock-animations"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @include('vendor.Chatify.pages.header-manager')
    @include('vendor.Chatify.pages.sidebar-manager')
    @include('admin.scripts')

    <div class="border-start bg-light">


        <div class="h-100 bg-light">

            <script>
                const offer_date;
                const get_timestamp;

                document.getElementById("asd").addEventListener("click", clicker);

                function clicker() {
                    document.getElementById("links").classList.remove("d-none");
                }
            </script>
            <div class="container-fluid mt-1">
                <script>
                    var hoursContainer = document.querySelector('.hours')
                    var minutesContainer = document.querySelector('.minutes')
                    var secondsContainer = document.querySelector('.seconds')
                    var tickElements = Array.from(document.querySelectorAll('.tick'))

                    var last = new Date(0)
                    last.setUTCHours(-1)


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
                            updateContainer(secondsContainer, nowSeconds)
                        }

                        last = now
                    }

                    function tick() {
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
                <div class="row mx-2" style="margin-right:1%; ">
                    <div class="col-12 col-md-6 mt-2" >
                        <div class="row">
                            <div class="col-12 col-lg-6">
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
                                    <div class="card p-3 mb-2" style="min-height: 239px">
                                        <div class="row">
                                            <div class="col-12 col-md-10 mb-2">
                                                <h4 class="heading mb-3">Login panel</h4>
                                                <hr>
                                                <div id="no_shifts" class="card p-0 m-0">
                                                    <center>
                                                        <p class=" p-0 m-1 text-secondary"><i
                                                                class="mx-1 bi bi-sticky"></i>No shifts avalible</p>
                                                    </center>
                                                </div>
                                                <div id="log_div" style="display:none">
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
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-12 col-md-12 mt-2">
                                                            <input id="confirm" class="btn btn-primary"
                                                                type="button" style="float: right; display: none;"
                                                                onclick="confirmArrival()" value="Log in">
                                                            <input id="departure" class="btn btn-danger"
                                                                type="button" style="float: left" value="Log out"
                                                                onclick="confirmDeparture()">
                                                            <div id="pause_div">

                                                                <div class="d-flex d-md-block justify-content-end">
                                                                    <button id="pause_start" type="button"
                                                                        style="bottom:1%;color:#ffffff;float: right;display:none"
                                                                        class="btn btn-info"
                                                                        onclick="start_break()">Start break</button>
                                                                </div>

                                                                <div class="d-flex d-md-block justify-content-end">
                                                                    <button id="pause_end" type="button"
                                                                        style="float: right;bottom:1%;display:none"
                                                                        class="btn btn-outline-info"
                                                                        onclick="end_break()">End break</button>
                                                                </div>

                                                                <script>
                                                                    function start_break() {
                                                                        $.ajax({
                                                                            url: '{{ route('startBreak') }}',
                                                                            type: 'POST',
                                                                            data: {
                                                                                _token: '{{ csrf_token() }}',

                                                                            },
                                                                            success: function(response) {
                                                                                document.getElementById("pause_start").style.display = "none";
                                                                                document.getElementById("pause_end").style.display = "";
                                                                                break_alert("Your break has begun");


                                                                            },
                                                                            error: function(xhr, status, error) {
                                                                                
                                                                                error_sweet_alert('Error fetching image renders: -- ');
                                                                            }
                                                                        });
                                                                    }

                                                                    function end_break() {

                                                                        $.ajax({
                                                                            url: '{{ route('endBreak') }}',
                                                                            type: 'POST',
                                                                            data: {
                                                                                _token: '{{ csrf_token() }}',

                                                                            },
                                                                            success: function(response) {
                                                                                document.getElementById("pause_start").style.display = "";
                                                                                document.getElementById("pause_end").style.display = "none";
                                                                                break_alert("Your break has ended");


                                                                            },
                                                                            error: function(xhr, status, error) {

                                                                                error_sweet_alert('Error fetching image renders: -- ');
                                                                            }
                                                                        });
                                                                    }
                                                                </script>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="card p-3 mb-2 " style="height: 285px;max-height: 285px;overflow:auto">

                                        <h5 class="heading mb-2">Comments on sheduled shift</h5>
                                        <hr>
                                        <script>
                                            var rowTextDay;
                                            var newTextDay;
                                        </script>
                                        @php
                                            $comments_counter = 0;
                                        @endphp
                                        <?php $comment_today = 0; ?>
                                        @foreach ($today as $t)
                                            @if ($t->comments != '')
                                                <?php $comment_today = 1; ?>
                                                <script>
                                                    rowTextDay = @json($t->comments);
                                                    newTextDay = rowTextDay.replace(/\n/g, '<br>');
                                                </script>
                                                <div class="card" style="max-height: 200px;overflow:auto">
                                                    <div class="card-header p-0 bg-white radius-10 border-top border-bottom border-end"
                                                        style="border:5px solid {{ $t->color }}">
                                                        <p class="m-1 text-secondary">
                                                            {{ $t->object_name }} -
                                                            {{ $t->shift_name }}
                                                        </p>
                                                    </div>
                                                    <div class="card-body p-1">
                                                        <p id="com_count-{{ $comments_counter }}" class="mb-0"></p>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById("com_count-{{ $comments_counter }}").innerHTML = newTextDay;
                                                </script>
                                            @endif
                                        @endforeach
                                        <?php if ($comment_today == 0){ ?>
                                        <div id="no_comments" class="card p-0 m-0">
                                            <center>
                                                <p class=" p-0 m-1 text-secondary"><i class="mx-1 bi bi-sticky"></i>No
                                                    comments</p>
                                            </center>

                                        </div>
                                        <?php } ?>


                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-6 ">
                                <div class="row m-lg-auto ">

                                    <div class="card p-3 pb-2 mb-2 mb-sm-0" style="height: 650px">
                                        <div style="overflow: auto">
                                            <?php $have_yesterday = 0;
                                            $have_today = 0;
                                            $have_tommorow = 0;
                                            $have_tomorrow_shift_next = 0; ?>
                                            @foreach ($tomorrow_shift_next as $tm2)
                                                <?php $have_tomorrow_shift_next = 1; ?>
                                            @endforeach
                                            <h5 class="heading mb-2">Upcoming shifts</h5>
                                            <hr>
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
                                                                            style="width: 100%">No shift planned
                                                                        </h4>
                                                                    </div>
                                                                </div>
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
                                                                            style="width: 100%">No shift planned
                                                                        </h4>
                                                                    </div>
                                                                </div>
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
                                                                            style="width: 100%">No shift planned
                                                                        </h4>
                                                                    </div>
                                                                </div>
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
                                                if($w == 0 || ($p1) == 0 ){ ?>
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 0%" aria-valuenow="{{ $w }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $p1  }}">
                                                            </div>
                                                            <?php }else{ ?>
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ ($w / $p1 ) * 100 }}%"
                                                                aria-valuenow="{{ $w }}" aria-valuemin="0"
                                                                aria-valuemax="10"></div>
                                                            <?php } ?>

                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                            <div class="mt-2">
                                                <span class="text1" style="float: right">
                                                    @foreach ($worked as $w)
                                                        {{ $w }}
                                                    @endforeach
                                                    &nbsp;worked&nbsp;
                                                    <span class="text2" style="float: right">of
                                                        @foreach ($planned1 as $p1)
                                                            @foreach ($planned2 as $p2)
                                                                {{ $p1 }}
                                                            @endforeach
                                                        @endforeach
                                                        planned
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="col-12 col-md-6  mt-2">
                        <div class="row ">
                            <div class="card p-3 mb-2" style="height: 650px">
                                <div class="row">
                                    <div class="col-8">
                                        <h5>Organization</h5>

                                    </div>
                                    <div class="col-4">
                                        <select id="select_obj" class="form-sm form-select"
                                            aria-label="Default select example">

                                        </select>

                                    </div>

                                </div>

                                <hr style="margin-top: 2px;margin-bottom: 5px ">
                                <div id="organization_load" style="overflow: auto">

                                </div>


                            </div>
                            <script>
                                renderObjectSelect();

                                function renderOrganization() {
                                    var input_id = document.getElementById("select_obj").value;

                                    $.ajax({
                                        url: '{{ route('loadOrganizationTable') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            input: input_id
                                        },
                                        success: function(response) {
                                            document.getElementById("organization_load").innerHTML = response;
       

                                        },
                                        error: function(xhr, status, error) {

                                            error_sweet_alert('Error fetching image renders: -- ');
                                        }
                                    });
                                }

                                function renderObjectSelect() {
                                    $.ajax({
                                        url: '{{ route('selectMainObjects') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                        },
                                        success: function(response) {
                                            document.getElementById("select_obj").innerHTML = response;
                                            renderOrganization();

                                        },
                                        error: function(xhr, status, error) {

                                            error_sweet_alert('Error fetching image render: 22 ');
                                        }
                                    });
                                }
                            </script>
                            <script>
                                $('#select_obj').change(function() {
                                    renderOrganization();

                                });
                            </script>
                        </div>
                    </div>
                </div>
                <!--</div>-->
                <div class="row px-2">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="px-3 py-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>My activity</h5>
                                            </div>
                                            <div class="col-6">
                                                <div class="dropdown" style="float: right">
                                                    <?php $current_year = Date('Y'); ?>
                                                    <select id="year_button"
                                                        class="btn  btn-secondary btn-sm form-select px-5 "
                                                        onchange="select_graph(this.value)" data-bs-toggle="dropdown"
                                                        aria-label=".form-select example">
                                                        @for ($i = 2020; $i <= $current_year + 1; $i++)
                                                            @if ($i == $current_year)
                                                                <option value="{{ $i }}" selected>
                                                                    {{ $i }}</option>
                                                            @else
                                                                <option value="{{ $i }}">
                                                                    {{ $i }}</option>
                                                            @endif
                                                        @endfor


                                                    </select>
                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto px-3">


                                <div class="graph pb-3">


                                    <ul class="px-0 months">
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
                                    <ul id="days_name" class="px-0 days ">
                                        <li style="font-size:15px; margin-top:-5px;">Sun</li>
                                        <li style="font-size:15px; margin-top:-5px;"></li>
                                        <li style="font-size:15px; margin-top:-5px;">Tue</li>
                                        <li style="font-size:15px; margin-top:-5px;"></li>
                                        <li style="font-size:15px; margin-top:-5px;">Thu</li>
                                        <li style="font-size:15px; margin-top:-5px;"></li>
                                        <li style="font-size:15px; margin-top:-5px;">Sat</li>
                                    </ul>
                                    <ul id="graph_square" class="px-0 squares" style="overflow: hidden">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card p-3 mb-2 mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <h5>This week statistics</h5>
                                    <hr>
                                    <div id="div_can">
                                        <canvas id="weekChart" style="width: 100%"></canvas>
                                    </div>

                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                    <script>
                                        const ctx = document.getElementById('weekChart');

                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', ],
                                                datasets: [{
                                                    label: '# of Votes',
                                                    data: [0, 0, 0, 0, 0, 0, 0],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false, // Disable this to allow for a custom aspect ratio
                                                scales: {
                                                    x: {
                                                        beginAtZero: true
                                                    },
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });

                                    </script>

                                </div>
                            </div>

                        </div>
                    </div>
                    <script>
                        let rowText = "";
                        var newText = "";
                    </script>
                    <div class="col-12 col-md-6 px-0">
                        <div class="card p-3 mb-3 h-100 ">
                            <div class="row">
                                <div class="col-12 ">
                                    <h5 style="display: inline">Free shifts</h5>
                                    <button class="btn btn-primary btn-sm" style="float: right;display: inline">View
                                        more</button>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <h6>Today</h6>

                                            <?php $is_today_offer = 0; ?>
                                            @foreach ($today_offer as $tdof)
                                                <?php $is_today_offer++; ?>
                                                <div class="mb-1">
                                                    <div class="card_shift radius-10 border-top border-bottom border-end pb-2"
                                                        style="border:10px solid {{ $tdof->color }}">
                                                        <p class="mb-0 mx-2 my-2 text-secondary">
                                                            {{ $tdof->object_name }} -
                                                            {{ $tdof->shift_name }}</p>
                                                        <p class="mb-0 mx-2 my-1"
                                                            style="display:inline;margin-bottom: 15px"><strong>
                                                                {{ substr($tdof->saved_from, 0, -3) }} -
                                                                {{ substr($tdof->saved_to, 0, -3) }}</strong></p>
                                                        <i id="it-{{ $tdof->id_offer }}"
                                                            class="bi bi-info-circle mx-2" style="float: right"></i>
                                                        <script>
                                                            get_timestamp = @json($tdof->created_at);
                                                            offer_date = new Date((get_timestamp + 86400) * 1000);
                                                            tippy("#it-{{ $tdof->id_offer }}", {
                                                                content: '<strong>Main: <br> Offered by: <span style="color: aqua;">{{ $tdof->last_name }} {{ $tdof->middle_name }} {{ $tdof->first_name }}</span> <br> Offered at:  <span style="color: aqua;">' +
                                                                    offer_date.toDateString() + '</span></strong>',
                                                                allowHTML: true,
                                                            });
                                                        </script>
                                                        <br>
                                                        <hr class="m-0 mt-1 p-0">
                                                        <i class="bi bi-sunglasses mx-2" style="font-size: 25px"></i>
                                                        <?php if($have_today == 1){ ?>
                                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                                            style="font-size: 20px; ;color:#0d6efd;"></i>
                                                        <?php }else{ ?>
                                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                                            style="font-size: 20px"></i>
                                                        <?php } ?>

                                                        @if ($tdof->comments == '' || $tdof->comments == null)
                                                            <i id="cm-{{ $tdof->id_offer }}"
                                                                class="bi bi-chat-square-dots-fill mt-1 mx-2"
                                                                style="font-size: 17px"></i>
                                                        @else
                                                            <i id="cm-{{ $tdof->id_offer }}"
                                                                class="bi bi-chat-square-dots-fill mt-1 mx-2"
                                                                style="font-size: 17px; color:#0d6efd;"></i>
                                                            <script>
                                                                rowText = @json($tdof->comments);
                                                                newText = rowText.replace(/\n/g, '<br>');
                                                                tippy("#cm-{{ $tdof->id_offer }}", {
                                                                    content: '<strong><span style="color: aqua;"></span>' + newText + '</strong>',
                                                                    allowHTML: true,
                                                                });
                                                            </script>
                                                        @endif
                                                        <script>
                                              
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                                                            rowText = @json($tdof->comments);
                                                        </script>
                          
                                                        @if ($tdof->accepted_at == null)
                                                            @if ($tdof->request_status == '1')
                                                            @else
                                                                <button id="btt-"
                                                                    class="mt-2 mx-2 btn btn-sm btn-outline-primary"
                                                                    style="float:right">
                                                                    <span id="st-{{ $tdof->id_offer }}"
                                                                        class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"
                                                                        style="display: none;">
                                                                    </span>Requests</button>
                                                            @endif
                                                        @else
                                                            @if ($tdof->request_status == '0')
                                                                <button id="btt-{{ $tdof->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-success"
                                                                    style="float:right">
                                                                    <i class="bi bi-calendar2-check"
                                                                        style="margin-right: 5px"></i>Granted</button>
                                                            @elseif ($tdof->request_status == '1')
                                                                <button id="btt-{{ $tdof->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-secondary"
                                                                    style="float:right">
                                                                    <i class="bi bi-calendar-minus"
                                                                        style="margin-right: 5px"></i>Unconfirmed</button>
                                                            @elseif ($tdof->request_status == '2')
                                                                <button id="btt-{{ $tdof->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-danger"
                                                                    style="float:right">

                                                                    <i class="bi bi-calendar2-x"
                                                                        style="margin-right: 5px"></i>Denied</button>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($is_today_offer == 0)
                                                <div class="card p-0 m-0">
                                                    <center>
                                                        <p class=" p-0 m-1 text-secondary"><i
                                                                class="mx-1 bi bi-sticky"></i>No offers</p>
                                                    </center>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <h6>Tommorow</h6>
                                            <?php $is_tommorow_offer = 0; ?>
                                            @foreach ($tommorow_offer as $tmof)
                                                <?php $is_tommorow_offer++; ?>
                                                <div class="mb-1">
                                                    <div class="card_shift radius-10 border-top border-bottom border-end pb-2"
                                                        style="border:10px solid {{ $tmof->color }}">
                                                        <p class="mb-0 mx-2 my-2 text-secondary">
                                                            {{ $tmof->object_name }} -
                                                            {{ $tmof->shift_name }}</p>
                                                        <p class="mb-0 mx-2 my-1"
                                                            style="display:inline;margin-bottom: 15px"><strong>
                                                                {{ substr($tmof->saved_from, 0, -3) }} -
                                                                {{ substr($tmof->saved_to, 0, -3) }}</strong></p>
                                                        <i id="it-{{ $tmof->id_offer }}"
                                                            class="bi bi-info-circle mx-2" style="float: right"></i>
                                                        <script>
                                                            get_timestamp = @json($tmof->created_at);
                                                            offer_date = new Date(get_timestamp * 1000);
                                                            tippy("#it-{{ $tmof->id_offer }}", {
                                                                content: '<strong>Main: <br> Offered by: <span style="color: aqua;">{{ $tmof->last_name }} {{ $tmof->middle_name }} {{ $tmof->first_name }}</span> <br> Offered at:  <span style="color: aqua;">' +
                                                                    offer_date.toDateString() + '</span></strong>',
                                                                allowHTML: true,
                                                            });
                                                        </script>
                                                        <br>
                                                        <hr class="m-0 mt-1 p-0">
                                                        <i class="bi bi-sunglasses mx-2" style="font-size: 25px"></i>
                                                        <?php if($have_tommorow == 1){ ?>
                                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                                            style="font-size: 20px; ;color:#0d6efd;"></i>
                                                        <?php }else{ ?>
                                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                                            style="font-size: 20px"></i>
                                                        <?php } ?>

                                                        @if ($tmof->comments == '' || $tmof->comments == null)
                                                            <i id="cm-{{ $tmof->id_offer }}"
                                                                class="bi bi-chat-square-dots-fill mt-1 mx-2"
                                                                style="font-size: 17px"></i>
                                                        @else
                                                            <i id="cm-{{ $tmof->id_offer }}"
                                                                class="bi bi-chat-square-dots-fill mt-1 mx-2"
                                                                style="font-size: 17px; color:#0d6efd;"></i>
                                                            <script>
                                                                rowText = @json($tmof->comments);
                                                                newText = rowText.replace(/\n/g, '<br>');
                                                                tippy("#cm-{{ $tmof->id_offer }}", {
                                                                    content: '<strong><span style="color: aqua;"></span>' + newText + '</strong>',
                                                                    allowHTML: true,
                                                                });
                                                            </script>
                                                        @endif
                                                        <script>
                                                            /*tippy("#cm-23", {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            content: '<strong><span style="color: aqua;"></span>dsa </strong>',
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             allowHTML: true,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            });*/
                                                        </script>
                                                        <!--<button class="mt-2 mx-2 btn btn-sm btn-outline-primary"
                                                            style="float:right">Request</button>-->
                                                        @if ($tmof->accepted_at == null)
                                                            @if ($tmof->request_status == '1')
                                                            @else
                                                                <button id="btt-"
                                                                    class="mt-2 mx-2 btn btn-sm btn-outline-primary"
                                                                    style="float:right">
                                                                    <span id="st-{{ $tmof->id_offer }}"
                                                                        class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"
                                                                        style="display: none;">
                                                                    </span>Requests</button>
                                                            @endif
                                                        @else
                                                            @if ($tmof->request_status == '0')
                                                                <button id="btt-{{ $tmof->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-success"
                                                                    style="float:right">
                                                                    <i class="bi bi-calendar2-check"
                                                                        style="margin-right: 5px"></i>Granted</button>
                                                            @elseif ($tmof->request_status == '1')
                                                                <button id="btt-{{ $tmof->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-secondary"
                                                                    style="float:right">
                                                                    <i class="bi bi-calendar-minus"
                                                                        style="margin-right: 5px"></i>Unconfirmed</button>
                                                            @elseif ($tmof->request_status == '2')
                                                                <button id="btt-{{ $tmof->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-danger"
                                                                    style="float:right">

                                                                    <i class="bi bi-calendar2-x"
                                                                        style="margin-right: 5px"></i>Denied</button>
                                                            @endif
                                                        @endif



                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($is_tommorow_offer == 0)
                                                <div class="card p-0 m-0">
                                                    <center>
                                                        <p class=" p-0 m-1 text-secondary"><i
                                                                class="mx-1 bi bi-sticky"></i>No offers</p>
                                                    </center>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-lg-4" style="min-height: 100%">


                                            <h6>Tommorow + </h6>

                                            <?php $is_tommorow_offer_plus = 0; ?>
                                            @foreach ($tommorow_offer2 as $tm2of)
                                                <?php $is_tommorow_offer_plus++; ?>
                                                <div class="mb-1">
                                                    <div class="card_shift radius-10 border-top border-bottom border-end pb-2"
                                                        style="border:10px solid {{ $tm2of->color }}">
                                                        <p class="mb-0 mx-2 my-2 text-secondary">
                                                            {{ $tm2of->object_name }} -
                                                            {{ $tm2of->shift_name }}</p>
                                                        <p class="mb-0 mx-2 my-1"
                                                            style="display:inline;margin-bottom: 15px"><strong>
                                                                {{ substr($tm2of->saved_from, 0, -3) }} -
                                                                {{ substr($tm2of->saved_to, 0, -3) }}</strong></p>
                                                        <i id="it-{{ $tm2of->id_offer }}"
                                                            class="bi bi-info-circle mx-2" style="float: right"></i>
                                                        <script>
                                                            get_timestamp = @json($tm2of->created_at);
                                                            offer_date = new Date(get_timestamp * 1000);
                                                            tippy("#it-{{ $tm2of->id_offer }}", {
                                                                content: '<strong>Main: <br> Offered by: <span style="color: aqua;">{{ $tm2of->last_name }} {{ $tm2of->middle_name }} {{ $tm2of->first_name }}</span> <br> Offered at:  <span style="color: aqua;">{{ $tm2of->date }}</span></strong>',
                                                                allowHTML: true,
                                                            });
                                                        </script>
                                                        <br>
                                                        <hr class="m-0 mt-1 p-0">
                                                        <i class="bi bi-sunglasses mx-2" style="font-size: 25px"></i>
                                                        <?php if($have_tomorrow_shift_next
                                                     == 1){ ?>
                                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                                            style="font-size: 20px; ;color:#0d6efd;"></i>
                                                        <?php }else{ ?>
                                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                                            style="font-size: 20px"></i>
                                                        <?php } ?>

                                                        @if ($tm2of->comments == '' || $tm2of->comments == null)
                                                            <i id="cm-{{ $tm2of->id_offer }}"
                                                                class="bi bi-chat-square-dots-fill mt-1 mx-2"
                                                                style="font-size: 17px"></i>
                                                        @else
                                                            <i id="cm-{{ $tm2of->id_offer }}"
                                                                class="bi bi-chat-square-dots-fill mt-1 mx-2"
                                                                style="font-size: 17px; color:#0d6efd;"></i>
                                                            <script>
                                                                rowText = @json($tm2of->comments);
                                                                newText = rowText.replace(/\n/g, '<br>');
                                                                tippy("#cm-{{ $tm2of->id_offer }}", {
                                                                    content: '<strong><span style="color: aqua;"></span>' + newText + '</strong>',
                                                                    allowHTML: true,
                                                                });
                                                            </script>
                                                        @endif
                                                        <script>

                                                        </script>
                                            
                                                        @if ($tm2of->accepted_at == null)
                                                            @if ($tm2of->request_status == '1')
                                                            @else
                                                                <button id="btt-"
                                                                    class="mt-2 mx-2 btn btn-sm btn-outline-primary"
                                                                    style="float:right">
                                                                    <span id="st-{{ $tm2of->id_offer }}"
                                                                        class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"
                                                                        style="display: none;">
                                                                    </span>Requests</button>
                                                            @endif
                                                        @else
                                                            @if ($tm2of->request_status == '0')
                                                                <button id="btt-{{ $tm2of->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-success"
                                                                    style="float:right">
                                                                    <i class="bi bi-calendar2-check"
                                                                        style="margin-right: 5px"></i>Granted</button>
                                                            @elseif ($tm2of->request_status == '1')
                                                                <button id="btt-{{ $tm2of->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-secondary"
                                                                    style="float:right">
                                                                    <i class="bi bi-calendar-minus"
                                                                        style="margin-right: 5px"></i>Unconfirmed</button>
                                                            @elseif ($tm2of->request_status == '2')
                                                                <button id="btt-{{ $tm2of->id_offer }}"
                                                                    class="mt-2 mx-2 btn btn-sm btn-danger"
                                                                    style="float:right">

                                                                    <i class="bi bi-calendar2-x"
                                                                        style="margin-right: 5px"></i>Denied</button>
                                                            @endif
                                                        @endif


                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($is_tommorow_offer_plus == 0)
                                                <div class="card p-0 m-0">
                                                    <center>
                                                        <p class=" p-0 m-1 text-secondary"><i
                                                                class="mx-1 bi bi-sticky"></i>No offers</p>
                                                    </center>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div id="MultiCarouselInsert">

                    </div>
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

                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <div class="col-12">


                                                                <button id="{{ Crypt::encrypt($b->id_board) }}" type="button"
                                                                    class="btn btn-outline-primary btn-sm "
                                                                    style="float: left" data-bs-toggle="modal"
                                                                    data-bs-target="#modalVer" onclick="editLoader(this.id)">Details</button>
                                                                <small class="mt-1"
                                                                    style="float:right">{{ substr($b->created_at, 0, -8) }}</small>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endforeach


                            </div>





                        </div>

                        <a class="carousel-control-prev bg-transparent" href="#recipeCarousel" role="button"
                            data-bs-slide="prev" style="max-height: 250px">
                            <span class="text-light rounded-circle px-3" aria-hidden="true">
                                <i class="bi bi-arrow-left-circle " style="font-size: 35px; color:#0d6efd"></i>
                            </span>
                        </a>
                        <a class="carousel-control-next bg-transparent" style="max-height: 250px"
                            href="#recipeCarousel" role="button" data-bs-slide="next">
                            <span class="text-light rounded-circle px-3 " aria-hidden="true"> <i
                                    class="bi bi-arrow-right-circle " style="font-size: 35px; color:#0d6efd"></i>
                            </span>
                        </a>

                    </div>
                </div>

            </div>
            <br>
            <br>

            <br>

            <br>


            <!-- Modal -->
            <script>
                function editLoader(value) {
                $.ajax({

                    url: '{{ route('loadBoardData') }}',
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: value
                    },
                    success: function(response) {
                        document.getElementById("caption_modal").innerHTML = response.caption;

                        document.getElementById("modal_content").innerHTML = (response.content).replace(/\n/g, '<br>');
                        document.getElementById("modal_header").style.backgroundColor = response.color;
                        document.getElementById("modal_date").innerHTML = (response.date).substring(0,10);
                        if(response.imageUrl == "https://www.rozbehamecesko.cz/repository/layout/noimage.png"){
                            document.getElementById("modal_img").src = "";

                        }else{
                        document.getElementById("modal_img").src = response.imageUrl;
                        }


                    },
                    error: function(response) {
                        error_sweet_alert("dsad");
                    }
                });
            }
            </script>
            <div class="modal fade w-100 modal-fullscreen" id="modalVer" tabindex="-1" data-bs-backdrop="false"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="container modal-dialog  modal-dialog-centered w-100 modal-xl">
                    <div class="modal-content border border-secondary">
                        <div id="modal_header" class="modal-header" style="background-color: #0d6efd">
                            <center>
                                <h1 class="modal-title fs-5" id="exampleModalLabel">

                                </h1>
                            </center>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                            <center>
                            <img id="modal_img" class="object-fit-cover img_responsive mb-1" style="aspect-ratio: auto; white-space: nowrap; max-height: 350px; width:100%"  src="" alt="">
                            
                                <h1 id="caption_modal" class="modal-title fs-5">Verification code

                                </h1>
                            </center>
                            <hr>
                            <p id="modal_content">

                            </p>
    
                        </div>
                        <div class="modal-footer float-start">
                            <p id="modal_date">Created at : 
                            </p>
                            <div class=" ">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                $.ajax({
                    url: '{{ route('MultiCarouselInsert') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
      
                    },
                    error: function(response) {
                        error_sweet_alert("dsad");
                    }
                });
                $.ajax({
                    url: '{{ route('MultiCarouselInsert2') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
 

                    },
                    error: function(response) {

                        error_sweet_alert("dsad");
                    }
                });
            </script>
            <script></script>
        </div>
        <script>
            const weekDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            const monthsArr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            const currentDateObj = new Date();
            const currentDay = weekDays[currentDateObj.getDay()];
            const currentDate = currentDateObj.getDate();
            const currentMonth = monthsArr[currentDateObj.getMonth()];
            const currentYear = currentDateObj.getFullYear();
        </script>


        <script>
            var id_update = 0;
            const myModal = document.getElementById('myModals')
            const myInput = document.getElementById('edit_opener')

            myModal.addEventListener('shown.bs.modal', () => {
                myInput.focus()
            })
        </script>

        <br>
        <br>
        <br>
        <br>

    </div>
    <script>
        let items = document.querySelectorAll('.carousel .carousel-item')

        items.forEach((el) => {
            const minPerSlide = 4
            let next = el.nextElementSibling
            for (var i = 1; i < minPerSlide; i++) {
                if (!next) {
                    next = items[0]
                }
                let cloneChild = next.cloneNode(true)
                el.appendChild(cloneChild.children[0])
                next = next.nextElementSibling
            }
        })
    </script>
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
                updateContainer(secondsContainer, nowSeconds)
            }

            last = now
        }

        function tick() {
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


    <script>
        function saveBoard() {
            var man = 0;
            var part = 0;
            var full = 0;
            let te = document.getElementById("areatext").value;
            let ca = document.getElementById("caption").value;
            if (document.getElementById("manager_c").checked == true) {
                man = 1;
            }
            if (document.getElementById("em_full_c").checked == true) {
                full = 1;
            }
            if (document.getElementById("em_part_c").checked == true) {
                part = 1;
            }



            $.ajax({
                url: '{{ route('saveBoard') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    color: shex,
                    man: man,
                    part: part,
                    full: full,
                    text: te,
                    caption: ca

                },
                success: function(response) {

                    // Get the selected file

                    if ($('#file_picker')[0].files.length != 0) {
                        var file = document.getElementById('file_picker').files[0];
                        if (!file) {
                            return;
                        }

                        // Create a FormData object to send the file data
                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('id', response.id_return);
                        // Get the CSRF token
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        // AJAX request to upload the image
                        $.ajax({
                            url: '{{ route('storeImageBoard') }}',
                            type: 'POST',
                            data: formData,
                            processData: false, 
                            contentType: false, 
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {

                            },
                            error: function(xhr, status, error) {
                                error_sweet_alert("RRRRRRRRRRRR");

                            }
                        });
                    }

                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });

        }
    </script>
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
    <script>
        attendanceConditions();

        function attendanceConditions() {
            $.ajax({
                url: '{{ route('attendanceConditions') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) { 

                    if (response.checkform == 1) {
                        document.getElementById("confirm").style.display = "none";
                        document.getElementById("departure").style.display = "";
                        if (response.pause == 0) {
                            document.getElementById("pause_start").style.display = "";
                            document.getElementById("pause_end").style.display = "none";
                        } else {
                            document.getElementById("pause_start").style.display = "none";
                            document.getElementById("pause_end").style.display = "";
                        }
                    } else {
                        document.getElementById("confirm").style.display = "";
                        document.getElementById("departure").style.display = "none";

                    }
                    if (response.log_exists == 1) {
                        document.getElementById("no_shifts").style.display = "none";
                        document.getElementById("log_div").style.display = "";

                    } else {
                        document.getElementById("no_shifts").style.display = "";
                        document.getElementById("log_div").style.display = "none";
                    }

                },
                error: function(xhr, status, error) {

                }
            });
        }

        function confirmArrival() {
            var comment_text = document.getElementById("textarea1").value;
            $.ajax({
                url: '{{ route('confirmArrival') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    text: comment_text,
                },
                success: function(response) { 
        

                    if (response.status == 0) {
                        document.getElementById("pause_start").style.display = "";
                        document.getElementById("confirm").style.display = "none";
                        document.getElementById("departure").style.display = "";
                        document.getElementById("textarea1").value = "";
                        arrival_alert();

                    } else if (response.status == 1) {
                        var message = "Please enter comment why are you late";
                        arrival_error(message);
                    }else if (response.status == 2) {
                        var message = "Please enter comment why are you early";
                        arrival_error(message);

                    } else if (response.status == 4) {
                        var message = "Your current device is not register in the system";
                        arrival_error(message);

                    } else if (response.status == 5) {
                        var message = "Connection error";
                        arrival_error(message);

                    } else {
                        var message = "";
                        arrival_error(message);

                    }
                },
                error: function(xhr, status, error) {

                    error_sweet_alert('Error fetching image render confirm:');
                }
            });
        }

        function confirmDeparture() {
            var comment_text = document.getElementById("textarea1").value;
            $.ajax({
                url: '{{ route('confirmDeparture') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    text: comment_text,
                },
                success: function(response) { 
                    if (response.left == 0) {
      
                        attendanceConditions();
                        departure_alert();
                    } else if (response.left == 1) {
                        var message = "Please enter comment why are you leaving late";
                        departure_error(message);
                    } else if (response.left == 2) {
                        var message = "Please enter comment why are you leaving early";
                        departure_error(message);
                    } else if (response.left == 4) {
                        var message = "Your current device is not register in the system";
                        departure_error(message);
                    } else if (response.left == 5) {
                        var message = "Connection error";
                        departure_error(message);
                    } else {
                        var message = "";
                        departure_error(message);
                    }
                },
                error: function(xhr, status, error) {

                    error_sweet_alert('Error fetching image render:');
                }
            });
        }
  
    </script>
    <script>
    
        select_graph(document.getElementById("year_button").value);
        var yearly_stats_arr = new Array();


        function select_graph(year_selected) {
            $.ajax({
                url: '{{ route('yearlyStats') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    year: year_selected
                },
                success: function(response) { 
                    graph_data(year_selected, response.amount, response.status);
                },
                error: function(xhr, status, error) {

                    error_sweet_alert('Error fetching image render:');
                }
            });
        }
        week_graph();

        function week_graph() {
            $.ajax({
                url: '{{ route('weekStats') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) { 
                    var xValues = new Array();
                    xValues = response.amount;
                    for (var d = 0; d < 7; d++) {
                        xValues[d] = (xValues[d]) / 3600;
                    }
                    var div_can = document.getElementById("div_can");
                    div_can.innerText = "";

                    var canva = document.createElement("canvas");
                    canva.id = "weekChart";
                    canva.width = "100%";

                    div_can.appendChild(canva);
                    new Chart("weekChart", {
                        type: 'bar',
                        data: {
                            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', ],
                            datasets: [{
                                label: '# Hours',
                                data: xValues,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, 
                            scales: {
                                x: {
                                    beginAtZero: true
                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {

                    error_sweet_alert('Error fetching image render:');
                }
            });
        }

        function graph_data(year_selected, amount, status) {
            var date_s = new Date(new Date().getFullYear(), 0, 1);

            document.getElementById("graph_square").innerHTML = "";
            const weekday_short = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            let wday_short = weekday_short[new Date(year_selected).getDay()];


            var start_day = new Date(year_selected).getDay();
            var li_string = "";
            for (var t = 0; t < 7; t++) {
                if ((t) % 2 == 1) {
                    li_string += `<li style="font-size:15px; margin-top:-5px;"></li>`;
                } else {
                    li_string += `<li style="font-size:15px; margin-top:-5px;">${weekday_short[(7+start_day+ t)%7]}</li>`;


                }
            }
            document.getElementById("days_name").innerHTML = li_string;
            const squares = document.querySelector('.squares');
            for (var i = 0; i < daysInYear(year_selected); i++) {
                var someDate = new Date(year_selected);
                var result = someDate.setDate(someDate.getDate() + i);

                var month = new Date(result).getUTCMonth() + 1; 
                var day = new Date(result).getUTCDate();

                var year = new Date(result).getUTCFullYear();


                const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

                let wday = weekday[new Date(result).getDay()];
                const newDate = year + "/" + month + "/" + day;
                var data_hour = 0;
                if (status[i] == 1) {
                    data_hour = 4;
                } else {
                    if (parseInt((amount[i])) == 0) {
                        data_hour = 0;
                    } else if ((amount[i]) / 3600 <= 3) {
                        data_hour = 1;
                    } else if ((amount[i]) / 3600 <= 6) {
                        data_hour = 2;
                    } else {
                        data_hour = 3;
                    }
                }
                squares.insertAdjacentHTML('beforeend', `<li id="stat-${i}" data-level="${data_hour}"></li>`);
                tippy(`#stat-${i}`, {
                    content: `<strong>Date: ${newDate} <br> Day: <span style="color: aqua;">${wday}</span> <br> Time: ${parseInt((amount[i])/3600)} H ${parseInt(((amount[i])%3600)/60)} Min<span style="color: aqua;"></span></strong>`,
                    allowHTML: true,
                });
            }
        }
        /* @source: https://stackoverflow.com/questions/41068969/calculate-total-number-of-days-in-a-year*/
        function daysInYear(year) {
            return ((year % 4 === 0 && year % 100 > 0) || year % 400 == 0) ? 366 : 365;
        }
    </script>
    <script>
     
        function arrival_alert() {
            Swal.fire({
                title: "Your arrival has been confirmed",
                text: "",
                confirmButtonText: "Close",
                icon: "success"
            });

        }

        function arrival_error(message) {
            Swal.fire({
                title: "Your arrival has not been confirmed",
                text: message,
                confirmButtonText: "Close",
                icon: "error"
            });

        }

        function departure_alert() {
            Swal.fire({
                title: "Your departure has been confirmed",
                text: "",
                icon: "success"
            });

        }

        function departure_error(message) {
            Swal.fire({
                title: "Your departure has not been confirmed",
                text: message,
                icon: "error"
            });

        }

        function break_alert(message) {
            Swal.fire({
                title: message,
                text: "",
                icon: "success"
            });

        }
        function error_sweet_alert(message) {
            Swal.fire({
                title: "Connection failed 1",
                text: "",
                icon: "error"
            });

        }
    </script>

</body>

</html>
