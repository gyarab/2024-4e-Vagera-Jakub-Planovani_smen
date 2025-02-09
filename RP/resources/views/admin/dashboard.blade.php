<!--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>-->
<!--  https://bbbootstrap.com/snippets/bootstrap-5-search-bar-microphone-icon-inside-12725910#-->
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link  rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5" rel="stylesheet"> <!--load all styles -->
    <link href="{{ asset('CSS/search.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/notification.css') }}" rel="stylesheet">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <div class="container-fluid">
        <header class="fixed-top">
            <div class="row flex-nowrap border-bottom bg-light" style="height: 50px">
                <div class="col-auto col-2 ">
                    <div class="ps-3 mt-0 ml-2 align-middle">
                        <div class="row">
                            <!--<div class="col-3">
                                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                    class="rounded-circle align-middle">
                            </div>-->
                            <div class="col-12">
                                <!--<h5 class="align-middle" style="display: inline">Plan % Go</h5>-->
                                <img src="{{ URL('images/logo2.png') }}" class="img-fluid d-none d-sm-inline"
                                    style="width:17em; height:3em;">
                            </div>
                            <div class="text-center">
                                <img src="{{ URL('images/new_icon.png') }}" alt="hugenerd" width="40" height="40"
                                    class="rounded-circle d-inline d-sm-none align-center mt-1 ml-1">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-8 col-sm-6 ">
                    <div class="mt-1">
                        <div class="form">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control form-input" placeholder="Search anything...">
                            <span class="left-pan"><i class="fa fa-microphone"></i></span>
                        </div>

                    </div>
                </div>
                <div class="col-auto col-0 col-sm-3 ">
                    <!--<button type="button" class="btn btn-primary position-relative">
                        <i class="bi bi-bell position-relative"></i> <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">+99
                            <span class="visually-hidden">unread messages</span></span>
                    </button>-->
                    <div class="dropdown d-none d-sm-inline" style="float: left; padding: 13px">

                        <a id="dropdownMenu1" href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            style="float: right" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
                            </i>
                        </a>
                        <span class="badge badge-danger">10</span>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenu1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                        <!--<ul class="dropdown-menu dropdown-menu-left pull-right" role="menu"
                            aria-labelledby="dropdownMenu1">
                            <li role="presentation">
                                <a href="#" class="dropdown-menu-header">Notifications</a>
                            </li>
                            <ul class="timeline timeline-icons timeline-sm" style="margin:10px;width:210px">
                                <li>
                                    <p>
                                        Your “Volume Trendline” PDF is ready <a href="">here</a>
                                        <span class="timeline-icon"><i class="fa fa-file-pdf-o"
                                                style="color:red"></i></span>
                                        <span class="timeline-date">Dec 10, 22:00</span>
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        Your “Marketplace Report” PDF is ready <a href="">here</a>
                                        <span class="timeline-icon"><i class="fa fa-file-pdf-o"
                                                style="color:red"></i></span>
                                        <span class="timeline-date">Dec 6, 10:17</span>
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        Your “Top Words” spreadsheet is ready <a href="">here</a>
                                        <span class="timeline-icon"><i class="fa fa-file-excel-o"
                                                style="color:green"></i></span>
                                        <span class="timeline-date">Dec 5, 04:36</span>
                                    </p>
                                </li>
                            </ul>
                            <li role="presentation">
                                <a href="#" class="dropdown-menu-header"></a>
                            </li>
                        </ul>-->
                    </div>

                    <div style="float: right">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle d-none d-sm-inline mt-2"
                            style="float: right" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                            <img src="{{ URL('images/person.jpg') }}" alt="hugenerd" width="30" height="30"
                                class="rounded-circle mx-2 mt-1" style="aspect-ratio: auto;">
                            <div class="row d-inline">
                                <div class="col-12 d-inline">
                                    <span class="d-none d-sm-inline mx-2 text-black">Moje jmeno</span>

                                    <span class="d-none d-sm-inline text-black"><small>Admin</small></span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                            aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-1">

                   <!-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtons"
                            data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">
                            Drop
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                          </ul>
                    
                    </div>-->

                    <div class="dropdown">
                        <a data-mdb-dropdown-init class="dropdown-toggle" href="#" id="Dropdowns"
                            role="button" data-mdb-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="flag-united-kingdom flag m-0"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="Dropdowns">
                            <li>
                                <a class="dropdown-item" href="#"><i
                                        class="flag-united-kingdom flag"></i>English <i
                                        class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i
                                        class="flag-portugal flag"></i>Português</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="row flex-nowrap">

            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light  border border-right-1 border-top-0">
                <div class="d-inline d-sm-none">

                    <br>

                </div>
                <div
                    class="flex-column align-items-center sticky-top align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pt-50 pb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>

                    <ul class="nav nav-wrapper nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <!--<div class="row">
                            <div class="col-12 bg-danger">
                                <h1>hjfas</h1>
                            </div>
                        </div>-->
                        <div class="row " style="display:flex;">
                            <div class="col-12">
                                <li class="nav-item " style="width: auto">
                                    <div class="d-block">
                                        <a href="#" class="nav-link align-middle px-0 text-black ">
                                            <i class="fs-4 bi-house"></i> <span
                                                class="ms-1 d-none d-sm-inline ">Home</span>
                                        </a>
                                    </div>
                                </li>
                            </div>
                        </div>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-speedometer2"></i> <span
                                    class="ms-1 d-none d-sm-inline text-black">Dashboard</span> </a>
                            <ul class="collapse nav flex-column ms-1 text-black" id="submenu1"
                                data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 1 </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 2 </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-table"></i> <span
                                    class="ms-1 d-none d-sm-inline text-black">Orders</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-bootstrap text-black"></i> <span
                                    class="ms-1 d-none d-sm-inline text-black">Bootstrap</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Item</span> 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-grid"></i> <span
                                    class="ms-1 d-none d-sm-inline text-black">Products</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 2</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 3</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 text-black"> <span
                                            class="d-none d-sm-inline text-black">Product</span> 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-black">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown d-inline d-sm-none">
                                <br>
                                <br>
                                <hr>
                            </div>
                            <div class="dropdown d-inline d-sm-none" style="float: right; padding-top: 18px">

                                <a id="dropdownMenu2" href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    style="float: right" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
                                    </i>
                                </a>
                                <span class="badge badge-danger">10</span>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownMenu2">
                                    <li><a class="dropdown-item" href="#">New project...</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4 d-inline d-sm-none">
                        <a href="#"
                            class="d-flex align-items-center text-decoration-none dropdown-toggle text-black"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle text-black">
                            <span class="d-none d-sm-inline mx-1 text-black">loser</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow text-black"
                            aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <h3>Left Sidebar with Submenus</h3>
                <p class="lead">
                    An example 2-level sidebar with collasible menu items. The menu functions like an "accordion" where
                    only a single
                    menu is be open at a time. While the sidebar itself is not toggle-able, it does responsively shrink
                    in width on smaller screens.</p>
                <ul class="list-unstyled">
                    <li>
                        <h5>Responsive</h5> shrinks in width, hides text labels and collapses to icons only on mobile
                    </li>
                </ul>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</body>

</html>
