<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('CSS/clock2.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/object-structure1.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/select-button.css') }}" rel="stylesheet">

    <link href="{{ asset('CSS/timeline.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
</head>

<body id="body-pd">

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
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

    <!-- Production -->

    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <div class="bg-light">
        <!-- <i id="myButton" class="bi bi-suitcase-lg-fill mt-1">My button</i>
        <i id="c-11" class="bi bi-suitcase-lg-fill mt-1">My button</i>
        <button id="myButtons" class="btn btn-primary" type="button">
            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                style="display: none;"></span>
            Click Me
        </button>-->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script>
            // With the above scripts loaded, you can call `tippy()` with a CSS
            // selector and a `content` prop:
            tippy('#myButton', {
                content: 'My tooltip!',
            });


            $('#myButtons').click(function() {
                // Show the spinner and change the button text
                $('#spinner').show();
                $('#myButtons').prop('disabled', true);
                //  $('#myButtons').text('Loading...');

                // After 1 second, hide the spinner and reset the button
                setTimeout(function() {
                    $('#spinner').hide();
                    $('#myButtons').prop('disabled', false);
                    $('#myButtons').text('Click Me');
                    $("#myButtons").attr("class", "mt-1 mx-2 btn btn-sm btn-warning text-");

                }, 500); // 1000ms = 1 second

            });
        </script>
        <!--  <br>
        <br>
        <br>
        <div class="container">
            <h3>Tooltip Example</h3>
            <a href="#" data-toggle="tooltip" data-html="true"
                title="On main object: <br> Made by : Jan <br> Made at:">Hover over me</a>
        </div>-->


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <div class="wrapper">
            <div class="container-fluid">
                <center>
                    <p class="current-date mb-0 mt-3" style="font-size: 25px"></p>
                </center>
                <!-- <div class="container-fluid">
                    <div class="row mx-1 gx-2 mb-1">
                        <div class="col-2 col-md-2 px-0 ">
                            <div class="card rounded-0 p-2 h-100">
                                <div class="row">
                                    <div class="col-12 ">
                                        <center>
                                            <h5 class="mb-3 " style="display: inline">20.</h5><small class="mb-1 "
                                                style="display: inline">1.</small>
                                            <br>
                                            <p>Jan</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mx-2 mt-0">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4  d-flex justify-content-center">
                                        <i class="bi bi-sunglasses " style="font-size: 25px; display:inline"></i>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex justify-content-center">
                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                            style="font-size: 20px; display:inline"></i>

                                    </div>
                                    <div class="col-12 col-md-4 d-flex justify-content-center">
                                        <i class="bi bi-flag-fill mt-3  mt-md-1" style="font-size: 20px;"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-10 col-md-10 p-0 ">
                            <div class="card h-100 rounded-0">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="mb-1 p-2">
                                            <div class="card_shift radius-10 border-top border-bottom border-end pb-2"
                                                style="border:10px solid #dc3545">
                                                <p class="mb-0 mx-2 my-2 text-secondary">FIRST - VIP</p>
                                                <p class="mb-0 mx-2 my-1" style="display:inline;margin-bottom: 15px">
                                                    <strong>00:00 -
                                                        00:00</strong>
                                                </p>
                                                <i class="bi bi-info-circle mx-2" style="float: right"></i>
                                                <br>
                                                <hr class="m-0 mt-1 mb-1 p-0">
                                                <i class="bi bi-chat-fill mx-2"
                                                    style="font-size: 20px; margin-top: 15px"></i>
                                                <button class="mt-1 mx-2 btn btn-sm btn-outline-primary"
                                                    style="float:right">Request</button>



                                            </div>
                                        </div>
                                        <div class="mb-1 p-2">
                                            <div class="card_shift radius-10 border-top border-bottom border-end pb-2"
                                                style="border:10px solid #dc3545">
                                                <p class="mb-0 mx-2 my-2 text-secondary">FIRST - VIP</p>
                                                <p class="mb-0 mx-2 my-1" style="display:inline;margin-bottom: 15px">
                                                    <strong>00:00 -
                                                        00:00</strong>
                                                </p>
                                                <i class="bi bi-info-circle mx-2" data-toggle="tooltip"
                                                    data-html="true"
                                                    title="On main object: <br> Made by : Jan <br> Made at:"
                                                    style="float: right"></i>
                                                <br>
                                                <hr class="m-0 mt-1 p-0">
                                                <i class="bi bi-sunglasses mx-2" style="font-size: 25px"></i>
                                                <i class="bi bi-suitcase-lg-fill mt-1" style="font-size: 20px"></i>
                                                <i class="bi bi-chat-square-dots-fill mt-1 mx-2"
                                                    style="font-size: 17px"></i>
                                                <button class="mt-2 mx-2 btn btn-sm btn-outline-primary"
                                                    style="float:right">Request</button>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">

                                    </div>
                                    <div class="col-12 col-md-4">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-1 gx-2">
                        <div class="col-2 col-md-2 px-0 ">
                            <div class="card rounded-0 p-2 h-100">
                                <div class="row">
                                    <div class="col-12 ">
                                        <center>
                                            <h5 class="mb-3 " style="display: inline">20.</h5><small class="mb-1 "
                                                style="display: inline">1.</small>
                                            <br>
                                            <p>Jan</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mx-2 mt-0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4  d-flex justify-content-center">
                                        <i class="bi bi-sunglasses " style="font-size: 25px; display:inline"></i>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex justify-content-center">
                                        <i class="bi bi-suitcase-lg-fill mt-1"
                                            style="font-size: 20px; display:inline"></i>

                                    </div>
                                    <div class="col-12 col-md-4 d-flex justify-content-center">
                                        <i class="bi bi-flag-fill mt-3  mt-md-1" style="font-size: 20px;"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-10 col-md-10 p-0 ">
                            <div class="card h-100 rounded-0">

                            </div>
                        </div>
                    </div>
                </div>-->

                <!--<div class='row '>
                    <div class='col-12 '>
                        <div class="row mx-2">
                            <div class="col-12 ">
                                <div class="row">
                                    <div class='col-12 col-md-1 border shadow-sm row rounded'>
                                        <center>
                                            <p>1</p>
                                            <hr>
                                        </center>
                                    </div>
                                    <div class='col-12 col-md-11 shadow-sm row rounded p-0'>
                                        <button class="btn btn-primary"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="icons">
                    <span id="prev" class="material-symbols-rounded" style="font-size: 25px"><label
                            class="my-1 mr-2" for="role"><i class="bi bi-arrow-bar-left"></i>
                            Previous</label></span>
                    <span id="next" class="material-symbols-rounded"
                        style="float: right; font-size: 25px"><label class="my-1 mr-2" for="next">Next</label><i
                            class="bi bi-arrow-bar-right"></i> </span>
                </div>
            </div>
            <div class="calendar d-none">
                <ul class="weeks">

                    <li>Sun</li>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>

                </ul>
                <div class='row'>
                    <div class='col-12'>
                        <ul class="days"></ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="calendart">
            <div class="container-fluid">
                <div class='row'>
                    <div class='col-12'>
                        <ul class="dayst" style="padding-left:0px"></ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <br>
                <input type="button" name="save" class="btn btn-primary" style="font-size: 15px;float:right;"
                    value="Save to database" id="butsave">
                <br>
                <br>
                <br>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <end-footer>


        </end-footer>
        <br>
    </div>

    <script>
        var result_arr = new Array();
        var from_result_arr = new Array();
        var to_result_arr = new Array();
        var total_lenght = 0;
        const daysTag = document.querySelector(".days"),
            currentDate = document.querySelector(".current-date"),
            prevNextIcon = document.querySelectorAll(".icons span");
        const daysTagt = document.querySelector(".dayst");
        // getting new date, current year and month
        let date = new Date(),
            currYear = date.getFullYear(),
            currMonth = date.getMonth(),
            currDay = date.getDate(),
            nowMonth = date.getMonth(),
            nowYear = date.getFullYear();

        // storing full name of all months in array
        const months = ["January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"
        ];
        let holidays = ["01-01", "12-31"];
        var offer_arr = new Array();
        var tooltip_arr = new Array();
        var tooltip_user_arr = new Array();
        var comments_id = new Array();
        var tooltip_comments = new Array();
        var shift_month = new Array();
        var date_selection = "2025-01";

        function RenderAjax() {
            offer_arr = new Array();
            var currMonthDate = "";
            if (currMonth < 9) {
                currMonthDate = "0" + (currMonth + 1);
            } else {
                currMonthDate = currMonth + 1;
            }

            var date_full = currYear + "-" + currMonthDate;
            $.ajax({
                url: '{{ route('adminGetAllOffer') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    date: date_full
                },
                success: function(response) {
                    offer_arr = [];
                    tooltip_arr = [];
                    tooltip_user_arr = [];
                    comments_id = [];
                    tooltip_comments = [];
                    offer_arr = response.offer;
                    tooltip_arr = response.tooltip;
                    tooltip_user_arr = response.tooltip_user;
                    tooltip_comments = response.tooltip_comments;
                    comments_id = response.comments_id;
                    shift_month = response.shift_month;
                    // alert(shift_month[0]);

                    // alert(offer_arr[0]);
                    renderTable(offer_arr);
                    //$("#MultiCarouselInsert").html(response);
                },
                error: function(response) {
                    alert("dsad");
                }
            });
        }








        const renderTable = (offer_arr) => {
            let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
                lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
                lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
                lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
            let liTag = "";
            let currMonthNull = "";
            if (currMonth < 9) {
                currMonthNull = "0" + (currMonth + 1);
            } else {
                currMonthNull = currMonth + 1;
            }
            for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
                //liTag += `<li class="inactive"><div class='row'><div class='col-12'>${lastDateofLastMonth - i + 1}</div></div></li>`;
            }
            var counter = 0;
            for (let i = 1; i <= lastDateofMonth; i++) {
                liTag +=
                    `<input type='hidden' id='current_load_date' name='current_load_date' value='${currYear}-${currMonthNull}'>`;
                if (i == 1) {
                    /*var text_return = "";
                    result_arr = [];
                    $.ajax({
                        type: "POST",
                        url: "../options/load_time_options.php",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data: {
                            month: currMonthNull, year: currYear, id: usid
                        },
                        success: function (data) {
                            text_return = JSON.stringify(data);
                            //alert(data);
                        }

                    });
                    text_return = text_return.substring(1, text_return.length - 1);
                    result_arr = text_return.split(",");
                    if (result_arr.length != 0) {
                        for (var ff = 0; ff < result_arr.length; ff++) {
                            result_arr[ff] = result_arr[ff].substring(1, result_arr[ff].length - 1);
                            if (result_arr[ff] == "empty") {
                                from_result_arr[ff] = "";
                                to_result_arr[ff] = "";
                            } else {
                                from_result_arr[ff] = result_arr[ff].substring(0, 5);
                                to_result_arr[ff] = result_arr[ff].substring(10, 15);
                            }

                        }
                    }*/

                }


                // creating li of all days of current month
                // adding active class to li if the current day, month, and year matched
                let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
                    currYear === new Date().getFullYear() ? "active" : "";
                //liTag += `<li class="${isToday}"><p class="day">${i}</p></li>`;
                if (i == currDay && nowMonth == currMonth && nowYear == currYear) {
                    //liTag += `<div class='row'><div class='col-12'><center><div class="circle"><p style="display: inline-block;color: #ffffff;">${i}</p></div></center>`;
                    //liTag +=
                    //`<div class='shadow-sm row rounded'><div class='pb-2 col-12'><div class='row'><div class=' col-12 text-center col-md-1 border-right'><center><div class="circle2 text-center mt-2"><p style="display: inline-block;color: #ffffff;">${i}</p></div></center></div><div class="col-12 col-md-11 border-left">`;

                } else {
                    //liTag += `<div class='row'><div class='col-12'><p>${i}</p>`;
                    //liTag +=
                    //  `<div class=' shadow-sm row rounded'><div class='pb-2 col-12'><div class='row'><div class=' col-12 text-center col-md-1 border-right'><p class="mt-2" style="font-size: 20px">${i}</p></div><div class="col-12 col-md-11 border-left">`;

                }
                liTag += ` <div class="row mx-1 gx-2 mb-1">
                        <div class="col-2 col-md-2 px-0 ">
                            <div class="card rounded-0 p-2 h-100">
                                <div class="row">
                                    <div class="col-12 ">
                                        <center>
                                        <h5 class="mb-3 "  style="display: inline">${i}.</h5><small class="mb-1 " style="display: inline">${currMonth +1}.</small>
                                        <br>
                                        <p>Jan</p>
                                    </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mx-2 mt-0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4  d-flex justify-content-center">
                                        <i class="bi bi-sunglasses " style="font-size: 25px; display:inline"></i>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex justify-content-center">`;
                if (i < 9) {
                    var dayNull = "0" + (i);
                } else {
                    var dayNull = (i);
                }
                //alert(tt);

                var complete_date = currYear + "-" + currMonthNull + "-" + dayNull;
                // alert(complete_date);
                if (shift_month.includes(complete_date)) {
                    // alert(complete_date);
                    liTag += `  <i class="bi bi-suitcase-lg-fill mt-1"
                                            style="font-size: 20px; display:inline; color:#0d6efd ;"></i>`;
                } else {
                    liTag += `  <i class="bi bi-suitcase-lg-fill mt-1"
                                            style="font-size: 20px; display:inline"></i> `;
                }
                liTag += `

                                    </div>`;
                if (holidays.includes(currMonthNull + "-" + dayNull)) {
                    liTag += ` <div class="col-12 col-md-4 d-flex justify-content-center">
                                        <i class="bi bi-flag-fill mt-3  mt-md-1" style="font-size: 20px;color:#0d6efd ;"></i>
                                    </div>`;
                } else {
                    liTag += ` <div class="col-12 col-md-4 d-flex justify-content-center">
                                        <i class="bi bi-flag-fill mt-3  mt-md-1" style="font-size: 20px;"></i>
                                    </div>`;
                }

                liTag += ` </div>

                            </div>
                        </div>
                        <div class="col-10 col-md-10 p-0 ">
                            <div class="card h-100 rounded-0" >
                              ${offer_arr[i-1]}
                            </div>
                        </div>
                    </div>

          `;



                /*liTag +=
                            `<div class='row'><div class='col-12'><p style="float:left"><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text">From</span></div><input id="fr${i}t" type="time" style="float:right" class="form-control" value="${from_result_arr[i - 1]}"></div></div></div>`;
                        liTag +=
                            `<div class='row'><div class='col-12'><p style="float:left"><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text">To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div><input id="to${i}t" type="time" style="float:right" class="form-control" value="${to_result_arr[i - 1]}"></div></div></div>`;
                        liTag += ``;

                                    tippy("#c-15", {
                        content: '<strong>Bolded <span style="color: aqua;">content</span></strong>',
                        allowHTML: true,
                  });
                        liTag += `</div></div></div></div>`;*/
            }

            for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
                //liTag += `<li class="inactive"><div class='row'><div class='col-12'>${i - lastDayofMonth + 1}</div></div></li>`

            }
            currentDate.innerText =
                `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
            daysTagt.innerHTML = liTag;
            if (tooltip_arr.length != null) {
                for (var o = 0; o < tooltip_arr.length; o++) {
                    tippy("#c-" + tooltip_arr[o], {
                        content: '<strong>Main: <br> Offered by: <span style="color: aqua;">' +
                            tooltip_user_arr[o] +
                            '</span> <br> Offered at:  <span style="color: aqua;">content</span></strong>',
                        allowHTML: true,
                    });
                }

                if (comments_id.length != null) {

                    for (var o = 0; o < comments_id.length; o++) {
                        //alert(tooltip_comments[o]);
                        var newText = tooltip_comments[o].replace(/\n/g, '<br>');
                        tippy("#cm-" + comments_id[o], {
                            content: '<strong><span style="color: aqua;">' + newText + '</span> </strong>',
                            allowHTML: true,
                        });
                    }

                }
            }
        }


        prevNextIcon.forEach(icon => { // getting prev and next icons
            icon.addEventListener("click", () => { // adding click event on both icons
                // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
                currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
                if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
                    // creating a new date of current year & month and pass it as date value
                    date = new Date(currYear, currMonth, new Date().getDate());
                    currYear = date.getFullYear(); // updating current year with new date year
                    currMonth = date.getMonth(); // updating current month with new date month
                } else {
                    date = new Date(); // pass the current date as date value
                }
                RenderAjax();
                /*renderCalendar(); // calling renderCalendar function
                renderTable();*/
            });
        });
        RenderAjax();



        function copy_cell(copy_id) {
            copy_id = copy_id.substring(2);

            from_paste = document.getElementById("fr" + copy_id).value;
            to_paste = document.getElementById("to" + copy_id).value;
            from_paste = document.getElementById("fr" + copy_id + "t").value;
            to_paste = document.getElementById("to" + copy_id + "t").value;


        }

        function paste_cell(paste_id) {

            paste_id = paste_id.substring(2);

            if (from_paste != "") {
                document.getElementById("fr" + paste_id).value = from_paste;
                document.getElementById("to" + paste_id).value = to_paste
                document.getElementById("fr" + paste_id + "t").value = from_paste;
                document.getElementById("to" + paste_id + "t").value = to_paste
            }
        }

        function copy_cellt(copy_id) {
            copy_id = copy_id.substring(2, copy_id.length - 1);

            from_paste = document.getElementById("fr" + copy_id).value;
            to_paste = document.getElementById("to" + copy_id).value;
            from_paste = document.getElementById("fr" + copy_id + "t").value;
            to_paste = document.getElementById("to" + copy_id + "t").value;

        }

        function paste_cellt(paste_id) {

            paste_id = paste_id.substring(2, paste_id.length - 1);

            if (from_paste != "") {
                document.getElementById("fr" + paste_id).value = from_paste;
                document.getElementById("to" + paste_id).value = to_paste
                document.getElementById("fr" + paste_id + "t").value = from_paste;
                document.getElementById("to" + paste_id + "t").value = to_paste
            }
        }

        function requestShift(id_offer) {
            var id_spinner = id_offer.substring(2);


            //alert(id_spinner);
            $('#s-' + id_spinner).show();
            // $("#"+id_offer).prop('disabled', true);
            //  $('#myButtons').text('Loading...');

            // After 1 second, hide the spinner and reset the button
            // 1000ms = 1 second


            $.ajax({
                url: '{{ route('sendOffer') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_offer: id_spinner

                },
                success: function(response) {
                    //alert(response);
                    setTimeout(function() {
                        $('#s-' + id_spinner).hide();
                        $('#myButtons').prop('disabled', false);
                        $('#myButtons').text('Click Me');
                        $("#" + id_offer).attr("class", "mt-1 mx-2 btn btn-sm btn-warning");
                        $("#" + id_offer).attr("onclick", "changeRequest(this.id)");

                        document.getElementById(id_offer).innerHTML =
                            "<i class='bi bi-question-lg'></i>Waitting";

                    }, 500);
                    //$("#MultiCarouselInsert").html(response);
                },
                error: function(response) {
                    alert("dsad");
                }
            });

            // $("#"+id_offer).attr("class","mt-1 mx-2 btn btn-sm btn-warning");
        }




        $("#butsave").click(function() {

            var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
            var from = new Array();
            var to = new Array();
            var date = new Array();
            for (var i = 1; i <= 31; i++) {


                if (i < 10) {
                    var q = "0" + i;
                } else {
                    var q = i;
                }

                var kla = "fr";
                let ml = kla + q;
                var myElem = document.getElementById(ml);
                if (myElem != null) {

                    to.push($("#to" + q).val());
                    from.push($("#fr" + q).val());
                    var ym = $("#current_load_date").val();
                    let h = ym + "-" + q;
                    date.push(h);
                }


            }
            var fromTime = JSON.stringify(from);
            var toTime = JSON.stringify(to);

            var dateArr = JSON.stringify(date);
            alert(dateArr);

            var year_month = $("#current_load_date").val();
            $.ajax({
                url: "../options/insert_time_options.php",
                type: "post",
                data: {
                    from: fromTime,
                    to: toTime,
                    dateym: year_month,
                    date: dateArr,
                    id: usid
                },
                success: function(data) {
                    success_alert(data); /* alerts the response from php.*/
                }
            });
        });


        function success_alert(message) {
            Swal.fire({
                title: message,
                text: "",
                icon: "success"
            });

        }

        function error_alert(message) {
            Swal.fire({
                title: message,
                text: "",
                icon: "error"
            });

        }

        function changeRequest(selected_button) {
            Swal.fire({
                title: "Are you sure you want to fill this shift ?",
                text: "The shift has been offered",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm"
            }).then((result) => {
                var buttom_id = selected_button.substring(2);
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('deleteOffer') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_offer: buttom_id

                        },
                        success: function(response) {
                            //alert(response);
                            $("#" + selected_button).attr("class",
                                "mt-1 mx-2 btn btn-sm btn-outline-primary");
                            $("#" + selected_button).attr("onclick", "requestShift(this.id)");

                            document.getElementById(selected_button).innerHTML = '<span id="s-' +
                                selected_button +
                                '" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>Request';
                            //$("#MultiCarouselInsert").html(response);
                        },
                        error: function(response) {
                            alert("dsad");
                        }
                    });

                }

            });

        }
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                html: true
            });
        });
    </script>
    <script>
        tippy('#c-18', {
            content: "My tooltip!",
        });
    </script>

</body>

</html>
