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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="body-pd">
    @include('vendor.Chatify.pages.header')
    @include('vendor.Chatify.pages.sidebar')
    @include('admin.scripts')
    <div class="height-100 bg-light">
        <script>
            var icon_value = "btnMobile";
        </script>
        <div class="container">
            <div class="row">
            
                <div class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Device </h5>
                            <hr>
                            <center>
                            <button id="btnMobile" class="btn btn-outline-primary rounded active" onclick="btnChanger(this.id)" ><i class="bi bi-phone"></i></button>
                            <button id="btnLaptop" class="btn btn-outline-primary rounded" onclick="btnChanger(this.id)" ><i class="bi bi-laptop"></i></button>
                            <button id="btnComputer" class="btn btn-outline-primary rounded" onclick="btnChanger(this.id)" ><i class="bi bi-pc-display"></i></button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
              
                    <div class="card">
                        <div class="card-body">
                          
                            <div class="row">

                                <div class="col-12 col-md-12">
                                    <h5>Description </h5>
                                    <hr>
                                    <div class="row">
        
                                        <div class="col-6 col-md-12">
                                            <input id="desc" class="form-control" style="display: inline" type="text" placeholder="Add description...">

                                        </div>
                        
                                    </div>
                            
                                    <!--<div class="p-2 mb-3" style="background: #4CAF50;color:#ffffff; font-size: 20px;">
                                Description
                            </div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- source: https://www.geeksforgeeks.org/how-to-specify-minimum-maximum-number-of-characters-allowed-in-an-input-field-in-html/ -->
                    <!-- <input type="hidden" id="hip">
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <div class="p-2 mb-2" style="background: #4CAF50;color:#ffffff; font-size: 20px;">Enter IP
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <input id="ip1" class="form-control" maxlength="3" type="text"
                                style="width: 58px;display: inline" onkeyup="checkIP1(this.value)">
                            <p style="font-size:30px; display: inline;height:38px">.</p>
                            <input id="ip2" class="form-control" maxlength="3" type="text"
                                style="width: 58px;display: inline" onkeyup="checkIP2(this.value)">
                            <p style="font-size:30px; display: inline;height:38px">.</p>
                            <input id="ip3" class="form-control" maxlength="3" type="text"
                                style="width: 58px;display: inline" onkeyup="checkIP3(this.value)">
                            <p style="font-size:30px; display: inline;height:38px">.</p>
                            <input id="ip4" class="form-control" maxlength="3" type="text"
                                style="width: 58px;display: inline">

                            <button type="button" class="btn btn-primary mt-2" onclick="add_ip()"
                                style="float:right">ADD
                                IP</button>
                            <button type="button" class="btn btn-warning mt-2" onclick="get_my_ip()"
                                style="float:right;margin-right:10px ">GET DEVICE IP</button>
                        </div>
                    </div>-->

                </div>
                <!--<div class="col-12 col-md-6">
                    <br>
                    <div class="row">
                        <div class="col-12">

                            <div class="p-2 mb-3" style="background: #4CAF50;color:#ffffff; font-size: 20px;">
                                Description
                            </div>
                        </div>
                    </div>

                    <input id="mytext" class="form-control" style="display: inline" type="text">

                </div>-->
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Current device</h5>
                            <hr>
                            <i class="bi bi-patch-check-fill text-primary fs-3"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Controllers</h5>
                            <hr>
                            <button class="btn btn-primary" onclick="add_cookie()" style="float:right">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
         
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Devices in network</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-2" style='display: flex; justify-content: center; align-items: center;'>
                                    <h6>Type</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>Description</h6>

                                </div>
                                <div class="col-md-4">
                                    <h6>Status</h6>

                                </div>
                            </div>
                            <hr>

                            <div id="allDevices">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <input id="mycookie" class="form-control" style="display: inline" type="text">
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row">
                        <div class="col-12">

                            <input type="button" class="btn btn-warning mb-2 mb-md-0 " onclick="get_my_cookie()"
                                value="GET DEVICE COOKIE IDENTIFIER">

                            <input type="button" class="btn btn-primary mb-2 mb-md-0" style="float:right"
                                onclick="" value="ADD COOKIE">
                        </div>
                    </div>
                </div>
                <script>
                    function add_cookie() {
                        alert("123456");
                        let description = document.getElementById("desc").value;
                        $.ajax({
                            url: '{{ route('registerDevice') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                icon: icon_value,
                                description: description,
                            },
                            success: function(response) {

                                alert(response.device_token);
                            },
                            error: function(xhr, status, error) {
                                alert('Error fetching image:', error);
                            }
                        });
                    }
                    $.ajax({
                            url: '{{ route('validateSecureCookie') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {

                                alert(response.status);
                                //document.getElementById("currentDevice").innerHTML = ; 

                            },
                            error: function(xhr, status, error) {
                                alert('Error fetching image:', error);
                            }
                        });

                        $.ajax({
                            url: '{{ route('loadDevices') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {

                                //alert(response);
                                document.getElementById("allDevices").innerHTML = response; 

                            },
                            error: function(xhr, status, error) {
                                alert('Error fetching image:', error);
                            }
                        });
                        function changeDeviceStatusActive(value){
                        $.ajax({
                            url: '{{ route('changeDeviceStatusActive') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id_device: value,
                            },
                            success: function(response) {

                                alert("------------");
                                //document.getElementById("allDevices").innerHTML = response; 

                            },
                            error: function(xhr, status, error) {
                                alert('Error fetching image:', error);
                            }
                        });
                    }
                    function changeDeviceStatusSuspend(value){
                        $.ajax({
                            url: '{{ route('changeDeviceStatusSuspend') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id_device: value,
                            },
                            success: function(response) {

                                alert("------------");
                                //document.getElementById("allDevices").innerHTML = response; 

                            },
                            error: function(xhr, status, error) {
                                alert('Error fetching image:', error);
                            }
                        });

                    }
                        //changeDeviceStatus
                   function btnChanger(vall){
            icon_value = vall;

                    //alert("123");
                    //document.getElementById("btnComputer").class = "btn btn-outline-primary rounded active";
                    document.getElementById("btnMobile").classList.remove("active"); 
                    document.getElementById("btnLaptop").classList.remove("active"); 
                    document.getElementById("btnComputer").classList.remove("active"); 
                    const element = document.getElementById(vall);  // Get the DIV element
                    element.classList.add("active"); 
                    }
                </script>
            </div>
            <br>
            <br>
        </div>
    </div>
</body>

</html>
