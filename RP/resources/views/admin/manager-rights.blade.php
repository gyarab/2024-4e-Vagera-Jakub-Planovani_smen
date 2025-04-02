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
    <title>Management rights</title>
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body id="body-pd">
    @include('vendor.Chatify.pages.header-admin')
    @include('vendor.Chatify.pages.sidebar-admin')
    @include('admin.scripts')
    <div class="height-100 bg-light">
        <script>
           var objects_arr = [];
        </script>
        <div class="container">
            <br>
            <div class="main-body">

                <!-- Breadcrumb -->

                <!-- /Breadcrumb -->

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column text-center">
                                    <div class="row gutters-sm">
                                        <div class="col-4 d-flex flex-column align-items-start">
                                            <img id="imagePersoanl" src="" alt="Admin"
                                                class="rounded-circle object-fit-cover"
                                                style="height: 70px; width: 70px;border: 2p">
                                        </div>
                                        <div class="col-8">
                                            <h4>{{ $user->first_name }} {{ $user->middle_name }}
                                                {{ $user->last_name }}
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
                                        </div>
                                    </div>

                                    <script>
                                        $.ajax({
                                            url: '{{ route('showImagePersonal') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                id: {{ $user->id }},
                                            },
                                            success: function(response) {
                                    
                                                $('#imagePersoanl').attr('src', response.url);

                                            },
                                            error: function(xhr, status, error) {
                                                error_alert('Error connection');
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="align-items-middle">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex flex-column align-items-middle mt-1">
                                                <h5>Controller</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <input type="button" onclick="getValue()" style="float: right" class="btn btn-primary"
                                                value="ADD">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="mb-0" style="display:inline">Timeline
                                        </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="">

                                    <div class="row">
                     
                                        <div class="col-12">
                                            <div class="container_timeline">
                                                <div class="wrapper_timeline p-0">
                                                <div id="timeline_content">
                                                </div>
                                                <script>
                                                    var number_load = 0;
                                                     loadTimeline(5);
                                                    /**Source: https://codepen.io/TajShireen/pen/JjGvVzg*/
                                            function loadTimeline(number){
                                                number_load += number;
                                                $.ajax({
                                                url: '{{ route('loadRightstTimeline') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    id: {{$user->id}},
                                                    number: number_load
                                                },
                                                success: function(response) {
                                                    $("#timeline_content").html(response);
                                                },
                                                error: function(response) {
                                                    error_alert('Error connection');
                                                }
                                            });
                                            }
                                                </script>

                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="align-items-middle">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="d-flex flex-column align-items-middle mt-1">
                                                <h5>Rights picker</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <select id="main_object" class="form-select"
                                              >
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <div id="assignment_load">

                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                            var shifts_arr = [];
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
                                                    url: '{{ route('structureRightsGet') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        object: id_main_object,
                                                        id: {{$user->id}}
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

                                            },
                                            error: function(xhr, status, error) {
                                                error_alert('Error connection');
                                            }
                                        });
                                        $('#main_object').change(function() {
                                            var inp = $(this).val();
                                            main_obj_var = inp;
                                            $.ajax({
                                                url: '{{ route('structureRightsGet') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    object: inp,
                                                    id: {{$user->id}}
                                                },
                                                success: function(response) {
                                                    $("#assignment_load").html(response);
                                                },
                                                error: function(response) {
                                                    error_alert('Error connection');
                                                }
                                            });
                                        });

                                        function getValue() {
                                            objects_arr = [];
                                            let checkboxes =
                                                document.getElementsByName('ch_rights');
                                            let result = "";
                                            for (var i = 0; i < checkboxes.length; i++) {
                                                if (checkboxes[i].checked) {
                                        
                                                    objects_arr.push(checkboxes[i].value);
                                                }
                                            }
                                           $.ajax({
                                                    url: '{{ route('insertRights') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        obj_arr: objects_arr,
                                                        id: {{$user->id}},
                                                        main_obj: main_obj_var
                                                    },
                                                    success: function(response) {
                                                        success_alert("Successfully edited");
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