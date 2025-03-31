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
    @include('vendor.Chatify.pages.header-admin')
    @include('vendor.Chatify.pages.sidebar-admin')
    @include('admin.scripts')
    <div class="border-start height-100 bg-light">
        <script>
            var icon_value = "btnMobile";
            function error_sweet_alert(message) {
            Swal.fire({
                title: "Connection failed",
                text: "",
                icon: "error"
            });

        }
        function success_sweet_alert(message) {
            Swal.fire({
                title: message,
                text: "",
                icon: "success"
            });

        }
        </script>
        <div class="container">
            <div class="row ">
            
                <div class="col-12 col-md-3 mt-3">
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
                <div class="col-12 col-md-9 mt-3">
              
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
                            
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- source: https://www.geeksforgeeks.org/how-to-specify-minimum-maximum-number-of-characters-allowed-in-an-input-field-in-html/ -->
        
                </div>
       
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Current device</h5>
                            <hr >
                
                            <div class="row">
                                <div class="col-2">
                                    <i id="verify" class="bi bi-patch-check-fill text-primary fs-3" style="display: inline"></i>
                                    <i id="x-circle" class="bi bi-x-circle text-danger fs-3" style="display: inline"></i>
                                </div>
                                <div class="col-1">
                                    <i id="device_icon" class="bi fs-3" style="display: inline"></i>

                                </div>
                                <div class="col-9 mt-1">
                                    <input type="text" class="form-control" id="currentDescription" style="display: inline" disabled readonly>

                                </div>
                            </div>

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

                <script>
                     document.getElementById("desc").value = "";

                     validateSecureCookie();
                    loadDevices();
                    function add_cookie() {
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

                                validateSecureCookie();
                                loadDevices();
                                success_sweet_alert("Device registered");
                            },
                            error: function(xhr, status, error) {
                                error_sweet_alert('Error fetching image:1', error);
                            }
                        });
                    }
                    function validateSecureCookie() {
                    $.ajax({
                            url: '{{ route('validateSecureCookie') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                document.getElementById("x-circle").style.display = "none";
                                document.getElementById("verify").style.display = "block";
                                document.getElementById("currentDescription").value = response.description;
                                if(response.icon == "btnLaptop"){
                                    document.getElementById("device_icon").classList.add("bi-laptop");
                                }else if(response.icon == "btnComputer"){
                                    document.getElementById("device_icon").classList.add("bi-pc-display");
                                }else{
                                    document.getElementById("device_icon").classList.add("bi-phone");
                                }
   

                            },
                            error: function(xhr, status, error) {
                                document.getElementById("verify").style.display = "none";
                                document.getElementById("x-circle").style.display = "block";
                            }
                        });
                    }
                    function loadDevices() {
                        $.ajax({
                            url: '{{ route('loadDevices') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {

                                document.getElementById("allDevices").innerHTML = response; 

                            },
                            error: function(xhr, status, error) {
                                error_sweet_alert('Error fetching ');
                            }
                        });
                    }
                        function changeDeviceStatusActive(value){
                        $.ajax({
                            url: '{{ route('changeDeviceStatusActive') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id_device: value,
                            },
                            success: function(response) {
                                loadDevices();

                            },
                            error: function(xhr, status, error) {
                                error_sweet_alert('Error fetching');
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
                                loadDevices();


                            },
                            error: function(xhr, status, error) {
                                error_sweet_alert('Error fetching');
                            }
                        });

                    }
                   function btnChanger(vall){
            icon_value = vall;

                    document.getElementById("btnMobile").classList.remove("active"); 
                    document.getElementById("btnLaptop").classList.remove("active"); 
                    document.getElementById("btnComputer").classList.remove("active"); 
                    const element = document.getElementById(vall);  
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
