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


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="{{ asset('CSS/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/search.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/notification.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/graph.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/card.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock2.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/toggle-switch.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/color_picker.css') }}" rel="stylesheet">
    <title>Create user</title>
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">
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
    <!--<button onclick="sendEmail()">dsad</button>-->
    <div class="height-100 bg-light">

        <div class="container">
            <br>
            <div class="main-body">

                <!-- Breadcrumb -->

                <!-- /Breadcrumb -->

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img id="imagePersoanl" src="/storage/profile-images/avatar_blank2.jpg"
                                        alt="Admin" class="rounded-circle object-fit-cover"
                                        style="height: 150px; width: 150px;border: 2p">
                                    <script></script>
                                    <div class="mt-3">
                                        <h4>
                                        </h4>

                                        <p class="text-muted font-size-sm mt-1 mb-0">Bio </p>
                                        <!--<button class="btn btn-primary">Follow</button>-->
                                        <textarea id="bio" class="form-control"></textarea>
                                        <!--<input id="imageInput" type="file" class="btn btn-primary mt-2" value="Image">-->
                                        <input type="file" class="mt-2" id="imageInput" hidden />
                                        <label for="imageInput" class="btn btn-primary mt-2"> <i for="imageInput"
                                                class="fa fa-fw fa-camera "></i>
                                            <span for="imageInput">Image</span></label>
                                        <button class="btn btn-danger mt-2" onclick="refresh()"><i
                                                class="bi bi-trash"></i></button>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h5 class="mb-0" style="display:inline">Role<h5
                                            style="color: red; display:inline; float: left">*</h5>
                                    </h5>

                                    <!-- <span class="text-secondary">https://bootdey.com</span>-->
                                </li>

                            </ul>
                            <div class=" align-items-center flex-wrap p-3">

                                <div class="mt-2" style="display: inline; float: left">
                                    <input type="radio" id="Administrator"
                                        style="display: inline;accent-color: black;" name="r-role" onclick="r_check(this.id)" value="admin">
                                    <span style="display: inline;" class="rounded text-bg-dark  p-1 "
                                        for="Administrator">Administrator</span>
                                </div>
                                <div class="mt-2" style="display: inline; float: right">
                                    <input type="radio" id="Manager" style="display: inline;accent-color: red"
                                        name="r-role" onclick="r_check(this.id)" value="manager">
                                    <span style="display: inline" class="rounded text-bg-danger p-1 "
                                        for="Manager">Manager</span>

                                    <input type="radio" id="Full-Time" style="display: inline;accent-color: blue"
                                        name="r-role" onclick="r_check(this.id)" value="fulltime">
                                    <span style="display: inline" class="rounded text-bg-primary p-1 "
                                        for="Full-Time">Full-Time</span>
                                </div>
                                <br>
                                <div class="mt-2" style="display: inline; float: right">
                                    <input type="radio" id="Part-Time" style="display: inline;accent-color: green"
                                        name="r-role" value="parttime" onclick="r_check(this.id)" checked>
                                    <span style="display: inline" class="rounded text-bg-success p-1 "
                                        for="Part-Time">Part-Time</span>
                                </div>
                                <br>

                            </div>
                            <br>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">

                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h5 class="mb-0" style="display:inline">Password<h5
                                            style="color: red; display:inline; float: left">*</h5>
                                    </h5>

                                    <!-- <span class="text-secondary">https://bootdey.com</span>-->
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="display:inline">Password</h6>
                                        </h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        <div class="form-group">
                                            <input id="f-password" type="password" class="form-control"
                                                value="">
                                        </div>
                                    </div>

                                    <!-- <span class="text-secondary">https://bootdey.com</span>-->
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="display:inline">Repeat</h6>
                                        </h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        <div class="form-group">
                                            <input id="r-password" type="password" class="form-control"
                                                value="">
                                        </div>
                                    </div>

                                    <!-- <span class="text-secondary">https://bootdey.com</span>-->
                                </li>
                            </ul>

                            <div class=" align-items-center flex-wrap px-3 py-1 ">

                                <small id="passwordHelp" class="form-text text-danger" style="display: none">Needs to
                                    be filled</small>

                            </div>

                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0" style="display:inline">Personal data
                                        </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="display:inline">First Name <h6
                                                style="color: red; display:inline">*</h6>
                                        </h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        <div class="form-group">
                                            <input id="first_name" type="text" class="form-control"
                                                value="">
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
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="display:inline">Last Name <h6
                                                style="color: red; display:inline">*</h6>
                                        </h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        <div class="form-group">
                                            <input id="last_name" type="text" class="form-control"
                                                value="">
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
                                                value="">
                                            <small id="userHelp" class="form-text text-danger"
                                                style="display: none">Needs to be filled</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="display:inline">Email <h6
                                                style="color: red; display:inline">*</h6>
                                        </h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control"
                                                value="">
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
                                                value="">
                                            <small id="phoneHelp" class="form-text text-danger"
                                                style="display: none">Needs to be filled</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- https://www.bootdey.com/snippets/view/profile-with-data-and-skills#html -->


                                <hr>
                                <br>
                                <br>


                                <div class="row">

                                    <div class="col-sm-12">

                                        <a class="btn btn-primary " style="float: right" target="__blank"
                                            onclick="updateProfile()">Create</a>
                                            <button type="button" class="btn btn-outline-secondary" onclick="clearParameters()" style="float: left">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters-sm">

                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            //function uploadImage() {
                            document.getElementById('imageInput').addEventListener('change', function(e) {
                                if (e.target.files[0]) {
                                    // Get the selected file
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
                                    alert("jfdhjkfdsjhfsdjk");
                                    filePreview();
                                    // AJAX request to upload the image
                                    /*$.ajax({
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
                                                //alert(response.messages);
                                            } else {
                                                document.getElementById('responseMessage').innerHTML = 'Upload failed!';
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            document.getElementById('responseMessage').innerHTML =
                                                'Error uploading image: ' + error;
                                        }
                                    });*/
                                }
                            });

                            function filePreview() {
                                const preview = document.getElementById('imagePersoanl');
                                const file = document.querySelector('#imageInput').files[0];
                                const reader = new FileReader();

                                reader.addEventListener("load", function() {
                                    // result is a base64 string
                                    preview.src = reader.result;
                                }, false);

                                if (file) {
                                    reader.readAsDataURL(file);
                                }
                            }
                        </script>

                        <script>
                            var previous_role = "";
                            var ele_role_prev = document.getElementsByName('r-role');
                            var role = "";
                            for (i = 0; i < ele_role_prev.length; i++) {
                                    if (ele_role_prev[i].checked) {
                                        role = ele_role_prev[i].value;
                                        previous_role = ele_role_prev[i].value;
                                    }
                                }
                            var img = "";

                            //alert(role);


                            function updateProfile() {
                                var first_name = document.getElementById("first_name").value;
                                var middle_name = document.getElementById("middle_name").value;
                                var last_name = document.getElementById("last_name").value;
                                var username = document.getElementById("username").value;
                                var email = document.getElementById("email").value;
                                var bio = document.getElementById("bio").value;

                                var f_password = document.getElementById('f-password').value;
                                var r_password = document.getElementById('r-password').value;
                                //alert(f_password);
                                //alert("hsdaj");
                                //alert(r_password);
                                /*for (i = 0; i < ele.length; i++) {
                                    if (ele[i].checked) {
                                        role = ele[i].value;
                                    }

                                }*/

                                /*var reg= /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                                var result= reg.test(eamil);
                                alert(result);*/

                                //alert(bio);
                                let email_check = document.getElementById("email").value;
                                let first_check = document.getElementById("first_name").value;
                                let last_check = document.getElementById("last_name").value;
                                var ele_role = document.getElementsByName('r-role');
                                //let username = document.getElementById("username").value;
                                for (i = 0; i < ele_role.length; i++) {
                                    if (ele_role[i].checked) {
                                        role = ele_role[i].value;
                                    }
                                }
                                var e = document.getElementById("countryCode");
                                var phone_code = e.value;
                                var phone_number = document.getElementById("phone_number").value;
                                //alert(bio);
                                //let current_check = document.getElementById("current_password").value;
                                //let code_check = document.getElementById("phone_code").value;
                                //let number_check = document.getElementById("phone_number").value;
                                let new_check = document.getElementById("f-password").value;
                                let repeat_check = document.getElementById("r-password").value;
                                if ((new_check != "" && repeat_check != "" && new_check == repeat_check)) {
                                    var popup5 = document.getElementById("passwordHelp");
                                    popup5.style.display = "none";
                                    if (first_check != "") {

                                        if (last_check != "") {

                                            var popup4 = document.getElementById("firstHelp");

                                            popup4.style.display = "none";
                                            //alert(email_check);
                                            if (email_check != "") {

                                                var popup3 = document.getElementById("lastHelp");
                                                popup3.style.display = "none";
                                                $.ajax({
                                                    url: '{{ route('insertUser') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        first_name: first_name,
                                                        middle_name: middle_name,
                                                        last_name: last_name,
                                                        username: username,
                                                        email: email,
                                                        phone_code: phone_code,
                                                        phone_number: phone_number,
                                                        role: role,
                                                        bio: bio,
                                                        img: img,
                                                        repeat_password: f_password,
                                                        new_password: r_password,

                                                    },
                                                    success: function(response) {
                                                        //alert(response.status);
                                                        //alert(response.rrr);
                                                        // Set the response (image data) as the source for the image element
                                                        //alert(response.email);
                                                        //alert(response.id_return);
                                                        if (response.status == 1) {
                                                            var file = document.getElementById('imageInput').files[0];

                                                            /*if (!file) {
                                                                alert('Please select an image file.');
                                                                return;
                                                            }*/

                                                            // Create a FormData object to send the file data
                                                            var formData = new FormData();
                                                            formData.append('image', file);
                                                            formData.append('id', response.id_return);
                                                            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                                            $.ajax({
                                                                url: '{{ route('storeImageInsert') }}',
                                                                type: 'POST',
                                                                data: formData,
                                                                processData: false, // Prevent jQuery from processing the data
                                                                contentType: false, // Prevent jQuery from setting content-type
                                                                headers: {
                                                                    'X-CSRF-TOKEN': csrfToken
                                                                },
                                                                success: function(response) {
                                                                    //alert(response.t);
          
                                                                },
                                                                error: function(xhr, status, error) {
                                                                    error_alert("Errorr occcured during image storage");

                                                                }
                                                            });
                                                            clearParameters();
                                                            success_alert("Account was successfully added to the network ");
                                                            refresh();
                                                        }
                                                        if (response.email == 0) {
                                                            var popup = document.getElementById("emailHelp");
                                                            popup.style.display = "inline";
                                                            popup.innerHTML = "Provide correct email form";


                                                        } else   if (response.email == 2) {
                                                            var popup = document.getElementById("emailHelp");
                                                            popup.style.display = "inline";
                                                            popup.innerHTML = "Email already exists";
                                                        }else{
                                                            var popup = document.getElementById("emailHelp");
                                                            popup.style.display = "inline";
                                                            popup.innerHTML = "Provide correct email form";


                                                        }
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
                                                        if (response.password != 1) {
                                                            var popup6 = document.getElementById("passwordHelp");
                                                            popup6.style.display = "inline";
                                                            if (response.password == 0) {
                                                                popup6.innerHTML = "Password do not equal";
                                                            } else if (response.password == 2) {
                                                                popup6.innerHTML = "Password needs to have lowercase char";
                                                            } else if (response.password == 3) {
                                                                popup6.innerHTML = "Password needs to have at least one number";

                                                            } else if (response.password == 4) {
                                                                popup6.innerHTML = "Password needs to have uppercase char";

                                                            } else {
                                                                popup6.innerHTML = "Password needs to have at least 8 chars long";
                                                            }

                                                        } else {
                                                            var popup6 = document.getElementById("passwordHelp");
                                                            popup6.style.display = "none";
                                                            document.getElementById("new_password").value = "";
                                                            document.getElementById("repeat_password").value = "";
                                                        }


                                                        //$('#profileImage').attr('src',response.url );

                                                    },
                                                    error: function(xhr, status, error) {
                                                        error_alert("Errorr occur");
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

                                } else {
                                    var popup5 = document.getElementById("passwordHelp");
                                    popup5.style.display = "inline";
                                    popup5.innerHTML = "Passwords must be provided and must equal ";
                                }
                            }
                            /*}else{
                                var popup5 = document.getElementById("passwordHelp");
                            popup5.style.display = "inline";
                            popup5.innerHTML = "Provide all passwords";
                            }*/
                            function refresh() {
                                //alert("jkhasdddddddddddddddddddjk");
                                document.querySelector('#imageInput').files[0] = "";

                                document.getElementById("imagePersoanl").src = "../storage/profile-images/avatar_blank2.jpg";
                                //document.getElementById("profileImage").src = '/storage/profile-images/avatar_blank2.jpg';
                                //$('#profileImage').attr('src', '/storage/profile-images/avatar_blank2.jpg');

                            }

                            function clearParameters() {
                                document.getElementById("first_name").value = "";
                                document.getElementById("middle_name").value = "";
                                document.getElementById("last_name").value = "";
                                document.getElementById("username").value = "";
                                document.getElementById("email").value = "";
                                document.getElementById("bio").value = "";

                                document.getElementById('f-password').value = "";
                                document.getElementById('r-password').value = "";
                                document.getElementById("phone_number").value = "";
                                role = "parttime";
                                document.getElementById('Part-Time').checked = true;

                            }

                            function r_check(id){
                                var r_element = document.getElementById(id);
                               if(r_element.value != role){
                                if(r_element.value != "admin"){
                          previous_role = role;
                                role = r_element.value;
                                }else{
                                    sure_admin(role);
                                }
      
                               }else{
                                alert("dsa");
                               }
                               
                            }
                        </script>



                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function sendEmail() {
            $.ajax({
                url: '{{ route('sendEmail') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Set the response (image data) as the source for the image element
                    alert(response);


                },
                error: function(xhr, status, error) {
                    alert("aas");
                }
            });
        }
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
            function sure_admin(role) {
                Swal.fire({
                    icon: "question",
                    title: "Do you want to grant Administrator access to this account ?",
                    text: "Account will be able to access critical information in network ",
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (!result.isConfirmed) {
                        if(role == "manager"){
                            document.getElementById('Manager').checked = true;
                        }else if(role == "fulltime"){
                            document.getElementById('Full-Time').checked = true;

                        }else if(role == "parttime"){
                            document.getElementById('Part-Time').checked = true;

                        }
                        /*var return_data;
                        $.ajax({
                            url: "../log/delete_ver.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: {
                                email: val_ver
                            },
                            success: function (data) {
                                return_data = data;


                            }
                        });
                        if (return_data == 0) {
                            Swal.fire("User was remove successfully", "", "success");
                        } else {
                            Swal.fire("Error occur", "", "error");
                        }
                        load_ver();*/
                    }
                });
            }
    </script>

</body>

</html>
