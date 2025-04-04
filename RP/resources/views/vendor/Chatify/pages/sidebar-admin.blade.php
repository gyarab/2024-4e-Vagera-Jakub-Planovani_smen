<style>
    @media only screen and (max-width: 600px) {
  .example {width: 61px;}
}
@media only screen and (min-width: 600px) {
  .example {width: 100%;}
}
</style>
<div class="l-navbar" id="nav-bar">
    <nav class="nav bg-white example" >
        <div id="menu">
            <div>

                <a href="#" class="nav_logo"> 
                    <img src="{{ URL('images/big_icon.png') }}" alt="hugenerd" width="20" height="20">
                    <span class="nav_logo-name text-dark">Clock Work</span> </a>
                <div class="nav_list">
                    <a href="/admin/dashboard-main" class="nav_link active mb-1 text-dark link-secondary"><i
                            class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                    <a href="/admin/employee-list" class="nav_link mb-1 text-dark link-secondary"> <i
                            class='bx bx-user nav_icon'></i> <span class="nav_name">Employees</span> </a>
                    <a href="/admin/shift-model/create-model-shift" class="nav_link mb-1 text-dark link-secondary"> <i class="bi bi-card-heading nav_icon"></i> <span class="nav_name">Shift models
                            </span>
                        </a> <a href="/admin/offers" class="nav_link mb-1 text-dark link-secondary"
                        class=" nav_link nav-link px-0 mx-0 align-middle"> <i class='bx bx-hash nav_icon' ></i> <span class="nav_name">Shift offers</span> </a>
                            <a href="/admin/confirm-offer-request" class="nav_link mb-1 text-dark link-secondary"
                        class=" nav_link nav-link px-0 mx-0 align-middle"> <i class='bx bx-folder nav_icon'
                            data-bs-parent="#menu"></i> <span class="nav_name">Shift requests</span> </a>
                        </a> <a href="/admin/object-model/create-model-object" class="nav_link mb-1 text-dark link-secondary"> <i class='bx bx-building-house nav_icon' ></i> <span class="nav_name">Objects
                            </span>
                        </a> <a href="/chatify" class="nav_link mb-1 text-dark link-secondary"
                        class=" nav_link nav-link px-0 mx-0 align-middle"> <i
                        class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Chat</span> </a>

                    <li class="mx-0">
                        <a href="#submenu6" class="nav_link mb-1 text-dark link-secondary"
                            data-bs-toggle="collapse" class=" nav_link nav-link px-0 mx-0 align-middle">
                            <i class='bi bi-calendar-week nav_icon'></i> <span
                                class="ms-1 d-none d-sm-inline">Calendar</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu6" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="/admin/calendar-view" class="nav_link mb-1 text-dark link-secondary"
                                    class="nav-link px-0"> <i class="bi bi-eye nav_icon"></i> <span class="d-none d-sm-inline">View calendar</span></a>
                            </li>
                            <li>
                                <a href="/admin/calendar" class="nav_link mb-1 text-dark link-secondary"
                                    class="nav-link px-0"> <i class="bi bi-pen nav_icon"></i> <span class="d-none d-sm-inline">Edit calendar</span> </a>
                            </li>
                        </ul>
                    </li>


                    <div ><a href="/admin/my-statistics" class="nav_link  mb-1 text-dark link-secondary"> <i
                                class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">My statistics</span>
                        </a>
                    </div>
                    <div ><a href="/admin/my-permanent-time-options" class="nav_link  mb-1 text-dark link-secondary"> <i class='bx bx-briefcase-alt nav_icon' ></i> <span class="nav_name">My time options</span>
                        </a>
                    </div>
                    <div ><a href="/admin/device-register" class="nav_link  mb-1 text-dark link-secondary"> <i class='bx bx-devices nav_icon' ></i> <span class="nav_name">Devices</span>
                    </a>
                </div>
                <div ><a href="/admin/board-information" class="nav_link  mb-1 text-dark link-secondary"> <i class='bx bx-chalkboard nav_icon' ></i> <span class="nav_name">Info-board</span>
                </a>
                </div>



                </div>







            </div>
            <div class="dropdown pb-4 d-inline d-sm-none " style="overflow-x: visible;" id="ne">
                <a href="#" class=" align-items-center text-decoration-none text-black"
                    style="margin-left: 20px" id="dropdownUser4" data-bs-toggle="dropdown" aria-expanded="false"
                    style="overflow-x: visible;">
                    <img src="" alt="hugenerd" width="30" height="30" id="smallProfileHeader"
                        class="rounded-circle text-black">
                    <span class="d-none d-sm-inline mx-1 text-black">ICON</span>
                </a>

                <ul id="drop_menu" class="dropdown-menu dropdown-menu-dark text-small shadow text-black;"
                    style="overflow-x: visible;" aria-labelledby="dropdownUser4" data-toggle="dropdown">
                    <li><a class="dropdown-item" href="/admin/editor-profile"><i class="bi bi-person"></i></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>    
                        <form method="POST" >
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>       
                        <!--<form method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                            <a class="dropdown-item" :href="route('logout')"
                                onclick="event.preventDefault();this.closest('form').submit();"> <i class="bi bi-box-arrow-right"></i></a>
--->


                      
                    </li>
                   
                </ul>
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

                },
                error: function(xhr, status, error) {
                    //alert('Error fetching image:', error);
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
        

                },
                error: function(xhr, status, error) {
                    //alert('Error fetching image:', error);
                }
            });
        </script>

    </nav>

</div>
