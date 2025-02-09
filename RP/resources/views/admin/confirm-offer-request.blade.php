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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
</head>

<body id="body-pd">
    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <div class="row">
        <div class="col-12">
            <div class="bg-light" style="height: 100vh">
                <div class="row p-2">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <h5 class="card-title mt-1">Waiting for confirmation</h5>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mx-2 py-2">
                                    <select id="select_obj_waiting" class="form-select"
                                        aria-label="Default select example">

                                    </select>
                                </div>
                            </div>
                            <script>
                                var repeat_counter = 0;

                                renderObjectSelect();

                                function renderObjectSelect() {
                                    $.ajax({
                                        url: '{{ route('selectMainObjects') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                        },
                                        success: function(response) {
                                            document.getElementById("select_obj_waiting").innerHTML = response;
                                            document.getElementById("select_obj_history").innerHTML = response;


                                        },
                                        error: function(xhr, status, error) {
                                            alert('Error fetching image render:', error);
                                        }
                                    });
                                }
                                $(document).on("ajaxComplete", function() {
                                    var input_obj = document.getElementById("select_obj_waiting").value;
                                    // alert(input_obj);
                                    if (repeat_counter == 0) {
                                        repeat_counter++;
                                        $.ajax({
                                            url: '{{ route('loadRequestWaiting') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                main_obj: input_obj
                                            },
                                            success: function(response) {
                                                document.getElementById("waitting_list").innerHTML = response.returns;

                                            },
                                            error: function(xhr, status, error) {
                                                alert('Error fetching image render:', error);
                                            }
                                        });

                                    } else if (repeat_counter == 1) {
                                        repeat_counter++;
                                        renderTable();
                                        renderHistory();

                                    } else if (repeat_counter == 2) {
                                        repeat_counter++;
                                        //  renderHistory();
                                    }
                                });


                                $('#select_obj_waiting').change(function() {
                                    //alert("56554s");
                                    $.ajax({
                                        url: '{{ route('loadRequestWaiting') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            main_obj: $(this).val()
                                        },
                                        success: function(response) {
                                            document.getElementById("waitting_list").innerHTML = response.returns;
                                        },
                                        error: function(xhr, status, error) {
                                            alert('Error fetching image render:', error);
                                        }
                                    });

                                });
                            </script>
                            <!--<ul  class="list-group">

                                <div class="row pt-2 mx-1 ">
                                    <div class="col-7">
                                        <h6>Name</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Users</h6>

                                    </div>
                                    <div class="col-1">
                                        <center>
                                            <h6>Status</h6>
                                        </center>
                                    </div>
                                    <div class="col-2">
                                        <center>
                                            <h6>Action</h6>
                                        </center>
                                    </div>
                                </div>
                                <li class="list-group-item p-0 m-0">
                                    <div class="row p-0 m-0">


                                        <div class="col-7 p-0 m-0">
                                            <div class="card rounded-0 border-top-0 border-bottom-0 border-end-0"
                                                style="border-width: 10px; border-color: blue;">
                                                <p class="py-2 mx-2 my-0 ">
                                                    HJsdhjsa - dsakjhdsak
                                                </p>

                                            </div>
                                        </div>
                                        <div class="col-2 ">
                                            <p class="py-2 my-0"> 0 users</p>
                                        </div>
                                        <div class="col-1 ">
                                            <center>
                                                <p class="py-2 my-0"><i class="bi bi-hourglass-split"></i></p>
                                            </center>
                                        </div>

                                        <div class="col-2">
                                            <center>
                                                <p class="py-2 my-0"><i class="bi bi-three-dots-vertical"></i></p>
                                            </center>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>-->
                            <ul id="waitting_list" class="list-group">



                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <div class="container-fluid">


                                    <div class="icons">
                                        <div class="row">
                                            <div class="col-4">
                                                <span id="prev" class="material-symbols-rounded"
                                                    style="font-size: 24px"><i class="bi bi-arrow-bar-left"></i>
                                                </span>
                                            </div>
                                            <div class="col-4">
                                                <center>
                                                    <p class="current-date m-0 " style="font-size: 24px"></p>
                                                </center>
                                            </div>
                                            <div class="col-4">
                                                <span id="next" class="material-symbols-rounded"
                                                    style="float: right; font-size: 24px">
                                                    <i class="bi bi-arrow-bar-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mx-2 py-2">
                                    <select id="select_obj_history" class="form-select"
                                        aria-label="Default select example">

                                    </select>
                                </div>
                            </div>

                            <!-- <div class="calendart">
                            <div class='row'>
                                    <div class='col-12'>
                                        <ul class="history" style="padding-left:0px"></ul>
                                    </div>

                                </div>
                            </div>-->
                            <!--<ul class="list-group">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>-->
                            <ul id="history_list" class="list-group">



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <script></script>
            <script>
                var result_arr = new Array();
                var from_result_arr = new Array();
                var to_result_arr = new Array();
                var total_lenght = 0;
                const daysTag = document.querySelector(".days"),
                    currentDate = document.querySelector(".current-date"),
                    prevNextIcon = document.querySelectorAll(".icons span");
              //  const daysTagt = document.querySelector(".history");
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
                let currMonthNull = "";

                const renderTable = () => {
                    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
                        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
                        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
                        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
                    let liTag = "";
                    currMonthNull = "";

                    if (currMonth < 9) {
                        currMonthNull = "0" + (currMonth + 1);
                    } else {
                        currMonthNull = currMonth + 1;
                    }
                    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
                        //liTag += `<li class="inactive"><div class='row'><div class='col-12'>${lastDateofLastMonth - i + 1}</div></div></li>`;
                    }
                    //renderHistory();

                    var counter = 0;
                   /* liTag += `<ul class="list-group">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>`;*/
                    /*for (let i = 1; i <= lastDateofMonth; i++) {
                                                                                        liTag +=
                                                                                            `<input type='hidden' id='current_load_date' name='current_load_date' value='${currYear}-${currMonthNull}'>`;
                                                                            

                                                                                        let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
                                                                                            currYear === new Date().getFullYear() ? "active" : "";
                                                                               
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

                                                                                        var complete_date = currYear + "-" + currMonthNull + "-" + dayNull;
                                                                                        if (shift_month.includes(complete_date)) {
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

                                                                                    }*/


                    currentDate.innerText =
                        `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
                   /* daysTagt.innerHTML = liTag;
                    if (tooltip_arr.length != null) {
                        for (var o = 0; o < tooltip_arr.length; o++) {
                            /*tippy("#c-" + tooltip_arr[o], {
                                content: '<strong>Main: <br> Offered by: <span style="color: aqua;">' +
                                    tooltip_user_arr[o] +
                                    '</span> <br> Offered at:  <span style="color: aqua;">content</span></strong>',
                                allowHTML: true,
                            });*/
                     /*   }

                        if (comments_id.length != null) {

                            /*for (var o = 0; o < comments_id.length; o++) {
                                var newText = tooltip_comments[o].replace(/\n/g, '<br>');
                                tippy("#cm-" + comments_id[o], {
                                    content: '<strong><span style="color: aqua;">' + newText + '</span> </strong>',
                                    allowHTML: true,
                                });
                            }*/

                       /* }
                    }*/
                }
                renderTable();
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

                        renderTable();
                        renderHistory();
                    });
                });

                var input_obj_history;

                $('#select_obj_history').change(function() {
                                    //alert("56554s");
                                    input_obj_history = $(this).val();

                                    $.ajax({
                        url: '{{ route('loadRequestHistory') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            main_obj: input_obj_history,
                            year: currYear,
                            month: currMonthNull,
                        },
                        success: function(response) {
                            document.getElementById("history_list").innerHTML = response.returns;
                            //alert(response.returns);

                        },
                        error: function(xhr, status, error) {
                            alert('Error fetching image render dsdds:', error);
                        }
                    });

                                });


                function renderHistory() {
                    input_obj_history = document.getElementById("select_obj_history").value;
                    /*alert(currYear);
                    alert(currMonthNull);*/
                    // alert(input_obj_history);
                    $.ajax({
                        url: '{{ route('loadRequestHistory') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            main_obj: input_obj_history,
                            year: currYear,
                            month: currMonthNull,
                        },
                        success: function(response) {
                            document.getElementById("history_list").innerHTML = response.returns;
                            //alert(response.returns);

                        },
                        error: function(xhr, status, error) {
                            alert('Error fetching image render dsdds:', error);
                        }
                    });


                }
            </script>
        </div>
    </div>
</body>

</html>
