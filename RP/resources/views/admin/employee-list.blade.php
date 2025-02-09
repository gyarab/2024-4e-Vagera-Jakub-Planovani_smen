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
    <title>Document</title>
</head>

<body id="body-pd">


    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="height-100 bg-light">
        <div class="container-fluid">

            <div class="col py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="row align-items-end mb-2">
                            <div class="col-12 col-md-4">

                                <input type="text" class="form-control" id="live_search" style="display:inline;"
                                    autocomplete="off" placeholder="Search...">
                            </div>

                            <!--<div class="col-12 col-md-1">-->

                            <!--<div class="p-2 mt-2 mt-md-0"
                                    style="height: 38px;background: #4CAF50;color:#ffffff; font-size: 15px;">Status:
                                </div>-->

                            <!--<h5 style="display:inline;"> &nbsp;&nbsp;Status : &nbsp;&nbsp;</h5>-->

                            <!--</div>-->
                            <div class="col-12 col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="pos_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckbox1" value="admin">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox1">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="pos_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckbox2" value="manager">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox2">Manager</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="pos_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckbox3" value="fulltime_employee">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox3">Full-time
                                        employee</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;"
                                        onclick="pos_click(this.value)" name="pos" type="checkbox"
                                        id="inlineCheckbox4" value="parttime_employee">
                                    <label class="form-check-label" style="display:inline;"
                                        for="inlineCheckbox4">Part-time
                                        employee</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <a id="create_shift" class="btn btn-outline-primary btn-rounded"
                                   href="/admin/create-user" style="float:right" ><i
                                        class="bi bi-patch-plus "></i>&nbsp&nbsp Add account</a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <script>
                                var input = "";
                            </script>
                            <h5 class="card-title">Contact List <span id="all_counter"
                                    class="text-muted fw-normal ms-2"></span>
                                <script>
                                    $.ajax({
                                        url: '{{ route('LoadNumberAll') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                        },
                                        success: function(response) {
                                            //alert(response);
                                            document.getElementById("all_counter").textContent = "(" + response + ")";

                                        },
                                        error: function(response) {
                                            alert("dsad");
                                        }
                                    });
                                </script>
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <!--<div>
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a aria-current="page" href="#"
                                            class="router-link-active router-link-exact-active nav-link active"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                            data-bs-original-title="List" aria-label="List">
                                            <i class="bx bx-list-ul"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="" data-bs-original-title="Grid"
                                            aria-label="Grid"><i class="bx bx-grid-alt"></i></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!--<div>
                                <a href="#" data-bs-toggle="modal" data-bs-target=".add-new"
                                    class="btn btn-primary"><i class="bx bx-plus me-1"></i> Add New</a>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="bx bx-dots-horizontal-rounded"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                </div>
                <!--<div class="row mb-1">
                    <div class="col-6 col-sm-3">
                        <h5>Name</h5>
                    </div>
                    <div class="col-0 col-sm-2 d-none d-sm-inline">
                        <h5>Position</h5>
                    </div>
                    <div class="col-0 col-sm-3 d-none d-sm-inline">
                        <h5>Email</h5>
                    </div>
                    <div class="col-0 col-sm-2 d-none d-sm-inline">
                        <h5>Status</h5>
                    </div>
                    <div class="col-6 col-sm-2">
                        <h5>Action</h5>
                    </div>
                </div>-->
                <div class="bg-white" id="employee_list">

                </div>
                <a href="{{ route('profile', ['id' => 1]) }}">View Profile</a>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="table-responsive">
                                <table
                                    class="table project-list-table table-nowrap align-middle table-borderless overflow-none">
                                    <div class="row">



                                    </div>
                                    <!--<thead class=" ">
                                        <tr>-->
                                    <!--<th scope="col-1" class="ps-4" style="width: 50px;">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck" /><label
                                                        class="form-check-label" for="contacusercheck"></label>
                                                </div>
                                            </th>-->

                                    <!--<th scope="col">Name</th>
                                            <th class="d-none d-sm-block" scope="col">Position</th>
                                            <th class="d-none d-sm-block" >Email</th>
                                            <th class="d-none d-sm-block" scope="col">Projects</th>
                                            <th scope="col" style="width: 200px;">Action</th>-->

                                    <!--<th class="col-6 col-sm-2">Name</th>
                                            <th class="col-0 col-sm-2 d-none d-sm-flex">Position</th>
                                            <th class="col-0 col-sm-3 d-none d-sm-flex">Email</th>
                                            <th class="col-0 col-sm-2 d-none d-sm-inline-block">Projects</th>
                                            <th class="col-6 col-sm-2">Action</th>-->
                                    <!--</tr>
                                    </thead>-->


                                    <script>
                                        $.ajax({
                                            url: '{{ route('loadEmployee') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                input: input,
                                            },
                                            success: function(response) {
                                                //alert(response);
                                                document.getElementById("employee_list").innerHTML = response;

                                            },
                                            error: function(response) {
                                                alert("dsad");
                                            }
                                        });
                                        $("#live_search").keyup(function() {

                                            input = $(this).val();
                                            $.ajax({
                                                url: '{{ route('loadEmployee') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    input: input,
                                                },
                                                success: function(response) {
                                                    //alert(response);
                                                    document.getElementById("employee_list").innerHTML = response;

                                                },
                                                error: function(response) {
                                                    alert("dsad");
                                                }
                                            });
                                        });
                                    </script>
                                    <!--<thead class="d-block d-sm-none">
                                        <tr>
                                            <th scope="col" class="ps-4" style="width: 50px;">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck" /><label
                                                        class="form-check-label" for="contacusercheck"></label>
                                                </div>
                                            </th>
             
                                           
                                   
                                            <th scope="col">Name</th>
                                            <th scope="col" style="width: 200px;">Action</th>
                                     
                                        </tr>
                                    </thead>-->
                                    <!--<tbody>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck1" /><label
                                                        class="form-check-label" for="contacusercheck1"></label>
                                                </div>
                                            </th>
                                            <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="" class="avatar-sm rounded-circle me-2" /><a
                                                    href="#" class="text-body">Simon Ryles</a></td>
                                            <td><span class="badge badge-soft-success mb-0">Full Stack
                                                    Developer</span></td>
                                            <td>SimonRyles@minible.com</td>
                                            <td>125</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck2" /><label
                                                        class="form-check-label" for="contacusercheck2"></label>
                                                </div>
                                            </th>
                                            <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="" class="avatar-sm rounded-circle me-2" /><a
                                                    href="#" class="text-body">Marion Walker</a></td>
                                            <td><span class="badge badge-soft-info mb-0">Frontend Developer</span>
                                            </td>
                                            <td>MarionWalker@minible.com</td>
                                            <td>132</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck3" /><label
                                                        class="form-check-label" for="contacusercheck3"></label>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="avatar-sm d-inline-block me-2">
                                                    <div
                                                        class="avatar-title bg-soft-primary rounded-circle text-primary">
                                                        <i class="mdi mdi-account-circle m-0"></i>
                                                    </div>
                                                </div>
                                                <a href="#" class="text-body">Frederick White</a>
                                            </td>
                                            <td><span class="badge badge-soft-danger mb-0">UI/UX Designer</span>
                                            </td>
                                            <td>FrederickWhite@minible.com</td>
                                            <td>112</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck4" /><label
                                                        class="form-check-label" for="contacusercheck4"></label>
                                                </div>
                                            </th>
                                            <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="" class="avatar-sm rounded-circle me-2" /><a
                                                    href="#" class="text-body">Shanon Marvin</a></td>
                                            <td><span class="badge badge-soft-primary mb-0">Backend
                                                    Developer</span></td>
                                            <td>ShanonMarvin@minible.com</td>
                                            <td>121</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck5" /><label
                                                        class="form-check-label" for="contacusercheck5"></label>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="avatar-sm d-inline-block me-2">
                                                    <div
                                                        class="avatar-title bg-soft-primary rounded-circle text-primary">
                                                        <i class="mdi mdi-account-circle m-0"></i>
                                                    </div>
                                                </div>
                                                <a href="#" class="text-body">Mark Jones</a>
                                            </td>
                                            <td><span class="badge badge-soft-info mb-0">Frontend Developer</span>
                                            </td>
                                            <td>MarkJones@minible.com</td>
                                            <td>145</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Edit</a><a
                                                                class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Remove</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck6" /><label
                                                        class="form-check-label" for="contacusercheck6"></label>
                                                </div>
                                            </th>
                                            <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="" class="avatar-sm rounded-circle me-2" /><a
                                                    href="#" class="text-body">Janice Morgan</a></td>
                                            <td><span class="badge badge-soft-primary mb-0">Backend
                                                    Developer</span></td>
                                            <td>JaniceMorgan@minible.com</td>
                                            <td>136</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck7" /><label
                                                        class="form-check-label" for="contacusercheck7"></label>
                                                </div>
                                            </th>
                                            <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="" class="avatar-sm rounded-circle me-2" /><a
                                                    href="#" class="text-body">Patrick Petty</a></td>
                                            <td><span class="badge badge-soft-danger mb-0">UI/UX Designer</span>
                                            </td>
                                            <td>PatrickPetty@minible.com</td>
                                            <td>125</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck8" /><label
                                                        class="form-check-label" for="contacusercheck8"></label>
                                                </div>
                                            </th>
                                            <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="" class="avatar-sm rounded-circle me-2" /><a
                                                    href="#" class="text-body">Marilyn Horton</a></td>
                                            <td><span class="badge badge-soft-primary mb-0">Backend
                                                    Developer</span></td>
                                            <td>MarilynHorton@minible.com</td>
                                            <td>154</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck9" /><label
                                                        class="form-check-label" for="contacusercheck9"></label>
                                                </div>
                                            </th>
                                            <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="" class="avatar-sm rounded-circle me-2" /><a
                                                    href="#" class="text-body">Neal Womack</a></td>
                                            <td><span class="badge badge-soft-success mb-0">Full Stack
                                                    Developer</span></td>
                                            <td>NealWomack@minible.com</td>
                                            <td>231</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"
                                                            class="px-2 text-primary"><i
                                                                class="bx bx-pencil font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete"
                                                            class="px-2 text-danger"><i
                                                                class="bx bx-trash-alt font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true"><i
                                                                class="bx bx-dots-vertical-rounded"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a><a
                                                                class="dropdown-item" href="#">Another
                                                                action</a><a class="dropdown-item"
                                                                href="#">Something else here</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>-->

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row g-0 align-items-center pb-4">
                    <div class="col-sm-6">
                        <div>
                            <p class="mb-sm-0">Showing 1 to 10 of 57 entries</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-end">
                            <ul class="pagination mb-sm-0">
                                <li class="page-item disabled">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                <li class="page-item">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</body>

</html>
