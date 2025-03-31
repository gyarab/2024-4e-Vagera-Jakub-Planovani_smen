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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css " rel="stylesheet">
</head>

<body id="body-pd">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @media (max-width: 767px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        /* medium and up screens */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-end.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(25%);
            }

            .carousel-inner .carousel-item-start.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-25%);
            }
        }

        .carousel-inner .carousel-item-end,
        .carousel-inner .carousel-item-start {
            transform: translateX(0);
        }
    </style>
    <style>
        .in {
            border-radius: 100%;
            height: 30px;
            width: 30px;
            border: solid #aaa;
        }
    </style>
    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <div class="bg-light">


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
<script>
        function success_sweet_alert(message) {
    Swal.fire({
        title: message,
        text: "",
        icon: "success"
    });
}
</script>


        <div class="container-fluid">
            <div class="card p-3 mb-2">
                <div class="row">
                    <div class="col-12">
                        <h3>Board editor</h3>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 col-md-4 flex">

                    <div class="card p-3">
                        <div class="row">
                            <h5>Caption </h5>
                            <hr>
                            <div class="col-12 col-md-10">
                                <input id="caption" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card p-3 mb-2">
                        <div class="row">
                            <h5>Color </h5>
                            <hr>

                            <center>
                                <input id="scolor-1" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #124072;" value="">
                                <input id="scolor-2" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #067088;" value="">
                                <input id="scolor-3" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #056362;" value="">
                                <input id="scolor-4" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #055d2b;" value="">
                                <input id="scolor-5" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #4b8723;" value="">
                                <input id="scolor-6" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #889d1e;" value="">

                                <input id="scolor-7" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #c3b204;" value="">
                                <input id="scolor-8" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #ce8425;" value="">
                                <input id="scolor-9" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color:  #a53d1a;" value="">
                                <input id="scolor-10" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color:  #880002;" value="">
                                <input id="scolor-11" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color:  #6a1161;" value="">
                                <input id="scolor-12" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color:  #4c1862 ;" value="">

                                <input id="scolor-13" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #1965b9;" value="">
                                <input id="scolor-14" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color:  #039ce0;" value="">
                                <input id="scolor-15" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #01969c;" value="">
                                <br>
                                <input id="scolor-16" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #009242;" value="">
                                <input id="scolor-17" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color:  #67ad31 ;" value="">
                                <input id="scolor-18" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #bcd637;" value="">

                                <input id="scolor-19" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #fff002;" value="">
                                <input id="scolor-20" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #fdaf43;" value="">
                                <input id="scolor-21" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #e87034;" value="">
                                <input id="scolor-22" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #eb1c26;" value="">
                                <input id="scolor-23" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #a2288d;" value="">
                                <input id="scolor-24" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #652d90;" value="">

                                <input id="scolor-25" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #81c1e7;" value="">
                                <input id="scolor-26" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #50ddd5;" value="">
                                <input id="scolor-27" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #addc81;" value="">
                                <input id="scolor-28" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #ffffba;" value="">
                                <input id="scolor-29" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #fea698;" value="">
                                <input id="scolor-30" type="button" class="in" onclick="sColor(this.id)"
                                    style="background-color: #b697dd;" value="">
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="card p-3 mb-2">
                        <div class="row">
                            <h5>Image </h5>
                            <hr>
      

                            <input id="file_picker" type="file" class="mt-2" hidden />
                            <img id="board_img" for="file_picker" class="object-fit-cover img-responsive w-100"
                                style="aspect-ratio: auto;white-space: nowrap;" height="190"
                                src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                            <label for="file_picker" class="btn btn-primary mt-2"> <i for="file_picker"
                                    class="fa fa-fw fa-camera "></i>
                            </label>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                            <script>
                                document.getElementById('file_picker').addEventListener('change', function(e) {
                                    if (e.target.files[0]) {

                                        filePreview();
                         
                                    }
                                });

                                function filePreview() {

                                    const preview = document.getElementById('board_img');
                                    const file = document.querySelector('#file_picker').files[0];
                                    const reader = new FileReader();

                                    reader.addEventListener("load", function() {
                                        preview.src = reader.result;
                                    }, false);

                                    if (file) {
                                        reader.readAsDataURL(file);
                                    }
                                }
                            </script>
                        </div>
                    </div>


                    <script>
                        const map1 = new Map();
                        /**hashmapy pro vyber barev */
                        map1.set('#124072', 'scolor-1');
                        map1.set('#067088', 'scolor-2');
                        map1.set('#056362', 'scolor-3');
                        map1.set('#055d2b', 'scolor-4');
                        map1.set('#4b8723', 'scolor-5');
                        map1.set('#889d1e', 'scolor-6');

                        map1.set('#c3b204', 'scolor-7');
                        map1.set('#ce8425', 'scolor-8');
                        map1.set('#a53d1a', 'scolor-9');
                        map1.set('#880002', 'scolor-10');
                        map1.set('#6a1161', 'scolor-11');
                        map1.set('#4c1862', 'scolor-12');

                        map1.set('#1965b9', 'scolor-13');
                        map1.set('#039ce0', 'scolor-14');
                        map1.set('#01969c', 'scolor-15');
                        map1.set('#009242', 'scolor-16');
                        map1.set('#67ad31', 'scolor-17');
                        map1.set('#bcd637', 'scolor-18');

                        map1.set('#fff002', 'scolor-19');
                        map1.set('#fdaf43', 'scolor-20');
                        map1.set('#e87034', 'scolor-21');
                        map1.set('#eb1c26', 'scolor-22');
                        map1.set('#a2288d', 'scolor-23');
                        map1.set('#652d90', 'scolor-24');

                        map1.set('#81c1e7', 'scolor-25');
                        map1.set('#50ddd5', 'scolor-26');
                        map1.set('#addc81', 'scolor-27');
                        map1.set('#ffffba', 'scolor-28');
                        map1.set('#fea698', 'scolor-29');
                        map1.set('#b697dd', 'scolor-30');

                        const map2 = new Map();

                        map2.set('#124072', 'ecolor-1');
                        map2.set('#067088', 'ecolor-2');
                        map2.set('#056362', 'ecolor-3');
                        map2.set('#055d2b', 'ecolor-4');
                        map2.set('#4b8723', 'ecolor-5');
                        map2.set('#889d1e', 'ecolor-6');

                        map2.set('#c3b204', 'ecolor-7');
                        map2.set('#ce8425', 'ecolor-8');
                        map2.set('#a53d1a', 'ecolor-9');
                        map2.set('#880002', 'ecolor-10');
                        map2.set('#6a1161', 'ecolor-11');
                        map2.set('#4c1862', 'ecolor-12');

                        map2.set('#1965b9', 'ecolor-13');
                        map2.set('#039ce0', 'ecolor-14');
                        map2.set('#01969c', 'ecolor-15');
                        map2.set('#009242', 'ecolor-16');
                        map2.set('#67ad31', 'ecolor-17');
                        map2.set('#bcd637', 'ecolor-18');

                        map2.set('#fff002', 'ecolor-19');
                        map2.set('#fdaf43', 'ecolor-20');
                        map2.set('#e87034', 'ecolor-21');
                        map2.set('#eb1c26', 'ecolor-22');
                        map2.set('#a2288d', 'ecolor-23');
                        map2.set('#652d90', 'ecolor-24');

                        map2.set('#81c1e7', 'ecolor-25');
                        map2.set('#50ddd5', 'ecolor-26');
                        map2.set('#addc81', 'ecolor-27');
                        map2.set('#ffffba', 'ecolor-28');
                        map2.set('#fea698', 'ecolor-29');
                        map2.set('#b697dd', 'ecolor-30');

                        /**promene pro vyber barev  */
                        let sprevious2 = "scolor-1";
                        let scodecolor = "#124072";
                        let shex;
                        /**dosazeni barvy primarni barvy po nacteni stranky  */
                        window.addEventListener("load", (event) => {

                            let sclicked_color = document.getElementById(sprevious2);
                            sclicked_color.style.border = "solid black";
                            shex = "#124072";
                        });
                        /** prepis z rgb modelu na hex model  */
                        function sColor(clicked) {
                            let sclicked_color = document.getElementById(clicked);
                            sclicked_color.style.border = "solid black";
                            scodecolor = sclicked_color.style.backgroundColor;
                            /**hex source : http://www.java2s.com/example/nodejs/css/get-background-color-in-hex.html */
                            var srgb = scodecolor.match(/\d+/g);
                            shex = '#' + ('0' + parseInt(srgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(srgb[1], 10).toString(16))
                                .slice(-2) + ('0' + parseInt(srgb[2], 10).toString(16)).slice(-2);
                            let sclicked_color_prev = document.getElementById(sprevious2);
                            if (clicked != sprevious2) {
                                sclicked_color_prev.style.border = "";
                                sprevious2 = clicked;
                            }


                        }
                        /**promene pro vyber barev v editoru */
                        let eprevious2 = "ecolor-1";
                        let ecodecolor = "#124072";
                        let ehex;
                        /** prepis z rgb modelu na hex model v editoru  */
                        function eColor(clicked) {
                            let eclicked_color = document.getElementById(clicked);
                            eclicked_color.style.border = "solid black";
                            ecodecolor = eclicked_color.style.backgroundColor;
                            /**hex source : http://www.java2s.com/example/nodejs/css/get-background-color-in-hex.html */
                            var ergb = ecodecolor.match(/\d+/g);
                            ehex = '#' + ('0' + parseInt(ergb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(ergb[1], 10).toString(16))
                                .slice(-2) + ('0' + parseInt(ergb[2], 10).toString(16)).slice(-2);
                            let eclicked_color_prev = document.getElementById(eprevious2);
                            if (clicked != eprevious2) {
                                eclicked_color_prev.style.border = "";
                                eprevious2 = clicked;
                            }


                        }
                    </script>
                </div>
                <div class="col-12 col-md-8 flex">
                    <div class="card p-3 mb-2">
                        <div class="row">
                            <h5>Text</h5>
                            <hr>


                            <div class="mb-3">

                                <textarea id="areatext" class="form-control" id="exampleFormControlTextarea1" rows="7"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card p-3 mb-2">
                        <div class="row">
                            <h5>For</h5>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <input type="checkbox" class="form-check-input col-12" id="admin_c"
                                                name="admin_c" disabled="true" checked="true" />
                                            <span for="admin_c" class="form-check-label p-1 rounded text-bg-dark">Administrators</span>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <input type="checkbox" class="form-check-input" id="manager_c"
                                                name="manager_c" />
                                            <span class="p-1 rounded text-bg-danger" for="manager_c">Management</span>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <input type="checkbox" class="form-check-input" id="em_full_c"
                                                name="em_full_c" />
                                            <span class="p-1 rounded text-bg-primary" for="em_full_c">Full-time employees</span>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <input type="checkbox" class="form-check-input" id="em_part_c"
                                                name="em_part_c" />
                                            <span class="p-1 rounded text-bg-success" for="em_part_c">Part-time employees</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-3 mb-2">
                        <div class="row">
                            <div class="col-12">
                                <h5>Controller</h5>
                                <hr>
                                <button type="button" class="btn btn-secondary"  onclick="clearData()">Clear</button>
                                <button type="button" class="btn btn-primary" onclick="saveBoard()"
                                    style="float:right;">Save</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card p-3 mb-2">
                        <div class="row">
                            <div class="col-12">
                                <h4>Preview</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
           
            <div class="row">

                <div id="MultiCarouselInsert">

                </div>
                <div class="row mx-auto my-auto justify-content-center">
                    <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div id="content_i">


                                @php
                                    $counter = 0;

                                @endphp
                                @foreach ($board as $b)
                                    @php
                                        $counter++;
                                        $inside = str_replace("\n", '<br>', $b->content);
                                        $inside = str_replace(' ', '&nbsp;', $inside);
                                    @endphp
                                    @if ($counter == 1)
                                        <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                    @endif
                                    <div class="col-12 col-md-3">
                                        <div class="card p-2">
                                            <div class="card">
                                                <div class="card-header"
                                                    style="background-color:{{ $b->color }}; height: 25px">
                                                </div>
                                                @php

                                                    if ($b->image_link != null) {
                                                        $imageUrl = Storage::url($b->image_link);
                                                        $img_exists = 1;
                                                    } else {
                                                        $imageUrl = '';
                                                        $img_exists = 0;
                                                    }
                                                @endphp
                                                @if ($img_exists == 1)
                                                    <img height="150" class="object-fit-cover img-responsive"
                                                        style="aspect-ratio: auto;white-space: nowrap;"
                                                        src="{{ $imageUrl }}">
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <center>{{ $b->caption }} </center>
                                                    </h5>
                                                    <hr>
                                                    <p class="card-text" id="id_board_{{ $b->id_board }}"
                                                        style="overflow: hidden visible;text-overflow: ellipsis;white-space: normal; max-height: 200px">

                                                        {!! nl2br(e($b->content)) !!}
                                                    </p>
                                                    <script></script>
                                          
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-12">
                                                    
                                                        
                                                        </div>
                                                  
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endforeach

                  
                        </div>





                    </div>

                    <a class="carousel-control-prev bg-transparent w-aut text-dark" href="#recipeCarousel"
                        role="button" data-bs-slide="prev">
                        <span class="text-dark" style="font-size: 55px" aria-hidden="true">
                            < </span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut text-dark" href="#recipeCarousel"
                        role="button" data-bs-slide="next">
                        <span class="text-dark" style="font-size: 55px" aria-hidden="true"> > </span>
                    </a>

                </div>
            </div>

        </div>
        <br>
        <br>

        <br>

        <br>
        <div class="row">
            <div class="col-12">
                <div class="card p-3 mb-2">
                    <div class="row">
                        <div class="col-12">
                            <h4>Edit</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $.ajax({
                url: '{{ route('MultiCarouselInsert') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });
            $.ajax({
                url: '{{ route('MultiCarouselInsert2') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });
        </script>
        <script></script>
    </div>
    <script>
        const weekDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        const monthsArr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        const currentDateObj = new Date();
        const currentDay = weekDays[currentDateObj.getDay()];
        const currentDate = currentDateObj.getDate();
        const currentMonth = monthsArr[currentDateObj.getMonth()];
        const currentYear = currentDateObj.getFullYear();
    </script>
    <div class="modal fade w-100" id="myModals" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog w-100 modal-fullscreen">

            <!-- Modal content-->
            <div class="modal-content modal-fullscreen d-flex justify-content-center w-100">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editor panel

                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-12 col-md-2 mb-3 flex">
                                <div class="card p-3">
                                    <div class="row">
                                        <h5>TimeLine</h5>
                                        <hr>
                                        <div class="container_timeline">
                                            <div class="wrapper_timeline p-0">
                                        <div id="timeline_div"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 flex">

                                <div class="card p-3">
                                    <div class="row">
                                        <h5>Caption</h5>
                                        <hr>
                                        <div class="col-12 col-md-10">
                                            <input id="2caption" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card p-3 mb-2">
                                    <div class="row">
                                        <h5>Color </h5>
                                        <hr>

                                        <center>
                                            <input id="ecolor-1" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #124072;"
                                                value="">
                                            <input id="ecolor-2" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #067088;"
                                                value="">
                                            <input id="ecolor-3" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #056362;"
                                                value="">
                                            <input id="ecolor-4" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #055d2b;"
                                                value="">
                                            <input id="ecolor-5" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #4b8723;"
                                                value="">
                                            <input id="ecolor-6" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #889d1e;"
                                                value="">

                                            <input id="ecolor-7" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #c3b204;"
                                                value="">
                                            <input id="ecolor-8" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #ce8425;"
                                                value="">
                                            <input id="ecolor-9" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color:  #a53d1a;"
                                                value="">
                                            <input id="ecolor-10" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color:  #880002;"
                                                value="">
                                            <input id="ecolor-11" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color:  #6a1161;"
                                                value="">
                                            <input id="ecolor-12" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color:  #4c1862 ;"
                                                value="">

                                            <input id="ecolor-13" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #1965b9;"
                                                value="">
                                            <input id="ecolor-14" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color:  #039ce0;"
                                                value="">
                                            <input id="ecolor-15" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #01969c;"
                                                value="">
                                            <br>
                                            <input id="ecolor-16" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #009242;"
                                                value="">
                                            <input id="ecolor-17" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color:  #67ad31 ;"
                                                value="">
                                            <input id="ecolor-18" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #bcd637;"
                                                value="">

                                            <input id="ecolor-19" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #fff002;"
                                                value="">
                                            <input id="ecolor-20" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #fdaf43;"
                                                value="">
                                            <input id="ecolor-21" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #e87034;"
                                                value="">
                                            <input id="ecolor-22" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #eb1c26;"
                                                value="">
                                            <input id="ecolor-23" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #a2288d;"
                                                value="">
                                            <input id="ecolor-24" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #652d90;"
                                                value="">

                                            <input id="ecolor-25" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #81c1e7;"
                                                value="">
                                            <input id="ecolor-26" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #50ddd5;"
                                                value="">
                                            <input id="ecolor-27" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #addc81;"
                                                value="">
                                            <input id="ecolor-28" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #ffffba;"
                                                value="">
                                            <input id="ecolor-29" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #fea698;"
                                                value="">
                                            <input id="ecolor-30" type="button" class="in"
                                                onclick="eColor(this.id)" style="background-color: #b697dd;"
                                                value="">
                                        </center>
                                    </div>
                                </div>
                                <br>
                                <div class="card p-3 mb-2">
                                    <div class="row">
                                        <h5>Image </h5>
                                        <hr>
                   
                                        <input id="file_picker2" type="file" class="mt-2" hidden />
                                        <img id="board_img2" for="file_picker2"
                                            class="object-fit-cover img-responsive w-100"
                                            style="aspect-ratio: auto;white-space: nowrap;" height="190"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <label for="file_picker2" class="btn btn-primary mt-2"> <i for="file_picker2"
                                                class="fa fa-fw fa-camera "></i>
                                        </label>

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                        <script>
                                            document.getElementById('file_picker2').addEventListener('change', function(e) {

                                                if (e.target.files[0]) {
                                                    filePreview2();

                                                }
                                            });

                                            function filePreview2() {
                                                const preview2 = document.getElementById('board_img2');

                                                const file_2 = document.querySelector('#file_picker2').files[0];

                                                const reader2 = new FileReader();


                                                reader2.addEventListener("load", function() {
                                                    preview2.src = reader2.result;
                                                }, false);
                                                if (file_2) {
                                                    reader2.readAsDataURL(file_2);
                                                }


                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-7 flex">
                                <div class="card p-3 mb-2">
                                    <div class="row">
                                        <h5>Text</h5>
                                        <hr>


                                        <div class="mb-3">

                                            <textarea id="areatext2" class="form-control" id="exampleFormControlTextarea1" rows="7"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card p-3 mb-2">
                                    <div class="row">
                                        <h5>For</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <input type="checkbox" class="form-check-input col-12"
                                                            id="2admin_c" name="2admin_c" disabled="true"
                                                            checked="true" />
                                                        <span for="2admin_c"
                                                        class="p-1 rounded text-bg-dark">Administrators</span>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="2manager_c" name="2manager_c" />
                                                        <span class="p-1 rounded text-bg-danger" for="2manager_c">Managers</span>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="2em_full_c" name="2em_full_c" />
                                                        <span class="p-1 rounded text-bg-primary" for="2em_full_c">Full-time employees</span>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="2em_part_c" name="2em_part_c" />
                                                        <span class="p-1 rounded text-bg-success" for="2em_part_c">Part-time employees</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card p-3 mb-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Controller</h5>
                                            <hr>
                                            <button type="button" class="btn btn-danger" onclick="deleteBoard()"
                                               >Delete</button>
                                            <button type="button" class="btn btn-primary" onclick="updateBoard()"
                                                style="float:right;">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>







                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var id_update = 0;
        const myModal = document.getElementById('myModals')
        const myInput = document.getElementById('edit_opener')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
    <div class="row mx-1">
        <div class="col-12">
            <div id="all_board">

            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    </div>
    <script>
        let items = document.querySelectorAll('.carousel .carousel-item')

        items.forEach((el) => {
            const minPerSlide = 4
            let next = el.nextElementSibling
            for (var i = 1; i < minPerSlide; i++) {
                if (!next) {
                    next = items[0]
                }
                let cloneChild = next.cloneNode(true)
                el.appendChild(cloneChild.children[0])
                next = next.nextElementSibling
            }
        })
    </script>



    <script>
        function saveBoard() {
            var man = 0;
            var part = 0;
            var full = 0;
            let te = document.getElementById("areatext").value;
            let ca = document.getElementById("caption").value;
            if (document.getElementById("manager_c").checked == true) {
                man = 1;
            }
            if (document.getElementById("em_full_c").checked == true) {
                full = 1;
            }
            if (document.getElementById("em_part_c").checked == true) {
                part = 1;
            }



            $.ajax({
                url: '{{ route('saveBoard') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    color: shex,
                    man: man,
                    part: part,
                    full: full,
                    text: te,
                    caption: ca

                },
                success: function(response) {

                    // Get the selected file
                    success_sweet_alert("Board saved successfully");
                    load_boards();
                    if ($('#file_picker')[0].files.length != 0) {
                        var file = document.getElementById('file_picker').files[0];
                        if (!file) {
                            return;
                        }

                        // Create a FormData object to send the file data
                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('id', response.id_return);
                        // Get the CSRF token
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        // AJAX request to upload the image
                        $.ajax({
                            url: '{{ route('storeImageBoard') }}',
                            type: 'POST',
                            data: formData,
                            processData: false, // Prevent jQuery from processing the data
                            contentType: false, // Prevent jQuery from setting content-type
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {

                            },
                            error: function(xhr, status, error) {
                                error_sweet_alert("RRRRRRRRRRRR");

                            }
                        });
                    }

                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });

        }

        function updateBoard() {
            var man = 0;
            var part = 0;
            var full = 0;
            let te2 = document.getElementById("areatext2").value;
            let ca2 = document.getElementById("2caption").value;
            if (document.getElementById("2manager_c").checked == true) {
                man = 1;
            }
            if (document.getElementById("2em_full_c").checked == true) {
                full = 1;
            }
            if (document.getElementById("2em_part_c").checked == true) {
                part = 1;
            }
            //succes_alert("Board successfully updated");
            $.ajax({
                url: '{{ route('updateBoard') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    color: ehex,
                    man: man,
                    part: part,
                    full: full,
                    text: te2,
                    caption: ca2,
                    id_board: id_update,
                },
                success: function(response) {

                    success_sweet_alert("Board updated successfully");
                    load_boards();
                    if ($('#file_picker2')[0].files.length != 0) {
                        var file = document.getElementById('file_picker2').files[0];
                        if (!file) {
                            //alert('Please select an image file.');
                            return;
                        }

                        // Create a FormData object to send the file data
                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('id', id_update);
                        // Get the CSRF token
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        // AJAX request to upload the image
                        $.ajax({
                            url: '{{ route('updateImageBoard') }}',
                            type: 'POST',
                            data: formData,
                            processData: false, // Prevent jQuery from processing the data
                            contentType: false, // Prevent jQuery from setting content-type
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {

                            },
                            error: function(xhr, status, error) {
                                error_sweet_alert("RRRRRRRRRRRR");

                            }
                        });
                    }


                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });

        }
        load_boards();
        var number_load = 0;
        /** nacteni existujicich zprav na nastence */
        function editLoader(value) {
            id_update = value;
            loadTimeline(5);
            $.ajax({


                url: '{{ route('loadBoardData') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: value
                },
                success: function(response) {
                    editClean();
                    document.getElementById("2caption").value = response.caption;

                    if (response.management == 1) {
                        document.getElementById("2manager_c").checked = true;
                    }
                    if (response.employee_full == 1) {
                        document.getElementById("2em_full_c").checked = true;
                    }
                    if (response.employee_part == 1) {
                        document.getElementById("2em_part_c").checked = true;
                    }
                    document.getElementById("areatext2").value = response.content;
                    eColor(map2.get(response.color));

                    document.getElementById("board_img2").src = response.imageUrl;

                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });
        }

        function editClean() {
            document.getElementById("2manager_c").checked = false;
            document.getElementById("2em_full_c").checked = false;
            document.getElementById("2em_part_c").checked = false;
            document.getElementById("areatext2").value = "";
            document.getElementById("2caption").value = "";
            document.getElementById("board_img2").src = "";
            document.getElementById('file_picker2').value = "";

        }

        function load_boards() {
            $.ajax({


                url: '{{ route('loadLargeBoard') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {

                    $("#all_board").html(data);
                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });
        }

        function loadTimeline(number) {
            number_load += number;
            $.ajax({
            url: '{{ route('loadBoardTimeline') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id_board: id_update,
                    number: number
                },
                success: function(data) {

                    $("#timeline_div").html(data);
                },
                error: function(response) {
                    error_sweet_alert("dsa ----d");
                }
            });

        }
        function clearData(){
            document.getElementById("manager_c").checked = false;
            document.getElementById("em_full_c").checked = false;
            document.getElementById("em_part_c").checked = false;
            document.getElementById("areatext").value = "";
            document.getElementById("caption").value = "";
            document.getElementById("board_img").src = "https://www.rozbehamecesko.cz/repository/layout/noimage.png";
            document.getElementById('file_picker').value = "";  
        }
        function deleteBoard(){
            $.ajax({
            url: '{{ route('deleteBoard') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id_board: id_update,
                },
                success: function(data) {
                    $('#myModals').modal('hide');
                    load_boards();
                    success_sweet_alert("Board deleted successfully");
                },
                error: function(response) {
                    error_sweet_alert("dsad");
                }
            });
        }
    </script>
    <button id="modalVerification" type="button" class="btn btn-outline-primary btn-sm " style="float: right"
        data-bs-toggle="modal" data-bs-target="#modalVer">Details</button>


    <!-- Modal -->
    <div class="modal fade w-100" id="modalVer" tabindex="-1" data-bs-backdrop="false"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="container modal-dialog w-100 ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Verification code

                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                </div>
            </div>
        </div>
    </div>
    <script>
        function error_sweet_alert(message) {
            Swal.fire({
                title: "Connection failed",
                text: ,
                icon: "error"
            });

        }



    </script>
    </div>
</body>

</html>
