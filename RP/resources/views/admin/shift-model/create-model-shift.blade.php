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
    <title>Document</title>
    <style>
        .in {
            border-radius: 50%;
            height: 30px;
            width: 30px;
            /*margin-bottom: 1px;*/
            border: solid #aaa;

        }

        .in:hover {
            height: 29px;
            width: 29px;
            opacity: 0.6;
        }
    </style>

</head>

<body id="body-pd">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <div class="height-100 bg-light">
        <div class="container-fluid">
            <script>
                var sub_object = "";
                var current_object = 0;
                var current_sub_object = 0;
                var edit_shift_id = "";
                var  shift_id = "";
            </script>


            <div class="col py-3">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control form-input" style=""
                                placeholder="Search anything...">

                        </div>
                    </div>
                    <div class="col-12 col-md-2 mt-1 mt-md-0">

                        <Select id="select_obj" style="display: inline;height: 40px;"
                            class="form-select form-select-sm">

                        </Select>
                        <script>
                            $.ajax({


                                url: '{{ route('loadExistingObjects') }}',
                                type: "POST",
                                data: {
                                    _token: '{{ csrf_token() }}',


                                },
                                success: function(response) {
                                    //alert(response)
                                    $("#select_obj").html(response);
                                    //$("#select_obj_edit").html(response);
                                },
                                error: function(response) {
                                    alert("dsad");
                                }
                            });
                        </script>
                    </div>
                    <div class="col-12 col-md-6">
                        <div id="shift_list_load">

                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <button id="create_shift" type="button" class="btn btn-outline-primary btn-rounded"
                            onclick="create_shift_load()" style="float:right" data-mdb-ripple-init
                            data-mdb-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#myModals"><i
                                class="bi bi-patch-plus "></i>&nbsp&nbsp Create shift</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div id="shift_existing">

                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-12">
                        <br>
                        <div class="p-3 mb-2" style="background: #4CAF50;color:#ffffff; font-size: 20px;">Create a new
                            shift
                        </div>
                    </div>
                </div>-->

                <div class="row">
                    <!-- <div class='col-12 '>
                        <div class="p-2 mb-2" style="background: #4CAF50;color:#ffffff; font-size: 18px;">Name of the
                            shift
                        </div>-->
                    <script>
                        var obj_search = new Array();
                        var shi_search = new Array();


                        let currentDate = new Date().toJSON().slice(0, 10);
                        let spreviouscolor = "scolor-1";
                        let scodecolor = "#124072";
                        let shex;

                        window.addEventListener("load", (event) => {

                            let sclicked_color = document.getElementById(spreviouscolor);
                            sclicked_color.style.border = "solid black";
                            shex = "#124072";
                        });
                    </script>

                    <!--<div class="row">
                            <div class='col-12 col-md-8'>
                                <input type="text" class="form-control" name="jobname" id="jobname"
                                    style="display:inline">
                                <br id="hbr" style="display:none">
                                <small id="label2" style="visibility:hidden;color:red"></small>
                            </div>
                        </div>

                        <div class="p-2 mb-2 mt-2" style="background: #4CAF50;color:#ffffff; font-size: 18px;">Select
                            the time
                        </div>-->


                    <!-- <div class="row">
                            <div class='col-12 col-md-12'>
                                <div class="row">
                                    <div class='col-12 col-md-4'>
                                        <input type="checkbox" class="form-check-input" id="everyday" name="radio"
                                            style="height:20px;width:20px">
                                        <label for="everyday" class="form-check-label"
                                            style="display:inline;font-size: 17px">
                                            Everyday</label>
                                    </div>
                                    <div class='col-12 col-md-4'>
                                        <input type="checkbox" class="form-check-input" id="everyworkday"
                                            name="radio" style="height:20px;width:20px">
                                        <label for="everyworkday" class="form-check-label"
                                            style="display:inline;font-size: 17px"> Every work
                                            day</label>
                                    </div>
                                    <div class='col-12 col-md-4'>

                                        <input type="checkbox" class="form-check-input" id="weekend"
                                            name="radio" style="height:20px;width:20px">
                                        <label for="weekend" class="form-check-label"
                                            style="display:inline;font-size: 17px"> Every
                                            weekend</label>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    <!--<div class="row">
                            <div class='col-12 col-md-12'>

                            </div>
                        </div>
                        <hr>-->
                    <!-- monday -->


                    <!--<div class="row mt-2">
                    <div class='col-12 col-md-12'>
                      <input class="form-check-input" type="checkbox" id="tuesday" name="tuesday">
                      <label for="tuesday" class="form-check-label" style="display:inline"> Tuesday - </label>
                      <label for="fromtuesday" style="display:inline">From </label>
                      <input type="time" id="fromtuesday" name="fromtuesday" style="display:inline" />
                      <label for="totuesday" style="display:inline">To </label>
                      <input type="time" id="totuesday" name="totuesday" style="display:inline" />
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class='col-12 col-md-12'>
                      <input class="form-check-input" type="checkbox" id="wednesday" name="wednesday">
                      <label for="wednesday" class="form-check-label" style="display:inline"> Wednesday - </label>
                      <label for="fromwednesday" style="display:inline">From </label>
                      <input type="time" id="fromwednesday" name="fromwednesday" style="display:inline" />
                      <label for="towednesday" style="display:inline">To </label>
                      <input type="time" id="towednesday" name="towednesday" style="display:inline" />
                    </div>
                  </div>
      
                  <div class="row mt-2">
                    <div class='col-12 col-md-12'>
                      <input class="form-check-input" type="checkbox" id="thursday" name="thursday">
                      <label for="thursday" class="form-check-label" style="display:inline"> Thursday - </label>
                      <label for="fromthursday" style="display:inline">From </label>
                      <input type="time" id="fromthursday" name="fromthursday" min="00:00" max="00:00" style="display:inline" />
                      <label for="tothursday" style="display:inline">To </label>
                      <input type="time" id="tothursday" name="tothursday" min="00:00" max="00:00" style="display:inline" />
                    </div>
                  </div>
      
                  <div class="row mt-2">
                    <div class='col-12 col-md-12'>
                      <input class="form-check-input" type="checkbox" id="friday" name="friday">
                      <label for="Friday" class="form-check-label" style="display:inline"> Friday - </label>
                      <label for="fromfriday" style="display:inline">From </label>
                      <input type="time" id="fromfriday" name="fromfriday" min="00:00" max="00:00" style="display:inline" />
                      <label for="tofriday" style="display:inline">To </label>
                      <input type="time" id="tofriday" name="tofriday" min="00:00" max="00:00" style="display:inline" />
                    </div>
                  </div>
      
                  <div class="row mt-2">
                    <div class='col-12 col-md-12'>
                      <input class="form-check-input" type="checkbox" id="saturday" name="saturday">
                      <label for="saturday" class="form-check-label" style="display:inline"> Saturday - </label>
                      <label for="fromsaturday" style="display:inline">From </label>
                      <input type="time" id="fromsaturday" name="fromsaturday" min="00:00" max="00:00" style="display:inline" />
                      <label for="tosaturday" style="display:inline">To </label>
                      <input type="time" id="tosaturday" name="tosaturday" min="00:00" max="00:00" style="display:inline" />
                    </div>
                  </div>
      
                  <div class="row mt-2">
                    <div class='col-12 col-md-12'>
                      <input class="form-check-input" type="checkbox" id="sunday" name="sunday">
                      <label for="sunday" class="form-check-label" style="display:inline"> Sunday - </label>
                      <label for="fromsunday" style="display:inline">From </label>
                      <input type="time" id="fromsunday" name="fromsunday" min="00:00" max="00:00" style="display:inline" />
                      <label style="display:inline">To </label>
                      <input type="time" id="tosunday" name="tosunday" min="00:00" max="00:00" style="display:inline" />
                    </div>
                  </div>-->


                    <!--<div class="row">
                            <div class='col-12 col-md-12'>
                                <div class="p-2 mb-2 mt-2"
                                    style="background: #4CAF50;color:#ffffff; font-size: 18px;">Color picker
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class='col-12 col-md-2'>
                            </div>
                            <div class='col-12 col-md-8'>
                                <center>

                                    <input id="color-1" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #124072;" value="">

                                    <input id="color-2" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #067088;" value="">

                                    <input id="color-3" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #056362;" value="">

                                    <input id="color-4" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #055d2b;" value="">


                                    <input id="color-5" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #4b8723;" value="">


                                    <input id="color-6" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #889d1e;" value="">


                                    <br>
                                    <input id="color-7" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #c3b204;" value="">
                                    <input id="color-8" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #ce8425;" value="">
                                    <input id="color-9" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color:  #a53d1a;" value="">
                                    <input id="color-10" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color:  #880002;" value="">
                                    <input id="color-11" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color:  #6a1161;" value="">
                                    <input id="color-12" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color:  #4c1862 ;" value="">
                                    <br>
                                    <input id="color-13" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #1965b9;" value="">
                                    <input id="color-14" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color:  #039ce0;" value="">
                                    <input id="color-15" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #01969c;" value="">
                                    <input id="color-16" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #009242;" value="">
                                    <input id="color-17" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color:  #67ad31 ;" value="">
                                    <input id="color-18" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #bcd637;" value="">
                                    <br>
                                    <input id="color-19" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #fff002;" value="">
                                    <input id="color-20" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #fdaf43;" value="">
                                    <input id="color-21" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #e87034;" value="">
                                    <input id="color-22" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #eb1c26;" value="">
                                    <input id="color-23" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #a2288d;" value="">
                                    <input id="color-24" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #652d90;" value="">
                                    <br>
                                    <input id="color-25" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #81c1e7;" value="">
                                    <input id="color-26" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #50ddd5;" value="">
                                    <input id="color-27" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #addc81;" value="">
                                    <input id="color-28" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #ffffba;" value="">
                                    <input id="color-29" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #fea698;" value="">
                                    <input id="color-30" type="button" class="in" onclick="Color(this.id)"
                                        style="background-color: #b697dd;" value="">
                                    <br>
                                </center>
                            </div>
                            <div class='col-12 col-md-2'>
                            </div>

                        </div>-->
                </div>
                <button type="button" class="btn btn-info btn-lg w-100" data-bs-toggle="modal"
                    data-bs-target="#myModals">Open Modal</button>

                <!-- Modal -->
                <div class="modal fade w-100" id="myModals" role="dialog" data-bs-backdrop="false">
                    <div class="modal-dialog w-100 modal-fullscreen">

                        <!-- Modal content-->
                        <div class="modal-content modal-fullscreen d-flex justify-content-center w-100">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Create panel</b></h5>
                                <button type="button" class="close btn" style="float: right"
                                    data-bs-dismiss="modal" aria-label="Close" onclick="hide_btn()">
                                    <span style="font-size: 35px; float: right" aria--bs-hidden="true"
                                        onclick="hide_btn()">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class='row w-100'>

                                    <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
                                        <h5>Select parametrs</h5>
                                        <div class="row">
                                            <div class='col-12 col-md-8'>

                                                <input type="text" class="form-control" id="sfield"
                                                    placeholder="Insert name...">
                                                <br id="hbrs" style="display:none">
                                                <small id="label2s" style="visibility:hidden;color:red"></small>
                                                <br>
                                            </div>
                                            <div class='col-12 col-md-3'>
                                                <div class='text-end'>
                                                    <p style='margin-right: 10px;display: inline'>Repeateble</p>


                                                    <label class='switch '>

                                                        <input id="repeateble" type='checkbox' onclick="repeatable()"
                                                            class='primary' checked>


                                                        <span class='slider round'></span>
                                                    </label>
                                                </div>
                                                <script></script>
                                            </div>
                                            <hr class="mt-2">
                                        </div>
                                        <div class="row">
                                            <div class='col-12 col-md-12'>
                                                <div class="row">
                                                    <div class='col-12 col-md-4'>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="everyday" name="radio"
                                                            style="height:20px;width:20px">
                                                        <label for="everyday" class="form-check-label"
                                                            style="display:inline;font-size: 17px">
                                                            Everyday</label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="everyworkday" name="radio"
                                                            style="height:20px;width:20px">
                                                        <label for="everyworkday" class="form-check-label"
                                                            style="display:inline;font-size: 17px"> Every work
                                                            day</label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <input type="checkbox" class="form-check-input"
                                                            id="weekend" name="radio"
                                                            style="height:20px;width:20px">
                                                        <label for="weekend" class="form-check-label"
                                                            style="display:inline;font-size: 17px"> Every
                                                            weekend</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-4'>
                                                <!--<label for="from" style="display:inline; font-size:18px">From </label>-->

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">From</span>
                                                    </div>
                                                    <input type="time" class="form-control" id="from"
                                                        name="from" style="display:inline" />
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-4'>
                                                <!--<label for="to" style="display:inline">To </label>-->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon2">To</span>
                                                    </div>
                                                    <input type="time" id="to" class="form-control"
                                                        name="to" style="display:inline" />
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-2'>
                                                <button id="paste" style="float: right;"
                                                    class="btn btn-outline-primary"
                                                    onclick="pasteFunction()">Paste</button>
                                            </div>
                                        </div>

                                        <!-- monday -->
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-12'>
                                                <div class="row align-items-center">
                                                    <div class='col-12 col-md-3'>
                                                        <input class="form-check-input mb-2" type="checkbox"
                                                            id="smonday" name="smonday"
                                                            style="height:20px;width:20px">
                                                        <label for="smonday" class="form-check-label"
                                                            style="display:inline;font-size: 17px;"> Monday
                                                        </label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">From</span>
                                                            </div>
                                                            <input id="sfrommonday" class="form-control"
                                                                name="sfrommonday" type="time"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">To</span>
                                                            </div>
                                                            <input type="time" id="stomonday" class="form-control"
                                                                name="stomonday" style="display:inline" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- tuesday -->
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-12'>
                                                <div class="row align-items-center">
                                                    <div class='col-12 col-md-3'>
                                                        <input class="form-check-input mb-2" type="checkbox"
                                                            id="stuesday" name="stuesday"
                                                            style="height:20px;width:20px">
                                                        <label for="stuesday" class="form-check-label"
                                                            style="display:inline;font-size: 17px;"> Tuesday
                                                        </label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">From</span>
                                                            </div>
                                                            <input id="sfromtuesday" class="form-control"
                                                                name="sfromtuesday" type="time"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">To</span>
                                                            </div>
                                                            <input type="time" id="stotuesday"
                                                                class="form-control" name="stotuesday"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- wednesday -->
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-12'>
                                                <div class="row align-items-center">
                                                    <div class='col-12 col-md-3'>
                                                        <input class="form-check-input mb-2" type="checkbox"
                                                            id="swednesday" name="swednesday"
                                                            style="height:20px;width:20px">
                                                        <label for="swednesday" class="form-check-label"
                                                            style="display:inline;font-size: 17px;">
                                                            Wednesday
                                                        </label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">From</span>
                                                            </div>
                                                            <input id="sfromwednesday" class="form-control"
                                                                name="sfromwednesday" type="time"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">To</span>
                                                            </div>
                                                            <input type="time" id="stowednesday"
                                                                class="form-control" name="stowednesday"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- thursday -->
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-12'>
                                                <div class="row align-items-center">
                                                    <div class='col-12 col-md-3'>
                                                        <input class="form-check-input mb-2" type="checkbox"
                                                            id="sthursday" name="thursday"
                                                            style="height:20px;width:20px">
                                                        <label for="sthursday" class="form-check-label"
                                                            style="display:inline;font-size: 17px;">
                                                            Thursday
                                                        </label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">From</span>
                                                            </div>
                                                            <input id="sfromthursday" class="form-control"
                                                                name="sfromthursday" type="time"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">To</span>
                                                            </div>
                                                            <input type="time" id="stothursday"
                                                                class="form-control" name="stothursday"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- friday -->
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-12'>
                                                <div class="row align-items-center">
                                                    <div class='col-12 col-md-3'>
                                                        <input class="form-check-input mb-2" type="checkbox"
                                                            id="sfriday" name="sfriday"
                                                            style="height:20px;width:20px">
                                                        <label for="sfriday" class="form-check-label"
                                                            style="display:inline;font-size: 17px;"> Friday
                                                        </label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">From</span>
                                                            </div>
                                                            <input id="sfromfriday" class="form-control"
                                                                name="sfromfriday" type="time"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">To</span>
                                                            </div>
                                                            <input type="time" id="stofriday" class="form-control"
                                                                name="stofriday" style="display:inline" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- saturday -->
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-12'>
                                                <div class="row align-items-center">
                                                    <div class='col-12 col-md-3'>
                                                        <input class="form-check-input mb-2" type="checkbox"
                                                            id="ssaturday" name="ssaturday"
                                                            style="height:20px;width:20px">
                                                        <label for="ssaturday" class="form-check-label"
                                                            style="display:inline;font-size: 17px;">
                                                            Saturday
                                                        </label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">From</span>
                                                            </div>
                                                            <input id="sfromsaturday" class="form-control"
                                                                name="sfromsaturday" type="time"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">To</span>
                                                            </div>
                                                            <input type="time" id="stosaturday"
                                                                class="form-control" name="stosaturday"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- sunday -->
                                        <div class="row mt-2">
                                            <div class='col-12 col-md-12'>
                                                <div class="row align-items-center">
                                                    <div class='col-12 col-md-3'>
                                                        <input class="form-check-input mb-2" type="checkbox"
                                                            id="ssunday" name="ssunday"
                                                            style="height:20px;width:20px">
                                                        <label for="ssunday" class="form-check-label"
                                                            style="display:inline;font-size: 17px;"> Sunday
                                                        </label>
                                                    </div>
                                                    <div class='col-12 col-md-4'>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">From</span>
                                                            </div>
                                                            <input id="sfromsunday" class="form-control"
                                                                name="sfromsunday" type="time"
                                                                style="display:inline" />
                                                        </div>
                                                    </div>
                                                    <div class='col-12 col-md-4'>

                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">To</span>
                                                            </div>
                                                            <input type="time" id="stosunday" class="form-control"
                                                                name="stosunday" style="display:inline" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-2">
                                        </div>

                                        <div class="row">

                                        </div>
                                        <div class="row">

                                            <div class='col-12 col-md-2'>
                                            </div>
                                            <div class='col-12 col-md-8'>
                                                <center>

                                                </center>
                                            </div>
                                            <div class='col-12 col-md-2'>
                                            </div>

                                        </div>

                                        <!--<button id="dropdown-currency-button" data-dropdown-toggle="dropdown-currency" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
                                                    <svg fill="none" aria-hidden="true" class="h-4 w-4 me-2" viewBox="0 0 20 15"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/><mask id="a" style="mask-type:luminance" width="20" height="15" x="0" y="0" maskUnits="userSpaceOnUse"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/></mask><g mask="url(#a)"><path fill="#D02F44" fill-rule="evenodd" d="M19.6.5H0v.933h19.6V.5zm0 1.867H0V3.3h19.6v-.933zM0 4.233h19.6v.934H0v-.934zM19.6 6.1H0v.933h19.6V6.1zM0 7.967h19.6V8.9H0v-.933zm19.6 1.866H0v.934h19.6v-.934zM0 11.7h19.6v.933H0V11.7zm19.6 1.867H0v.933h19.6v-.933z" clip-rule="evenodd"/><path fill="#46467F" d="M0 .5h8.4v6.533H0z"/><g filter="url(#filter0_d_343_121520)"><path fill="url(#paint0_linear_343_121520)" fill-rule="evenodd" d="M1.867 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.866 0a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM7.467 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zM2.333 3.3a.467.467 0 100-.933.467.467 0 000 .933zm2.334-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.4.467a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm-2.334.466a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.466a.467.467 0 11-.933 0 .467.467 0 01.933 0zM1.4 4.233a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM6.533 4.7a.467.467 0 11-.933 0 .467.467 0 01.933 0zM7 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zM3.267 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0z" clip-rule="evenodd"/></g></g><defs><linearGradient id="paint0_linear_343_121520" x1=".933" x2=".933" y1="1.433" y2="6.1" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"/><stop offset="1" stop-color="#F0F0F0"/></linearGradient><filter id="filter0_d_343_121520" width="6.533" height="5.667" x=".933" y="1.433" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" result="hardAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/><feOffset dy="1"/><feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"/><feBlend in2="BackgroundImageFix" result="effect1_dropShadow_343_121520"/><feBlend in="SourceGraphic" in2="effect1_dropShadow_343_121520" result="shape"/></filter></defs></svg>
                                                USD <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
                                                </button>
                                                <div id="dropdown-currency" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-36 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-currency-button">
                                                        <li>
                                                            <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                                <div class="inline-flex items-center">
                                                                    <svg fill="none" aria-hidden="true" class="h-4 w-4 me-2" viewBox="0 0 20 15"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/><mask id="a" style="mask-type:luminance" width="20" height="15" x="0" y="0" maskUnits="userSpaceOnUse"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/></mask><g mask="url(#a)"><path fill="#D02F44" fill-rule="evenodd" d="M19.6.5H0v.933h19.6V.5zm0 1.867H0V3.3h19.6v-.933zM0 4.233h19.6v.934H0v-.934zM19.6 6.1H0v.933h19.6V6.1zM0 7.967h19.6V8.9H0v-.933zm19.6 1.866H0v.934h19.6v-.934zM0 11.7h19.6v.933H0V11.7zm19.6 1.867H0v.933h19.6v-.933z" clip-rule="evenodd"/><path fill="#46467F" d="M0 .5h8.4v6.533H0z"/><g filter="url(#filter0_d_343_121520)"><path fill="url(#paint0_linear_343_121520)" fill-rule="evenodd" d="M1.867 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.866 0a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM7.467 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zM2.333 3.3a.467.467 0 100-.933.467.467 0 000 .933zm2.334-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.4.467a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm-2.334.466a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.466a.467.467 0 11-.933 0 .467.467 0 01.933 0zM1.4 4.233a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM6.533 4.7a.467.467 0 11-.933 0 .467.467 0 01.933 0zM7 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zM3.267 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0z" clip-rule="evenodd"/></g></g><defs><linearGradient id="paint0_linear_343_121520" x1=".933" x2=".933" y1="1.433" y2="6.1" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"/><stop offset="1" stop-color="#F0F0F0"/></linearGradient><filter id="filter0_d_343_121520" width="6.533" height="5.667" x=".933" y="1.433" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" result="hardAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/><feOffset dy="1"/><feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"/><feBlend in2="BackgroundImageFix" result="effect1_dropShadow_343_121520"/><feBlend in="SourceGraphic" in2="effect1_dropShadow_343_121520" result="shape"/></filter></defs></svg>
                                                                    USD
                                                                </div>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                                <div class="inline-flex items-center">
                                                                    <svg fill="none" aria-hidden="true" class="h-4 w-4 me-2" viewBox="0 0 20 15"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/><mask id="a" style="mask-type:luminance" width="20" height="15" x="0" y="0" maskUnits="userSpaceOnUse"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/></mask><g mask="url(#a)"><path fill="#043CAE" d="M0 .5h19.6v14H0z"/><path fill="#FFD429" fill-rule="evenodd" d="M9.14 3.493L9.8 3.3l.66.193-.193-.66.193-.66-.66.194-.66-.194.193.66-.193.66zm0 9.334l.66-.194.66.194-.193-.66.193-.66-.66.193-.66-.193.193.66-.193.66zm5.327-4.86l-.66.193L14 7.5l-.193-.66.66.193.66-.193-.194.66.194.66-.66-.193zm-9.994.193l.66-.193.66.193L5.6 7.5l.193-.66-.66.193-.66-.193.194.66-.194.66zm9.369-2.527l-.66.194.193-.66-.194-.66.66.193.66-.193-.193.66.193.66-.66-.194zm-8.743 4.86l.66-.193.66.193-.194-.66.194-.66-.66.194-.66-.194.193.66-.193.66zm7.034-6.568l-.66.193.194-.66-.194-.66.66.194.66-.193-.193.66.193.66-.66-.194zm-5.326 8.276l.66-.193.66.193-.194-.66.194-.66-.66.194-.66-.193.193.66-.193.66zM13.84 10.3l-.66.193.194-.66-.194-.66.66.194.66-.194-.193.66.193.66-.66-.193zM5.1 5.827l.66-.194.66.194-.194-.66.194-.66-.66.193-.66-.193.193.66-.193.66zm7.034 6.181l-.66.193.194-.66-.194-.66.66.194.66-.193-.193.66.193.66-.66-.194zm-5.326-7.89l.66-.193.66.193-.194-.66.194-.66-.66.194-.66-.193.193.66-.193.66z" clip-rule="evenodd"/></g></svg>
                                                                    EUR
                                                                </div>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                                <div class="inline-flex items-center">
                                                                    <svg fill="none" aria-hidden="true" class="h-4 w-4 me-2" viewBox="0 0 20 15"><rect width="19.1" height="13.5" x=".25" y=".75" fill="#fff" stroke="#F5F5F5" stroke-width=".5" rx="1.75"/><mask id="a" style="mask-type:luminance" width="20" height="15" x="0" y="0" maskUnits="userSpaceOnUse"><rect width="19.1" height="13.5" x=".25" y=".75" fill="#fff" stroke="#fff" stroke-width=".5" rx="1.75"/></mask><g fill="#FF3131" mask="url(#a)"><path d="M14 .5h5.6v14H14z"/><path fill-rule="evenodd" d="M0 14.5h5.6V.5H0v14zM11.45 6.784a.307.307 0 01-.518-.277l.268-1.34-.933.466-.467-1.4-.467 1.4-.933-.466.268 1.34a.307.307 0 01-.518.277.307.307 0 00-.434 0l-.25.25-.933-.467L7 7.5l-.231.231a.333.333 0 000 .471l1.164 1.165h1.4l.234 1.4h.466l.234-1.4h1.4l1.164-1.165a.333.333 0 000-.471l-.231-.23.467-.934-.934.466-.25-.25a.307.307 0 00-.433 0z" clip-rule="evenodd"/></g></svg>
                                                                    CAD
                                                                </div>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                                <div class="inline-flex items-center">
                                                                    <svg fill="none" aria-hidden="true" class="h-4 w-4 me-2" viewBox="0 0 20 15"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/><mask id="a" style="mask-type:luminance" width="20" height="15" x="0" y="0" maskUnits="userSpaceOnUse"><rect width="19.6" height="14" y=".5" fill="#fff" rx="2"/></mask><g mask="url(#a)"><path fill="#0A17A7" d="M0 .5h19.6v14H0z"/><path fill="#fff" fill-rule="evenodd" d="M-.898-.842L7.467 4.8V-.433h4.666V4.8l8.365-5.642L21.542.706l-6.614 4.46H19.6v4.667h-4.672l6.614 4.46-1.044 1.549-8.365-5.642v5.233H7.467V10.2l-8.365 5.642-1.044-1.548 6.614-4.46H0V5.166h4.672L-1.942.706-.898-.842z" clip-rule="evenodd"/><path stroke="#DB1F35" stroke-linecap="round" stroke-width=".667" d="M13.068 4.933L21.933-.9M14.009 10.088l7.948 5.357M5.604 4.917L-2.686-.67M6.503 10.024l-9.19 6.093"/><path fill="#E6273E" fill-rule="evenodd" d="M0 8.9h8.4v5.6h2.8V8.9h8.4V6.1h-8.4V.5H8.4v5.6H0v2.8z" clip-rule="evenodd"/></g></svg>
                                                                    GBP
                                                                </div>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>-->



                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="mb-1">
                                                    <h5>Select Salary</h5>
                                                </div>
                                                <div class="input-group">
                                                    <input type="number" id="currency-input" class="form-control"
                                                        aria-label="Text input with dropdown button" required>
                                                    <div class="input-group-append">
                                                        <select name="" id=""
                                                            style="display: inline;height: 38px;"
                                                            class="form-select form-select-sm">
                                                            <option>USD </option>
                                                            <option>CZK </option>
                                                            <option>EUR </option>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="relative">


                                                    <input id="price-range-input" type="range" value="1000"
                                                        min="0" max="1500"
                                                        class="w-100 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                                                    <!--<span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">Min ($100)</span>
                                                <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">$500</span>
                                                <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">$1000</span>
                                                <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">Max ($1500)</span>-->
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-1">
                                                    <h5>Select color</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input id="scolor-1" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #124072;" value="">
                                                        <input id="scolor-2" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #067088;" value="">
                                                        <input id="scolor-3" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #056362;" value="">
                                                        <input id="scolor-4" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #055d2b;" value="">
                                                        <input id="scolor-5" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #4b8723;" value="">
                                                        <input id="scolor-6" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #889d1e;" value="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input id="scolor-7" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #c3b204;" value="">
                                                        <input id="scolor-8" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #ce8425;" value="">
                                                        <input id="scolor-9" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color:  #a53d1a;" value="">
                                                        <input id="scolor-10" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color:  #880002;" value="">
                                                        <input id="scolor-11" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color:  #6a1161;" value="">
                                                        <input id="scolor-12" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color:  #4c1862 ;" value="">
                                                    </div>
                                                </div>
                                                <input id="scolor-13" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #1965b9;"
                                                    value="">
                                                <input id="scolor-14" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color:  #039ce0;"
                                                    value="">
                                                <input id="scolor-15" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #01969c;"
                                                    value="">
                                                <input id="scolor-16" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #009242;"
                                                    value="">
                                                <input id="scolor-17" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color:  #67ad31 ;"
                                                    value="">
                                                <input id="scolor-18" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #bcd637;"
                                                    value="">
                                                <br>
                                                <input id="scolor-19" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #fff002;"
                                                    value="">
                                                <input id="scolor-20" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #fdaf43;"
                                                    value="">
                                                <input id="scolor-21" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #e87034;"
                                                    value="">
                                                <input id="scolor-22" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #eb1c26;"
                                                    value="">
                                                <input id="scolor-23" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #a2288d;"
                                                    value="">
                                                <input id="scolor-24" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #652d90;"
                                                    value="">
                                                <br>
                                                <input id="scolor-25" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #81c1e7;"
                                                    value="">
                                                <input id="scolor-26" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #50ddd5;"
                                                    value="">
                                                <input id="scolor-27" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #addc81;"
                                                    value="">
                                                <input id="scolor-28" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #ffffba;"
                                                    value="">
                                                <input id="scolor-29" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #fea698;"
                                                    value="">
                                                <input id="scolor-30" type="button" class="in"
                                                    onclick="sColor(this.id)" style="background-color: #b697dd;"
                                                    value="">
                                                <script>
                                                    const map1 = new Map();

                                                    map1.set('#124072', 'scolor-1');
                                                    map1.set('#067088', 'scolor-2');
                                                    map1.set('#056362', 'scolor-3');
                                                    map1.set('#055d2b', 'scolor-4');
                                                    map1.set('#4b8723', 'scolor-5');
                                                    map1.set('#889d1e', 'scolor-6');

                                                    map1.set('#c3b204', 'scolor-7');
                                                    map1.set('#ce8425', 'scolor-8');
                                                    map1.set('#a53d1a', 'scolor-9');
                                                    map1.set('#880002', 'scolor-10');
                                                    map1.set('#6a1161', 'scolor-11');
                                                    map1.set('#4c1862', 'scolor-12');

                                                    map1.set('#1965b9', 'scolor-13');
                                                    map1.set('#039ce0', 'scolor-14');
                                                    map1.set('#01969c', 'scolor-15');
                                                    map1.set('#009242', 'scolor-16');
                                                    map1.set('#67ad31', 'scolor-17');
                                                    map1.set('#bcd637', 'scolor-18');

                                                    map1.set('#fff002', 'scolor-19');
                                                    map1.set('#fdaf43', 'scolor-20');
                                                    map1.set('#e87034', 'scolor-21');
                                                    map1.set('#eb1c26', 'scolor-22');
                                                    map1.set('#a2288d', 'scolor-23');
                                                    map1.set('#652d90', 'scolor-24');

                                                    map1.set('#81c1e7', 'scolor-25');
                                                    map1.set('#50ddd5', 'scolor-26');
                                                    map1.set('#addc81', 'scolor-27');
                                                    map1.set('#ffffba', 'scolor-28');
                                                    map1.set('#fea698', 'scolor-29');
                                                    map1.set('#b697dd', 'scolor-30');
                                                </script>
                                            </div>
                                        </div>




                                        <script>
                                            var rangeInput = document.getElementById('price-range-input');
                                            var currencyInput = document.getElementById('currency-input');

                                            // Function to update the currency input
                                            function updateCurrencyInput() {
                                                currencyInput.value = rangeInput.value;
                                            }

                                            // Add event listener to the range input
                                            rangeInput.addEventListener('input', updateCurrencyInput);
                                        </script>

                                    </div>
                                    <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
                                        <h5>Select object</h5>

                                        <div class='row'>
                                            <div class='col-12 col-md-6'>
                                                <!--<Select id="select_obj_edit" style="display: inline;height: 38px;"
                                                        class="form-select form-select-sm">
                                                
                                                    </Select>-->
                                            </div>
                                        </div>
                                        <div class="tree">
                                            <div id="object_model">

                                            </div>
                                        </div>
                                        <br id="hbr3s" style="display:none">
                                        <label id="label3s" style="visibility:hidden;color:red">Object needs
                                            to be selected*</label>
                                        <script></script>
                                    </div>
                                </div>
                                <div>

                                    <script></script>

                                    <!--<fieldset class="color-swatch" id="cp2"
                                        style="--bdw:1px;--gap:2px;--item-bxsh-w:1px;--items-per-row:10;--maw:15rem;">
                          
                                    </fieldset><br>-->

                                    <script>
                                        /*const swatches = '\
                                                                                                            #000000 #434343 #656666 #999999 #B7B7B7 #CCCDCD #D7D8D8 #EEEEEF #F3F3F3 #FFFFFF \
                                                                                                            #94000B #F8001A #F99922 #FBFF2F #2AFF24 #45FFFE #5880E6 #3600FC #9D00FC #FC01FD \
                                                                                                            #E4B7B0 #F2CBCC #FAE5CE #FDF3CD #DAEBD5 #D1E0E3 #CBD9F7 #D2E1F3 #D9D1E8 #E9D0DC \
                                                                                                            #D97C6D #E7979A #F5CC9E #FCE79C #B6D9A9 #A4C4C8 #A8C0F3 #A3C5E7 #B5A4D5 #D3A4BD \
                                                                                                            #C73B2C #DB6268 #F1B370 #FBDB6E #94C77F #7AA5AE #769AE9 #77A6DA #9077C1 #C077A0 \
                                                                                                            #A1100E #C60013 #E19140 #EDC43F #6BAB52 #4B818D #4B72D6 #4A82C4 #6A46A5 #A34879 \
                                                                                                            #811B13 #95000B #B05E17 #BB921A #3A7921 #1C4F5B #2F4BCA #214F92 #380D74 #711147 \
                                                                                                            #580A04 #630005 #753F0D #7C610E #285016 #12343D #284185 #143562 #220A4C #4A0B30'.split(' ');

                                                                                                                renderColorPicker(cp1, '\
                                                                                                            hsl(168,41%,65%) hsl(198,45%,47%) hsl(207,84%,63%) hsl(210,58%,77%) \
                                                                                                            hsl(227,92%,64%) hsl(258,90%,64%) hsl(276,74%,57%) hsl(297,59%,75%) \
                                                                                                            hsl(332,54%,58%) hsl(5,77%,74%) hsl(0,0%,50%) hsl(0,0%,73%) hsl(27,30%,69%) \
                                                                                                            transparent'.split(' '), 'cg1');

                                                                                                                renderColorPicker(cp2, swatches, 'cg2');
                                                                                                                renderColorPicker(cp3, swatches, 'cg3');

                                                                                                                function renderColorPicker(element, colors, group) {
                                                                                                                    element.innerHTML = colors.map((color, index) => `
<label class="color-item" style="--bgc:${color.trim()}">
  <input type="radio" name="${group}" value="${color.trim()}"${index === 0 ? ` checked`:''}><i></i>
</label>`).join('');
                                                                                                                }*/

                                        function setLuminance(elements) {
                                            elements.forEach(element => {
                                                const rgb = window.getComputedStyle(element).getPropertyValue('background-color');
                                                if (rgb) {
                                                    const [r, g, b] = rgb.replace(/[^\d,]/g, '').split(',');
                                                    const brightness = (299 * r + 587 * g + 114 * b) / 1000;
                                                    if (!element.style.cssText.includes('transparent')) {
                                                        element.style.setProperty('--bdc', brightness <= 127 ? `rgb(${r-10},${g-10},${b-10})` :
                                                            `rgb(${r-40},${g-40},${b-40})`);
                                                        element.style.setProperty('--ico-c', brightness <= 127 ? 'rgba(255, 255, 255, 0.97)' :
                                                            'rgba(0, 0, 0, .97)');
                                                    }
                                                }
                                            })
                                        }

                                        /* Add brightness-check, if color-contrast is not supported */
                                        if (CSS.supports('not (color: color-contrast(red vs black, white))')) {
                                            setLuminance(cp1.querySelectorAll('label'));
                                            setLuminance(cp2.querySelectorAll('label'));
                                            setLuminance(cp3.querySelectorAll('label'));
                                        }
                                    </script>

                                    <input type="button" style="display: none; float: right" id="edit_btn"
                                        onclick="Edit_shift()" class="btn btn-primary" value="EDIT">
                                    <input type="button" style="display: none; float: right" id="save_btn"
                                        onclick="Save_shift()" class="btn btn-primary" value="Save">
                                    <input type="button" style="display: none; float: left" id="delete_btn"
                                        onclick="Delete_shift()" class="btn btn-danger" value="DELETE">
                                    <br>
                                    <br>
                                    <br id="hbr1s" style="display:none">
                                    <label id="label1s"
                                        style="float:left;font-size: 18px;visibility:hidden;color:red">*Something
                                        went
                                        wrong. Check if object is selected or
                                        shift has proper name </label>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class='text-end'>
                                <span class="close">&times;</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="myModal" class="modal">

                    <!-- Modal content -->


                </div>
                <script>
                    function Open_edit() {
                        //var modal = document.getElementById("myModal");
                        //var span = document.getElementsByClassName("close")[0];
                        // modal.style.display = "block";

                    }



                    var modal = document.getElementById("myModal");

                    // Get the button that opens the modal
                    var btn = document.getElementById("myBtn");

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    // When the user clicks the button, open the modal 


                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";

                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";

                        }
                    }
                    var shi_search = new Array();
                    $('#select_obj').change(function() {
                        current_object = $(this).val();
                        shi_search = [];
                        load_existing_shifts();
                        load_existing_list_shifts();

                    });
                    load_existing_shifts();
                    load_existing_list_shifts();

                    function load_existing_shifts() {
                        $.ajax({


                            url: '{{ route('loadExistingShifts') }}',
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                object: current_object,
                                shift_list: shi_search

                            },
                            success: function(response) {
                                //alert(response)
                                $("#shift_existing").html(response);
                            },
                            error: function(response) {
                                alert("dsad");
                            }
                        });
                    }

                    function load_existing_list_shifts() {
                        $.ajax({


                            url: '{{ route('loadExistingListShift') }}',
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                object: current_object


                            },
                            success: function(response) {
                                // alert(response)
                                $("#shift_list_load").html(response);
                            },
                            error: function(response) {
                                alert("dsad");
                            }
                        });
                    }
                    $.ajax({


                        url: '{{ route('loadObjectStructure') }}',
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            object: current_object,
                            sub_object: current_sub_object


                        },
                        success: function(response) {
                            //alert(response)
                            $("#object_model").html(response);
                        },
                        error: function(response) {
                            alert("dsad");
                        }
                    });

                    function shift_search(clicked_val) {
                        if (shi_search.includes(clicked_val) == true) {
                            for (let i = 0; i < shi_search.length; i++) {
                                if (shi_search[i] === clicked_val) {
                                    shi_search.splice(i, 1);
                                }
                            }
                        } else {
                            shi_search.push(clicked_val);
                        }
                        load_existing_shifts();
                        //alert(shi_search);
                    }

                    function select_dropdown(response, response2) {
                        current_object = response.substring(4);

                        sub_object = "";
                        $.ajax({
                            url: '{{ route('loadObjectStructure') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                object: current_object,
                                sub_object: response2,
                            },

                            success: function(response) {
                                $("#object_model").html(response);
                                /*$('#structure').html(response);
                                document.getElementById("h_controler").innerHTML = "Control panel : ";
                                sub_object = "";*/

                            },
                            error: function(response) {
                                alert("dsad");
                            }
                        });

                    }

                    function radiocheck(browser) {
                        //alert(browser);
                        sub_object = browser;

                        //document.getElementById("h_controler").value;
                        /*$.ajax({
                            url: '{{ route('parametrsGet') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                search: browser
                            },
                            success: function(response) {
                                document.getElementById("h_controler").innerHTML = "Control panel : " + response;
                                sub_object = browser;

                            },
                            error: function(response) {
                                alert("dsad");
                            }
                        });*/
                    }

                    function create_shift_load() {
                        document.getElementById("save_btn").style.display = "block";
                        /*var mf = document.getElementById('sfrommonday').value;
                        document.getElementById('stomonday').value = "";
                        document.getElementById('sfromtuesday').value = "";
                        document.getElementById('stotuesday').value = "";
                        document.getElementById('sfromwednesday').value = "";
                        document.getElementById('stowednesday').value = "";
                        document.getElementById('sfromthursday').value = "";
                        document.getElementById('stothursday').value = "";
                        document.getElementById('sfromfriday').value = "";
                        document.getElementById('stofriday').value = "";
                        document.getElementById('sfromsaturday').value = "";
                        document.getElementById('stosaturday').value = "";
                        document.getElementById('sfromsunday').value = "";
                        document.getElementById('stosunday').value = "";

                        document.getElementById('sfield').value = "";
                        var start = currentDate;

                        var mo_d = document.getElementById("smonday");
                        var tu_d = document.getElementById("stuesday");
                        var we_d = document.getElementById("swednesday");
                        var th_d = document.getElementById("sthursday");
                        var fr_d = document.getElementById("sfriday");
                        var sa_d = document.getElementById("ssaturday");
                        var su_d = document.getElementById("ssunday");*/
                        clear_data();
                    }




                    function Save_shift() {


                        let q = document.getElementById("sfield").value;

                        if (q != "") {

                            var cq = 0;


                            var mf = document.getElementById('sfrommonday').value;
                            var mt = document.getElementById('stomonday').value;
                            var tuf = document.getElementById('sfromtuesday').value;
                            var tut = document.getElementById('stotuesday').value;
                            var wf = document.getElementById('sfromwednesday').value;
                            var wt = document.getElementById('stowednesday').value;
                            var thf = document.getElementById('sfromthursday').value;
                            var tht = document.getElementById('stothursday').value;
                            var ff = document.getElementById('sfromfriday').value;
                            var ft = document.getElementById('stofriday').value;
                            var saf = document.getElementById('sfromsaturday').value;
                            var sat = document.getElementById('stosaturday').value;
                            var suf = document.getElementById('sfromsunday').value;
                            var sut = document.getElementById('stosunday').value;

                            var name = document.getElementById('sfield').value;
                            //var start = currentDate;

                            var mo_d = document.getElementById("smonday");
                            var tu_d = document.getElementById("stuesday");
                            var we_d = document.getElementById("swednesday");
                            var th_d = document.getElementById("sthursday");
                            var fr_d = document.getElementById("sfriday");
                            var sa_d = document.getElementById("ssaturday");
                            var su_d = document.getElementById("ssunday");
                            if (sub_object != "") {


                                /*var bb = "box" + previous;
                                var hh = "hid" + previous;
                                var pj = document.getElementById(bb).value;
                                var jj = document.getElementById(hh).value;*/
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
                                alert("--------asd-------");

                                /* var monf = JSON.stringify(mf);
                                                                  var mont = JSON.stringify(mt);
                                                                  var tuef = JSON.stringify(tuf);
                                                                  var tuet = JSON.stringify(tut);
                                                                  var wedf = JSON.stringify(wf);
                                                                  var wedt = JSON.stringify(wt);
                                                                  var thuf = JSON.stringify(thf);
                                                                  var thut = JSON.stringify(tht);
                                                                  var frif = JSON.stringify(ff);
                                                                  var frit = JSON.stringify(ft);
                                                                  var satf = JSON.stringify(saf);
                                                                  var satt = JSON.stringify(sat);
                                                                  var sunf = JSON.stringify(suf);
                                                                  var sunt = JSON.stringify(sut);

                                                                  var jobname = JSON.stringify(name);
                                */
                                var mond = JSON.parse(mon_day);
                                var tued = JSON.parse(tue_day);
                                var wedd = JSON.parse(wed_day);
                                var thud = JSON.parse(thu_day);
                                var frid = JSON.parse(fri_day);
                                var satd = JSON.parse(sat_day);
                                var sund = JSON.parse(sun_day);

                                $.ajax({


                                    url: '{{ route('shiftSave') }}',
                                    method: "POST",
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        mond: mond,
                                        mf: mf,
                                        mt: mt,
                                        tued: tued,
                                        tuf: tuf,
                                        tut: tut,
                                        wedd: wedd,
                                        wf: wf,
                                        wt: wt,
                                        thud: thud,
                                        thf: thf,
                                        tht: tht,
                                        frid: frid,
                                        ff: ff,
                                        ft: ft,
                                        satd: satd,
                                        saf: saf,
                                        sat: sat,
                                        sund: sund,
                                        suf: suf,
                                        sut: sut,
                                        jobname: q,
                                        color: shex,
                                        object: sub_object,
                                        update: update

                                    },
                                    success: function(data) {
                                        //success_alert("Shift saved succesfully");
                                        alert(data);
                                        clear_data();
                                    },
                                    error: function(data) {
                                        alert("dsad");
                                    }

                                });
                                /*$.ajax({


                                  url: "../shifts/load_existing_shift.php",
                                  method: "POST",
                                  data: { input: inp0, type: typ_btn, obj: obj_search, shi: shi_search, id: usid },
                                  success: function (data) {
                                    $("#shift_ex_load").html(data);
                                  }
                                });
                                var popup = document.getElementById("label2");
                                popup.style.visibility = "hidden";
                                popup.innerText = "";
                                var po = document.getElementById("hbr");
                                po.style.display = "none";

                                var popu = document.getElementById("label1");
                                popu.style.visibility = "hidden";
                                var pop = document.getElementById("hbr1");
                                pop.style.display = "none";

                                var popups = document.getElementById("label3");
                                popups.style.visibility = "hidden";
                                var p = document.getElementById("hbr3");
                                p.style.display = "none";*/
                            } else {
                                // alert("adssda");
                                var popup = document.getElementById("label3s");
                                popup.style.visibility = "visible";
                                var po = document.getElementById("hbr3s");
                                po.style.display = "";

                                /*         var popu = document.getElementById("label1s");
                                         popu.style.visibility = "visible";
                                         var pop = document.getElementById("hbr1s");
                                         pop.style.display = "";*/


                            }
                        } else {
                            var popup = document.getElementById("label2s");
                            popup.style.visibility = "visible";
                            popup.innerText = "Needs to be filled*";
                            //  var po = document.getElementById("hbrs");
                            //po.style.display = "";

                            /*var popu = document.getElementById("slabel1");
                            popu.style.visibility = "visible";
                            var pop = document.getElementById("shbr1");
                            pop.style.display = "";*/


                        }
                    }

                    function clear_data() {
                        document.getElementById("sfield").value = "";
                        document.getElementById("smonday").checked = false;
                        document.getElementById("stuesday").checked = false;
                        document.getElementById("swednesday").checked = false;
                        document.getElementById("sthursday").checked = false;
                        document.getElementById("sfriday").checked = false;
                        document.getElementById("ssaturday").checked = false;
                        document.getElementById("ssunday").checked = false;
                        document.getElementById("sfrommonday").value = "";
                        document.getElementById("stomonday").value = "";
                        document.getElementById("sfromtuesday").value = "";
                        document.getElementById("stotuesday").value = "";
                        document.getElementById("sfromwednesday").value = "";
                        document.getElementById("stowednesday").value = "";
                        document.getElementById("sfromthursday").value = "";
                        document.getElementById("stothursday").value = "";
                        document.getElementById("sfromfriday").value = "";
                        document.getElementById("stofriday").value = "";
                        document.getElementById("sfromsaturday").value = "";
                        document.getElementById("stosaturday").value = "";
                        document.getElementById("sfromsunday").value = "";
                        document.getElementById("stosunday").value = "";
                        document.getElementById("everyday").checked = false;
                        document.getElementById("weekend").checked = false;
                        document.getElementById("everyworkday").checked = false;
                        $('input[name=accept-offers]').prop('checked', false);
                        /*let sclicked_color = document.getElementById(spreviouscolor);
                            sclicked_color.style.border = "solid black";
                            shex = "#124072";*/
                    }


                    document.getElementById('everyday').onclick = function() {
                        var mo = document.getElementById('smonday');
                        var tu = document.getElementById('stuesday');
                        var we = document.getElementById('swednesday');
                        var th = document.getElementById('sthursday');
                        var fr = document.getElementById('sfriday');
                        var sa = document.getElementById('ssaturday');
                        var su = document.getElementById('ssunday');
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

                        var mo = document.getElementById('smonday');
                        var tu = document.getElementById('stuesday');
                        var we = document.getElementById('swednesday');
                        var th = document.getElementById('sthursday');
                        var fr = document.getElementById('sfriday');
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


                        var sa = document.getElementById('ssaturday');
                        var su = document.getElementById('ssunday');

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

                    function pasteFunction() { // source: www.java2s.com
                        if (document.getElementById("smonday").checked) {
                            document.getElementById("sfrommonday").value = document.getElementById("from").value;
                            document.getElementById("stomonday").value = document.getElementById("to").value;
                        }
                        if (document.getElementById("stuesday").checked) {
                            document.getElementById("sfromtuesday").value = document.getElementById("from").value;
                            document.getElementById("stotuesday").value = document.getElementById("to").value;
                        }
                        if (document.getElementById("swednesday").checked) {
                            document.getElementById("sfromwednesday").value = document.getElementById("from").value;
                            document.getElementById("stowednesday").value = document.getElementById("to").value;
                        }
                        if (document.getElementById("sthursday").checked) {
                            document.getElementById("sfromthursday").value = document.getElementById("from").value;
                            document.getElementById("stothursday").value = document.getElementById("to").value;
                        }
                        if (document.getElementById("sfriday").checked) {
                            document.getElementById("sfromfriday").value = document.getElementById("from").value;
                            document.getElementById("stofriday").value = document.getElementById("to").value;
                        }
                        if (document.getElementById("ssaturday").checked) {
                            document.getElementById("sfromsaturday").value = document.getElementById("from").value;
                            document.getElementById("stosaturday").value = document.getElementById("to").value;
                        }
                        if (document.getElementById("ssunday").checked) {
                            document.getElementById("sfromsunday").value = document.getElementById("from").value;
                            document.getElementById("stosunday").value = document.getElementById("to").value;
                        }
                    }


                    function sColor(clicked) {
                        let sclicked_color = document.getElementById(clicked);
                        sclicked_color.style.border = "solid black";
                        scodecolor = sclicked_color.style.backgroundColor;
                        /**hex source : http://www.java2s.com/example/nodejs/css/get-background-color-in-hex.html */
                        var srgb = scodecolor.match(/\d+/g);
                        shex = '#' + ('0' + parseInt(srgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(srgb[1], 10).toString(16))
                            .slice(-2) + ('0' + parseInt(srgb[2], 10).toString(16)).slice(-2);
                        let sclicked_color_prev = document.getElementById(spreviouscolor);
                        if (clicked != spreviouscolor) {
                            sclicked_color_prev.style.border = "";
                            spreviouscolor = clicked;
                        }


                    }

                    function load_existing_data(get_id) {
                        //alert("dsjak");
                        var cut_id = get_id.substring(5);
                        //alert(cut_id);
                        $.ajax({
                            url: '{{ route('loadExistingShiftParametrs') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: cut_id
                                //search: browser
                            },
                            success: function(response) {
                                //alert(response);
                                let data1 = response.data1;
                                let data2 = response.data2;

                                clear_data();
                                if (response.monday == 1) {
                                    document.getElementById("smonday").checked = true;

                                    document.getElementById("sfrommonday").value = response.mon_from;

                                    document.getElementById("stomonday").value = response.mon_to;
                                }
                                if (response.tuesday == 1) {
                                    document.getElementById("stuesday").checked = true;

                                    document.getElementById("sfromtuesday").value = response.tue_from;

                                    document.getElementById("stotuesday").value = response.tue_to;
                                }
                                if (response.wednesday == 1) {
                                    document.getElementById("swednesday").checked = true;

                                    document.getElementById("sfromwednesday").value = response.wed_from;

                                    document.getElementById("stowednesday").value = response.wed_to;
                                }
                                if (response.thursday == 1) {
                                    document.getElementById("sthursday").checked = true;

                                    document.getElementById("sfromthursday").value = response.thu_from;

                                    document.getElementById("stothursday").value = response.thu_to;
                                }
                                if (response.friday == 1) {
                                    document.getElementById("sfriday").checked = true;

                                    document.getElementById("sfromfriday").value = response.fri_from;

                                    document.getElementById("stofriday").value = response.fri_to;
                                }
                                if (response.saturday == 1) {
                                    document.getElementById("ssaturday").checked = true;

                                    document.getElementById("sfromsaturday").value = response.sat_from;

                                    document.getElementById("stosaturday").value = response.sat_to;
                                }
                                if (response.sunday == 1) {
                                    document.getElementById("ssunday").checked = true;

                                    document.getElementById("sfromsunday").value = response.sun_from;

                                    document.getElementById("stosunday").value = response.sun_to;
                                }

                                document.getElementById("sfield").value = response.shift_name;
                                sColor(map1.get(response.color));
                                edit_shift_id = get_id;
                                //alert(response.main_object);
                                let extra = "drop" + response.main_object;
                                let sub_check = response.sub_object;
                                //alert(response.sub_object);
                                select_dropdown(extra, sub_check);
                                sub_object = response.sub_object;
                                document.getElementById("edit_btn").style.display = "block";
                                document.getElementById("delete_btn").style.display = "block";
                                shift_id = response.shift_id;

                            },
                            error: function(response) {
                                alert("dsad");
                            }
                        });
                    }

                    function hide_btn() {
                        document.getElementById("save_btn").style.display = "none";
                        document.getElementById("edit_btn").style.display = "none";
                        document.getElementById("delete_btn").style.display = "none";
                        shift_id = "";
                    }

                    function load_editing_object(object_id) {

                    }

                    function Edit_shift() {
                        let q = document.getElementById("sfield").value;

                        if (q != "") {

                            var cq = 0;


                            var mf = document.getElementById('sfrommonday').value;
                            var mt = document.getElementById('stomonday').value;
                            var tuf = document.getElementById('sfromtuesday').value;
                            var tut = document.getElementById('stotuesday').value;
                            var wf = document.getElementById('sfromwednesday').value;
                            var wt = document.getElementById('stowednesday').value;
                            var thf = document.getElementById('sfromthursday').value;
                            var tht = document.getElementById('stothursday').value;
                            var ff = document.getElementById('sfromfriday').value;
                            var ft = document.getElementById('stofriday').value;
                            var saf = document.getElementById('sfromsaturday').value;
                            var sat = document.getElementById('stosaturday').value;
                            var suf = document.getElementById('sfromsunday').value;
                            var sut = document.getElementById('stosunday').value;

                            var name = document.getElementById('sfield').value;


                            var mo_d = document.getElementById("smonday");
                            var tu_d = document.getElementById("stuesday");
                            var we_d = document.getElementById("swednesday");
                            var th_d = document.getElementById("sthursday");
                            var fr_d = document.getElementById("sfriday");
                            var sa_d = document.getElementById("ssaturday");
                            var su_d = document.getElementById("ssunday");
                            if (sub_object != "") {


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
                                alert("--------asd-------");


                                var mond = JSON.parse(mon_day);
                                var tued = JSON.parse(tue_day);
                                var wedd = JSON.parse(wed_day);
                                var thud = JSON.parse(thu_day);
                                var frid = JSON.parse(fri_day);
                                var satd = JSON.parse(sat_day);
                                var sund = JSON.parse(sun_day);

                                $.ajax({


                                    url: '{{ route('editShift') }}',
                                    method: "POST",
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        mond: mond,
                                        mf: mf,
                                        mt: mt,
                                        tued: tued,
                                        tuf: tuf,
                                        tut: tut,
                                        wedd: wedd,
                                        wf: wf,
                                        wt: wt,
                                        thud: thud,
                                        thf: thf,
                                        tht: tht,
                                        frid: frid,
                                        ff: ff,
                                        ft: ft,
                                        satd: satd,
                                        saf: saf,
                                        sat: sat,
                                        sund: sund,
                                        suf: suf,
                                        sut: sut,
                                        jobname: q,
                                        color: shex,
                                        object: sub_object,
                                        update: update,
                                        shift_id: shift_id

                                    },
                                    success: function(data) {
                                        alert(data);
                                        //clear_data();
                                    },
                                    error: function(data) {
                                        alert("dsad");
                                    }

                                });

                            } else {

                                var popup = document.getElementById("label3s");
                                popup.style.visibility = "visible";
                                var po = document.getElementById("hbr3s");
                                po.style.display = "";




                            }
                        } else {
                            var popup = document.getElementById("label2s");
                            popup.style.visibility = "visible";
                            popup.innerText = "Needs to be filled*";



                        }
                    }
                </script>

            </div>
        </div>
    </div>
    </div>
</body>

</html>
