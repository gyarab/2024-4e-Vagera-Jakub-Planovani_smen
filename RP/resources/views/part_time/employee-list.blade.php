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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Employee list</title>
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">
</head>

<body id="body-pd">


    @include('vendor.Chatify.pages.header-parttime')
    @include('vendor.Chatify.pages.sidebar-parttime')
    @include('admin.scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="border-start wh-100 bg-light" style="height: 100%">
        <div class="container-fluid">

            <div class="col py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="row align-items-end mb-2">
                            <div class="col-12 col-md-4">

                                <input type="text" class="form-control" id="live_search" style="display:inline;"
                                    autocomplete="off" placeholder="Search...">
                            </div>

                   
                            <div class="col-12 col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="admin_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckboxAdmin" value="admin">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox1">Adminstators</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="manager_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckboxManager" value="manager">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox2">Managers</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="full_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckboxFull" value="fulltime_employee">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox3">Full-time
                                        employee</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="part_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckboxPart" value="parttime_employee">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox4">Part-time
                                        employee</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                           
                            </div>
                            <script>
                                var checkAdmin = 0;
                                var checkManager = 0;
                                var checkFull = 0;
                                var checkPart = 0;
                                function admin_click(){
                                    if (document.getElementById('inlineCheckboxAdmin').checked) {
                                        checkAdmin = 1;
                                    }else{
                                        checkAdmin = 0;
                                    }
                                    loadEmployeeTable();

                                }
                                function manager_click(){
                                    if (document.getElementById('inlineCheckboxManager').checked) {
                                        checkManager = 1;
                                    }else{
                                        checkManager = 0;
                                    }
                                    loadEmployeeTable();
                                }
                                function full_click(){
                                    if (document.getElementById('inlineCheckboxFull').checked) {
                                        checkFull = 1;
                                    }else{
                                        checkFull = 0;
                                    }
                                    loadEmployeeTable();
                                }
                                function part_click(){
                                    if (document.getElementById('inlineCheckboxPart').checked) {
                                        checkPart = 1;
                                    }else{
                                        checkPart = 0;
                                    }
                                    loadEmployeeTable();
                                }
                            </script>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <script>
                                var input = "";
                            </script>
                            <h5 class="card-title mx-1">In organization <span id="all_counter"
                                    class="text-muted fw-normal ms-2"></span>
                                <script>
                                    $.ajax({
                                        url: '{{ route('LoadNumberAll') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                        },
                                        success: function(response) {
                                            document.getElementById("all_counter").textContent = "(" + response + ")";

                                        },
                                        error: function(response) {
                                            error_alert("Connection error");
                                        }
                                    });
                                </script>
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                        </div>
                    </div>
                <div class="bg-white" id="employee_list">

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="table-responsive">
                                <table
                                    class="table project-list-table table-nowrap align-middle table-borderless overflow-none">
                                    <div class="row">



                                    </div>
                               


                                    <script>
                                        loadEmployeeTable();
                              
                                        $("#live_search").keyup(function() {

                                            input = $(this).val();
                                            loadEmployeeTable();
                        
                                        });

                                        function loadEmployeeTable(){
                                            $.ajax({
                                            url: '{{ route('loadEmployee') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                input: input,
                                                admin: checkAdmin,
                                                manager: checkManager,
                                                full: checkFull,
                                                part: checkPart,

                                            },
                                            success: function(response) {
                                                document.getElementById("employee_list").innerHTML = response;

                                            },
                                            error: function(response) {
                                                error_alert("Connection error");
                                            }
                                        });   
                                        }
                                    </script>
                                 

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
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
</body>

</html>
