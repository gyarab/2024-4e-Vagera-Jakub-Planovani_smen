
<header class="header bg-white" id="header">
    <div class="header_toggle "> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto col-10 col-sm-8 ">
                <div class="mt-0 px-3">
                    <div class="form">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control form-input" placeholder="Search anything...">
                        <span class="left-pan"><i class="fa fa-microphone"></i></span>
                    </div>

                </div>
            </div>
            <div class="col-auto col-0 d-none d-sm-inline col-sm-3 ">
                <div class="dropdown d-none d-sm-inline mt-0" style="float: left;">

                    <a id="dropdownMenu1" href="#"
                        class="d-flex text-white text-decoration-none dropdown-toggle mt-2"
                        style="float: right;position:absolute" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
                        </i>
                    </a>
                    <span class="badge badge-danger" style="position:absolute">10</span>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow mt-2 "
                        aria-labelledby="dropdownMenu1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>

                <div style="float: right;max-width: 70%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                    <a href="#"
                        class="d-flex align-items-center text-white text-decoration-none dropdown-toggle d-none d-sm-inline mt-1"
                        id="dropdownUser1" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <img src="" id="profileHeader" alt="Profile image" width="30"
                            height="30" class="rounded-circle mx-2 mt-1 object-fit-cover"
                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;">

                        <div class="row d-inline d-none d-lg-inline">
                            <div class="col-12 d-inline"
                                style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                                    <h6 id="name_header" class="d-none d-sm-inline mx-2 text-black"
                                        style="max-width: 300px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                                    </h6>


                                    <span class="d-none d-sm-inline text-black"><small> Admin</small></span>
                            </div>

                        </div>

                        <script>
                            $.ajax({
                                url: '{{ route('showProfileImage') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                },
                                success: function(response) {

                                    $('#profileHeader').attr('src', response.url);
                                    $('#smallProfileHeader').attr('src', response.url);
                                    //alert(response.url);

                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image:', error);
                                }
                            });
                            $.ajax({
                                url: '{{ route('parameters') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                },
                                success: function(response) {
                                    
                                    document.getElementById("name_header").innerHTML = response.first_name + " "+ response.middle_name + " "  + response.last_name;
                                    //alert(response.id);
                                    //$('#profileHeader').attr('src', response.url);
                                    //$('#smallProfileHeader').attr('src', response.url);
                                    //alert(response.url);

                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image:', error);
                                }
                            });
                        </script>

                    </a>


                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow mt-2" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" :href="route('logout')"
                                    onclick="event.preventDefault();this.closest('form').submit();">Sign out</a>



                            </form>
                        </li>
                    </ul>


                    <!--<div class="dropdown mt-2" style="float: right">

                        <ul class="dropdown-menu" aria-labelledby="dropdownUser1">
                            <li>
                                <a class="dropdown-item" href="#"><span class="fi fi-gb"></span>&nbsp; English
                                    <i class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><span class="fi fi-cz"></span>
                                    </i>&nbsp;Czech</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#"><span
                                        class="fi fi-de"></span></i>&nbsp;Deutsch</a>
                            </li>

                        </ul>
                    </div>-->
                </div>
            </div>
            <div class="col-2 col-md-1">
                <div class="dropdown mt-2" style="float: right; margin-right: 45px;">
                    <a data-mdb-dropdown-init class="dropdown-toggle " href="#" id="Dropdowns" role="button"
                        data-mdb-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false"  style="position:absolute">
                        <span class="fi fi-gb" style="font-size: 1.3em;"></span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="Dropdowns">
                        <li>
                            <a class="dropdown-item" href="#"><span class="fi fi-gb"></span>&nbsp; English5
                                <i class="fa fa-check text-success ms-2"></i></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><span class="fi fi-cz"></span>
                                </i>&nbsp;Czech</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#"><span
                                    class="fi fi-de"></span></i>&nbsp;Deutsch</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>-->
</header>
