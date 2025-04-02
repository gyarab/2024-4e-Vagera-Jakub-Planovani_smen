<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My time options</title>
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
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
    <link href="{{ asset('CSS/timeline.css') }}" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
</head>

<body id="body-pd">
    <style id="clock-animations"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>

    </style>
    @include('vendor.Chatify.pages.header-admin')
    @include('vendor.Chatify.pages.sidebar-admin')
    @include('admin.scripts')

    <div class="wh-100 bg-light border-start" class="height: 100vh">
        <div class="container">
            <br>
            <div class="main-body">

                <script>
                    /**
                     * Alerty
                     */

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
                </script>

                <div class="row gutters-sm">

                    <div class="col-md-10 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="align-items-middle">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="d-flex flex-column align-items-middle mt-1">
                                                <h5>Shifts picker</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">

                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class='col-12 col-md-12'>



                                                    <!-- monday -->
                                                    <div class="row mt-2">
                                                        <div class='col-12 col-md-12'>
                                                            <div class="row align-items-center">
                                                                <div class='col-12 col-md-4'>
                                                                    <input class="form-check-input mb-2"
                                                                        type="checkbox" id="monday" name="monday"
                                                                        style="height:20px;width:20px" disabled>
                                                                    <label for="monday" class="form-check-label"
                                                                        style="display:inline;font-size: 17px;"> Monday
                                                                    </label>
                                                                </div>
                                                                <div class='col-12 col-md-4'>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">From</span>
                                                                        </div>
                                                                        <input id="frommonday" class="form-control"
                                                                            name="frommonday" type="time"
                                                                            style="display:inline" disabled />
                                                                    </div>
                                                                </div>
                                                                <div class='col-12 col-md-4'>

                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">To</span>
                                                                        </div>
                                                                        <input type="time" id="tomonday"
                                                                            class="form-control" name="tomonday"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- tuesday -->
                                                    <div class="row mt-2">
                                                        <div class='col-12 col-md-12'>
                                                            <div class="row align-items-center">
                                                                <div class='col-12 col-md-4'>
                                                                    <input class="form-check-input mb-2"
                                                                        type="checkbox" id="tuesday" name="tuesday"
                                                                        style="height:20px;width:20px" disabled>
                                                                    <label for="tuesday" class="form-check-label"
                                                                        style="display:inline;font-size: 17px;">
                                                                        Tuesday
                                                                    </label>
                                                                </div>
                                                                <div class='col-12 col-md-4'>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">From</span>
                                                                        </div>
                                                                        <input id="fromtuesday" class="form-control"
                                                                            name="fromtuesday" type="time"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class='col-12 col-md-4'>

                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">To</span>
                                                                        </div>
                                                                        <input type="time" id="totuesday"
                                                                            class="form-control" name="totuesday"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- wednesday -->
                                                    <div class="row mt-2">
                                                        <div class='col-12 col-md-12'>
                                                            <div class="row align-items-center">
                                                                <div class='col-12 col-md-4'>
                                                                    <input class="form-check-input mb-2"
                                                                        type="checkbox" id="wednesday"
                                                                        name="wednesday"
                                                                        style="height:20px;width:20px" disabled>
                                                                    <label for="wednesday" class="form-check-label"
                                                                        style="display:inline;font-size: 17px;">
                                                                        Wednesday
                                                                    </label>
                                                                </div>
                                                                <div class='col-12 col-md-4'>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">From</span>
                                                                        </div>
                                                                        <input id="fromwednesday" class="form-control"
                                                                            name="fromwednesday" type="time"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class='col-12 col-md-4'>

                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">To</span>
                                                                        </div>
                                                                        <input type="time" id="towednesday"
                                                                            class="form-control" name="towednesday"
                                                                            style="display:inline" disabled />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- thursday -->
                                                    <div class="row mt-2">
                                                        <div class='col-12 col-md-12'>
                                                            <div class="row align-items-center">
                                                                <div class='col-12 col-md-4'>
                                                                    <input class="form-check-input mb-2"
                                                                        type="checkbox" id="thursday"
                                                                        name="thursday"
                                                                        style="height:20px;width:20px" disabled>
                                                                    <label for="thursday" class="form-check-label"
                                                                        style="display:inline;font-size: 17px;">
                                                                        Thursday
                                                                    </label>
                                                                </div>
                                                                <div class='col-12 col-md-4'>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">From</span>
                                                                        </div>
                                                                        <input id="fromthursday" class="form-control"
                                                                            name="fromthursday" type="time"
                                                                            style="display:inline" disabled />
                                                                    </div>
                                                                </div>
                                                                <div class='col-12 col-md-4'>

                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">To</span>
                                                                        </div>
                                                                        <input type="time" id="tothursday"
                                                                            class="form-control" name="tothursday"
                                                                            style="display:inline" disabled />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- friday -->
                                                    <div class="row mt-2">
                                                        <div class='col-12 col-md-12'>
                                                            <div class="row align-items-center">
                                                                <div class='col-12 col-md-4'>
                                                                    <input class="form-check-input mb-2"
                                                                        type="checkbox" id="friday" name="friday"
                                                                        style="height:20px;width:20px" disabled>
                                                                    <label for="friday" class="form-check-label"
                                                                        style="display:inline;font-size: 17px;"> Friday
                                                                    </label>
                                                                </div>
                                                                <div class='col-12 col-md-4'>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">From</span>
                                                                        </div>
                                                                        <input id="fromfriday" class="form-control"
                                                                            name="fromfriday" type="time"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class='col-12 col-md-4'>

                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">To</span>
                                                                        </div>
                                                                        <input type="time" id="tofriday"
                                                                            class="form-control" name="tofriday"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- saturday -->
                                                    <div class="row mt-2">
                                                        <div class='col-12 col-md-12'>
                                                            <div class="row align-items-center">
                                                                <div class='col-12 col-md-4'>
                                                                    <input class="form-check-input mb-2"
                                                                        type="checkbox" id="saturday"
                                                                        name="saturday"
                                                                        style="height:20px;width:20px" disabled>
                                                                    <label for="saturday" class="form-check-label"
                                                                        style="display:inline;font-size: 17px;">
                                                                        Saturday
                                                                    </label>
                                                                </div>
                                                                <div class='col-12 col-md-4'>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">From</span>
                                                                        </div>
                                                                        <input id="fromsaturday" class="form-control"
                                                                            name="fromsaturday" type="time"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class='col-12 col-md-4'>

                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">To</span>
                                                                        </div>
                                                                        <input type="time" id="tosaturday"
                                                                            class="form-control" name="tosaturday"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- sunday -->
                                                    <div class="row mt-2">
                                                        <div class='col-12 col-md-12'>
                                                            <div class="row align-items-center">
                                                                <div class='col-12 col-md-4'>
                                                                    <input class="form-check-input mb-2"
                                                                        type="checkbox" id="sunday" name="sunday"
                                                                        style="height:20px;width:20px" disabled>
                                                                    <label for="sunday" class="form-check-label"
                                                                        style="display:inline;font-size: 17px;"> Sunday
                                                                    </label>
                                                                </div>
                                                                <div class='col-12 col-md-4'>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">From</span>
                                                                        </div>
                                                                        <input id="fromsunday" class="form-control"
                                                                            name="fromsunday" type="time"
                                                                            style="display:inline" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class='col-12 col-md-4'>

                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">To</span>
                                                                        </div>
                                                                        <input type="time" id="tosunday"
                                                                            class="form-control" name="tosunday"
                                                                            style="display:inline" disabled />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <br>
                                                        <div class='col-12 col-md-12'>
                                                            <br>

                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        var shifts_arr = [];

                                        var passed_array = new Array();
                                        $.ajax({
                                            url: '{{ route('loadPermanentOptions') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                input: {{ Auth::id() }},

                                            },
                                            success: function(response) {
                                                passed_array = response.saved_data;
                                                if (passed_array.length != null) {

                                                    if (passed_array[0] == 1) {
                                                        document.getElementById("monday").checked = true;
                                                        document.getElementById("frommonday").value = passed_array[1].substring(0, 5);
                                                        document.getElementById("tomonday").value = passed_array[2].substring(0, 5);
                                                    }
                                                    if (passed_array[3] == 1) {
                                                        document.getElementById("tuesday").checked = true;
                                                        document.getElementById("fromtuesday").value = passed_array[4].substring(0, 5);
                                                        document.getElementById("totuesday").value = passed_array[5].substring(0, 5);
                                                    }
                                                    if (passed_array[6] == 1) {
                                                        document.getElementById("wednesday").checked = true;
                                                        document.getElementById("fromwednesday").value = passed_array[7].substring(0, 5);
                                                        document.getElementById("towednesday").value = passed_array[8].substring(0, 5);
                                                    }
                                                    if (passed_array[9] == 1) {
                                                        document.getElementById("thursday").checked = true;
                                                        document.getElementById("fromthursday").value = passed_array[10].substring(0, 5);
                                                        document.getElementById("tothursday").value = passed_array[11].substring(0, 5);
                                                    }
                                                    if (passed_array[12] == 1) {
                                                        document.getElementById("friday").checked = true;
                                                        document.getElementById("fromfriday").value = passed_array[13].substring(0, 5);
                                                        document.getElementById("tofriday").value = passed_array[14].substring(0, 5);
                                                    }
                                                    if (passed_array[15] == 1) {
                                                        document.getElementById("saturday").checked = true;
                                                        document.getElementById("fromsaturday").value = passed_array[16].substring(0, 5);
                                                        document.getElementById("tosaturday").value = passed_array[17].substring(0, 5);
                                                    }
                                                    if (passed_array[18] == 1) {
                                                        document.getElementById("sunday").checked = true;
                                                        document.getElementById("fromsunday").value = passed_array[19].substring(0, 5);
                                                        document.getElementById("tosunday").value = passed_array[20].substring(0, 5);
                                                    }

                                                }
                                            },
                                            error: function(xhr, status, error) {
                                                error_alert('Error connection');

                                            }
                                        });

                                        function getValue() {

                                            var mf = document.getElementById('frommonday').value;
                                            var mt = document.getElementById('tomonday').value;
                                            var tuf = document.getElementById('fromtuesday').value;
                                            var tut = document.getElementById('totuesday').value;
                                            var wf = document.getElementById('fromwednesday').value;
                                            var wt = document.getElementById('towednesday').value;
                                            var thf = document.getElementById('fromthursday').value;
                                            var tht = document.getElementById('tothursday').value;
                                            var ff = document.getElementById('fromfriday').value;
                                            var ft = document.getElementById('tofriday').value;
                                            var saf = document.getElementById('fromsaturday').value;
                                            var sat = document.getElementById('tosaturday').value;
                                            var suf = document.getElementById('fromsunday').value;
                                            var sut = document.getElementById('tosunday').value;


                                            var mo_d = document.getElementById("monday");
                                            var tu_d = document.getElementById("tuesday");
                                            var we_d = document.getElementById("wednesday");
                                            var th_d = document.getElementById("thursday");
                                            var fr_d = document.getElementById("friday");
                                            var sa_d = document.getElementById("saturday");
                                            var su_d = document.getElementById("sunday");
                                            var update = 0;
                                            if (mo_d.checked == true) {
                                                mon_day = 1;
                                            } else {
                                                mon_day = 0;
                                            }
                                            if (tu_d.checked == true) {
                                                tue_day = 1;
                                            } else {
                                                tue_day = 0;
                                            }
                                            if (we_d.checked == true) {
                                                wed_day = 1;
                                            } else {
                                                wed_day = 0;
                                            }
                                            if (th_d.checked == true) {
                                                thu_day = 1;
                                            } else {
                                                thu_day = 0;
                                            }
                                            if (fr_d.checked == true) {
                                                fri_day = 1;
                                            } else {
                                                fri_day = 0;
                                            }
                                            if (sa_d.checked == true) {
                                                sat_day = 1;
                                            } else {
                                                sat_day = 0;
                                            }
                                            if (su_d.checked == true) {
                                                sun_day = 1;
                                            } else {
                                                sun_day = 0;
                                            }
                                            $.ajax({
                                                url: '{{ route('insertPermanenntOption') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    mond: mon_day,
                                                    monf: mf,
                                                    mont: mt,
                                                    tued: tue_day,
                                                    tuef: tuf,
                                                    tuet: tut,
                                                    wedd: wed_day,
                                                    wedf: wf,
                                                    wedt: wt,
                                                    thud: thu_day,
                                                    thuf: thf,
                                                    thut: tht,
                                                    frid: fri_day,
                                                    frif: ff,
                                                    frit: ft,
                                                    satd: sat_day,
                                                    satf: saf,
                                                    satt: sat,
                                                    sund: sun_day,
                                                    sunf: suf,
                                                    sunt: sut,
                                                    id: {{ Auth::id() }},

                                                },
                                                success: function(response) {
                                                    success_alert('Sved successfully');
                                                },
                                                error: function(xhr, status, error) {
                                                    error_alert('Error connection');
                                                }
                                            });
                                        }
                                    </script>
                                    <script>
                                        document.getElementById('everyday').onclick = function() {
                                            var mo = document.getElementById('monday');
                                            var tu = document.getElementById('tuesday');
                                            var we = document.getElementById('wednesday');
                                            var th = document.getElementById('thursday');
                                            var fr = document.getElementById('friday');
                                            var sa = document.getElementById('saturday');
                                            var su = document.getElementById('sunday');
                                            if (mo.checked == true) {
                                                mo.checked = false;
                                            } else {
                                                mo.checked = true;
                                            }
                                            if (tu.checked == true) {
                                                tu.checked = false;
                                            } else {
                                                tu.checked = true;
                                            }
                                            if (we.checked == true) {
                                                we.checked = false;
                                            } else {
                                                we.checked = true;
                                            }
                                            if (th.checked == true) {
                                                th.checked = false;
                                            } else {
                                                th.checked = true;
                                            }
                                            if (fr.checked == true) {
                                                fr.checked = false;
                                            } else {
                                                fr.checked = true;
                                            }
                                            if (sa.checked == true) {
                                                sa.checked = false;
                                            } else {
                                                sa.checked = true;
                                            }
                                            if (su.checked == true) {
                                                su.checked = false;
                                            } else {
                                                su.checked = true;
                                            }

                                        }
                                        document.getElementById('everyworkday').onclick = function() {

                                            var mo = document.getElementById('monday');
                                            var tu = document.getElementById('tuesday');
                                            var we = document.getElementById('wednesday');
                                            var th = document.getElementById('thursday');
                                            var fr = document.getElementById('friday');
                                            if (mo.checked == true) {
                                                mo.checked = false;
                                            } else {
                                                mo.checked = true;
                                            }
                                            if (tu.checked == true) {
                                                tu.checked = false;
                                            } else {
                                                tu.checked = true;
                                            }
                                            if (we.checked == true) {
                                                we.checked = false;
                                            } else {
                                                we.checked = true;
                                            }
                                            if (th.checked == true) {
                                                th.checked = false;
                                            } else {
                                                th.checked = true;
                                            }
                                            if (fr.checked == true) {
                                                fr.checked = false;
                                            } else {
                                                fr.checked = true;
                                            }

                                        }
                                        document.getElementById('weekend').onclick = function() {


                                            var sa = document.getElementById('saturday');
                                            var su = document.getElementById('sunday');

                                            if (sa.checked == true) {
                                                sa.checked = false;
                                            } else {
                                                sa.checked = true;
                                            }
                                            if (su.checked == true) {
                                                su.checked = false;
                                            } else {
                                                su.checked = true;
                                            }
                                        }

                                        function pasteFunction() { // source :www.java2s.com
                                            if (document.getElementById("monday").checked) {
                                                document.getElementById("frommonday").value = document.getElementById("from").value;
                                                document.getElementById("tomonday").value = document.getElementById("to").value;
                                            }
                                            if (document.getElementById("tuesday").checked) {
                                                document.getElementById("fromtuesday").value = document.getElementById("from").value;
                                                document.getElementById("totuesday").value = document.getElementById("to").value;
                                            }
                                            if (document.getElementById("wednesday").checked) {
                                                document.getElementById("fromwednesday").value = document.getElementById("from").value;
                                                document.getElementById("towednesday").value = document.getElementById("to").value;
                                            }
                                            if (document.getElementById("thursday").checked) {
                                                document.getElementById("fromthursday").value = document.getElementById("from").value;
                                                document.getElementById("tothursday").value = document.getElementById("to").value;
                                            }
                                            if (document.getElementById("friday").checked) {
                                                document.getElementById("fromfriday").value = document.getElementById("from").value;
                                                document.getElementById("tofriday").value = document.getElementById("to").value;
                                            }
                                            if (document.getElementById("saturday").checked) {
                                                document.getElementById("fromsaturday").value = document.getElementById("from").value;
                                                document.getElementById("tosaturday").value = document.getElementById("to").value;
                                            }
                                            if (document.getElementById("sunday").checked) {
                                                document.getElementById("fromsunday").value = document.getElementById("from").value;
                                                document.getElementById("tosunday").value = document.getElementById("to").value;
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

</body>

</html>
