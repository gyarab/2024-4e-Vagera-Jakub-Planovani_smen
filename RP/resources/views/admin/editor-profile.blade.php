<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5"
        rel="stylesheet">
        <title>Edit profile</title>
        <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">


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
</head>

<body id="body-pd">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
  
        import {
            Ripple,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Ripple
        });
    </script>
    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <div class="height-100 bg-light">
        <div class="container ">
            <div class="row">
                <div class="col mb-3">
                    <div class="card shadow bg-white rounded mt-2 h-100">
                        <div class="card-body ">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <img id="profileImage" src="" alt="Profile Image"
                                                class="rounded-circle object-fit-cover"
                                                style="height: 140px; width: 140px;border: 2px solid black;"
                                                class="img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            @foreach ($parameters as $p)
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $p->first_name }}
                                                    {{ $p->middle_name }} {{ $p->last_name }}</h4>
                                                <p class="mb-0">{{ $p->username }}</p>
                                                <?php $stamp = $p->created_at;
                                                
                                                $year = substr($stamp, 0, 4);
                                                $month = substr($stamp, 5, 2);
                                                $day = substr($stamp, 8, 2);
                                                
                                                ?>
                                                <div class="text-muted"><small> Joined <?php echo $year . ' ' . $month . ' ' . $day; ?></small></div>

                                            @endforeach
                                            <div class="mt-2">
                                                <input type="file" id="imageInput" hidden />
                                                <label for="imageInput" class="btn btn-primary"> <i for="imageInput"
                                                        class="fa fa-fw fa-camera "></i>
                                                    <span for="imageInput">Change Photo</span></label>
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-right">
                                            <span class="p-1 rounded text-bg-dark">Administrator</span>
             

                                            <div class="modal fade w-100" id="exampleModal" tabindex="-1"
                                                data-bs-backdrop="false" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="container modal-dialog w-100 ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                title
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <center>
                                                                <main>
                                                                    <div id="qrcode"></div>
                                                                </main>
                                                            </center>
                                                        </div>
                                                        <div class="modal-footer">
                                     
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                const myModal = document.getElementById('exampleModal')
                                                const myInput = document.getElementById('modalbtn')

                                                myModal.addEventListener('shown.bs.modal', () => {
                                                    myInput.focus()
                                                })
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content pt-3">

                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        @foreach ($parameters as $p)
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label>First Name</label>
                                                                    <input class="form-control" id="first_name"
                                                                        type="text" name="name"
                                                                        placeholder="John Smith"
                                                                        value="{{ $p->first_name }}">
                                                                    <div id="first_validation"
                                                                        class="invalid-feedback" style="display:none">
                                                                        Provide a first name.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label>Middle Name</label>
                                                                    <input class="form-control" id="middle_name"
                                                                        type="text" name="name"
                                                                        placeholder="John Smith"
                                                                        value="{{ $p->middle_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label>Last Name</label>
                                                                    <input class="form-control" id="last_name"
                                                                        type="text" name="name"
                                                                        placeholder="John Smith"
                                                                        value="{{ $p->last_name }}">
                                                                    <div id="last_validation" class="invalid-feedback"
                                                                        style="display:none">
                                                                        Provide a last name.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        @foreach ($parameters as $p)
                                                            <label>Username</label>
                                                            <input class="form-control" type="text" name=""
                                                                id="username" placeholder="My username"
                                                                value="{{ $p->username }}">
                                                            <div id="username_validation" class="invalid-feedback"
                                                                style="display:none">
                                                                Username already exists.
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1 needs-validation">
                                                <div class="col">
                                                    <div class="form-group">
                                                        @foreach ($parameters as $p)
                                                            <label>Email</label>
                                                            <input class="form-control" type="text" id="email"
                                                                placeholder="user@example.com"
                                                                value="{{ $p->email }}" required>
                                                            <div id="email_validation" class="invalid-feedback"
                                                                style="display:none">
                                                                Please provide a valid email.
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                                                <div class="col-12">


                                                    <script>
                                                        var qrcode = new QRCode("qrcode",
                                                            "https://www.geeksforgeeks.org");
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <label>About</label>
                                                        @foreach ($parameters as $p)
                                                            <textarea id="bio" class="form-control" rows="5" placeholder="My Bio">{{ $p->bio }}</textarea>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="mb-2"><b>Change Password</b></div>
                                 
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input id="new_password" class="form-control" type="password"
                                                            placeholder=".....">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Confirm
                                                       </label>
                                                        <input id="repeat_password" class="form-control"
                                                            type="password" placeholder=".....">
                                                    </div>
                                                    <div id="password_validation" class="invalid-feedback"
                                                        style="display:none">
                                                        Please provide a valid email.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit"
                                                onclick="updateProfile()">Save Changes</button>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
            @csrf
     
            <script>
       
            </script>
         
            <div id="responseMessage"></div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
               /**source : https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded*/ 
                document.getElementById('imageInput').addEventListener('change', function(e) {
                    if (e.target.files[0]) {
                        var file = document.getElementById('imageInput').files[0];

                        if (!file) {
                            alert('Please select an image file.');
                            return;
                        }

                        // Create a FormData object to send the file data
                        var formData = new FormData();
                        formData.append('image', file);

                        // Get the CSRF token
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        // AJAX request to upload the image
                        $.ajax({
                            url: '{{ route('storeImage') }}',
                            type: 'POST',
                            data: formData,
                            processData: false, // Prevent jQuery from processing the data
                            contentType: false, // Prevent jQuery from setting content-type
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#profileImage').attr('src', response.path);
                                } else {
                                    document.getElementById('responseMessage').innerHTML = 'Upload failed!';
                                }
                            },
                            error: function(xhr, status, error) {
                                document.getElementById('responseMessage').innerHTML =
                                    'Error uploading image: ' + error;
                            }
                        });
                    }
                });
            </script>

            <script>
                var imageFilename = 'profile-images/swKGI3VjRDAAEVAUADYUaX1TCKZM2J5CSNubnhAN.jpg';
                $.ajax({
                    url: '{{ route('showProfileImage') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        imageFilename: imageFilename
                    },
                    success: function(response) {
                        $('#profileImage').attr('src', response.url);

                    },
                    error: function(xhr, status, error) {
                        error_alert('Error connection');
                    }
                });
                var alertVar = 0;

                function updateProfile() {
                    var first_name = document.getElementById("first_name").value;
                    var middle_name = document.getElementById("middle_name").value;
                    var last_name = document.getElementById("last_name").value;
                    var username = document.getElementById("username").value;
                    var email = document.getElementById("email").value;
                    var bio = document.getElementById("bio").value;
                    var new_password = document.getElementById("new_password").value;
                    var repeat_password = document.getElementById("repeat_password").value;
                    let email_check = document.getElementById("email").value;
                    let first_check = document.getElementById("first_name").value;
                    let last_check = document.getElementById("last_name").value;
                    let new_check = document.getElementById("new_password").value;
                    let repeat_check = document.getElementById("repeat_password").value;
                    if (( new_check == "" && repeat_check == "") || ( new_check != "" && repeat_check != "")) {
                        if (first_check != "") {
                            if (last_check != "") {
                                var popup4 = document.getElementById("first_validation");
                                popup4.style.display = "none";
                                if (email_check != "") {
                                    var popup3 = document.getElementById("last_validation");
                                    popup3.style.display = "none";
                                    $.ajax({
                                        url: '{{ route('updateProfile') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            bio: bio,
                                            first_name: first_name,
                                            middle_name: middle_name,
                                            last_name: last_name,
                                            username: username,
                                            email: email,
                                            new_password: new_password,
                                            repeat_password: repeat_password

                                        },
                                        success: function(response) {
                                            alertVar = 0;
                                            if (response.email == 0) {
                                                var popup = document.getElementById("email_validation");
                                                popup.style.display = "inline";
                                                popup.innerHTML = "Provide correct email form";
                                                alertVar++;
                                            } else {
                                                var popup = document.getElementById("email_validation");
                                                popup.style.display = "none";

                                            }
                                            if (response.username == 0) {
                                                var popup2 = document.getElementById("username_validation");
                                                popup2.style.display = "inline";
                                                popup2.innerHTML = "Username already exists";
                                                alertVar++;

                                            } else {
                                                var popup2 = document.getElementById("username_validation");
                                                popup2.style.display = "none";
                                            }
                                            if (response.password != 1) {
                                                var popup6 = document.getElementById("password_validation");
                                                popup6.style.display = "inline";
                                                if(response.password == 0){
                                                    popup6.innerHTML = "Password do not equal";
                                            }else if(response.password == 2){
                                                    popup6.innerHTML = "Password needs to have lowercase char";
                                                }else if(response.password == 3){
                                                    popup6.innerHTML = "Password needs to have at least one number";

                                                }else if(response.password == 4){
                                                    popup6.innerHTML = "Password needs to have uppercase char";

                                                }else{
                                                    popup6.innerHTML = "Password needs to have at least 8 chars long";
                                                }
                                            } else {
                                               if(alertVar == 0){

                                                success_alert("Data changed");
                                               }
                                                var popup6 = document.getElementById("password_validation");
                                                popup6.style.display = "none";
                                                document.getElementById("new_password").value = "";
                                                document.getElementById("repeat_password").value = "";
                                            }

                                        },
                                        error: function(xhr, status, error) {
                                            error_alert('Error connection');
                                        }
                                    });
                                } else {
                                    var popup = document.getElementById("email_validation");
                                    popup.style.display = "inline";
                                    popup.innerHTML = "Provide email address";
                                }
                            } else {
                                var popup3 = document.getElementById("last_validation");
                                popup3.style.display = "inline";
                            }
                        } else {
                            var popup4 = document.getElementById("first_validation");
                            popup4.style.display = "inline";
                        }
                    } else {
                        var popup5 = document.getElementById("password_validation");
                        popup5.style.display = "inline";
                        popup5.innerHTML = "Provide all passwords";
                    }
                }
            </script>
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
        </div>
    </div>
</body>

</html>
