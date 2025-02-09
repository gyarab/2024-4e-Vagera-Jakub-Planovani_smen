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
</head>

<body id="body-pd">
    <style>
        /* .MultiCarousel {
            float: left;
            overflow: hidden;
            padding: 15px;
            width: 100%;
            position: relative;
        }

        .MultiCarousel .MultiCarousel-inner {
            transition: 1s ease all;
            float: left;
        }

        .MultiCarousel .MultiCarousel-inner .item {
            float: left;
            margin-right: 20px
        }

        .MultiCarousel .MultiCarousel-inner .item>div {
            text-align: center;
            padding: 10px;
            margin: 10px;
            width: 400px;
            max-height: 600px
        }

        .MultiCarousel .leftLst,
        .MultiCarousel .rightLst {
            position: absolute;
            border-radius: 50%;
            top: calc(50% - 40px);
        }

        .MultiCarousel .leftLst {
            left: 0;
        }

        .MultiCarousel .rightLst {
            right: 0;
        }

        .MultiCarousel .leftLst.over,
        .MultiCarousel .rightLst.over {
            pointer-events: none;
            background: #ccc;
        }*/

        .MultiCarousel {
            float: left;
            overflow: hidden;
            padding: 15px;
            width: 100%;
            position: relative;
        }

        .MultiCarousel .MultiCarousel-inner {
            transition: 1s ease all;
            float: left;
        }

        .MultiCarousel .MultiCarousel-inner .item {
            float: left;
            margin-right: 140px;
        }

        .MultiCarousel .MultiCarousel-inner .item>div {
            text-align: center;
            padding: 10px;
            margin: 10px;
            background: #f1f1f1;
            color: #666;
        }

        .MultiCarousel .leftLst,
        .MultiCarousel .rightLst {
            position: absolute;
            border-radius: 50%;
            top: calc(50% - 20px);
        }

        .MultiCarousel .leftLst {
            left: 0;
        }

        .MultiCarousel .rightLst {
            right: 0;
        }

        .MultiCarousel .leftLst.over,
        .MultiCarousel .rightLst.over {
            pointer-events: none;
            background: #ccc;
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
                                            <label for="admin_c" class="form-check-label">Administrators</label>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <input type="checkbox" class="form-check-input" id="manager_c"
                                                name="manager_c" />
                                            <label for="manager_c">Managers</label>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <input type="checkbox" class="form-check-input" id="em_full_c"
                                                name="em_full_c" />
                                            <label for="em_full_c">Full-time employees</label>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <input type="checkbox" class="form-check-input" id="em_part_c"
                                                name="em_part_c" />
                                            <label for="em_part_c">Part-time employees</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <br>
            <br>
            <button type="button" class="btn btn-primary" onclick="saveBoard()" style="float:right">Save</button>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
            <!--<div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header" style="background-color: #009242; height: 25px">
                        </div>
                        <!--<img class="card-img-top img-responsive img-fluid" src="https://www.rozbehamecesko.cz/repository/layout/noimage.png" style="height: 250px" alt="Card image cap">-->
            <!--<img height="150" class="object-fit-cover img-responsive"
                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.d sad sa dsa dsa dsa dsa s   as  sad asdhjhfjkhsajkf hdhskj fhsdh jkfhkdsh khfjshd jhfjkds hfhksd hjkfds  fhdsjh hsdjk fjksdh fhie fhsd
                            </p>
                            <p>For</p>
                        </div>
                        <div class="card-footer">
                            
                                <div style="display: inline">
                                    <img src="{{ URL('images/person.jpg') }}" alt="hugenerd" width="40"
                                        height="40" class="rounded-circle object-fit-cover img-responsive mr-3"
                                        style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                </div>
                                <div class="user__info" style="display: inline">
                                    <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;</h5>


                                </div>
                                <small class="mt-2" style="float: right">2d ago</small>
                           
                        </div>
                    </div>
                </div>
            </div>-->
            <br>
            <br>
            <div id="MultiCarouselInsert" style="display: none">

            </div>
            <div class="row m-md-auto">
                <div class="col-12">
                    <div class="card p-3 mb-2" style="max-height:700px">


                        <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"
                            data-interval="1000">
                            <div class="MultiCarousel-inner">
                                <div class="item" style="width: 400px; paddilng-right: 100px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <!--<img class="card-img-top img-responsive img-fluid" src="https://www.rozbehamecesko.cz/repository/layout/noimage.png" style="height: 250px" alt="Card image cap">-->
                                        <img height="150" class="object-fit-cover img-responsive"
                                        style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                        src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text"
                                                style="overflow: hidden visible;text-overflow: ellipsis;white-space: normal; max-height: 186px">
                                                With supporting text below as a natural lead-in to additionadsak hjdsha
                                                hdash jkhdhsa kjhdkjash kjhdsa hkjdhjsa dh sjahkjd hsah jkdhash udhiua
                                                OHFSD FHDUSA FHDSAHF Oh ihHFIHIHh ihsdh fhsduh fhds hfds fhuewof husd
                                                fhps hfdpil conten dsahj kdhsjah kjdsha jdh asjh djksah kjdsah jkdh
                                                asjkdh asjk hdnuasi hduasi hduasi dhu sahui dhasiu dhasui dhasio dhaso
                                                hdisao hdd uasoihduasi hdu ashduasoi uhdusaio hdusai hduasip dhusiap
                                                hdusap hds aphdusaip dhusiap dhusiap hdusiap hduiasp dhusa dhasio doast.
                                            </p>
                                            <hr>
                                            <p style="float: left"><strong>For : </strong></p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div style="display: inline">
                                                        <img src="{{ URL('images/person.jpg') }}" alt="hugenerd" width="40"
                                                            height="40"
                                                            class="rounded-circle object-fit-cover img-responsive mr-3"
                                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline;float: left">
                                                    </div>

                                                    <h5 class="mt-2" style="display: inline;float: left">&nbsp; John
                                                        Doe&nbsp;&nbsp;</h5>
                                                    <small class="mt-2" style="float:right">2d ago</small>


                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                               <!-- <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="item" style="width:400px">
                                    <div class="card" style="width:400px">
                                        <div class="card-header" style="background-color: #009242; height: 25px">
                                        </div>
                                        <img height="150" class="object-fit-cover img-responsive"
                                            style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;"
                                            src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.
                                            </p>
                                        </div>
                                        <div class="card-footer">

                                            <div style="display: inline">
                                                <img src="{{ URL('images/person.jpg') }}" alt="hugenerd"
                                                    width="40" height="40"
                                                    class="rounded-circle object-fit-cover img-responsive mr-3"
                                                    style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline">
                                            </div>
                                            <div class="user__info" style="display: inline">
                                                <h5 class="mt-1" style="display: inline">&nbsp; John Doe&nbsp;&nbsp;
                                                </h5>


                                            </div>
                                            <small class="mt-2" style="float: right">2d ago</small>

                                        </div>
                                    </div>
                                </div>-->
                                <!--<div class="item" style="width: 400px;">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item" style="width: 400px;">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <p class="lead">Multi Item Carousel</p>
                                        <p>₹ 1</p>
                                        <p>₹ 6000</p>
                                        <p>50% off</p>
                                    </div>
                                </div>
                            </div>-->
                            <button class="btn btn-primary leftLst">
                                <</button>
                                    <button class="btn btn-primary rightLst">></button>
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
                            alert(response);
                            $("#MultiCarouselInsert").html(response);
                        },
                        error: function(response) {
                            alert("dsad");
                        }
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        var itemsMainDiv = ('.MultiCarousel');
                        var itemsDiv = ('.MultiCarousel-inner');
                        var itemWidth = "";

                        $('.leftLst, .rightLst').click(function() {
                            var condition = $(this).hasClass("leftLst");
                            if (condition)
                                click(0, this);
                            else
                                click(1, this)
                        });

                        ResCarouselSize();




                        $(window).resize(function() {
                            ResCarouselSize();
                        });

                        //this function define the size of the items
                        function ResCarouselSize() {
                            var incno = 0;
                            var dataItems = ("data-items");
                            var itemClass = ('.item');
                            var id = 0;
                            var btnParentSb = '';
                            var itemsSplit = '';
                            var sampwidth = $(itemsMainDiv).width();
                            var bodyWidth = $('body').width();
                            $(itemsDiv).each(function() {
                                id = id + 1;
                                var itemNumbers = $(this).find(itemClass).length;
                                btnParentSb = $(this).parent().attr(dataItems);
                                itemsSplit = btnParentSb.split(',');
                                $(this).parent().attr("id", "MultiCarousel" + id);


                                if (bodyWidth >= 1200) {
                                    incno = itemsSplit[3];
                                    itemWidth = sampwidth / incno;
                                } else if (bodyWidth >= 992) {
                                    incno = itemsSplit[2];
                                    itemWidth = sampwidth / incno;
                                } else if (bodyWidth >= 768) {
                                    incno = itemsSplit[1];
                                    itemWidth = sampwidth / incno;
                                } else {
                                    incno = itemsSplit[0];
                                    itemWidth = sampwidth / incno;
                                }
                                $(this).css({
                                    'transform': 'translateX(0px)',
                                    'width': itemWidth * itemNumbers
                                });
                                $(this).find(itemClass).each(function() {
                                    $(this).outerWidth(itemWidth);
                                });

                                $(".leftLst").addClass("over");
                                $(".rightLst").removeClass("over");

                            });
                        }


                        //this function used to move the items
                        function ResCarousel(e, el, s) {
                            var leftBtn = ('.leftLst');
                            var rightBtn = ('.rightLst');
                            var translateXval = '';
                            var divStyle = $(el + ' ' + itemsDiv).css('transform');
                            var values = divStyle.match(/-?[\d\.]+/g);
                            var xds = Math.abs(values[4]);
                            if (e == 0) {
                                translateXval = parseInt(xds) - parseInt(itemWidth * s);
                                $(el + ' ' + rightBtn).removeClass("over");

                                if (translateXval <= itemWidth / 2) {
                                    translateXval = 0;
                                    $(el + ' ' + leftBtn).addClass("over");
                                }
                            } else if (e == 1) {
                                var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                                translateXval = parseInt(xds) + parseInt(itemWidth * s);
                                $(el + ' ' + leftBtn).removeClass("over");

                                if (translateXval >= itemsCondition - itemWidth / 2) {
                                    translateXval = itemsCondition;
                                    $(el + ' ' + rightBtn).addClass("over");
                                }
                            }
                            $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
                        }

                        //It is used to get some elements from btn
                        function click(ell, ee) {
                            var Parent = "#" + $(ee).parent().attr("id");
                            var slide = $(Parent).attr("data-slide");
                            ResCarousel(ell, Parent, slide);
                        }

                    });
                </script>
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


            <div id="all_board">

            </div>
            <br>
            <br>
            <br>
            <br>

        </div>
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
                        alert("123");
                        //alert(response);
                        //structure_load();
                        //sub_object = "";
                        //document.getElementById("h_controler").innerHTML = "Control panel : ";
                    },
                    error: function(response) {
                        alert("dsad");
                    }
                });
                /*$.ajax({


                    url: "../board/add_board.php",
                    method: "POST",
                    data: {
                        color: shex, man: man, part: part, full: full, text: te, caption: ca
                    },
                    success: function (data) {
                        success_alert("Board was successfully added");
                    }
                });*/
            }

            load_boards();
            /** nacteni existujicich zprav na nastence */
            function load_boards() {
                $.ajax({


                    url: '{{ route('loadLargeBoard') }}',
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        alert("123");

                        $("#all_board").html(data);
                    },
                    error: function(response) {
                        alert("dsad");
                    }
                });
            }
        </script>
    </div>
</body>

</html>
