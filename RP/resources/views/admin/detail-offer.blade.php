<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <link href="{{ asset('CSS/clock2.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
</head>

<body id="body-pd">
    @include('vendor.Chatify.pages.header-admin')
    @include('vendor.Chatify.pages.sidebar-admin')
    @include('admin.scripts')
    <div class="bg-light" style="height: 100vh;">
        <br>
        <div class="container">

            <div class="row m-1">
                <div class="col-12 col-md-4">
                    <div class="card  p-3 mb-2">
                        @foreach ($offer_shift as $offer)
                            <script>
                                var id_offer = @json($offer->id_offer);
                                var offer_date = @json($offer->date);
                            </script>
                            <div class="row">
                                <div class="col-8 d-flex">
                                    <h5 class="heading mb-2 ">Details</h5>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <div style="float: right">
                                        <i class="bi bi-circle-fill"
                                            style="float: right;color: {{ $offer->color }};font-size: 22px"></i>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-4 d-flex">
                                    <div class=" justify-content-center align-self-center">
                                        <h6 class="d-inline">Object </h6>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="obejct" class="d-inline form-control" id="exampleFormControlInput1"
                                        value=" {{ $offer->object_name }}" disabled>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 d-flex">
                                    <div class=" justify-content-center align-self-center">
                                        <h6>Shift</h6>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="shift" class="d-inline form-control" id="exampleFormControlInput1"
                                        value="{{ $offer->shift_name }}" disabled>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 d-flex">
                                    <div class=" justify-content-center align-self-center">
                                        <h6>Planned from</h6>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="offered_by" class="d-inline form-control" id="exampleFormControlInput1"
                                        value="{{ substr($offer->saved_from, 0, -3) }}" disabled>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 d-flex">
                                    <div class=" justify-content-center align-self-center">
                                        <h6>Planned to</h6>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="offered_at" class="d-inline form-control" id="exampleFormControlInput1"
                                        value="{{ substr($offer->saved_to, 0, -3) }}" disabled>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 d-flex">
                                    <div class=" justify-content-center align-self-center">
                                        <h6>Offered at</h6>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="offered_by" class="d-inline form-control"
                                        id="exampleFormControlInput1" value="{{ $offer->date }}" disabled>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 d-flex">
                                    <div class=" justify-content-center align-self-center">
                                        <h6>Offered by</h6>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="offered_at" class="d-inline form-control"
                                        id="exampleFormControlInput1"
                                        value="{{ $offer->last_name }} {{ $offer->middle_name }} {{ $offer->first_name }}"
                                        disabled>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card  p-3 mb-2">
                        <h5 class="heading mb-2">Selected user</h5>
                        <div class="d-flex flex-column align-items-center text-center">
                            <img id="modalImage" src="https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-profile-picture-suitable-social-media-profiles-icons-screensavers-as-templatex9xa_719432-1040.jpg?semt=ais_hybrid"
                                alt="Admin" class="rounded-circle object-fit-cover"
                                style="height: 150px; width: 150px">
                        </div>
                        <script>
                  
                        </script>
                        <hr>
                        <p id="modalName">Name: </p>
                        <p id="modalRole">Position: </p>
                        <button style="float: right" onclick="saveRequest()" class="btn btn-primary"> Save</button>
                        <script>
                            var global_user = "";

                            function saveRequest() {
                                alert(global_user);
                                if (global_user != null || global_user != "") {
                                    $.ajax({
                                        url: '{{ route('confirmRequest') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            id_user: global_user,
                                            offer_date: offer_date,
                                            id_offer: id_offer
                                        },
                                        success: function(response) {
                        
                


                                        },
                                        error: function(xhr, status, error) {
                                            alert('Error fetching image render:', error);
                                        }
                                    });
                                }
                            }
                            loadRequestProfile();
                            function loadRequestProfile() {
                                if (global_user != null || global_user != "") {
                                    $.ajax({
                                        url: '{{ route('requestProfile') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            input: {{ $offer->id_offer }}
                                            
                                        },
                                        success: function(response) {
                                            $('#modalImage').attr('src', response.imageUrl);
                                            document.getElementById("modalName").innerHTML = "Name: <strong id='name_selected'>" +
                                            response.name +
                                            "</strong>";
                                        document.getElementById("modalRole").innerHTML = "Position: " + response.role;
                                      



                                        },
                                        error: function(xhr, status, error) {
                                            alert('Error fetching image render:', error);
                                        }
                                    });
                                }
                            }
                        </script>
                    
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="card p-3 mb-2 h-100">
                        <h5 class="heading mb-2">Requests</h5>
                        <hr>
                        <div id="table">

                        </div>


                        <script>
                            $.ajax({
                                url: '{{ route('loadRequestTable') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    input: {{ $offer->id_offer }}
                                },
                                success: function(response) {
                                    document.getElementById("table").innerHTML = response;


                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image render:', error);
                                }
                            });

                            function pickUser(id_user) {
                                global_user = id_user.substring(4);
                                $.ajax({
                                    url: '{{ route('showImagePersonal') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        id: id_user.substring(4),
                                    },
                                    success: function(response) {
                                   
                                        $('#modalImage').attr('src', response.url);

                                    },
                                    error: function(xhr, status, error) {
                                        alert('Error fetching image:', error);
                                    }
                                });
                                $.ajax({
                                    url: '{{ route('getNameRole') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        id: id_user.substring(4),
                                    },
                                    success: function(response) {
                                  
                                        document.getElementById("modalName").innerHTML = "Name: <strong id='name_selected'>" +
                                            response.name +
                                            "</strong>";
                                        document.getElementById("modalRole").innerHTML = "Position: " + response.role;
                               

                                    },
                                    error: function(xhr, status, error) {
                                        alert('Error fetching image:', error);
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
