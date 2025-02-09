<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!--<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>-->

            <!--<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>-->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="container ">
        <div class="row">
            <div class="col mb-3">
                <div class="card shadow bg-white rounded">
                    <div class="card-body">
                        <div class="e-profile">
                            <div class="row">
                                <div class="col-12 col-sm-auto mb-3">
                                    <div class="mx-auto" style="width: 140px;">
                                        <div class="d-flex justify-content-center align-items-center rounded"
                                            style="height: 140px; background-color: rgb(233, 236, 239);">
                                            <span
                                                style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">John Smith dsfaf as fasf as</h4>
                                        <p class="mb-0">@johnny.s</p>
                                        <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                                        <div class="mt-2">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fa fa-fw fa-camera"></i>
                                                <span>Change Photo</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-center text-sm-right">
                                        <span class="badge badge-secondary">administrator</span>
                                        <div class="text-muted"><small>Joined 09 Dec 2017</small></div>

                                        <button id="modalbtn" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Launch demo modal
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            dsa
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
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
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                            </ul>
                            <div class="tab-content pt-3">
                                <div class="tab-pane active">
                                    <form class="form" novalidate="">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input class="form-control" type="text"
                                                                        name="name" placeholder="John Smith"
                                                                        value="John Smith">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input class="form-control" type="text"
                                                                        name="name" placeholder="John Smith"
                                                                        value="John Smith">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input class="form-control" type="text"
                                                                        name="name" placeholder="John Smith"
                                                                        value="John Smith">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input class="form-control" type="text"
                                                                name="username" placeholder="johnny.s"
                                                                value="johnny.s">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="user@example.com">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                                                    <div class="col-12">
                                                        <x-primary-button
                                                            style="width: 100px; float: right">{{ __('Save') }}</x-primary-button>
                                                        <!--<main>
                                        <div id="qrcode"></div>
                                    </main>-->
                                                        <script>
                                                            var qrcode = new QRCode("qrcode",
                                                                "https://www.geeksforgeeks.org");
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <div class="form-group">
                                                            <label>About</label>
                                                            <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
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
                                                            <label>Current Password</label>
                                                            <input class="form-control" type="password"
                                                                placeholder="••••••">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input class="form-control" type="password"
                                                                placeholder="••••••">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>Confirm <span
                                                                    class="d-none d-xl-inline">Password</span></label>
                                                            <input class="form-control" type="password"
                                                                placeholder="••••••">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                                                <div class="mb-2"><b>Keeping in Touch</b></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Email Notifications</label>
                                                        <div class="custom-controls-stacked px-2">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="notifications-blog" checked="">
                                                                <label class="custom-control-label"
                                                                    for="notifications-blog">Blog posts</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="notifications-news" checked="">
                                                                <label class="custom-control-label"
                                                                    for="notifications-news">Newsletter</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="notifications-offers" checked="">
                                                                <label class="custom-control-label"
                                                                    for="notifications-offers">Personal Offers</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="theFile" class="form-label">Default file input example</label>
        <input id="theFile" class="form-control" type="file">
    </div>
    <script>
        function save_image() {


            //alert(formData);
        }
        document.getElementById('theFile').addEventListener('change', function(e) {
            if (e.target.files[0]) {
                //var formData = new FormData();
                //formData.append('file', $('#theFile').get(0).files[0]);
                //formData.append('fileName', $("#theFile").val());
                //alert(formData);
                //document.body.append('You selected ' + e.target.files[0].name);
                var message = "123";
                /*$.ajax({
                    type: "POST",
                    url: '{{ route('Filestore') }}',
                    success: function(data) {
                        alert("hjkasdhjk");
                    },
                    error: function(response) {
                        alert("dsa");
                    }

                });*/
            }
        });
    </script>
</x-app-layout>
