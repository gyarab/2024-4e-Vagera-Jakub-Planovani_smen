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
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
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

    <link href="{{ asset(path: 'CSS/timeline.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">

    <!-- Latest compiled and minified JavaScript -->

</head>

<body id="body-pd">
    <script>
        var doneChnages = false;
    </script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    @include('vendor.Chatify.pages.header-admin')
    @include('vendor.Chatify.pages.sidebar-admin')
    @include('admin.scripts')

    <div class="height-100 bg-light">



        <input type="hidden" id="kpk" name="kpk" value="2024-01">
        <div>
            <input type="hidden" id="help" name="help">
            <input type="hidden" id="help2" name="help2">
            <input type="hidden" id="hideYM">


            <div class="row mt-2">

                <!-- Modal -->
                <div class="modal fade w-100" id="detailModal" tabindex="-1" data-bs-backdrop="false"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="container modal-dialog modal-dialog-centered w-100 modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Details

                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h6>Comment</h6>
                                        <hr>

                                        <textarea name="textModal" id="textModal" style="width: 100%; height:300px" maxlength="300" placeholder="Add comment..."
                                            autofocus></textarea>

                                        <div id="textcount">
                                            <div style="float: right">
                                                <span id="current">0</span>
                                                <span id="maximum">/ 300</span>
                                            </div>
                                        </div>

                                        <script>
                                            var offer_array = new Array();

                                            var details_id_global = 0;
                                            var repeat_counter = 0;
                                        </script>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <h6>Controllers</h6>
                                        <hr>
                                        <button id="closeOffer" class="btn btn-sm btn-danger" style="float: right"
                                            onclick="closeOffer()"><i class="bi bi-x-octagon "
                                                style="margin-right: 3px"></i>Close offer</button>
                                        <button id="offerShift" class="btn btn-sm btn-primary" style="float: right"
                                            onclick="offerShift()"><i class="bi bi-clipboard-data"
                                                style="margin-right: 3px"></i>Offer shift</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer float-start">
                                <div class=" ">

                                    <button onclick="saveDetails()" class="btn btn-primary" data-bs-dismiss="modal">
                                        Save comment
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>



                <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                <div class="col-12 col-md-4">

                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="background: #4CAF50;color:#ffffff;height:42px">Objects:</span>
                        </div>
                        <select id="select_obj" class="form-select form-select-sm" name="option" id="option"
                            style="font-size:15px;display:inline; height:42px">
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div id="objects_div">
                        <select name="objects" id="objects" multiple>

                        </select>
                    </div>
                </div>
            </div>






            <div class="row mt-3">
                <div class="col-12 col-md-2">
                    <div class="p-2 mb-2" style="background: #4CAF50;color:#ffffff;">Shifts:
                    </div>
                </div>
                <div class="col-12 col-md-10">
                    <div id="shi_load_div">
                        <select name="shi_load" id="shi_load" multiple>

                        </select>
                    </div>
                </div>
            </div>







            <script>
                renderObjectSelect();
                var passedSavedata = Array();
                var tttttt = 0;

                function renderObjectSelect() {
                    $.ajax({
                        url: '{{ route('selectMainObjects') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            document.getElementById("select_obj").innerHTML = response;

                        },
                        error: function(xhr, status, error) {
                            alert('Error fetching image render:', error);
                        }
                    });
                }



                var f_load = 0;
                var obj_search = new Array();
                var pos_search = new Array();

                function cal_obj_load(input_obj) {

                    $.ajax({
                        url: '{{ route('cal_obj_load_view') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            input: input_obj,

                        },
                        success: function(data) {
                            document.getElementById('shi_load_div').innerHTML =
                                '<select name="shi_load" id="shi_load" multiple></select>';
                            document.getElementById("objects_div").innerHTML =
                                '<select name="objects" id="objects" multiple></select>';
                            document.getElementById('objects').innerHTML = data.objects;
                            document.getElementById("shi_load").innerHTML = data.shifts;
                            shi_search = [];
                            obj_search = [];
                            obj_search.push('|--ALL--|');
                            shi_search.push('|--ALL--|');


                            new MultiSelectTag('objects', {
                                rounded: true, // default true
                                shadow: false, // default false
                                placeholder: 'Search', // default Search...
                                tagColor: {
                                    textColor: '#327b2c',
                                    borderColor: '#92e681',
                                    bgColor: '#eaffe6',
                                },
                                onChange: function(values) {
                                    obj_search = new Array();


                                    values.forEach(item => {
                                        console.log(`${item.value}`);

                                        if (!obj_search.includes(`${item.value}`)) {
                                            obj_search.push(`${item.value}`);

                                        }




                                    });
                                    repeat_counter = 2;
                                    filter(document.getElementById("select_obj").value);
                                }
                            })

                            new MultiSelectTag('shi_load', {
                                rounded: true, // default true
                                shadow: false, // default false
                                placeholder: 'Search', // default Search...
                                tagColor: {
                                    textColor: '#327b2c',
                                    borderColor: '#92e681',
                                    bgColor: '#eaffe6',
                                },
                                onChange: function(values) {
                                    shi_search = [];
                                    console.log(values)

                                    values.forEach(item => {
                                        shi_search.push(`${item.value}`);

                                    });
                                    repeat_counter = 2;
                                    filter(document.getElementById("select_obj").value);
                                }

                            })

                        },
                        error: function(xhr, status, error) {
                            alert('Error fetching image cal:', error);
                        }
                    });
                }

                var type_obj = 504;







                $('#select_obj').change(function() {
                    obj_search = [];
                    shi_search = [];
                    load_check1 = 0;
                    load_check2 = 0;
                    load_check3 = 0;
                    repeat_counter = 1;
                    cal_obj_load($(this).val());

                });


                var load_check1 = 0;
                var load_check2 = 0;
                var load_check3 = 0;
                var arridc = new Array();


                $(document).on("ajaxComplete", function() {
                    var input_obj = document.getElementById("select_obj").value;
                    if (repeat_counter == 0) {
                        cal_obj_load(document.getElementById("select_obj").value);
                        repeat_counter++;
                    } else if (repeat_counter == 1) {
                        repeat_counter++;
                        filter(document.getElementById("select_obj").value);
                    } else if (repeat_counter == 2) {
                        repeat_counter++;
                        dataLoader();
                    } else if (repeat_counter == 3) {
                        repeat_counter++;

                    }


                });


                var arrcols = new Array();
                var arrcolor = new Array();
                var arrwdw = new Array(7);
                var arrcolordark = new Array();
                var arrtish = new Array();
                var arrobj = new Array();
                var arrname = new Array();
                var arrdescription = new Array();
                var arricons = new Array();
            </script>



            <div class="row">
                <div class='col-12 col-md-2' style="padding-right: 0px">

                    <div class="card h-100">
                        <div class="px-3 ">
                            <center>
                                <h5 class="mb-4" style="margin-top: 21px">Employees statistics</h5>
                            </center>

                            <hr>
                        </div>
                        <div class="w-100 mh-100 h-100">
                            <div class="h-100" id="employee_table">
                            </div>


                        </div>
                    </div>

                </div>
                <div class='col-12 col-md-10' style="padding-left: 0px">

                    <div class="card p-3 mb-2 ">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-4">
                                    <div class="icons">
                                        <span id="prev" class="material-symbols-rounded" style="float:left"><i
                                                class="bi bi-arrow-left-circle h4"></i></span>
                                        <h4 style="display:inline;float:left">&nbsp;&nbsp;Previous month</h4>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <center>
                                        <h4 id="current_date" style="display: inline" class="current-date"></h4>
                                    </center>
                                </div>
                                <div class="col-4">
                                    <div class="icons">
                                        <span id="next" class="material-symbols-rounded" style="float:right"><i
                                                class="bi bi-arrow-right-circle h4"></i></span>
                                        <h4 style="display:inline;float:right">Next month&nbsp;&nbsp;</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div style="width: 100%;overflow: auto; max-height: 65;height: 65vh;">

                            <div class="calendar">
                                <table>
                                    <tr>
                                    </tr>
                                    <table class="days" style="border-collapse:collapse;">
                                        <div class="hoverTable">
                                            <!--<tr>
                                            </tr>-->
                                        </div>
                                    </table>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <script>
                var modal = "";
                var btn = "";
            </script>
            <script>
                var name_table = new Array();
                var id_table = new Array();
                var count_table = new Array();
                var time_table = new Array();

                function load_employee_table() {
                    var from = new Array();
                    var to = new Array();
                    var nameid = new Array();
                    var name = new Array();
                    from = [];
                    to = [];
                    nameid = [];
                    name = [];
                    for (var x = 1; x <= arridc.length + 10; x++) {
                        for (var i = 1; i <= 31; i++) {

                            if (i < 10) {
                                var q = "0" + i;
                            } else {
                                var q = i;
                            }
                            if (x < 10) {
                                var p = "0" + "0" + x;
                            } else if (x < 100) {
                                var p = "0" + x;
                            } else {
                                var p = x;
                            }
                            var kla = "tf";
                            var kla2 = "-";
                            let ml = kla + q + kla2 + p;
                            var myElem = document.getElementById(ml);
                            if (myElem != null) {
                                to.push($("#tt" + q + "-" + p).val());
                                from.push($("#tf" + q + "-" + p).val());
                                nameid.push($("#hn" + q + "-" + p).val());
                                name.push($("#bn" + q + "-" + p).val());

                            }

                        }
                    }



                    var fromTime = JSON.stringify(from);
                    var toTime = JSON.stringify(to);
                    var nameidArr = JSON.stringify(nameid);
                    var nameArr = JSON.stringify(name);




                    $.ajax({
                        url: '{{ route('loadEmployeeTableCalendar') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: nameid,
                            from: from,
                            to: to,
                            name: name
                        },
                        success: function(response) {
                            $("#employee_table").html(response);


                        },
                        error: function(xhr, status, error) {
                            alert('Error fetching image table:', error);
                        }
                    });


                }
                var map1 = new Map();
                var yesterday_id = new Array();
                var yesterday_from = new Array();
                var yesterday_to = new Array();
                var current_id = new Array();
                var current_from = new Array();
                var current_to = new Array();
                var counter_al_id = new Array();
                var counter_al_number = new Array();
                var mark_cell = new Array();
                var mark_cell_nposition = new Array();
                var mark_cell_xnext = new Array();
                let combinationFromArr = new Array();
                let combinationToArr = new Array();
                var combinationIdArr = new Array();
                var finalLongestCombination = new Array();

                var posible_combination = new Array();
                var final_posible_combination = new Array();
                var count_solution_row = 0;
                var count_solution_column = 0;
                let filtered_users = new Array();
                var inputCombinationInput = [];

                function addArrayToCombination(newArray) {
                    inputCombinationInput.push(newArray);
                }

                var firstCombinatoryGeneration = 0;
                var lengthCombination = "";

                function generateCombinations(arrCombination) {
                    if (!arrCombination || arrCombination.length === 0) {
                        return [
                            []
                        ]; // Return an array with an empty array if input is empty
                    }


                    const firstSubArray = arrCombination[0];
                    const restCombinations = generateCombinations(arrCombination.slice(1));
                    const result = [];


                    for (const item of firstSubArray) {
                        for (const combination of restCombinations) {
                            result.push([item, ...combination]);
                        }
                    }

                    return result;
                }

                function checkTimeOverlap(fromFirst, toFirst, fromSecond, toSecond) {
                    // Convert time strings to minutes since midnight
                    const fromFirstMinutes = timeToMinutes(fromFirst);
                    const toFirstMinutes = timeToMinutes(toFirst);
                    const fromSecondMinutes = timeToMinutes(fromSecond);
                    const toSecondMinutes = timeToMinutes(toSecond);

                    // Check for overlap
                    if (fromFirstMinutes <= toSecondMinutes && fromSecondMinutes <= toFirstMinutes) {
                        return true; // Overlap exists
                    } else {
                        return false; // No overlap
                    }
                }

                function timeToMinutes(time) {
                    const [hours, minutes] = time.split(':').map(Number);
                    return hours * 60 + minutes;
                }

                async function cell_selector() {
                    let ajax1Promises = [];
                    //alert("789456123");
                    for (var z = 0; z <= arridc.length; z++) {
                        if (z < 10) {
                            var p = "0" + "0" + z;
                        } else if (z < 100) {
                            var p = "0" + z;
                        } else {
                            var p = z;
                        }

                        for (var i = 1; i <= 31; i++) {
                            if (i < 10) {
                                var q = "0" + i;
                            } else {
                                var q = i;
                            }
                            let counter_el = "tf" + q + "-" + p;
                            var conElem = document.getElementById(counter_el);
                            if (conElem != null) {
                                if ($("#hn" + q + "-" + p).val() != "") {
                                    var is_in_arr = 0;
                                    if (counter_al_id.length != 0) {
                                        for (var t = 0; t < counter_al_id.length; t++) {
                                            if ($("#hn" + q + "-" + p).val() == counter_al_id[t]) {
                                                is_in_arr = 1;
                                                counter_al_number[t] = counter_al_number[t] + 1;
                                                break;
                                            }
                                        }
                                        if (is_in_arr == 0) {
                                            counter_al_id.push($("#hn" + q + "-" + p).val());
                                            counter_al_number.push(1);
                                        }

                                    } else {
                                        counter_al_id.push($("#hn" + q + "-" + p).val());
                                        counter_al_number.push(1);

                                    }
                                }
                            }


                        }
                    }

                    for (var i = 1; i <= 31; i++) {
                        yesterday_id = [];
                        yesterday_from = [];
                        yesterday_to = [];
                        current_id = [];
                        current_from = [];
                        current_to = [];

                        if (i != 1) {
                            for (var z = 0; z <= arridc.length; z++) {
                                if (z < 10) {
                                    var k = "0" + "0" + z;
                                } else if (z < 100) {
                                    var k = "0" + z;
                                } else {
                                    var k = z;
                                }
                                if (i - 1 < 10) {
                                    var r = "0" + (i - 1);
                                } else {
                                    var r = (i - 1);
                                }
                                let previous_el = "tf" + r + "-" + k;
                                var prevElem = document.getElementById(previous_el);
                                if (prevElem != null) {
                                    if ($("#hn" + r + "-" + k).val() != "") {

                                        yesterday_id.push($("#hn" + r + "-" + k).val());
                                        yesterday_from.push($("#tf" + r + "-" + k).val());
                                        yesterday_to.push($("#tt" + r + "-" + k).val());
                                    }
                                }

                            }
                        }







                        for (var x = 1; x <= arridc.length; x++) {
                            current_id = [];
                            current_from = [];
                            current_to = [];
                            ajax1Promises = [];
                            for (var a = 0; a <= arridc.length; a++) {
                                if (a < 10) {
                                    var b = "0" + "0" + a;
                                } else if (a < 100) {
                                    var b = "0" + a;
                                } else {
                                    var b = a;
                                }
                                if (i < 10) {
                                    var c = "0" + (i);
                                } else {
                                    var c = (i);
                                }
                                let current_el = "tf" + c + "-" + b;
                                var curElem = document.getElementById(current_el);
                                if (curElem != null) {
                                    if ($("#hn" + c + "-" + b).val() != "") {
                                        current_id.push($("#hn" + c + "-" + b).val());
                                        current_from.push($("#tf" + c + "-" + b).val());
                                        current_to.push($("#tt" + c + "-" + b).val());
                                    }
                                }

                            }
                            if (i < 10) {
                                var q = "0" + i;
                            } else {
                                var q = i;
                            }

                            if (x < 10) {
                                var p = "0" + "0" + x;
                            } else if (x < 100) {
                                var p = "0" + x;
                            } else {
                                var p = x;
                            }

                            var kla = "tf";
                            var kla2 = "-";

                            let ml = kla + q + kla2 + p;
                            let marker = q + kla2 + p;

                            var myElem = document.getElementById(ml);

                            if (myElem != null) {


                                var em_sel = $("#hn" + q + "-" + p).val();
                                if (em_sel == "") {
                                    if (!mark_cell.includes(marker)) {
                                        mark_cell.push(marker);
                                        mark_cell_nposition.push(0);
                                        map1.set(marker, 0);
                                    }



                                    var from_sel = $("#tf" + q + "-" + p).val();
                                    var to_sel = $("#tt" + q + "-" + p).val();
                                    var id_sel = $("#i00-" + p).val();
                                    var month_sel = currMonth + 1;
                                    if (month_sel < 10) {
                                        var date_sel = currYear + "-0" + month_sel + "-" + q;
                                    } else {
                                        var date_sel = currYear + "-" + month_sel + "-" + q;
                                    }
                                    var element_end = q + "-" + p;

                                    ajax1Promises.push(algorithm(from_sel, to_sel, id_sel, date_sel, element_end, map1.get(
                                        marker), current_id, current_from, current_to, mark_cell));
                                }
                            }


                        }
                        var new_reload = 0;

                        const combinations = generateCombinations(inputCombinationInput);
                        inputCombinationInput = [];

                        /*
                         * Cyklus opravuje kombinace tak, aby v kombinaci nebyly uzivatle jejich smeny se prekryji 
                         */
                        for (let m = 0; m < combinations.length; m++) {
                            combinationToArr = [];
                            combinationFromArr = [];
                            combinationIdArr = [];

                            for (let n = 0; n < combinations[m].length; n++) {
                                var combinationFrom = $("#tf" + mark_cell[n]).val();
                                var combinationTo = $("#tt" + mark_cell[n]).val();
                                combinationFromArr[n] = combinationFrom;
                                combinationToArr[n] = combinationTo;
                                combinationIdArr[n] = combinations[m][n];
                                if (n != 0) {
                                    for (let w = 0; w < combinationIdArr.length - 1; w++) {
                                        if (combinations[m][n] == combinationIdArr[w]) {
                                            if (checkTimeOverlap(combinationFrom, combinationTo, combinationFromArr[w],
                                                    combinationToArr[w]) == true) {
                                                combinations[m][n] = 0;
                                                break;
                                            }
                                        }
                                    }
                                }

                            }
                        }
                        var longestCombinationMAX = 0;
                        var longestCombinationCurrent = 0;
                        finalLongestCombination = [];
                        for (let m = 0; m < combinations.length; m++) {
                            longestCombinationCurrent = 0;
                            for (let n = 0; n < combinations[m].length; n++) {
                                if (combinations[m][n] != 0) {
                                    longestCombinationCurrent++;
                                }
                            }
                            if (longestCombinationMAX < longestCombinationCurrent) {
                                longestCombinationMAX = longestCombinationCurrent;
                                finalLongestCombination = [];
                                finalLongestCombination.push(combinations[m]);
                            } else if (longestCombinationMAX == longestCombinationCurrent) {
                                finalLongestCombination.push(combinations[m]);
                            }
                        }
                        console.log('Final', finalLongestCombination);
                        var idExistingCounter = new Array();
                        var countExistingCounter = new Array();
                        idExistingCounter = [];
                        countExistingCounter = [];
                        for (var xx = 1; xx <= arridc.length; xx++) {
                            for (var ii = 1; ii <= 31; ii++) {

                                if (ii < 10) {
                                    var qq = "0" + ii;
                                } else {
                                    var qq = ii;
                                }
                                if (xx < 10) {
                                    var pp = "0" + "0" + xx;
                                } else if (xx < 100) {
                                    var pp = "0" + xx;
                                } else {
                                    var pp = xx;
                                }
                                let hn_al = "hn" + qq + "-" + pp;
                                var myElem_al = document.getElementById(hn_al);
                                if (myElem_al != null) {
                                    if (!idExistingCounter.includes(document.getElementById(hn_al).value) && document
                                        .getElementById(hn_al).value != "") {

                                        idExistingCounter.push(document.getElementById(hn_al).value);

                                        countExistingCounter.push(1);
                                    } else {
                                        /**
                                         * source : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf */
                                        var position_al = idExistingCounter.indexOf(document.getElementById(hn_al).value);
                                        countExistingCounter[position_al] = countExistingCounter[position_al] + 1;
                                    }

                                }

                            }
                        }
                        for (var dd = 1; dd <= idExistingCounter.length; dd++) {
                            console.log('id', idExistingCounter[dd]);
                            console.log('count', countExistingCounter[dd]);

                        }
                        $.ajax({
                            url: '{{ route('algorithmBestCombination') }}',
                            type: 'POST',
                            cache: false,
                            async: false,
                            data: {
                                _token: '{{ csrf_token() }}',
                                combination: finalLongestCombination,
                                id: idExistingCounter,
                                count: countExistingCounter

                            },
                            success: function(response) {

                                if (Array.isArray(response.idArr)) {
                                    let returnedNames = [];
                                    let returnedIds = [];
                                    for (var k = 0; k < (response.idArr).length; k++) {




                                        returnedNames.push(response.namesArr[k]);
                                        returnedIds.push(response.idArr[k]);
                                        document.getElementById("hn" + mark_cell[k]).value = (response.idArr)[k];
                                        document.getElementById("bn" + mark_cell[k]).value = (response.namesArr)[k];
                                    }
                                    for (var k = 0; k < (response.idArr).length; k++) {
                                        document.getElementById("hn" + mark_cell[k]).value = returnedIds[k];
                                        document.getElementById("bn" + mark_cell[k]).value = returnedNames[k];
                                    }


                                }


                            },
                            error: function(xhr, status, error) {
                                alert('Error fetching:', error);
                            }
                        });

                        try {
                            await Promise.all(ajax1Promises); // Wait for all ajax1 to finish

                        } catch (error) {
                            console.error("Error in ajax1 or ajax2", error);

                        }
                        if (mark_cell_xnext.length != 0) {
                            for (var jj = 0; jj < mark_cell_xnext.length; jj++) {
                                if (mark_cell_xnext[jj] == 1) {
                                    new_reload = 1;
                                    for (var ll = mark_cell_xnext.length; ll > -1; ll--) {
                                        if (mark_cell_xnext[ll] == 0) {
                                            var gut_cell = mark_cell[ll];
                                            map1.set(gut_cell, 0)
                                        } else if (mark_cell_xnext[ll] == 1) {
                                            var gut_cell = mark_cell[ll];
                                            var ncurrent = map1.get(gut_cell);
                                            map1.set(gut_cell, ncurrent + 1)
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }

                            posible_combination = [];
                            var nameid_al = new Array();
                            var count_al = new Array();
                            nameid_al = [];
                            count_al = [];
                            for (var xx = 1; xx <= arridc.length; xx++) {
                                for (var ii = 1; ii <= (i - 1); ii++) {

                                    if (ii < 10) {
                                        var qq = "0" + ii;
                                    } else {
                                        var qq = ii;
                                    }
                                    if (xx < 10) {
                                        var pp = "0" + "0" + xx;
                                    } else if (xx < 100) {
                                        var pp = "0" + xx;
                                    } else {
                                        var pp = xx;
                                    }
                                    let hn_al = "hn" + qq + "-" + pp;
                                    var myElem_al = document.getElementById(hn_al);
                                    if (myElem_al != null) {
                                        if (!nameid_al.includes(document.getElementById(hn_al).value) && document
                                            .getElementById(hn_al).value != "") {

                                            nameid_al.push(document.getElementById(hn_al).value);

                                            count_al.push(1);
                                        } else {
                                            /**
                                             * source : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf */
                                            var position_al = nameid_al.indexOf(document.getElementById(hn_al).value);
                                            count_al[position_al] = count_al[position_al] + 1;
                                        }

                                    }

                                }
                            }

                            test_combination = new Array();
                            test_combination[0] = "27-27-0-28";
                            test_combination[1] = "27-27-0-28";
                            var output_arr = new Array();
                            output_arr = [];
                            mark_cell = [];
                            final_posible_combination = [];
                        } else {

                        }

                    }

                    load_employee_table();


                }





                function algorithm(from, to, id, date, element, nposition, cur_id, cur_from, cur_to, mk_cell) {
                    //return new Promise((resolve, reject) => {
                    var al_return;
                    var create_unmber = "";
                    let sub_name;
                    $.ajax({
                        url: '{{ route('algorithmPick') }}',
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            from: from,
                            to: to,
                            date: date,
                            y_id: yesterday_id,
                            y_from: yesterday_from,
                            y_to: yesterday_to,
                            c_id: cur_id,
                            c_from: cur_from,
                            c_to: cur_to,
                            count_id: counter_al_id,
                            count_number: counter_al_number,
                            nposition: nposition

                        },
                        success: function(response) {
                            mark_cell_xnext.push(response.mark_cell_xnext);
                            if (response.create_nunmber != 0) {

                                if (Array.isArray(response.all_users)) {
                                    addArrayToCombination(response.all_users);

                                }
                                posible_combination.push(response.create_nunmber);
                                var is_in_arr = 0;
                                if (counter_al_id.length != 0) {
                                    for (var t = 0; t < counter_al_id.length; t++) {
                                        if (create_unmber == counter_al_id[t]) {
                                            is_in_arr = 1;
                                            counter_al_number[t] = counter_al_number[t] + 1;
                                            break;
                                        }
                                    }
                                    if (is_in_arr == 0) {
                                        counter_al_id.push(response.create_nunmber);
                                        counter_al_number.push(1);
                                    }

                                } else {
                                    counter_al_id.push(response.create_nunmber);
                                    counter_al_number.push(1);

                                }


                            } else {
                                posible_combination.push(0);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error alg:', error);
                        }
                    });

                }
            </script>
            <script>
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the button that opens the modal
                var btn = document.getElementById("myBtn");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
            </script>



            <script>
                var final_arr = new Array();

                var passedID = "";
                const daysTag = document.querySelector(".days"),
                    currentDate = document.querySelector(".current-date"),
                    prevNextIcon = document.querySelectorAll(".icons span");

                let items = [
                    [0, 1],
                    [4, 8],
                    [6, 5],
                    [6, 6],
                    [8, 28],
                    [9, 28],
                    [10, 17],
                    [11, 24],
                    [11, 25],
                    [11, 26]
                ];
                // getting new date, current year and month
                let date = new Date(),
                    currYear = date.getFullYear(),
                    currMonth = date.getMonth();

                // storing full name of all months in array
                const months = ["January", "February", "March", "April", "May", "June", "July",
                    "August", "September", "October", "November", "December"
                ];
                const months2 = [".1", ".2", ".3", ".4", ".5", ".6", ".7",
                    ".8", ".9", ".10", ".11", ".12"
                ];
                const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                var first = 0;
                var commentArrTippy = new Array();
                //renderCalendar();

                function renderCalendar() {
                    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
                        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
                        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
                        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
                    let liTag = "";


                    const fr = new Date(currYear, currMonth, 0);
                    const f = new Date(currYear, currMonth, 0);
                    const kl = new Date(currYear, currMonth, 0);
                    const d = new Date();
                    const re = new Date();


                    let currMonthNull = "";
                    if (currMonth < 9) {
                        currMonthNull = "0" + (currMonth + 1);
                    } else {
                        currMonthNull = currMonth + 1;
                    }
                    let tet = "<input type='hidden' id='current_load_date' name='current_load_date' value='" + currYear + "-" + (
                        currMonthNull) + "'>";
                    liTag += `${tet}`;
                    for (let i = 1; i <= lastDateofMonth; i++) {

                        if (i == 1) {
                            commentArrTippy = new Array();

                            var col_code = "";
                            for (var ps = 0; ps < arrcols.length; ps++) {

                                let ff = ps + 1;
                                if (ff < 10) {
                                    ff = "0" + "0" + ff;
                                } else if (ff < 100) {
                                    ff = "0" + ff;
                                }
                                col_code = col_code + "<th id='00-" + ff +
                                    "' style='padding:5px;border: solid black; position: sticky; top: 0px;z-index: 1' bgcolor='white' >" +
                                    arrcols[
                                        ps] + "&nbsp;&nbsp;<i id='ic00-" + ff +
                                    "' class='bi bi-info-circle'></i></th><input type='hidden' id='h00-" +
                                    ff + "' value='" + arrcols[1] +
                                    "'><input type='hidden' id='i00-" + ff + "' value='" + arridc[ps] + "'>";


                            }

                            let final_col_code =
                                "<table><tr style='font-size: 15px;pading:10px;border: solid black; position: sticky;top: 0px;z-index: 1' >" +
                                col_code +
                                "</tr><table>";
                            var col_code_obj = "<th id='00-000' rowspan='2'>Date</th>";
                            var sea_obj = 0;
                            var cou_obj = 0;
                            var prea = "";
                            for (var ps = 0; ps < arrcols.length; ps++) {
                                if (sea_obj == 0) {
                                    sea_obj = arrobj[ps];
                                    cou_obj++;
                                } else if (arrobj[ps] != sea_obj) {
                                    col_code_obj = col_code_obj +
                                        "<th style='padding:5px;border: solid black;' colspan='" +
                                        cou_obj + "' ><i class='" + arricons[ps - 1] + "'></i>&nbsp;" + arrname[ps - 1] + "</th>";
                                    sea_obj = arrobj[ps];
                                    cou_obj = 1;
                                } else {
                                    cou_obj++;
                                }
                                prea = arrname[ps];

                            }
                            col_code_obj = col_code_obj +
                                "<th style='padding:5px;border: solid black; position: sticky;top: 0px;z-index: 1' colspan='" +
                                cou_obj +
                                "' >" + prea + "</th>";
                            let final_col_code_obj =
                                "<table style='border-collapse: separate;'><tr style='font-size: 15px;pading:10px;border: solid black; position: sticky;'>" +
                                col_code_obj + "</tr><table>";
                            liTag += `${final_col_code_obj}`;
                            liTag += `${final_col_code}`;
                            col_code = "<th id='00-000'>Date</th>" + col_code;








                        }

                        let find = 0;
                        let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
                            currYear === new Date().getFullYear() ? "active" : "";
                        /**source - https://stackoverflow.com/questions/966225/how-can-i-create-a-two-dimensional-array-in-javascript */
                        fr.setDate(fr.getDate() + 1);
                        f.setDate(f.getDate() + 1)
                        let day = weekday[fr.getDay()];
                        const m = fr.getMonth();
                        //var dayy = day;


                        for (let e = 0; e < items.length; e++) {

                            if (m == items[e][0] && i == items[e][1]) {
                                find = 1;
                                break;
                            }

                        }

                        var passedArray = arrwdw;
                        var passedTime = arrtish;
                        var passedColor = arrcolor;
                        var passedColorDark = arrcolordark;




                        if (f_load == 0) {
                            var sz = arridc.length;
                            var numas = arridc.length;
                        } else {
                            var sz = arridc.length - 1;
                            var numas = arridc.length - 1;
                        }
                        let dts = "";
                        let ddd = '<div><td id="';
                        let xxx = "-";
                        let ccc = '" style="min-width:153px;height:195px;border:solid black;background-color: ';
                        let zzz = ';">';
                        let qqq = "</td></div>";
                        let mmm =
                            '<center><button class="btn btn-outline-light" style="display:none;border-radius: 20%; " onClick="reply_click(this.id)" id="b';
                        let nnn = '"><i class="bi bi-plus "></i></button></center>';


                        let open = '--vacant--';
                        let s = "background-color:#585858;color:white;";
                        let ii = "";



                        let td_start = '<td id="';
                        let td_body = '" style="width: 140px;height: 120px;border:solid black;background-color: ';
                        let td_end =
                            '"><div id="pb-';
                        let progress_start =
                            '" class="progress mx-1" style="height: 7px;"><div class="progress-bar bg-light" role="progressbar" style="width: ';
                        let progress_fill = '%" aria-valuenow="';
                        let progress_middle =
                            '" aria-valuemin="0" aria-valuemax="100"></div><div class="progress-bar bg-warning" role="progressbar" style="width: ';
                        let progress_end =
                            '" aria-valuemin="0" aria-valuemax="100"></div></div><div style="margin: 5px;width: 140px;"><div class="row"><div class="col-12"><div class="row mb-1" style="padding-left:12px; padding-right:12px;"><div class="col-4 p-0 bg-light d-flex justify-content-center text-align-center rounded-right"><span style="font-size:13px;margin-top: 6px" id="basic-addon1">From</span></div>';
                        let timepicker_first_start =
                            '<div class="col-8 p-0"><input class="form-control" onkeyup="CalculateKey(this.id, event)" disabled type="time" style="font-size:13px;border-radius: 0 !important;" title="Time selector" id="tf';
                        let timepicker_first_body = '" value="';
                        let timepicker_first_end =
                            '"></div></div></div></div><div class="row mb-1" style="padding-left:12px; padding-right:12px;"><div class="col-4 p-0 bg-light d-flex justify-content-center text-align-center rounded-right"><span style="font-size:13px;margin-top: 6px">To</span></div>';
                        let timepicker_second_start =
                            '<div class="col-8 p-0"><input type="time" class="form-control" onkeyup="CalculateKey(this.id, event)" disabled style="font-size:13px; border-radius: 0 !important;" title="Time selector" id="tt';
                        let timepicker_second_body = '" value="';
                        let timepicker_second_end =
                            '"</div></div></div><div class="row"><div class="col-12"><div class="text-center">';
                        let employee_selector_start = '<input type="button" id="bn';
                        let employee_selector_end =
                            '" onClick="userSelector(this.id)" title="Employee selector" class="form-control"  data-bs-toggle="modal" data-bs-target="#usersModal" disabled style="height: 32px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size:12px" value="';
                        let em_hidden_selector_start = '"><input type="hidden" id="hn';
                        let em_hidden_selector_body = '" value="';
                        let em_hidden_selector_end = '"></div></div></div><div class="row"><div class="col-12">';
                        let textarea_start = '<textarea class="form-control" id="tx';
                        let textarea_body =
                            '" style="height: 40px;font-size:12px;margin-top:3px;display: none" title="Comment" rows="1">';
                        let textarea_end =
                            '</textarea></div></div><div class="row mt-1" style="padding-left:13px; padding-right:13px;"><div class="col-7 p-0">';

                        let delete_start =
                            '<button class="btn btn-danger align-top" style="display: none;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" title="Delete" onClick="canceled(this.id)" id="x';
                        let delete_end =
                            '"><i class="bi bi-trash"></i></button><button id="dt-';
                        let details_start =
                            '" type="button" class="btn btn-secondary" onclick="openDetails(this.id)" data-bs-toggle="modal" data-bs-target="#detailModal" style="display: none;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" ><i class="bi bi-three-dots"></i></button><div id="cdt-';
                        let details_end =
                            '" style="float: right;font-size:22px;margin-top: -2px;width: 25px;height: 25px;padding:0px"><i class="bi bi-chat-left-dots-fill text-light"></i></div></div><div class="col-5 p-0">';
                        let details_end_empty =
                            '" style="float: right;font-size:22px;margin-top: -2px;width: 25px;height: 25px;padding:0px"><i class="bi bi-chat-left-dots text-light"></i></div></div><div class="col-5 p-0">';
                        let paste_start =
                            '<button type="button" class="btn btn-primary" style="display: none;border: 1px solid black;font-size:15px;margin-top:2px;margin-left:2px;width: 25px;height: 25px;padding:0px;float:right" title="Paste" onClick="paste_cell(this.id)" id="pa';
                        let paste_end = '">P</button>';
                        let copy_start =
                            '<button type="button" class="btn btn-primary" style="display: none; border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:right" title="Copy" onClick="copy_cell(this.id)" id="co';
                        let copy_end = '">C</button></div></div></div></td>';





                        if (day == "Monday") {
                            s = "background-color:#303030; color:white;";
                            for (let q = 0; q < sz; q++) {
                                //alert(passedSavedata[q][0]);
                                if (passedSavedata[q][0] == "1" && first == 0) {
                                    if (passedSavedata[q][i] == "empty") {
                                        let p = q + 1;
                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }
                                        dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);


                                    } else {
                                        let str1 = passedSavedata[q][i];
                                        str1 = str1.substring(0, 5);
                                        let str2 = passedSavedata[q][i];
                                        str2 = str2.substring(10, 15);
                                        let str3 = final_arr[q][i - 1];


                                        let p = q + 1;
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }

                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                            commentArrTippy.push("#cdt-" + ii + xxx + p);
                                        }
                                        var count = 0;
                                        var char = 20;
                                        var val3 = "";
                                        for (;;) {
                                            let result = passedSavedata[q][i].charAt(char);
                                            if (result != "/") {
                                                val3 = val3 + result;
                                                char++;
                                            } else {
                                                break;
                                            }
                                        }

                                        char = char + 2;
                                        let namen = passedSavedata[q][i].substring(char);
                                        dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                            progress_start, fromBarCalculator(
                                                str1), progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(
                                                str1, str2), progress_fill, toBarCalculator(str1, str2), progress_end,
                                            timepicker_first_start, ii, xxx, p, timepicker_first_body, str1,
                                            timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body,
                                            str2, timepicker_second_end, employee_selector_start, ii, xxx, p,
                                            employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p,
                                            em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p,
                                            textarea_body, str3, textarea_end, delete_start, ii, xxx, p, delete_end, ii, xxx, p,
                                            details_start, ii, xxx, p, comment_icon,
                                            paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                                    }
                                } else if (passedArray[0][q] == 1) {
                                    let str1 = passedTime[0][q];
                                    str1 = str1.substring(0, str1.length - 3);
                                    let str2 = passedTime[1][q];
                                    str2 = str2.substring(0, str2.length - 3);
                                    let str3 = final_arr[q][i - 1];



                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }

                                    dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                        progress_start, fromBarCalculator(str1),
                                        progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(str1, str2),
                                        progress_fill, toBarCalculator(str1, str2), progress_end, timepicker_first_start,
                                        ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start,
                                        ii, xxx, p, timepicker_second_body, str2, timepicker_second_end,
                                        employee_selector_start, ii, xxx, p, employee_selector_end, open,
                                        em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end,
                                        textarea_start, ii, xxx, p, textarea_body, str3, textarea_end, delete_start, ii, xxx, p,
                                        delete_end, ii, xxx, p, details_start, ii, xxx, p, comment_icon, paste_start, ii, xxx,
                                        p,
                                        paste_end, copy_start, ii, xxx, p, copy_end);
                                } else {
                                    let p = q + 1;
                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }
                                    dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                                }
                            }
                        } else if (day == "Tuesday") {
                            s = "background-color:#585858; color:white;";
                            for (let q = 0; q < sz; q++) {

                                if (passedSavedata[q][0] == "1" && first == 0) {
                                    if (passedSavedata[q][i] == "empty") {
                                        let p = q + 1;
                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }
                                        dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                                    } else {
                                        let str1 = passedSavedata[q][i];
                                        str1 = str1.substring(0, 5);
                                        let str2 = passedSavedata[q][i];
                                        str2 = str2.substring(10, 15);
                                        let str3 = final_arr[q][i - 1];

                                        let p = q + 1;
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }

                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                            commentArrTippy.push("#cdt-" + ii + xxx + p);

                                        }
                                        var count = 0;
                                        var char = 20;
                                        var val3 = "";
                                        for (;;) {
                                            let result = passedSavedata[q][i].charAt(char);
                                            if (result != "/") {
                                                val3 = val3 + result;
                                                char++;
                                            } else {
                                                break;
                                            }
                                        }
                                        char = char + 2;
                                        let namen = passedSavedata[q][i].substring(char);
                                        dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, ii, xxx, p,
                                            progress_start,
                                            fromBarCalculator(str1), progress_fill, fromBarCalculator(str1), progress_middle,
                                            toBarCalculator(str1, str2), progress_fill, toBarCalculator(str1, str2),
                                            progress_end,
                                            timepicker_first_start, ii, xxx, p, timepicker_first_body, str1,
                                            timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body,
                                            str2, timepicker_second_end, employee_selector_start, ii, xxx, p,
                                            employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p,
                                            em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p,
                                            textarea_body, str3, textarea_end, delete_start, ii, xxx, p, delete_end,
                                            ii, xxx, p, details_start, ii, xxx, p, comment_icon,
                                            paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

                                    }
                                } else if (passedArray[1][q] == 1) {
                                    let str1 = passedTime[2][q];
                                    str1 = str1.substring(0, str1.length - 3);
                                    let str2 = passedTime[3][q];
                                    str2 = str2.substring(0, str2.length - 3);
                                    let str3 = final_arr[q][i - 1];

                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                    dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, ii, xxx, p,
                                        progress_start, fromBarCalculator(
                                            str1), progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(
                                            str1, str2), progress_fill, toBarCalculator(str1, str2), progress_end,
                                        timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end,
                                        timepicker_second_start, ii, xxx, p, timepicker_second_body, str2,
                                        timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open,
                                        em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end,
                                        textarea_start, ii, xxx, p, textarea_body, str3, textarea_end, delete_start, ii, xxx, p,
                                        delete_end, ii, xxx, p, details_start, ii, xxx, p, comment_icon, paste_start, ii, xxx,
                                        p,
                                        paste_end, copy_start, ii, xxx, p, copy_end);

                                } else {
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                                }
                            }
                        } else if (day == "Wednesday") {
                            s = "background-color:#303030; color:white;";
                            for (let q = 0; q < sz; q++) {

                                if (passedSavedata[q][0] == "1" && first == 0) {
                                    if (passedSavedata[q][i] == "empty") {
                                        let p = q + 1;
                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }
                                        dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                                    } else {
                                        let str1 = passedSavedata[q][i];
                                        str1 = str1.substring(0, 5);
                                        let str2 = passedSavedata[q][i];
                                        str2 = str2.substring(10, 15);
                                        let str3 = final_arr[q][i - 1];
                              
                                        let p = q + 1;
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }

                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                        var count = 0;
                                        var char = 20;
                                        var val3 = "";
                                        for (;;) {
                                            let result = passedSavedata[q][i].charAt(char);
                                            if (result != "/") {
                                                val3 = val3 + result;
                                                char++;
                                            } else {
                                                break;
                                            }
                                        }
                                        char = char + 2;
                                        let namen = passedSavedata[q][i].substring(char);
                                        dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                            progress_start, fromBarCalculator(
                                                str1), progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(
                                                str1, str2), progress_fill, toBarCalculator(str1, str2), progress_end,
                                            timepicker_first_start, ii, xxx, p, timepicker_first_body, str1,
                                            timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body,
                                            str2, timepicker_second_end, employee_selector_start, ii, xxx, p,
                                            employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p,
                                            em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p,
                                            textarea_body, str3, textarea_end, delete_start, ii, xxx, p, delete_end, ii, xxx, p,
                                            details_start, ii, xxx, p, comment_icon,
                                            paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                                    }
                                } else if (passedArray[2][q] == 1) {
                                    let str1 = passedTime[4][q];
                                    str1 = str1.substring(0, str1.length - 3);
                                    let str2 = passedTime[5][q];
                                    str2 = str2.substring(0, str2.length - 3);
                                    let str3 = final_arr[q][i - 1];
                       
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }

                                    dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                        progress_start, fromBarCalculator(str1),
                                        progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(str1, str2),
                                        progress_fill, toBarCalculator(str1, str2), progress_end, timepicker_first_start,
                                        ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start,
                                        ii, xxx, p, timepicker_second_body, str2, timepicker_second_end,
                                        employee_selector_start, ii, xxx, p, employee_selector_end, open,
                                        em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end,
                                        textarea_start, ii, xxx, p, textarea_body, str3, textarea_end, delete_start, ii, xxx, p,
                                        delete_end, ii, xxx, p, details_start, ii, xxx, p, comment_icon, paste_start, ii, xxx,
                                        p,
                                        paste_end, copy_start, ii, xxx, p, copy_end);


                                } else {
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                                }
                            }
                        } else if (day == "Thursday") {
                            s = "background-color:#585858; color:white;";
                            for (let q = 0; q < sz; q++) {

                                if (passedSavedata[q][0] == "1" && first == 0) {
                                    if (passedSavedata[q][i] == "empty") {
                                        let p = q + 1;
                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }
                                        dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                                    } else {
                                        let str1 = passedSavedata[q][i];
                                        str1 = str1.substring(0, 5);
                                        let str2 = passedSavedata[q][i];
                                        str2 = str2.substring(10, 15);
                                        let str3 = final_arr[q][i - 1];
                             
                                        let p = q + 1;
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }

                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                        var count = 0;
                                        var char = 20;
                                        var val3 = "";
                                        for (;;) {
                                            let result = passedSavedata[q][i].charAt(char);
                                            if (result != "/") {
                                                val3 = val3 + result;
                                                char++;
                                            } else {
                                                break;
                                            }
                                        }
                                        char = char + 2;
                                        let namen = passedSavedata[q][i].substring(char);
                                        dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, ii, xxx, p,
                                            progress_start,
                                            fromBarCalculator(str1), progress_fill, fromBarCalculator(str1), progress_middle,
                                            toBarCalculator(str1, str2), progress_fill, toBarCalculator(str1, str2),
                                            progress_end,
                                            timepicker_first_start, ii, xxx, p, timepicker_first_body, str1,
                                            timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body,
                                            str2, timepicker_second_end, employee_selector_start, ii, xxx, p,
                                            employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p,
                                            em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p,
                                            textarea_body, str3, textarea_end, delete_start, ii, xxx, p, delete_end, ii, xxx, p,
                                            details_start, ii, xxx, p, comment_icon,
                                            paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                                    }
                                } else if (passedArray[3][q] == 1) {
                                    let str1 = passedTime[6][q];
                                    str1 = str1.substring(0, str1.length - 3);
                                    let str2 = passedTime[7][q];
                                    str2 = str2.substring(0, str2.length - 3);
                                    let str3 = final_arr[q][i - 1];
                                 
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                    dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, ii, xxx, p,
                                        progress_start, fromBarCalculator(
                                            str1), progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(
                                            str1, str2), progress_fill, toBarCalculator(str1, str2), progress_end,
                                        timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end,
                                        timepicker_second_start, ii, xxx, p, timepicker_second_body, str2,
                                        timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open,
                                        em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end,
                                        textarea_start, ii, xxx, p, textarea_body, str3, textarea_end, delete_start, ii, xxx, p,
                                        delete_end, ii, xxx, p, details_start, ii, xxx, p, comment_icon, paste_start, ii, xxx,
                                        p,
                                        paste_end, copy_start, ii, xxx, p, copy_end);

                                } else {
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                                }
                            }
                        } else if (day == "Friday") {

                            s = "background-color:#303030; color:white;";
                            for (let q = 0; q < sz; q++) {

                                if (passedSavedata[q][0] == "1" && first == 0) {
                                    if (passedSavedata[q][i] == "empty") {
                                        let p = q + 1;
                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }
                                        dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                                    } else {
                                        let str1 = passedSavedata[q][i];
                                        str1 = str1.substring(0, 5);
                                        let str2 = passedSavedata[q][i];
                                        str2 = str2.substring(10, 15);
                                        let str3 = final_arr[q][i - 1];
                     
                                        let p = q + 1;
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }

                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                        var count = 0;
                                        var char = 20;
                                        var val3 = "";
                                        for (;;) {
                                            let result = passedSavedata[q][i].charAt(char);
                                            if (result != "/") {
                                                val3 = val3 + result;
                                                char++;
                                            } else {
                                                break;
                                            }
                                        }
                                        char = char + 2;
                                        let namen = passedSavedata[q][i].substring(char);
                                        dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                            progress_start, fromBarCalculator(
                                                str1), progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(
                                                str1, str2), progress_fill, toBarCalculator(str1, str2), progress_end,
                                            timepicker_first_start, ii, xxx, p, timepicker_first_body, str1,
                                            timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body,
                                            str2, timepicker_second_end, employee_selector_start, ii, xxx, p,
                                            employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p,
                                            em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p,
                                            textarea_body, str3, textarea_end, delete_start, ii, xxx, p, delete_end, ii, xxx, p,
                                            details_start, ii, xxx, p, comment_icon,
                                            paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                                    }
                                } else if (passedArray[4][q] == 1) {
                                    let str1 = passedTime[8][q];
                                    str1 = str1.substring(0, str1.length - 3);
                                    let str2 = passedTime[9][q];
                                    str2 = str2.substring(0, str2.length - 3);
                                    let str3 = final_arr[q][i - 1];
                            
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                    dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                        progress_start, fromBarCalculator(str1),
                                        progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(str1, str2),
                                        progress_fill, toBarCalculator(str1, str2), progress_end, timepicker_first_start,
                                        ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start,
                                        ii, xxx, p, timepicker_second_body, str2, timepicker_second_end,
                                        employee_selector_start, ii, xxx, p, employee_selector_end, open,
                                        em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end,
                                        textarea_start, ii, xxx, p, textarea_body, str3, textarea_end, delete_start, ii, xxx, p,
                                        delete_end, ii, xxx, p, details_start, ii, xxx, p, comment_icon, paste_start, ii, xxx,
                                        p,
                                        paste_end, copy_start, ii, xxx, p, copy_end);

                                } else {
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {

                                        ii = i;
                                    }
                                    dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                                }
                            }
                        } else if (day == "Saturday") {
                            s = "background-color:#585858; color:white;";
                            for (let q = 0; q < sz; q++) {

                                if (passedSavedata[q][0] == "1" && first == 0) {
                                    if (passedSavedata[q][i] == "empty") {
                                        let p = q + 1;
                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }
                                        dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                                    } else {
                                        let str1 = passedSavedata[q][i];
                                        str1 = str1.substring(0, 5);
                                        let str2 = passedSavedata[q][i];
                                        str2 = str2.substring(10, 15);
                                        let str3 = final_arr[q][i - 1];
                         
                                        let p = q + 1;
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }

                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                        var count = 0;
                                        var char = 20;
                                        var val3 = "";
                                        for (;;) {
                                            let result = passedSavedata[q][i].charAt(char);
                                            if (result != "/") {
                                                val3 = val3 + result;
                                                char++;
                                            } else {
                                                break;
                                            }
                                        }
                                        char = char + 2;
                                        let namen = passedSavedata[q][i].substring(char);
                                        dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, ii, xxx, p,
                                            progress_start,
                                            fromBarCalculator(str1), progress_fill, fromBarCalculator(str1), progress_middle,
                                            toBarCalculator(str1, str2), progress_fill, toBarCalculator(str1, str2),
                                            progress_end,
                                            timepicker_first_start, ii, xxx, p, timepicker_first_body, str1,
                                            timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body,
                                            str2, timepicker_second_end, employee_selector_start, ii, xxx, p,
                                            employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p,
                                            em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p,
                                            textarea_body, str3, textarea_end, delete_start, ii, xxx, p, delete_end, ii, xxx, p,
                                            details_start, ii, xxx, p, comment_icon,
                                            paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                                    }
                                } else if (passedArray[5][q] == 1) {
                                    let str1 = passedTime[10][q];
                                    str1 = str1.substring(0, str1.length - 3);
                                    let str2 = passedTime[11][q];
                                    str2 = str2.substring(0, str2.length - 3);
                                    let str3 = final_arr[q][i - 1];
        
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                    dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, ii, xxx, p,
                                        progress_start, fromBarCalculator(
                                            str1), progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(
                                            str1, str2), progress_fill, toBarCalculator(str1, str2), progress_end,
                                        timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end,
                                        timepicker_second_start, ii, xxx, p, timepicker_second_body, str2,
                                        timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open,
                                        em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end,
                                        textarea_start, ii, xxx, p, textarea_body, str3, textarea_end, delete_start, ii, xxx, p,
                                        delete_end, ii, xxx, p, details_start, ii, xxx, p, comment_icon, paste_start, ii, xxx,
                                        p,
                                        paste_end, copy_start, ii, xxx, p, copy_end);

                                } else {
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                                }
                            }
                        } else if (day == "Sunday") {
                            s = "background-color:#303030; color:white;";
                            for (let q = 0; q < sz; q++) {

                                if (passedSavedata[q][0] == "1" && first == 0) {
                                    if (passedSavedata[q][i] == "empty") {
                                        let p = q + 1;
                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }
                                        dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                                    } else {
                                        let str1 = passedSavedata[q][i];
                                        str1 = str1.substring(0, 5);
                                        let str2 = passedSavedata[q][i];
                                        str2 = str2.substring(10, 15);
                                        let str3 = final_arr[q][i - 1];
                    
                                        let p = q + 1;
                                        if (p < 10) {
                                            p = "0" + "0" + p;
                                        } else if (p < 100) {
                                            p = "0" + p;
                                        }

                                        if (i < 10) {
                                            ii = "0" + i;
                                        } else {
                                            ii = i;
                                        }
                                        if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                        var count = 0;
                                        var char = 20;
                                        var val3 = "";
                                        for (;;) {
                                            let result = passedSavedata[q][i].charAt(char);
                                            if (result != "/") {
                                                val3 = val3 + result;
                                                char++;
                                            } else {
                                                break;
                                            }
                                        }
                                        char = char + 2;
                                        let namen = passedSavedata[q][i].substring(char);
                                        dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                            progress_start, fromBarCalculator(
                                                str1), progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(
                                                str1, str2), progress_fill, toBarCalculator(str1, str2), progress_end,
                                            timepicker_first_start, ii, xxx, p, timepicker_first_body, str1,
                                            timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body,
                                            str2, timepicker_second_end, employee_selector_start, ii, xxx, p,
                                            employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p,
                                            em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p,
                                            textarea_body, str3, textarea_end, delete_start, ii, xxx, p, delete_end, ii, xxx, p,
                                            details_start, ii, xxx, p, comment_icon,
                                            paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

                                    }
                                } else if (passedArray[6][q] == 1) {
                                    let str1 = passedTime[12][q];
                                    str1 = str1.substring(0, str1.length - 3);
                                    let str2 = passedTime[13][q];
                                    str2 = str2.substring(0, str2.length - 3);
                                    let str3 = final_arr[q][i - 1];
                             
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;
                                    } else {
                                        ii = i;
                                    }
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                        commentArrTippy.push("#cdt-" + ii + xxx + p);
                                    }
                                    dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, ii, xxx, p,
                                        progress_start, fromBarCalculator(str1),
                                        progress_fill, fromBarCalculator(str1), progress_middle, toBarCalculator(str1, str2),
                                        progress_fill, toBarCalculator(str1, str2), progress_end, timepicker_first_start,
                                        ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start,
                                        ii, xxx, p, timepicker_second_body, str2, timepicker_second_end,
                                        employee_selector_start, ii, xxx, p, employee_selector_end, open,
                                        em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end,
                                        textarea_start, ii, xxx, p, textarea_body, str3, textarea_end, delete_start, ii, xxx, p,
                                        delete_end, ii, xxx, p, details_start, ii, xxx, p, comment_icon, paste_start, ii, xxx,
                                        p,
                                        paste_end, copy_start, ii, xxx, p, copy_end);

                                } else {
                                    let p = q + 1;
                                    if (p < 10) {
                                        p = "0" + "0" + p;
                                    } else if (p < 100) {
                                        p = "0" + p;
                                    }

                                    if (i < 10) {
                                        ii = "0" + i;

                                    } else {
                                        ii = i;
                                    }
                                    dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                                }
                            }
                        }
                        let nul = 0;

                        if (find == 1) {


                            liTag +=
                                `<tr><td id="${i}-000" class="${isToday}" style="${s};font-size: 12px;min-height:100px;border: solid black;z-index: 3;position: sticky; left:0px">${i} ${months2[currMonth]} <br> ${day} - Holiday <br> <button id="rc${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;margin-right:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="copy_row(this.id)" title="Copy">C</button><button id="rp${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="paste_row(this.id)" title="Paste">P</button> </td>${dts}<tr>`;
                        } else {
                            liTag +=
                                `<tr style="min-height:100px"><td id="${i}-000" class="${isToday}" style="${s};font-size: 15px;min-height:100px;z-index: 3;border: solid black;margin-left:10px; position: sticky; left:0px; ">${i} ${months2[currMonth]} <br> ${day} <br> <button id="rc${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;margin-right:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="copy_row(this.id)" title="Copy">C</button><button id="rp${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="paste_row(this.id)" title="Paste">P</button> </td>${dts}<tr>`;


                        }

                        if (day == "Sunday" && i != lastDateofMonth) {
                            let tet = "";
                            liTag += `${col_code}`;
                            daysTag.innerHTML = liTag;
                        }





                    }
                    f_load = 1;

                    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
                    daysTag.innerHTML = liTag;

                    tippyCommentLoader();

                    load_employee_table();


                }


                prevNextIcon.forEach(icon => { // getting prev and next icons
                    icon.addEventListener("click", () => { // adding click event on both icons
                        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
                        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

                        if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
                            // creating a new date of current year & month and pass it as date value
                            date = new Date(currYear, currMonth, new Date().getDate());
                            currYear = date.getFullYear(); // updating current year with new date year
                            currMonth = date.getMonth(); // updating current month with new date month
                        } else {
                            date = new Date(); // pass the current date as date value
                        }
                        offer_array = [];
                        queryLoader(); // calling renderCalendar function


                    });
                });
            </script>


            <script>
                var r_type = 555;

                function filter(main_obj) {
                    from_paste_arr = [];
                    to_paste_arr = [];
                    exist_arr = [];
                    arridc = [];
                    arrcols = [];
                    arrcolor = [];
                    arrcolordark = [];
                    arrwdw = [];
                    arrtish = [];
                    arrobj = [];
                    arrname = [];
                    arricons = [];
                    arrdescription = [];
                    f_load = 0;
                    var results = new Array();
                    $.ajax({
                        url: '{{ route('pickLoaderCalendar') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',

                            shift_arr: shi_search,
                            object_arr: obj_search,
                            input: main_obj,
                            type: r_type
                        },
                        success: function(data) {

                            var counterRows = 0;
                            var ooot;
                            data.forEach(item => {
                                if (counterRows == 0) {
                                    for (let z = 0; z < 7; z++) {
                                        arrwdw[z] = [];
                                        for (let j = 0; j < data.length; j++) {
                                            arrwdw[z][j] = 0;
                                        }
                                    }
                                    for (let z = 0; z < 14; z++) {
                                        arrtish[z] = [];
                                        for (let j = 0; j < data.length; j++) {
                                            arrtish[z][j] = 0;
                                        }
                                    }
                                }

                                arridc.push(`${item.id_shift}`);
                                arrcols.push(`${item.shift_name}`);
                                arrcolor.push(`${item.color}`);
                                arrcolordark.push(`${item.darkcolor}`);

                                arrwdw[0][counterRows] = `${item.monday}`;
                                arrwdw[1][counterRows] = `${item.tuesday}`;
                                arrwdw[2][counterRows] = `${item.wednesday}`;
                                arrwdw[3][counterRows] = `${item.thursday}`;
                                arrwdw[4][counterRows] = `${item.friday}`;
                                arrwdw[5][counterRows] = `${item.saturday}`;
                                arrwdw[6][counterRows] = `${item.sunday}`;
                                arrtish[0][counterRows] = `${item.mon_from}`;
                                arrtish[1][counterRows] = `${item.mon_to}`;
                                arrtish[2][counterRows] = `${item.tue_from}`;
                                arrtish[3][counterRows] = `${item.tue_to}`;
                                arrtish[4][counterRows] = `${item.wed_from}`;
                                arrtish[5][counterRows] = `${item.wed_to}`;
                                arrtish[6][counterRows] = `${item.thu_from}`;
                                arrtish[7][counterRows] = `${item.thu_to}`;
                                arrtish[8][counterRows] = `${item.fri_from}`;
                                arrtish[9][counterRows] = `${item.fri_to}`;
                                arrtish[10][counterRows] = `${item.sat_from}`;
                                arrtish[11][counterRows] = `${item.sat_to}`;
                                arrtish[12][counterRows] = `${item.sun_from}`;
                                arrtish[13][counterRows] = `${item.sun_to}`;
                                arrobj.push(`${item.id_object}`);
                                arrname.push(`${item.object_name}`);
                                arrdescription.push(`${item.description}`);
                                arricons.push(`${item.object_icon}`);
                                ooot = `${item.monday}`;
                                counterRows++;
                            });
                        },
                        error: function(xhr, status, error) {
                            alert('Error fetching imageaa _ filter:', error);
                        }
                    });


                }
                var tst = 0;



                function CalculateKey(id_selector, event) {
                    if (event.keyCode == 13) {
                        var first_part = id_selector.substring(0, 2);
                        var second_part = id_selector.substring(2);

                        if (first_part == "tf") {
                            document.getElementById("tt" + second_part).focus();
                        } else if (first_part == "tt") {
                            document.getElementById("bn" + second_part).click();

                        }
                    }
                    var id_cut = id_selector.substring(2);
                    var from_key = document.getElementById('tf' + id_cut).value;
                    var to_key = document.getElementById('tt' + id_cut).value;
                    let progress_start_key =
                        '<div class="progress-bar bg-light" role="progressbar" style="width: ';
                    let progress_fill_key = '%" aria-valuenow="';
                    let progress_midde_key =
                        '" aria-valuemin="0" aria-valuemax="100"></div><div class="progress-bar bg-warning" role="progressbar" style="width: ';
                    let progress_end_key =
                        '" aria-valuemin="0" aria-valuemax="100"></div>';
                    document.getElementById("pb-" + id_cut).innerHTML = progress_start_key + fromBarCalculator(from_key) +
                        progress_fill_key + fromBarCalculator(from_key) + progress_midde_key + toBarCalculator(from_key, to_key) +
                        progress_fill_key + toBarCalculator(from_key, to_key) + progress_end_key;
                }

                function fromBarCalculator(from) {
                    var hourCut = parseInt(from.substring(0, 2));
                    var minuteCut = parseInt(from.substring(3, 5));
                    var totalCut = parseInt((60 * hourCut + minuteCut) / 14.4);
                    return totalCut;

                }

                function toBarCalculator(from, to) {
                    var hourCutFrom = parseInt(from.substring(0, 2));
                    var minuteCutFrom = parseInt(from.substring(3, 5));
                    var hourCutTo = parseInt(to.substring(0, 2));
                    var minuteCutTo = parseInt(to.substring(3, 5));
                    totalCutFrom = parseInt((60 * hourCutFrom + minuteCutFrom));
                    totalCutTo = parseInt((60 * hourCutTo + minuteCutTo));
                    if (totalCutFrom < totalCutTo) {
                        return parseInt(((totalCutTo - totalCutFrom)) / 14.4);
                    } else {
                        return 100;
                    }
                }

                function tippyCommentLoader() {
                    for (let j = 0; j < commentArrTippy.length; j++) {
                        var textID = commentArrTippy[j].substring(5);
                        var newDescription = document.getElementById("tx" + textID).value.replace(/\n/g, '<br>');

                        tippy(commentArrTippy[j], {
                            content: '<strong><span style="color: aqua;">Comment :<br></span>' +
                                newDescription + '</strong>',
                            allowHTML: true,
                        });
                    }
                }

                function dataLoader() {
                    var count_number = arrcols.length;


                    var passedID = arridc;



                    var lena = count_number;
                    var tsaas = "1";
                    var idp = JSON.stringify(passedID);
                    var Yp = JSON.parse(currYear);
                    var Mp = JSON.stringify(currMonth);

                    var tes;
                    var FormatMonth = currMonth + 1;
                    var a1sa = new Array();
                    var text_return = new Array();
                    $.ajax({
                        url: '{{ route('getCommentCalendar') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: arridc,
                            year: currYear,
                            month: FormatMonth,

                        },
                        success: function(data) {
                            var middle_arr = new Array();
                            var second_arr = new Array();
                            final_arr = data;
                            $.ajax({
                                url: '{{ route('getSavedCalendarData') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: arridc,
                                    year: currYear,
                                    month: FormatMonth,
                                },
                                success: function(response) {

                                    passedSavedata = response;


                                    renderCalendar();
                                    for (var ps = 0; ps < arrcols.length; ps++) {

                                        let ff = ps + 1;
                                        if (ff < 10) {
                                            ff = "0" + "0" + ff;
                                        } else if (ff < 100) {
                                            ff = "0" + ff;
                                        }
                                        if (arrdescription[ps] != "null") {
                                            var newDescription = arrdescription[ps].replace(/\n/g, '<br>');

                                            tippy("#ic00-" + ff, {
                                                content: '<strong><span style="color: aqua;">Description :<br></span>' +
                                                    newDescription + '</strong>',
                                                allowHTML: true,
                                            });
                                        } else {
                                            tippy("#ic00-" + ff, {
                                                content: '<strong><span style="color: aqua;">Description :<br></span>//</strong>',
                                                allowHTML: true,
                                            });
                                        }

                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching imagebb:', error);
                                }

                            });

                        },
                        error: function(xhr, status, error) {
                            alert('Error fetching imagecc:', error);
                        }

                    });

                }
            </script>
            <script>
                function canceled(clicked_id) {
                    if (controlDelete == true) {
                        question_delete_alert(clicked_id);

                    } else {

                        deleteCell(clicked_id);
                    }
                }
                var from_paste = "";
                var to_paste = "";
                var bar_content = "";

                var exist_arr = new Array()
                var from_paste_arr = new Array();
                var to_paste_arr = new Array();
                var bar_content_arr = new Array();


                function paste_cell(paste_id) {
                    doneChnages = true;
                    paste_id = paste_id.substring(2);

                    if (from_paste != "") {
                        document.getElementById("tf" + paste_id).value = from_paste;
                        document.getElementById("tt" + paste_id).value = to_paste;
                        document.getElementById("pb-" + paste_id).innerHTML = bar_content;

                    }
                }

                function copy_cell(copy_id) {
                    copy_id = copy_id.substring(2);

                    from_paste = document.getElementById("tf" + copy_id).value;
                    to_paste = document.getElementById("tt" + copy_id).value;
                    bar_content = document.getElementById("pb-" + copy_id).innerHTML;

                }

                function copy_row(copy_id) {
                    from_paste_arr = [];
                    to_paste_arr = [];
                    exist_arr = [];
                    copy_id = copy_id.substring(2);
                    if (copy_id < 10) {
                        copy_id = "0" + copy_id;
                    }
                    var sz = arridc.length;
                    for (var i = 1; i < sz; i++) {


                        var col_id = i;
                        if (col_id < 10) {
                            col_id = "0" + "0" + col_id;
                        } else if (col_id < 100) {
                            col_id = "0" + col_id;
                        }
                        if (document.getElementById('tf' + copy_id + "-" + col_id) != null) {
                            exist_arr[i - 1] = 1;
                            from_paste_arr[i - 1] = document.getElementById("tf" + copy_id + "-" + col_id).value;
                            to_paste_arr[i - 1] = document.getElementById("tt" + copy_id + "-" + col_id).value;
                            bar_content_arr[i - 1] = document.getElementById("pb-" + copy_id + "-" + col_id).innerHTML;
                        } else {
                            exist_arr[i - 1] = 0;
                            from_paste_arr[i - 1] = "00:00";
                            to_paste_arr[i - 1] = "00:00";
                            bar_content_arr[i - 1] = "----";

                        }

                    }

                }

                function paste_row(paste_id) {
                    doneChnages = true;
                    paste_id = paste_id.substring(2);
                    if (paste_id < 10) {
                        paste_id = "0" + paste_id;
                    }
                    if (from_paste_arr.length != 0) {
                        var sz = arridc.length;

                        for (var i = 1; i < sz; i++) {

                            var col_id = i;
                            if (col_id < 10) {
                                col_id = "0" + "0" + col_id;
                            } else if (col_id < 100) {
                                col_id = "0" + col_id;
                            }
                            if (exist_arr[i - 1] == 0) {
                                if (document.getElementById('tf' + paste_id + "-" + col_id) != null) {
                                    var x_id = "x" + paste_id + "-" + col_id;
                                    canceled(x_id);
                                }

                            } else {
                                if (document.getElementById('tf' + paste_id + "-" + col_id) == null) {
                                    var r_id = "b" + paste_id + "-" + col_id;
                                    reply_click(r_id);
                                    document.getElementById("tf" + paste_id + "-" + col_id).value = from_paste_arr[i - 1];
                                    document.getElementById("tt" + paste_id + "-" + col_id).value = to_paste_arr[i - 1];
                                    document.getElementById("pb-" + paste_id + "-" + col_id).innerHTML = bar_content_arr[i - 1];

                                } else {
                                    document.getElementById("tf" + paste_id + "-" + col_id).value = from_paste_arr[i - 1];
                                    document.getElementById("tt" + paste_id + "-" + col_id).value = to_paste_arr[i - 1];
                                    document.getElementById("pb-" + paste_id + "-" + col_id).innerHTML = bar_content_arr[i - 1];

                                }
                            }

                        }
                    }

                }

                var month_ajax_const = 1;

                function queryLoader() {
                    month_ajax_const = 0;
                    filter(document.getElementById("select_obj").value);


                }
                $(document).on("ajaxComplete", function() {
                    if (month_ajax_const == 0) {
                        dataLoader();
                        month_ajax_const = 1;
                    }
                });

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

                function question_delete_alert(clicked_id) {
                    Swal.fire({
                        title: "Do you want to delete this shift?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirm"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteCell(clicked_id);
                        }

                    });
                }

                function question_alert(message) {
                    Swal.fire({
                        title: "Are you sure you want to offer the shift ?",
                        text: "The shift is already taken",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Offer"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            insertOffer();
                        }

                    });
                }

                function cancel_offer(selected_picker_cell) {
                    Swal.fire({
                        title: "Are you sure you want to fill this shift ?",
                        text: "The shift has been offered",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirm"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById("hn" + selected_picker_cell).value = picker_global_id;
                            document.getElementById("bn" + selected_picker_cell).value = document.getElementById(
                                'name_selected').innerHTML;
                            if (offer_array.includes(selected_picker_cell) == true) {
                                offer_array = offer_array.filter(number => number !== selected_picker_cell);
                                load_employee_table();

                            }
                        }

                    });

                }
            </script>



        </div>






    </div>

</body>

</html>
