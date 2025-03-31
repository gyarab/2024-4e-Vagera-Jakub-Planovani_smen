<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link href="{{ asset('CSS/toggle-switch.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/color_picker.css') }}" rel="stylesheet">

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <title>My statistics</title>
</head>

<body id="body-pd">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @include('vendor.Chatify.pages.header-admin')
    @include('vendor.Chatify.pages.sidebar-admin')
    @include('admin.scripts')
    <script>
        var sum_sch = 0;
        var sum_log = 0;
        var sum_sch_r = 0;
        var sum_log_r = 0;
        var xValues = new Array();
        var yValues = new Array();
        var max_day = 0;
        var pie_x = new Array();
        var pie_y = new Array();
        var pie_color = new Array();
    </script>
    <div class="wh-100 bg-light border border-secondary-subtle border-start border-top-0">
        <div class="container-fluid mt-1 mb-1 py-2">
            <div class="card p-3 mb-2 mt-1">
                <div class='row'>
                    <div class="col-12 col-lg-6">
                        <h4>My statistics
                        </h4>
                        <script>
                            $.ajax({
                                url: '{{ route('showImagePersonal') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: {{ Auth::id() }},
                                },
                                success: function(response) {
                                    $('#imagePersoanl').attr('src', response.url);

                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image:', error);
                                }
                            });
                        </script>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class='row'>
                            <div class="col-12">
                                <div class='row'>
                                    <div class="col-6">

                                    </div>
                                    <div class="col-3">
                                        <select id="month" name="month"
                                            style="float:right;height: 38px;display:inline"
                                            class="form-select form-select-sm">
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                        <script>
                                            const d = new Date();
                                            let current_month = d.getMonth();
                                            document.getElementById("month").value = (current_month + 1);
                                        </script>

                                    </div>

                                    <div class="col-3">
                                        <?php $current_year = Date('Y'); ?>

                                        <select id="year" style="float:right;height: 38px;display:inline"
                                            class="form-select form-select-sm">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-3 mb-2 mt-1">
                <div id="div_can" class="card-body" style="min-height: 40vh">
                    <canvas id="chLine" style="width:100%;max-height: 600px"></canvas>
                </div>
            </div>
            <div class="card p-3 mb-2 mt-1">

                <div class="row">
                    <div class="col-12">
                        <ul class="list-group">
                            <li class="list-group-item border-0">

                                <div class="row">
                                    <div class='col-12 col-md-2'>
                                        <strong>
                                            <p class="mb-0">Date</p>
                                        </strong>
                                        <hr class="d-block d-md-none my-1">
                                    </div>
                                    <div class='col-6 col-md-2'>
                                        <strong>
                                            <p class="mb-0">Scheduled</p>
                                        </strong>
                                    </div>
                                    <div class='col-6 col-md-2'>
                                        <strong>
                                            <p class="mb-0">Scheduled rounded</p>
                                        </strong>
                                    </div>
                                    <hr class="d-block d-md-none my-1">
                                    <div class='col-6 col-md-2'>
                                        <strong>
                                            <p class="mb-0">Logged</p>
                                        </strong>
                                    </div>
                                    <div class='col-6 col-md-2'>
                                        <strong>
                                            <p class="mb-0">Logged rounded</p>
                                        </strong>
                                    </div>
                                    <div class='col-12 col-md-2'>
                                        <strong>
                                            <p class="mb-0">Name</p>
                                        </strong>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <hr>

                        <div id="stat_table">
                        </div>


                    </div>
                </div>
                <hr class="mt-3 mb-1 m-0" style="height: 3px;">
                <ul class="list-group border-0">
                    <li class="list-group-item border-0 list-group-item-action">
                        <div class="row">
                            <div class='col-12 col-md-2'>
                                <strong>
                                    <p class="mb-0">Total: </p>
                                </strong>
                            </div>
                            <div class='col-12 col-md-2'>
                                <div style="display:inline">
                                    <p class="mb-0" id="st" style="display:inline">0</p>
                                </div>
                                <div style="display:inline">
                                    <p id="st_hm" class="mb-0" style="display:inline">-</p>
                                </div>
                            </div>
                            <div class='col-12 col-md-2'>
                                <div style="display:inline">
                                    <p id="srt" class="mb-0" style="display:inline">0</p>
                                </div>
                                <div style="display:inline">
                                    <p id="srt_hm" class="mb-0" style="display:inline">-</p>
                                </div>
                            </div>
                            <div class='col-12 col-md-2'>
                                <div style="display:inline">
                                    <p id="lt" class="mb-0" style="display:inline">0</p>
                                </div>
                                <div style="display:inline">
                                    <p id="lt_hm" class="mb-0" style="display:inline">-</p>
                                </div>
                            </div>
                            <div class='col-12 col-md-2'>
                                <div style="display:inline">
                                    <p id="lrt" class="mb-0" style="display:inline">0</p>
                                </div>
                                <div style="display:inline">
                                    <p id="lrt_hm" class="mb-0" style="display:inline">-</p>
                                </div>
                            </div>

                        </div>
                    </li>
                </ul>
                <script>
                    var element_month = document.getElementById("month");
                    var selected_month = element_month.value;
                    var element_year = document.getElementById("year");
                    var selected_year = element_year.value;

                    function loadTable(year_inp, month_inp) {
                        $.ajax({
                            url: '{{ route('certainStatsTable') }}',
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                year: year_inp,
                                month: month_inp,
                                id: {{ Auth::id() }}

                            },
                            success: function(response) {
                                document.getElementById("stat_table").innerHTML = response;
                                overallTable(year_inp, month_inp);
                                loadComment(year_inp, month_inp);
                                loadLogTable(year_inp, month_inp);
                                loadBreakTable(year_inp, month_inp)
                                pieLoad();

                            },
                            error: function(response) {
                                alert("dsad");
                            }
                        });
                    }



                    $('#year').change(function() {
                        var inp_year = $(this).val();
                        var inp_month = document.getElementById("month").value;
                        clearData();
                        loadTable(inp_year, inp_month);
                    });
                    $('#month').change(function() {
                        var inp_month = $(this).val();
                        var inp_year = document.getElementById("year").value;
                        clearData();
                        loadTable(inp_year, inp_month);

                    });

                    function clearData() {
                        sum_sch = 0;
                        sum_log = 0;
                        sum_sch_r = 0;
                        sum_log_r = 0;
                    }


                    function overallTable(year_inp, month_inp) {
                        var counter = 0;

                        for (;;) {
                            if (document.getElementById("s" + counter) != null) {
                                sum_sch = sum_sch + Number(document.getElementById("s" + counter).innerHTML);
                                sum_log = sum_log + Number(document.getElementById("l" + counter).innerHTML);
                                sum_sch_r = sum_sch_r + Number(document.getElementById("sr" + counter).innerHTML);
                                sum_log_r = sum_log_r + Number(document.getElementById("lr" + counter).innerHTML);
                            } else {
                                break;
                            }
                            counter++;
                        }
                        document.getElementById("st").innerHTML = Math.round(sum_sch * 1000) / 1000;
                        document.getElementById("lt").innerHTML = Math.round(sum_log * 1000) / 1000;
                        document.getElementById("srt").innerHTML = Math.round(sum_sch_r * 1000) / 1000;
                        document.getElementById("lrt").innerHTML = Math.round(sum_log_r * 1000) / 1000;
                        document.getElementById("st_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch) +
                            "h&nbsp;" + Math.trunc(sum_sch * 3600 % 3600 / 60) + "min";
                        document.getElementById("srt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch_r) +
                            "h&nbsp;" + Math.trunc(sum_sch_r * 3600 % 3600 / 60) + "min";
                        document.getElementById("lt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log) +
                            "h&nbsp;" + Math.trunc(sum_log * 3600 % 3600 / 60) + "min";
                        document.getElementById("lrt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log_r) +
                            "h&nbsp;" + Math.trunc(sum_log_r * 3600 % 3600 / 60) + "min";
                        var div_can = document.getElementById("div_can");
                        div_can.innerText = "";

                        var canva = document.createElement("canvas");
                        canva.id = "chLine";
                        div_can.appendChild(canva);

                        max_day = daysInMonth(month_inp, year_inp);

                        for (var x = 0; x < max_day; x++) {
                            xValues[x] = x + 1;
                        }
                        $.ajax({


                            url: '{{ route('certainStats') }}',
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                year: year_inp,
                                month: month_inp,
                                id: {{ Auth::id() }}
                            },
                            success: function(response) {
                                yValues = response;
                                load_char(yValues);

                            },
                            error: function(response) {
                                alert("dsad");
                            }
                        });

                    }
                    var colors = ['#007bff', '#28a745', '#333333', '#c3e6cb', '#dc3545', '#6c757d'];

                    function daysInMonth(month, year) {
                        return new Date(year, month, 0).getDate();
                    }





                    function load_char(yValues_transfer) {
                        var chLine = document.getElementById("chLine");
                        var chartData = {
                            labels: xValues,
                            datasets: [{
                                label: '# hours worked',
                                data: yValues_transfer,
                                backgroundColor: 'transparent',
                                borderColor: colors[0],
                                borderWidth: 4,
                                pointBackgroundColor: colors[0]
                            }]
                        };
                        if (chLine) {
                            new Chart(chLine, {
                                type: 'line',
                                data: chartData,
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: false
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                min: 0,
                                                max: 25
                                            }
                                        }],
                                    },
                                    legend: {
                                        display: false
                                    },
                                }
                            });
                        }
                        log();
                        breaks();
                    }
                </script>

            </div>
            <div class="row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 col-md-6">
                            <div class="card p-3 mt-1 mb-5 h-100">
                                <ul class="list-group border-0">
                                    <li class="list-group-item border-0">
                                        <div class="row">
                                            <div class='col-12 col-md-3'>
                                                <strong>
                                                    <h6>Date</h6>
                                                </strong>
                                            </div>
                                            <div class='col-12 col-md-3'>
                                                <strong>
                                                    <h6>Comment on</h6>
                                                </strong>
                                            </div>
                                            <div class='col-12 col-md-3'>
                                                <strong>
                                                    <h6>Comment from</h6>
                                                </strong>
                                            </div>
                                            <div class='col-12 col-md-3'>
                                                <strong>
                                                    <h6>Comment to</h6>
                                                </strong>
                                            </div>
                                            <hr class="mb-1">

                                        </div>
                                    </li>
                                </ul>
                                <div id="com_table"></div>
                            </div>
                            <script>
                                function loadComment(year_inp, month_inp) {
                                    $.ajax({
                                        url: '{{ route('loadStatsCommentCertain') }}',
                                        type: "POST",
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            year: year_inp,
                                            month: month_inp,
                                            id: {{ Auth::id() }}
                                        },
                                        success: function(response) {
                                            document.getElementById("com_table").innerHTML = response;
                                        },
                                        error: function(response) {
                                            alert("dsad");
                                        }
                                    });
                                }
                            </script>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card p-3 mb-2 mt-1 h-100">
                                <select id="object_stats" class="form-select form-select-sm" name="optionObj"
                                    id="optionObj" style=" margin: auto">
                                </select>
                                <center>
                                    <div id="div_can2" style="max-height: 500px">
                                        <canvas id="pieShifts"></canvas>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <script>
                        renderObjectSelect();

                        function renderObjectSelect() {
                            $.ajax({
                                url: '{{ route('selectMainObjects') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                },
                                success: function(response) {
                                    document.getElementById("object_stats").innerHTML = response;
                                    loadTable(selected_year, selected_month);


                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image render: 22 ', error);
                                }
                            });
                        }

                        function pieLoad() {
                            var m_select = document.getElementById("month").value;
                            var y_select = document.getElementById("year").value;
                            var o_select = document.getElementById("object_stats").value;

                            $.ajax({
                                url: '{{ route('loadPieStatsCertain') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    year: y_select,
                                    month: m_select,
                                    object: o_select,
                                    id: {{ Auth::id() }}
                                },
                                success: function(response) {
                                    pie_x = [];
                                    pie_y = [];
                                    pie_color = [];
                                    pie_x = response.name;
                                    pie_y = response.count;
                                    pie_color = response.color;
                                    pieData();

                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image render: 22 ', error);
                                }
                            });
        

                        }
                        var xValuesp = new Array();
                        var yValuesp = new Array();
                        var barColorsp = new Array();

                        function pieData() {
                            xValuesp = [];
                            yValuesp = [];
                            barColorsp = [];
                            if (pie_x.length == 0) {
                                xValuesp.push("No data");
                                yValuesp.push(1);
                                barColorsp.push("#808080");
                            } else {
                                xValuesp = pie_x;
                                yValuesp = pie_y;
                                barColorsp = pie_color;
                            }
                            var div_can = document.getElementById("div_can2");
                            div_can.innerText = "";
                            var canva = document.createElement("canvas");
                            canva.id = "pieShifts";
                            canva.height = "10";
                            div_can.appendChild(canva);

                            new Chart("pieShifts", {
                                type: "pie",
                                data: {
                                    labels: xValuesp,
                                    datasets: [{
                                        backgroundColor: barColorsp,
                                        data: yValuesp
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: true,
 
                                }
                            });

                        }
                        $('#object_stats').change(function() {
                            pieLoad();
                        });
                    </script>

                </div>
                <!-- konec tabulky statistiky -->
            </div>
            <div class="row">

                <div class='col-12 col-md-7 mt-3'>
                    <div class="card p-3 mb-2 mt-1 h-100">
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0">
                                <h5>Log times</h5>
                            </li>
                        </ul>
                        <hr class="m-0 mb-2">
                        <br>
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0">
                                <div class="row">
                                    <div class='col-12 col-md-3'>
                                        <h6>Date</h6>
                                    </div>
                                    <div class='col-12 col-md-3'>
                                        <h6>Object</h6>
                                    </div>
                                    <div class='col-12 col-md-3'>
                                        <h6>From</h6>
                                    </div>
                                    <div class='col-12 col-md-3'>
                                        <h6>To</h6>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                            </li>
                        </ul>
                        <div id="log_table">

                        </div>
                        <script>
                            function loadLogTable(year_inp, month_inp) {
                                $.ajax({
                                    url: '{{ route('loadTableLogCertain') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        year: year_inp,
                                        month: month_inp,
                                        id: {{ Auth::id() }}
                                    },
                                    success: function(response) {
                                        document.getElementById("log_table").innerHTML = response;

                                    },
                                    error: function(xhr, status, error) {
                                        alert('Error fetching image render: 22 ', error);
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
                <div class='col-12 col-md-5 mt-3'>
                    <div class="card p-3 mb-2 mt-1 h-100">
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0">
                                <h5> Break times</h5>
                            </li>
                        </ul>
                        <hr class="m-0 mb-2">

                        <br>
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0">
                                <div class="row">
                                    <div class='col-12 col-md-4'>
                                        <h6>Date</h6>
                                    </div>
                                    <div class='col-12 col-md-4'>
                                        <h6>From</h6>
                                    </div>
                                    <div class='col-12 col-md-4'>
                                        <h6>To</h6>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                            </li>
                        </ul>
                        <div id="break_table">

                        </div>
                    </div>
                    <script>
                        function loadBreakTable(year_inp, month_inp) {

                            $.ajax({
                                url: '{{ route('loadTableBreak') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    year: year_inp,
                                    month: month_inp,
                                    id: {{ Auth::id() }}
                                },
                                success: function(response) {
                                    document.getElementById("break_table").innerHTML = response;

                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image render: 22 ', error);
                                }
                            });
                        }
                        var previous_id = "0";

                        function highlight(id) {
                            highlightClear();
                            var selected_name = document.getElementById(id).getAttribute("name");
                            if (previous_id != id) {
                                var length_names = document.getElementsByName(selected_name).length;
                                for (var c = 0; c < length_names; c++) {
                                    var element = document.getElementsByName(selected_name)[c];
                                    element.className += " active";
                                }
                            }
                            previous_id = id;
                        }

                        function highlightClear() {
                            var myEle = document.getElementById(previous_id);
                            if (myEle) {
                                var selected_name = document.getElementById(previous_id).getAttribute("name");
                                var length_names = document.getElementsByName(selected_name).length;
                                for (var c = 0; c < length_names; c++) {
                                    var element = document.getElementsByName(selected_name)[c];
                                    element.className += "list-group-item list-group-item-action";

                                }
                            }

                        }
                    </script>
                </div>
            </div>
            <br>
        </div>
    </div>
</body>

</html>
