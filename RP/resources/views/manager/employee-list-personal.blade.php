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
    <title>Employess</title>
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="body-pd">
    @include('vendor.Chatify.pages.header-manager')
    @include('vendor.Chatify.pages.sidebar-manager')
    @include('admin.scripts')
    <div class="wh-100 border-start bg-light">
        <script>
            var main_obj_var = 0;
            var main_obj_var2 = 0;
        </script>
        <div class="container">
            <br>
            <div class="main-body">


                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img id="imagePersoanl" src="" alt="Admin"
                                        class="rounded-circle object-fit-cover"
                                        style="height: 150px; width: 150px;border: 2p">
                                    <script>
                                        $.ajax({
                                            url: '{{ route('showImagePersonal') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                id: {{ $user->id }},
                                            },
                                            success: function(response) {
                                                // Set the response (image data) as the source for the image element
                                                $('#imagePersoanl').attr('src', response.url);

                                            },
                                            error: function(xhr, status, error) {
                                                error_alert('Error connection');
                                            }
                                        });
                                    </script>
                                    <div class="mt-3">
                                        <h4>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                                        </h4>
                                        <?php if($user->role == "admin") { ?>
                                        <span class="p-1 rounded text-bg-dark">Administrator</span>
                                        <?php }else if($user->role == "manager") { ?>
                                        <span class="p-1 rounded text-bg-danger">Manager</span>
                                        <?php }else if($user->role == "fulltime") { ?>
                                        <span class="p-1 rounded text-bg-primary">Full-Time</span>
                                        <?php }else if($user->role == "parttime") { ?>
                                        <span class="p-1 rounded text-bg-success">Part-Time</span>
                                        <?php } ?>
                                        <?php $stamp = $user->created_at;
                                        
                                        $year = substr($stamp, 0, 4);
                                        $month = substr($stamp, 5, 2);
                                        $day = substr($stamp, 8, 2);
                                        
                                        ?>
                                        <p class="text-muted font-size-sm mt-1 mb-0">Joined <?php echo $year . ' ' . $month . ' ' . $day; ?></p>
                                        <!--<button class="btn btn-primary">Follow</button>-->
                                        <textarea class="form-control" readonly>{{ $user->bio }}</textarea>

                                        <a class="btn btn-outline-primary mt-2"
                                            href="/chatify/{{ $user->id }}">Message</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Current Status</h6>
                                    <?php if ($user->status == 1) { ?>
                                    <span class="border border-success text-success p-1 rounded">Active</span>
                                    <?php } else { ?>
                                    <span class="border border-warning text-warning p-1 rounded">Suspend</span>

                                    <?php } ?>
                                    <!-- <span class="text-secondary">https://bootdey.com</span>-->
                                </li>

                            </ul>
                            <div class=" align-items-center flex-wrap p-3">
                                <h5 class="mb-0 ">Actions : </h5>
                             
                                <br>
                                <h6 class="mt-3 " style="display: inline">Verification <div id="icon_verification"
                                        style="display: inline"></div>
                                </h6>
                                <button id="modalVerification" type="button" class="btn btn-outline-primary btn-sm "
                                    style="float: right" data-bs-toggle="modal"
                                    data-bs-target="#modalVer">Details</button>


                                <!-- Modal -->
                                <div class="modal fade w-100" id="modalVer" tabindex="-1" data-bs-backdrop="false"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="container modal-dialog w-100 ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Verification code

                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    <main>
                                                        <div id="qrcode"></div>
                                                        <h5 id="verification_text" class="text-muted mt-2"></h5>
                                                    </main>
                                                </center>
                                            </div>
                                            <div class="modal-footer float-start">
                                                <div class=" ">
                                                    <button onclick="sendNew()" class="btn btn-outline-primary ">
                                                        Send new code
                                                    </button>
                                                    <button onclick="verifyUser()" class="btn btn-primary">
                                                        Veriffy
                                                    </button>
                                                </div>
                                                <script>
                                                    function sendNew() {

                                                        $.ajax({
                                                            url: '{{ route('verificationNew') }}',
                                                            type: 'POST',
                                                            data: {
                                                                _token: '{{ csrf_token() }}',
                                                                id: {{ $user->id }},
                                                            },
                                                            success: function(response) {
                                                                location.reload();


                                                            },
                                                            error: function(xhr, status, error) {
                                                                error_alert('Error connection');
                                                            }
                                                        });
                                                    }

                                                    function verifyUser() {
                                                        $.ajax({
                                                            url: '{{ route('verifyUser') }}',
                                                            type: 'POST',
                                                            data: {
                                                                _token: '{{ csrf_token() }}',
                                                                id: {{ $user->id }},

                                                            },
                                                            success: function(response) {
                                                                location.reload();
                                                            },
                                                            error: function(xhr, status, error) {
                                                                error_alert('Error connection');
                                                            }
                                                        });
                                                    }
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                                <div class="col-12">


                                    <script>
                                        var qrcode;
                                    </script>
                                </div>
                                <script>
                                    const myModal = document.getElementById('modalVer')
                                    const myInput = document.getElementById('modalVerification')

                                    myModal.addEventListener('shown.bs.modal', () => {
                                        myInput.focus()
                                    })
                                </script>
                                <script>
                                    $.ajax({
                                        url: '{{ route('verificationLoad') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            id: {{ $user->id }},

                                        },
                                        success: function(response) {

                                            if (response.status == false) {
                                                document.getElementById("icon_verification").innerHTML =
                                                    "<i class='bi bi-x-circle' style = 'color:red;'></i>";
                                                document.getElementById("verification_text").innerHTML = response.verification_code;
                                                qrcode = new QRCode("qrcode", response.verification_code);
                                            } else {
                                                document.getElementById("icon_verification").innerHTML =
                                                    "<i class='bi bi-check-circle'></i>";
                                                document.getElementById("modalVerification").style.display = "none";

                                            }


                                        },
                                        error: function(xhr, status, error) {
                                            error_alert('Error connection');
                                        }
                                    });
                                </script>


                                <br>
                                <?php if ($user->role == 'fulltime' || $user->role == 'parttime') { ?>
                                <h6 class="mt-4 " style="display: inline">Role</h6>
                                <br>
                                <div class="mt-2" style="display: inline; float: left">

                                    <input type="radio" id="Full-Time" style="display: inline;accent-color: blue"
                                        onclick="r_check(this.id)" name="r-role" value="fulltime">
                                    <span style="display: inline" class="rounded text-bg-primary p-1 "
                                        for="Full-Time">Full-Time</span>
                                 
                                </div>
                          
                                <div class="mt-2" style="display: inline; float: right">
                                    <input type="radio" id="Part-Time" style="display: inline;accent-color: green"
                                        onclick="r_check(this.id)" name="r-role" value="parttime">
                                    <span style="display: inline" class="rounded text-bg-success p-1 "
                                        for="Part-Time">Part-Time</span>
                                </div>
                                <br>
                               <?php if ($user->role == 'fulltime') {
                                    echo "<script> document.getElementById('Full-Time').checked = true; </script>";
                                } elseif ($user->role == 'parttime') {
                                    echo "<script> document.getElementById('Part-Time').checked = true; </script>";
                                } ?>
                               <?php  } ?>
                            </div>
                            <br>
                        </div>
                        <!-- Cast pro pridani TimeLine -->
                        <!--<div class="card mt-3">
                            <div class=" align-items-center flex-wrap p-3">
                                <h5 class="mb-0 ">Timeline </h5>
                                <hr>
                                <div class="row">

                                    <div class="col-12">
                                        <div class="container_timeline">
                                            <div class="wrapper_timeline p-0 mt-0">
                                                <div id="timeline_content">
                                                </div>
                                                <div id="timeline_content">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <script>
                                    var number_load = 0;
                                    loadTimeline(5);

                                    function loadTimeline(number) {
                                        number_load += number;
                                        $.ajax({
                                            url: '{{ route('loadEditTimeline') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                id: {{ $user->id }},
                                                number: number_load
                                            },
                                            success: function(response) {
                                                $("#timeline_content").html(response);
                                            },
                                            error: function(response) {
                                                alert('Error fetching image:', response);
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </div>-->

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-sm-3">
                                        <h5 class="mb-0" style="display:inline">Personal data
                                        </h5>
                                    </div>
                                    <div class="col-6 col-sm-9">
                                        <div class="float-end">

                                            <?php if ($user->role == 'parttime') {
                                                echo '<a id="time_permanent"
                                                                                        class="btn btn-sm btn-outline-primary btn-rounded float-end"
                                                                                     
                                                                                        href="/admin/time-options/' .
                                                    $user->id .
                                                    '"
                                                                                        style="float:right"><i
                                                                                            class="bi bi-patch-plus "></i>&nbsp&nbsp
                                                                                            View time options</a></div>';
                                            } else {
                                                if ($user->role == 'fulltime') {
                                                echo '<a id="time_permanent"
                                                                                        class="btn btn-sm btn-outline-primary btn-rounded float-end"
                                                                                     
                                                                                        href="/admin/permanent-time-options/' .
                                                    $user->id .
                                                    '"
                                                                                        style="float:right"><i
                                                                                            class="bi bi-patch-plus "></i>&nbsp&nbsp
                                                                                            View time options</a></div>';
                                            }else{
                                               echo '</div>';
                                            } 
                                        }?>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">First Name</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <div class="form-group">
                                                <input id="first_name" type="text" class="form-control"
                                                    value="{{ $user->first_name }}">
                                                <small id="firstHelp" class="form-text text-danger"
                                                    style="display: none">Needs to be filled</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Middle Name</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <div class="form-group">
                                                <input id="middle_name" type="text" class="form-control"
                                                    value="{{ $user->middle_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Last Name</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <div class="form-group">
                                                <input id="last_name" type="text" class="form-control"
                                                    value="{{ $user->last_name }}">
                                                <small id="lastHelp" class="form-text text-danger"
                                                    style="display: none">Needs to be filled</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Username</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <div class="form-group">
                                                <input id="username" type="text" class="form-control"
                                                    value="{{ $user->username }}">
                                                <small id="userHelp" class="form-text text-danger"
                                                    style="display: none">Needs to be filled</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control"
                                                    value="{{ $user->email }}">
                                                <small id="emailHelp" class="form-text text-danger"
                                                    style="display: none">Needs to be filled</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone code</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            @include('phone-selector')
                                            <small id="codeHelp" class="form-text text-danger"
                                                style="display: none">Needs to be filled</small>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <div class="form-group">
                                                <input id="phone_number" type="email" class="form-control"
                                                    value="{{ $user->phone_number }}">
                                                <small id="phoneHelp" class="form-text text-danger"
                                                    style="display: none">Needs to be filled</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- https://www.bootdey.com/snippets/view/profile-with-data-and-skills#html -->


                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php if ($user->role == 'fulltime' || $user->role == 'parttime') { ?>
                                            <a class="btn btn-primary " style="float: right" target="__blank"
                                                onclick="updateProfile()">Edit</a>
                                                <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters-sm">
                                <?php if ($user->role == 'manager') { ?>
                                <div class="col-sm-6 mb-3">
                                    <script>
                                        var col_form = 6;
                                    </script>
                                    <?php }else{ ?>
                                    <div class="col-sm-12 mb-3">
                                        <script>
                                            var col_form = 4;
                                        </script>

                                        <?php } ?>
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="d-flex align-items-center justify-content-between mb-3">
                                                    Assigned
                                                    shifts
                                                    <div class="float-end"><a id="create_shift"
                                                            class="btn btn-sm btn-outline-primary btn-rounded float-end"
                                                            href="/admin/assign-shifts/{{ $user->id }}"
                                                            style="float:right"><i
                                                                class="bi bi-patch-plus "></i>&nbsp&nbsp
                                                            Add shifts</a></div>
                                                </h5>
                                                <hr>
                                                <select id="main_object" class="form-select form-control-sm"
                                                    aria-label="Default select example">
                                                </select>
                                                <div id="assignment_load">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $.ajax({
                                            url: '{{ route('mainObjectSelect') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                            },
                                            success: function(response) {
                                                document.getElementById("main_object").innerHTML = response;

                                                var e = document.getElementById("main_object");
                                                var id_main_object = e.value;


                                                $.ajax({
                                                    url: '{{ route('loadAssignmentList') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        id_object: id_main_object,
                                                        id: {{ $user->id }},
                                                        col: col_form
                                                    },
                                                    success: function(response) {
                                                        document.getElementById("assignment_load").innerHTML = response;
                                                        var e = document.getElementById("main_object");
                                                        main_obj_var = e.value;


                                                    },
                                                    error: function(xhr, status, error) {
                                                        error_alert('Error connection');
                                                    }
                                                });
                                                var myElem = document.getElementById('main_object2');
                                                if (myElem != null) {
                                                    document.getElementById("main_object2").innerHTML = response;
                                                    var f = document.getElementById("main_object2");
                                                    var id_main_object2 = f.value;

                                                    $.ajax({
                                                        url: '{{ route('loadRightsList') }}',
                                                        type: 'POST',
                                                        data: {
                                                            _token: '{{ csrf_token() }}',
                                                            id_object: id_main_object2,
                                                            id: {{ $user->id }},
                                                        },
                                                        success: function(response) {
                                                            document.getElementById("rights_load").innerHTML = response;
                                                            var e = document.getElementById("main_object2");
                                                            main_obj_var2 = e.value;

                                                        },
                                                        error: function(xhr, status, error) {
                                                            error_alert('Error connection');
                                                        }
                                                    });
                                                }

                                            },
                                            error: function(xhr, status, error) {
                                                error_alert('Error connection');
                                            }
                                        });
                                        $('#main_object').change(function() {
                                            var inp = $(this).val();
                                            main_obj_var = inp;
                                            $.ajax({
                                                url: '{{ route('loadAssignmentList') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    id_object: main_obj_var,
                                                    id: {{ $user->id }},
                                                    col: col_form
                                                },
                                                success: function(response) {
                                                    document.getElementById("assignment_load").innerHTML = response;
                                                    var e = document.getElementById("main_object");
                                                    main_obj_var = e.value;


                                                },
                                                error: function(xhr, status, error) {
                                                    error_alert('Error connection');
                                                }
                                            });

                                        });
                                    </script>




                                    <?php if ($user->role == 'manager') { ?>
                                    <div class="col-sm-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="d-flex align-items-center justify-content-between mb-3">
                                                    Assigned
                                                    rights
                                         
                                                </h5>
                                                <hr>
                                                <select id="main_object2" class="form-select form-control-sm"
                                                    aria-label="Default select example">
                                                </select>
                                                <div id="rights_load">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#main_object2').change(function() {
                                            var inp = $(this).val();
                                            main_obj_var2 = inp;
                                            $.ajax({
                                                url: '{{ route('loadRightsList') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    id_object: main_obj_var2,
                                                    id: {{ $user->id }},
                                                },
                                                success: function(response) {
                                                    document.getElementById("rights_load").innerHTML = response;
                                                    var e = document.getElementById("main_object2");
                                                    main_obj_var2 = e.value;


                                                },
                                                error: function(xhr, status, error) {
                                                    error_alert('Error connection');
                                                }
                                            });

                                        });
                                    </script>
                                    <?php } ?>
                                </div>

                                <script>
                                    var ele_status_prev = document.getElementsByName('r-status');
                                    var status_r = "";
                                    for (i = 0; i < ele_status_prev.length; i++) {
                                        if (ele_status_prev[i].checked) {
                                            status_r = ele_status_prev[i].value;
                                        }
                                    }
                                    var ele_role_prev = document.getElementsByName('r-role');
                                    var role = "";
                                    for (i = 0; i < ele_role_prev.length; i++) {
                                        if (ele_role_prev[i].checked) {
                                            role = ele_role_prev[i].value;
                                        }
                                    }

                                    function updateProfile() {
                                        var first_name = document.getElementById("first_name").value;
                                        var middle_name = document.getElementById("middle_name").value;
                                        var last_name = document.getElementById("last_name").value;
                                        var username = document.getElementById("username").value;
                                        var email = document.getElementById("email").value;

                                        let email_check = document.getElementById("email").value;
                                        let first_check = document.getElementById("first_name").value;
                                        let last_check = document.getElementById("last_name").value;
                                        var e = document.getElementById("countryCode");
                                        var phone_code = e.value;
                                        var phone_number = document.getElementById("phone_number").value;


                                        var ele_role = document.getElementsByName('r-role');
                                        for (i = 0; i < ele_role.length; i++) {
                                            if (ele_role[i].checked) {
                                                role = ele_role[i].value;
                                            }
                                        }
                                        var ele_status = document.getElementsByName('r-status');
                                        for (i = 0; i < ele_status.length; i++) {
                                            if (ele_status[i].checked) {
                                                status_r = ele_status[i].value;
                                            }
                                        }
                                        if (first_check != "") {
                                            if (last_check != "") {
                                                var popup4 = document.getElementById("firstHelp");

                                                popup4.style.display = "none";
                                                if (email_check != "") {

                                                    var popup3 = document.getElementById("lastHelp");
                                                    popup3.style.display = "none";
                                                    $.ajax({
                                                        url: '{{ route('updateProfilePersonal') }}',
                                                        type: 'POST',
                                                        data: {
                                                            _token: '{{ csrf_token() }}',
                                                            id: {{ $user->id }},
                                                            first_name: first_name,
                                                            middle_name: middle_name,
                                                            last_name: last_name,
                                                            username: username,
                                                            email: email,
                                                            phone_code: phone_code,
                                                            phone_number: phone_number,
                                                            role: role,
                                                            status: status_r


                                                        },
                                                        success: function(response) {
                                                         
                                                            if (response.status == 1) {
                                                                window.location.reload();
                                                            }
                                                            if (response.email == 0) {
                                                                var popup = document.getElementById("emailHelp");
                                                                popup.style.display = "inline";
                                                                popup.innerHTML = "Provide correct email form";
                                                            } else {
                                                                var popup = document.getElementById("emailHelp");
                                                                popup.style.display = "none";

                                                            }
                                                            if (response.username == 0) {
                                                                var popup2 = document.getElementById("userHelp");
                                                                popup2.style.display = "inline";
                                                                popup2.innerHTML = "Username already exists";
                                                            } else {
                                                                var popup2 = document.getElementById("userHelp");
                                                                popup2.style.display = "none";
                                                            }
                                                            if (response.phone == 0) {
                                                                var popup7 = document.getElementById("phoneHelp");
                                                                popup7.style.display = "inline";
                                                                popup7.innerHTML = "Phone must contain only numbers";
                                                            } else {
                                                                var popup7 = document.getElementById("phoneHelp");
                                                                popup7.style.display = "none";
                                                            }


                                                        },
                                                        error: function(xhr, status, error) {
                                                            error_alert('Error connection');
                                                        }
                                                    });

                                                } else {
                                                    var popup = document.getElementById("emailHelp");
                                                    popup.style.display = "inline";
                                                    popup.innerHTML = "Provide email address";
                                                }
                                            } else {
                                                var popup3 = document.getElementById("lastHelp");
                                                popup3.style.display = "inline";
                                            }
                                        } else {
                                            var popup4 = document.getElementById("firstHelp");
                                            popup4.style.display = "inline";
                                        }

                                    }

                                    function r_check(id) {
                                        var r_element = document.getElementById(id);
                                        if (r_element.value != role) {
                                            sure_role(role, id, r_element.value);
                                        }

                                    }

                                    function sure_role(role_r, name, ele_val) {
                                        Swal.fire({
                                            icon: "question",
                                            title: "Do you want to grant " + name + " access to this account ?",
                                            text: "Account will receive different access in network ",
                                            showCancelButton: true,
                                            confirmButtonText: "Confirm",
                                        }).then((result) => {
                                            if (!result.isConfirmed) {
                                                if (role_r == "manager") {
                                                    document.getElementById('Manager').checked = true;
                                                } else if (role_r == "fulltime") {
                                                    document.getElementById('Full-Time').checked = true;

                                                } else if (role_r == "parttime") {
                                                    document.getElementById('Part-Time').checked = true;

                                                } else if (role_r == "admin") {
                                                    document.getElementById('Administrator').checked = true;

                                                }

                                            } else {
                                                role = ele_val;
                                            }
                                        });
                                    }

                                    function r_status_check(id) {
                                        var r_element = document.getElementById(id);
                                        if (r_element.value != status_r) {
                                            var text_s = "Account will not be able to connect to the network";
                                            var name_s = "";
                                            if (r_element.value == 0) {
                                                text_s = "Account will not be able to connect to the network";
                                                name_s = "Suspend";
                                            } else {
                                                text_s = "Account will be able to connect to the network";
                                                name_s = "Activate";

                                            }
                                            sure_status(status_r, name_s, text_s, r_element.value);
                                        }

                                    }

                                    function sure_status(status, name, text_s, ele_val) {
                                        Swal.fire({
                                            icon: "question",
                                            title: "Do you want  " + name + " this account ?",
                                            text: text_s,
                                            showCancelButton: true,
                                            confirmButtonText: "Confirm",
                                        }).then((result) => {
                                            if (!result.isConfirmed) {
                                                if (status == 1) {
                                                    document.getElementById('Active').checked = true;
                                                } else if (status == 0) {
                                                    document.getElementById('Suspend').checked = true;

                                                }


                                            } else {
                                                status_r = ele_val;

                                            }
                                        });
                                    }
                                </script>



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
