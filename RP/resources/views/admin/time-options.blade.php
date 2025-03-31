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
    <link href="{{ asset(path: 'CSS/calendar.css') }}" rel="stylesheet">

    <!-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
        <meta charset='utf-8' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendarss');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    eventContent: {
                        html: '<p>some html</p>'
                    }
                });
                calendar.render();
            });
        </script>-->
</head>

<body id="body-pd">
    <div id='calendarss'></div>
    <style id="clock-animations"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>

    </style>
    @include('vendor.Chatify.pages.header')
    @include('vendor.Chatify.pages.sidebar')
    @include('admin.scripts')
    <div class="bg-light" class="height: 100vh">
        <!--<script src="../js/main_page.js"></script>-->


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <div class="card p-2 mb-2 mx-2">
            <header>
                <div class="row">
                    <div class="col-12">
                        <h5 class="px-1 px-md-5 py-2">Time options</h5>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="current-date mx-1 mt-1 mx-md-5"></p>
                    </div>
                    <!-- <div class="col-6">-->
                    <div class="col-6 icons">
                        <span id="next" style="float: right"><i class="bi bi-arrow-right-square"></i></span>

                        <span id="prev" style="float: right" class="mx-3"><i
                                class="bi bi-arrow-left-square"></i></span>
                        <!--</div>-->
                    </div>
                </div>
            </header>
            <div class="calendar d-none d-md-block">
                <ul class="weeks">

                    <li class="">Sun</li>
                    <li class="mx-1">Mon</li>
                    <li>Tue</li>
                    <li class="mx-1">Wed</li>
                    <li>Thu</li>
                    <li class="mx-1">Fri</li>
                    <li>Sat</li>

                </ul>
                <div class='row'>
                    <div class='col-12'>
                        <ul class="days"></ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="container">
            <div class="calendart d-block d-md-none">

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
        var saved_data = new Array();
        var my_shifts = new Array();
        var result_arr = new Array();
        var from_result_arr = new Array();
        var to_result_arr = new Array();
        var total_lenght = 0;
        let holidays = ["01-01", "12-31"];

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
        const renderCalendar = () => {
            // alert("asd");
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
                liTag +=
                    `<li class="inactive"><div class='row'><div class='col-12'>${lastDateofLastMonth - i + 1}</div></div></li>`;
            }
            var counter = 0;
            for (let i = 1; i <= lastDateofMonth; i++) {
                liTag +=
                    `<input type='hidden' id='current_load_date' name='current_load_date' value='${currYear}-${currMonthNull}'>`;
                if (i == 1) {
                    /*var text_return = "";
                    result_arr = [];*/
                    /*$.ajax({
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
                var from_data;
                var to_data;
                if (saved_data[i - 1] == "empty") {
                    from_data = "";
                    to_data = "";
                    //  alert("dsas");
                } else {
                    from_data = saved_data[i - 1].substring(0, 5);
                    to_data = saved_data[i - 1].substring(10, 15);
                }


                // creating li of all days of current month
                // adding active class to li if the current day, month, and year matched
                let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
                    currYear === new Date().getFullYear() ? "active" : "";
                //liTag += `<li class="${isToday}"><p class="day">${i}</p></li>`;
                if (i == currDay && nowMonth == currMonth && nowYear == currYear) {
                    liTag +=
                        `<li><div class='row'><div class='col-12'><center><div class="circle"><h6 style="display: inline-block;color: #ffffff;">${i}</h6></div></center>`;
                } else {
                    liTag += `<li><div class='row'><div class='col-12'><h6>${i}</h6>`;
                }
                liTag +=
                    `<div class='row'><div class='col-12'><p style="float:left"><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text">From</span></div><input id="fr${i}" type="time" style="float:right" onkeyup="keyUpFrom(this.id)" class="form-control" value="${from_data}"></div></div></div>`;
                liTag +=
                    `<div class='row'><div class='col-12'><p style="float:left"><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text">To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div><input id="to${i}" type="time" style="float:right" onkeyup="keyUpTo(this.id)" class="form-control" value="${to_data}"></div></div></div>`;
                liTag +=
                    `<div class='row'><div class='col-12'><hr class="p-0 m-0"><i class="bi bi-sunglasses " style="font-size: 25px; float: left"></i>`;

                if (i < 9) {
                    var dayNull = "0" + (i);
                } else {
                    var dayNull = (i);
                }
                var complete_date = currYear + "-" + currMonthNull + "-" + dayNull;
                // alert(complete_date);
                if (my_shifts.includes(complete_date)) {
                    liTag +=
                        `<i class="bi bi-suitcase-lg-fill mt-1 mx-2" style="font-size: 20px; display:inline;color:#0d6efd ; float: left"></i>`;
                } else {
                    liTag +=
                        `<i class="bi bi-suitcase-lg-fill mt-1 mx-2" style="font-size: 20px; display:inline; float: left"></i>`;

                }
                if (holidays.includes(currMonthNull + "-" + dayNull)) {
                    liTag +=
                        `<i class="bi bi-flag-fill mt-3  mt-md-1" style="font-size: 18px;float: left;color:#0d6efd ;"></i></div></div>`;
                } else {
                    liTag +=
                        `<i class="bi bi-flag-fill mt-3  mt-md-1" style="font-size: 18px;float: left"></i></div></div>`;

                }

                liTag +=
                    `<div class='row'><div class='col-12'><button type="button" class="btn btn-primary px-1 " style="position:relative;border: 1px solid black;font-size:15px;height: 25px;padding:0px;float:left" title="Copy" onClick="copy_cell(this.id)" id="co${i}"><i class="bi bi-c-circle"></i>&nbsp;Copy</button><button type="button" class="btn btn-outline-primary px-1" style="position:relative;border: 1px solid black;font-size:15px;margin-bottom:10px;margin-left:10px;height: 25px;float:left;padding:0px;" title="Paste" onClick="paste_cell(this.id)" id="pa${i}"><i class="bi bi-copy"></i>&nbsp;Paste</button><button id="d${i}" onclick="scrap(this.id)" class="btn btn-danger p-0 px-1 mx-1" style="float: right;height:25px"><i class="bi bi-trash3"></i></button></div></div>`;

                liTag += `</div></div></li>`;
            }

            for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
                liTag +=
                    `<li class="inactive"><div class='row'><div class='col-12'>${i - lastDayofMonth + 1}</div></div></li>`

            }
            currentDate.innerText =
                `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
            daysTag.innerHTML = liTag;
        }



        const renderTable = () => {
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
                    var text_return = "";
                    result_arr = [];
                    /*$.ajax({
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
                var from_data;
                var to_data;
                if (saved_data[i - 1] == "empty") {
                    from_data = "";
                    to_data = "";
                    //  alert("dsas");
                } else {
                    from_data = saved_data[i - 1].substring(0, 5);
                    to_data = saved_data[i - 1].substring(10, 15);
                }


                // creating li of all days of current month
                // adding active class to li if the current day, month, and year matched
                let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
                    currYear === new Date().getFullYear() ? "active" : "";
                //liTag += `<li class="${isToday}"><p class="day">${i}</p></li>`;
                if (i == currDay && nowMonth == currMonth && nowYear == currYear) {
                    //liTag += `<div class='row'><div class='col-12'><center><div class="circle"><p style="display: inline-block;color: #ffffff;">${i}</p></div></center>`;
                    // liTag += `<div class='card shadow-sm row rounded'><div class='pb-2 col-12'><div class='row'><div class=' col-12 text-center col-md-1 '><center><div class="circle2 text-center mt-2"><p style="display: inline-block;color: #ffffff;">${i}</p></div></center></div><div class="col-12 col-md-11">`;

                } else {
                    //liTag += `<div class='row'><div class='col-12'><p>${i}</p>`;
                    // liTag += `<div class='card shadow-sm row rounded'><div class='pb-2 col-12'><div class='row'><div class=' col-12 text-center col-md-1 '><p class="mt-2" style="font-size: 20px">${i}</p></div><div class="col-12 col-md-11">`;

                }
                liTag += `<div class="row mx-1 gx-2 mb-1"><div class="col-2  px-0 ">
                            <div class="card rounded-0 p-2 h-100">
                                <div class="row">
                                    <div class="col-12 ">
                                        <center>`;
                if (i == currDay && nowMonth == currMonth && nowYear == currYear) {
                    liTag +=
                        `<h5 class="mb-3 text-success"  style="display: inline">${i}.</h5><small class="mb-1 text-success" style="display: inline">${currMonth +1}.</small>`;
                } else {
                    liTag +=
                        `<h5 class="mb-3 "  style="display: inline">${i}.</h5><small class="mb-1 " style="display: inline">${currMonth +1}.</small>`;

                }
                liTag += `<br>
                                        <p>Jan</p>

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
                if (my_shifts.includes(complete_date)) {
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
                                    </center>
                                    </div>

                                </div>
                                </div>
                                </div><div class="col-10  px-0 "> <div class="card rounded-0 p-2 h-100">`;

                liTag +=
                    `<div class='row'><div class='col-12'><p style="float:left"><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text">From</span></div><input id="fr${i}t" type="time" style="float:right" onkeyup="keyUpFromTable(this.id)"  class="form-control" value="${from_data}"></div></div></div>`;
                liTag +=
                    `<div class='row'><div class='col-12'><p style="float:left"><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text">To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div><input id="to${i}t" type="time" style="float:right" onkeyup="keyUpToTable(this.id)" class="form-control" value="${to_data}"></div></div></div>`;
                liTag +=
                    `<div class='row'><div class='col-12'><button type="button" class="btn btn-primary px-1 " style="position:relative;border: 1px solid black;font-size:15px;height: 25px;padding:0px;float:left" title="Copy" onClick="copy_cell(this.id)" id="co${i}t"><i class="bi bi-c-circle"></i>&nbsp;Copy</button><button type="button" class="btn btn-outline-primary px-1" style="position:relative;border: 1px solid black;font-size:15px;margin-bottom:10px;margin-left:10px;height: 25px;float:left;padding:0px;" title="Paste" onClick="paste_cell(this.id)" id="pa${i}t"><i class="bi bi-copy"></i>&nbsp;Paste</button><button id="d${i}t" onclick="scrapTable(this.id)" class="btn btn-danger p-0 px-1 mx-1" style="float: right;height:25px"><i class="bi bi-trash3"></i></button></div></div>`;

                // liTag += `<div class='row'><div class='col-12'><button type="button" class="btn btn-primary px-1" style="position:relative;border: 1px solid black;font-size:15px;margin-bottom:10px;height: 25px;padding:0px;float:left" title="Copy" onClick="copy_cellt(this.id)" id="co${i}t">Copy</button><button type="button" class="btn btn-primary px-1" style="position:relative;border: 1px solid black;font-size:15px;margin-bottom:10px;margin-left:10px;height: 25px;float:left;padding:0px;" title="Paste" onClick="paste_cellt(this.id)" id="pa${i}t">Paste</button></div></div>`;
                //liTag += `</div></div></div></div></div></div>`;
                liTag += `</div></div></div>`;
            }

            for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
                //liTag += `<li class="inactive"><div class='row'><div class='col-12'>${i - lastDayofMonth + 1}</div></div></li>`

            }
            currentDate.innerText =
                `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
            daysTagt.innerHTML = liTag;
        }
        //renderCalendar();
        //  renderTable();
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
                //renderCalendar(); // calling renderCalendar function
                
                //renderTable();
                RenderAjax();
            });
        });
        RenderAjax();

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
                url: '{{ route('loadTimeOptions') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    date: date_full
                },
                success: function(response) {
                    /* offer_arr = [];
                     tooltip_arr = [];
                     tooltip_user_arr = [];
                     comments_id = [];
                     tooltip_comments = [];
                     offer_arr = response.offer;
                     tooltip_arr = response.tooltip;
                     tooltip_user_arr = response.tooltip_user;
                     tooltip_comments = response.tooltip_comments;*/
                    saved_data = response.saved_data;
                    my_shifts = response.shifts;
                    alert(response.shifts);
                    //alert(response.response);*/
                    renderTable();
                    renderCalendar();
                    // alert(shift_month[0]);
                    /* alert(response.saved_data);
                     alert(response.shifts);*/
                    // alert(offer_arr[0]);
                    //renderTable(offer_arr);
                    //$("#MultiCarouselInsert").html(response);
                },
                error: function(response) {
                    alert("dsadhgcjx");
                }
            });
        }

        var from_paste;
        var to_paste;
        var from_paste2;
        var to_paste2;
        //var paste_id;
        function copy_cell(copy_id) {

            copy_id = copy_id.substring(2);

            from_paste = document.getElementById("fr" + copy_id).value;
            to_paste = document.getElementById("to" + copy_id).value;
            from_paste = document.getElementById("fr" + copy_id + "t").value;
            to_paste = document.getElementById("to" + copy_id + "t").value;

            /*alert(document.getElementById("fr" + copy_id).value);
            alert(to_paste);*/
        }

        function paste_cell(paste_id) {

            paste_id = paste_id.substring(2);
            alert("-----");

            if (from_paste != "") {
                document.getElementById("fr" + paste_id).value = from_paste;
                document.getElementById("to" + paste_id).value = to_paste
                document.getElementById("fr" + paste_id + "t").value = from_paste;
                document.getElementById("to" + paste_id + "t").value = to_paste;

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

        function keyUpFrom(from_id) {
            document.getElementById(from_id+"t").value = document.getElementById(from_id).value;

            //document.getElementById("demo").innerHTML = x;
        }

        function keyUpTo(to_id) {
            document.getElementById(to_id+ "t").value = document.getElementById(to_id).value;
            //document.getElementById("demo").innerHTML = x;
        }
        function keyUpFromTable(from_id) {
           /* alert(from_id);
            alert(from_id.substring(0 , from_id.length - 1));*/
            document.getElementById(from_id.substring(0 , from_id.length - 1)).value = document.getElementById(from_id).value;

            //document.getElementById("demo").innerHTML = x;
        }

        function keyUpToTable(to_id) {
            document.getElementById(to_id.substring(0 , to_id.length - 1)).value = document.getElementById(to_id).value;
            //document.getElementById("demo").innerHTML = x;
        }
        function scrapTable(scrap_id){
            document.getElementById("fr"+scrap_id.substring(1)).value = "";
            document.getElementById("to"+scrap_id.substring(1)).value = "";
            document.getElementById("fr"+scrap_id.substring(1, scrap_id.length -1)).value = "";
            document.getElementById("to"+scrap_id.substring(1, scrap_id.length -1)).value = "";

        }
        function scrap(scrap_id){
            document.getElementById("fr"+scrap_id.substring(1)).value = "";
            document.getElementById("to"+scrap_id.substring(1)).value = "";
            document.getElementById("fr"+scrap_id.substring(1)+"t").value = "";
            document.getElementById("to"+scrap_id.substring(1)+"t").value = "";

        }


        $("#butsave").click(function() {

            //var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
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
                let ml = kla + i;
                var myElem = document.getElementById(ml);
                if (myElem != null) {

                    to.push($("#to" + i).val());
                    from.push($("#fr" + i).val());
                    var ym = $("#current_load_date").val();
                    let h = ym + "-" + q;
                    date.push(h);
                }


            }
            var year_month = $("#current_load_date").val();
            alert(from);
            alert(to);
            $.ajax({
                url: '{{ route('insertTimeOptions') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    from: from,
                    to: to,
                    dateym: year_month,
                    date: date,
                },
                success: function(response) {
                    alert("saved succeddfully");
                },
                error: function(response) {
                    alert("dsadhgcjx");
                }
            });
            /*var fromTime = JSON.stringify(from);
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
              /*  }
            });*/
        });
    </script>
    </div>
</body>

</html>
