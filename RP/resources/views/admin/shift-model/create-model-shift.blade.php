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

        /*source: https://www.bootdey.com/snippets/view/profile-with-team-section*/
        .avatar-group .avatar-group-item {
            margin-left: -14px;
            border: 2px solid #fff;
            border-radius: 50%;
            -webkit-transition: all .2s;
            transition: all .2s;
        }

        .avatar-sm {
            height: 50px;
            width: 50px;
        }

        .avatar-group {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 12px;
        }
    </style>

</head>

<body id="body-pd">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <div class="border-start wh-100 bg-light">
        <div class="container-fluid">
            <script>
                var sub_object = "";
                var current_object = 0;
                var current_sub_object = 0;
                var edit_shift_id = "";
                var shift_id = "";
                var search_text = "";

                function success_alert(message) {
                    Swal.fire({
                        title: message,
                        text: "",
                        icon: "success"
                    });

                }

                function error_alert(message) {
                    Swal.fire({
                        title: "Connection Error",
                        text: "",
                        icon: "error"
                    });

                }

                function sure_delete() {
                    Swal.fire({
                        icon: "warning",
                        title: "Do you want to delete this shift?",
                        text: "Such action is irreversible",
                        showCancelButton: true,
                        confirmButtonText: "Delete object",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            alert(shift_id);
                            $.ajax({
                                url: '{{ route('deleteShift') }}',
                                type: "POST",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    shift_id: shift_id,
                                },
                                success: function(response) {
                                    $('#myModals').modal('hide');
                                    success_alert("Shift successfully deleted from system");
                                },
                                error: function(response) {
                                    error_alert("Error");
                                }
                            });
                        }
                    });
                }
            </script>


            <div class="col py-3">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form">
                            <i class="fa fa-search"></i>
                            <input id="search_shift" type="text" class="form-control form-input"
                                onkeyup="searchKeyup(this.value)" placeholder="Search anything...">
                            <script>
                                function searchKeyup(input_value) {
                                    search_text = input_value;
                                    load_existing_shifts();
                                }
                            </script>

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
                                    $("#select_obj").html(response);
                                },
                                error: function(response) {
                                    error_alert("Error");
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


                <div class="row">

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


                </div>


                <!-- Modal -->
                <div class="modal fade w-100" id="myModals" role="dialog" data-bs-backdrop="false">
                    <div class="modal-dialog w-100 modal-fullscreen">

                        <!-- Modal content-->
                        <div class="modal-content modal-fullscreen d-flex justify-content-center w-100">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Create panel</b></h5>
                                <button type="button" class="close btn" style="float: right" data-bs-dismiss="modal"
                                    aria-label="Close" onclick="hide_btn()">
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
                                                    <p style='margin-right: 10px;display: inline'>Repeatable</p>


                                                    <label class='switch '>

                                                        <input id="repeatable" type='checkbox' onclick="repeatable()"
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

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">From</span>
                                                    </div>
                                                    <input type="time" class="form-control" id="from"
                                                        name="from" style="display:inline" />
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-4'>
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



                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group mb-1">
                                                    <span class="input-group-text">Description</span>
                                                    <textarea id="description" class="form-control" aria-label="With textarea"></textarea>
                                                </div>
                                                <hr>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-12 col-md-6">
                                                <div class="card ">
                                                    <div class="card-body">
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
                                                                    style="background-color:  #a53d1a;"
                                                                    value="">
                                                                <input id="scolor-10" type="button" class="in"
                                                                    onclick="sColor(this.id)"
                                                                    style="background-color:  #880002;"
                                                                    value="">
                                                                <input id="scolor-11" type="button" class="in"
                                                                    onclick="sColor(this.id)"
                                                                    style="background-color:  #6a1161;"
                                                                    value="">
                                                                <input id="scolor-12" type="button" class="in"
                                                                    onclick="sColor(this.id)"
                                                                    style="background-color:  #4c1862 ;"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <input id="scolor-13" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #1965b9;" value="">
                                                        <input id="scolor-14" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color:  #039ce0;" value="">
                                                        <input id="scolor-15" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #01969c;" value="">
                                                        <input id="scolor-16" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #009242;" value="">
                                                        <input id="scolor-17" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color:  #67ad31 ;" value="">
                                                        <input id="scolor-18" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #bcd637;" value="">
                                                        <br>
                                                        <input id="scolor-19" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #fff002;" value="">
                                                        <input id="scolor-20" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #fdaf43;" value="">
                                                        <input id="scolor-21" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #e87034;" value="">
                                                        <input id="scolor-22" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #eb1c26;" value="">
                                                        <input id="scolor-23" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #a2288d;" value="">
                                                        <input id="scolor-24" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #652d90;" value="">
                                                        <br>
                                                        <input id="scolor-25" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #81c1e7;" value="">
                                                        <input id="scolor-26" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #50ddd5;" value="">
                                                        <input id="scolor-27" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #addc81;" value="">
                                                        <input id="scolor-28" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #ffffba;" value="">
                                                        <input id="scolor-29" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #fea698;" value="">
                                                        <input id="scolor-30" type="button" class="in"
                                                            onclick="sColor(this.id)"
                                                            style="background-color: #b697dd;" value="">
                                                    </div>
                                                </div>
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
                                            <div class="col-12 col-md-6">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="mb-1">
                                                            <h5>Controllers: </h5>
                                                            <input type="button" style="display: none; float: right"
                                                                id="edit_btn" onclick="Edit_shift()"
                                                                class="btn btn-primary" value="EDIT">
                                                            <input type="button" style="display: none; float: right"
                                                                id="save_btn" onclick="Save_shift()"
                                                                class="btn btn-primary" value="Save">
                                                            <input type="button" style="display: none; float: left"
                                                                id="delete_btn" onclick="sure_delete()"
                                                                class="btn btn-danger" value="DELETE">
                                                        </div>
                                                    </div>
                                                </div>
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
                                <div class="row">

                                    <div class="col-12 ">
                                        <div id="assignment_div">
                                            <div class="mb-1">
                                                <h5>Assigned employees </h5>
                                            </div>
                                            <div id="assignment_table">

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div>




                                    <script>
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

                <script>
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
                                shift_list: shi_search,
                                search_text: search_text,

                            },
                            success: function(response) {
                                $("#shift_existing").html(response);
                            },
                            error: function(response) {
                                error_alert("Error");
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
                                $("#shift_list_load").html(response);
                            },
                            error: function(response) {
                                error_alert("Error");
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
                            $("#object_model").html(response);
                        },
                        error: function(response) {
                            error_alert("Error");
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
                    }

                    function select_dropdown2(response) {
                        current_object = response.substring(4);

                        var select_value = document.getElementById("h" + response).value;
                        $.ajax({
                            url: '{{ route('loadObjectStructure') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                object: current_object,
                                sub_object: select_value,
                            },

                            success: function(response) {
                                $("#object_model").html(response);

                            },
                            error: function(response) {
                                error_alert("Error");
                            }
                        });


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

                            },
                            error: function(response) {
                                error_alert("Error");
                            }
                        });

                    }



                    function create_shift_load() {
                        document.getElementById("edit_btn").style.display = "none";
                        document.getElementById("delete_btn").style.display = "none";

                        document.getElementById("assignment_div").style.display = "none";
                        document.getElementById("save_btn").style.display = "block";
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
                                        clear_data();

                                        success_alert("Shift saved successfully");

                                    },
                                    error: function(data) {
                                        error_alert("Error");
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

                    function clear_data() {

                        document.getElementById("description").value = "";

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
                        document.getElementById("repeatable").checked = true;

                        $('input[name=accept-offers]').prop('checked', false);

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
                        var cut_id = get_id.substring(5);
                        $.ajax({
                            url: '{{ route('loadExistingShiftParametrs') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: cut_id
                            },
                            success: function(response) {
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
                                if (response.repeat == 1) {
                                    document.getElementById("repeatable").checked = true;
                                } else {
                                    document.getElementById("repeatable").checked = false;
                                }
                                document.getElementById("description").value = response.description;

                                document.getElementById("sfield").value = response.shift_name;
                                sColor(map1.get(response.color));
                                edit_shift_id = get_id;
                                let extra = "drop" + response.main_object;
                                let sub_check = response.sub_object;
                                select_dropdown(extra, sub_check);
                                sub_object = response.sub_object;
                                document.getElementById("edit_btn").style.display = "block";
                                document.getElementById("delete_btn").style.display = "block";
                                shift_id = response.shift_id;
                                document.getElementById("save_btn").style.display = "none";
                                load_assigned_employess(cut_id);

                            },
                            error: function(response) {
                                error_alert("dsad");
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
                            var description = document.getElementById('description').value;


                            var mo_d = document.getElementById("smonday");
                            var tu_d = document.getElementById("stuesday");
                            var we_d = document.getElementById("swednesday");
                            var th_d = document.getElementById("sthursday");
                            var fr_d = document.getElementById("sfriday");
                            var sa_d = document.getElementById("ssaturday");
                            var su_d = document.getElementById("ssunday");
                            var repeatable = document.getElementById("repeatable");
                            var r_non = 0;
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
                                if (repeatable.checked == true) {
                                    r_non = 1;
                                } else {
                                    r_non = 0;
                                }


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
                                        shift_id: shift_id,
                                        repeat: r_non,
                                        description: description,

                                    },
                                    success: function(data) {
                                        success_alert("Edited successfully");
                                    },
                                    error: function(data) {
                                        error_alert("error");
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

                    function enableShift(response) {
                        var eanableID = response.substring(7);
                        var elementEnable = document.getElementById(response);
                        if (elementEnable.checked == true) {
                            questionEnable("Do you want to do this ?", eanableID, 1);

                        } else {
                            questionEnable("Do you want to do this ?", eanableID, 0);
                        }
                    }

                    function questionEnable(message, eanableID, status) {
                        Swal.fire({
                            icon: "warning",
                            title: message,
                            text: "Such action will effect access to shift",
                            showCancelButton: true,
                            confirmButtonText: "Enable",
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ route('enableShift') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        shift_id: eanableID,
                                        status: status


                                    },
                                    success: function(response) {

                                    },
                                    error: function(response) {
                                        error_alert("Error");
                                    }
                                });
                            } else {
                                if (status == 1) {
                                    document.getElementById("enable_" + eanableID).checked = false;
                                } else {
                                    document.getElementById("enable_" + eanableID).checked = true;

                                }
                            }
                        });

                    }
                </script>
                <script>
                    function load_assigned_employess(send_id) {
                        document.getElementById("assignment_div").style.display = "block";

                        $.ajax({


                            url: '{{ route('loadShiftAssignmentStructure') }}',
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id_shift: send_id,

                            },
                            success: function(response) {
                                $("#assignment_table").html(response);
                            },
                            error: function(response) {
                                error_alert("ERROR");
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
