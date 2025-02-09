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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body id="body-pd">
    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="height-100 bg-light">
        <div class="container-fluid">

            <div class="col py-3">
                <div class="row">
                    <div class='col-12 col-md-6 flex '>
                        <div class="card p-3 ">
                            <center>
                                <h3>Current structure</h3>
                            </center>

                            <div id="structure"></div>
                        </div>
                    </div>
                    <div class='col-12 col-md-6 flex'>
                        <div class="card p-3 mb-0 h-100">
                            <div class="row">
                                <div class="col-12">

                                    <h4 id="h_controler">Control panel :</h4>

                                </div>
                                <div class="col-12">
                                    <h5>Create new main object:</h5>

                                    <!--<label for="new_object"></label>-->
                                    <div class="input-group mb-2 mb-md-0 ">
                                        <input id="new_object" class="form-control" placeholder="Enter name"
                                            name="new_object" style="display:inline" type="text">


                                        <!--<div class="popup">-->
                                        <div class="input-group-append">
                                            <input id="savemain" type="button" onclick="create_model_object()"
                                                class="btn btn-primary" style="display:inline" value="Create object">

                                        </div>

                                    </div>
                                    <small id="label1" class="text-form" style="visibility:hidden;color:red">Needs to
                                        be
                                        filled
                                        *</small>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12">
                                    <h5>Create new ub-object:</h5>
                                    <div class="input-group mb-2 mb-md-0">
                                        <input id="new_sub_object" class="form-control" placeholder="Enter name"
                                            name="new_sub_object" style="display:inline" type="text">
                                        <div class="input-group-append">
                                            <input id="savesub" type="button" onclick="add_model_object()"
                                                class="btn btn-primary" style="display:inline"
                                                value="Create sub-object">
                                        </div>
                                    </div>

                                    <small id="label2" class="text-form" style="visibility:hidden;color:red"></small>
                                    <br>
                                </div>
                            </div>
                            <div class="row ">
                                <div class='col-12 col-md-6'>
                                    <div class="input-group mt-2 mt-md-0">
                                        <!--<div class="input-group-prepend">
                                    <span style="background: #4CAF50;color:#ffffff;" class="input-group-text" id="basic-addon1">Rename selected object</span>
                                  </div>-->
                                        <input id="rename_input" class="form-control" placeholder="Enter new name"
                                            name="rename_input" style="display:inline" type="text">
                                        <div class="input-group-append">
                                            <input id="renamebtn" type="button" onclick="rename_object()"
                                                class="btn btn-warning" style="display:inline" value="Rename">
                                        </div>
                                    </div>

                                    <small id="label3" class="text-form"
                                        style="visibility:hidden;color:red"></small>
                                    <br>
                                    <br>



                                </div>
                                <div class='col-12 col-md-6 '>
                                    <button type="button" class="btn btn-danger float-end"
                                        onclick="delete_object()">Delete</button>
                                    <br>
                                    <br>
                                    <small id="label4" class="text-form"
                                        style="visibility:hidden;color:red; float: right"></small>

                                </div>

                            </div>
                            <div class="row ">
                                <div class='col-12 '>

                                    <h5>Select icon for sub-object:</h5>
                                    <!--<i class="bi bi-building"></i>-->
                                    <div class="radio-group">
                                        <input type="radio" id="option1" style="display: none;" name="Icons"
                                            value="home" checked>
                                        <label id="l1" for="option1" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic1"
                                                class="bi bi-house "
                                                style="font-size: 30px;color: #0d6efd "></i></label>

                                        <input type="radio" id="option2" style="display: none;" name="Icons"
                                            value="building">
                                        <label id="l2" for="option2" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic2"
                                                class="bi bi-buildings" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option3" style="display: none;" name="Icons"
                                            value="shop1">
                                        <label id="l3" for="option3" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic3"
                                                class="bi bi-shop" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option4" style="display: none;" name="Icons"
                                            value="shop2">
                                        <label id="l4" for="option4" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic4"
                                                class="bi bi-shop-window" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option5" style="display: none;" name="Icons"
                                            value="stats">
                                        <label id="l5" for="option5" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic5"
                                                class="bi bi-bar-chart-line" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option6" style="display: none;" name="Icons"
                                            value="computer">
                                        <label id="l6" for="option6" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic6"
                                                class="bi bi-pc-display-horizontal"
                                                style="font-size: 30px"></i></label>

                                        <input type="radio" id="option7" style="display: none;" name="Icons"
                                            value="car">
                                        <label id="l7" for="option7" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic7"
                                                class="bi bi-car-front-fill" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option8" style="display: none;" name="Icons"
                                            value="cart">
                                        <label id="l8" for="option8" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic8"
                                                class="bi bi-cart2" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option9" style="display: none;" name="Icons"
                                            value="phone">
                                        <label id="l9" for="option9" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic9"
                                                class="bi bi-person-badge" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option10" style="display: none;" name="Icons"
                                            value="suitcase">
                                        <label id="l10" for="option10" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic10"
                                                class="bi bi-suitcase-lg" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option11" style="display: none;" name="Icons"
                                            value="gear">
                                        <label id="l11" for="option11" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic11"
                                                class="bi bi-gear" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option12" style="display: none;" name="Icons"
                                            value="code">
                                        <label id="l12" for="option12" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic12"
                                                class="bi bi-code-slash" style="font-size: 30px"></i></label>

                                        <input type="radio" id="option13" style="display: none;" name="Icons"
                                            value="code">
                                        <label id="l13" for="option13" class="p-1 px-2 border border-grey"
                                            style="cursor: pointer;" onclick="selectIcon(this.id)"><i id="ic13"
                                                class="bi bi-building" style="font-size: 30px"></i></label>
                                    </div>
                                    <script>
                                        function selectIcon(id_option) {
                                            var selected_id = id_option.substring(1);
                                            for (var i = 1; i < 14; i++) {
                                                document.getElementById("ic" + i).style.color = "";
                                                if (selected_id == i) {
                                                    document.getElementById("ic" + i).style.color = "#0d6efd ";
                                                }



                                                //document.getElementById("").innerHTML = " ";
                                            }
                                        }
                                    </script>
                                </div>
                            </div>

                            <!--</div>-->
                            <!--<br>-->
                            <br>

                            <script>
                                var token = 1;
                                var current_object = 0;
                                var sub_object = "";
                                structure_load();

                                function structure_load() {

                                    $.ajax({
                                        url: '{{ route('structureGet') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            object: current_object
                                        },

                                        success: function(response) {
                                            $('#structure').html(response);


                                        },
                                        error: function(response) {
                                            alert("dsad");
                                        }
                                    });
                                }

                                function select_dropdown(response) {
                                    current_object = response.substring(4);
                                    $.ajax({
                                        url: '{{ route('structureGet') }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            object: current_object
                                        },

                                        success: function(response) {
                                            $('#structure').html(response);
                                            document.getElementById("h_controler").innerHTML = "Control panel : ";
                                            sub_object = "";

                                        },
                                        error: function(response) {
                                            alert("dsad");
                                        }
                                    });

                                }
                            </script>


                            <!-- source display z datatbaze: https://www.geeksforgeeks.org/how-to-fetch-data-from-localserver-database-and-display-on-html-table-using-php/ -->

                            <br>
                            <div style="background-color: white">

                                <script>
                                    $(document).ready(function() {
                                        // Look for the open panel and get the id.
                                        const id = $(".collapse.show").attr('id');
                                        if (id) {
                                            // Click on the element pointing to this id.
                                            $("[data-bs-target='#" + id + "']").click();
                                        }
                                    });
                                </script>
                                <script>
                                    $("input[@name='accept-offers']").change(function() {
                                        // Do something interesting here
                                        alert("ds");
                                    });

                                    function radiocheck(browser) {
                                        //alert(browser);

                                        //document.getElementById("h_controler").value;
                                        $.ajax({
                                            url: '{{ route('parametrsGet') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                search: browser
                                            },
                                            success: function(response) {
                                                document.getElementById("h_controler").innerHTML = "Control panel : " + response.name;
                                                for (var t = 1; t < 14; t++) {
                                                    document.getElementById("ic" + t).style.color = "";
                                                    var my_icon = document.getElementById("ic" + t).className;
                                                    if (my_icon.trim() == response.icon.trim()) {
                                                        document.getElementById("ic" + t).style.color = "#0d6efd";
                                                        document.getElementById("option" + t).checked = true;
                                                        //alert(document.getElementById("ic"+ t).className );
                                                    }

                                                }
                                                sub_object = browser;

                                            },
                                            error: function(response) {
                                                alert("dsad");
                                            }
                                        });
                                    }

                                    function create_model_object(object) {
                                        let name = document.getElementById("new_object").value;
                                        if (name == "") {
                                            var popup = document.getElementById("label1");
                                            popup.style.visibility = "visible";
                                        } else {
                                            //alert(browser);
                                            var ele = document.getElementsByName('Icons');
                                            var sub_icon = "";
                                            for (i = 0; i < ele.length; i++) {
                                                if (ele[i].checked) {
                                                    //alert(ele[i].value);
                                                    //document.getElementById().sty

                                                    sub_icon = document.getElementById("ic" + (i + 1)).className;
                                                    //alert(sub_icon);
                                                    //sub_icon = (ele[i].value);
                                                }
                                                //document.getElementById("result").innerHTML = "Gender: " + ele[i].value;
                                            }
                                            $.ajax({
                                                url: '{{ route('structureCreate') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    name: name,
                                                    icon: sub_icon
                                                },
                                                success: function(response) {
                                                    document.getElementById("new_object").value = "";
                                                    document.getElementById("h_controler").innerHTML = "Control panel : ";
                                                    var popup = document.getElementById("label1");
                                                    popup.style.visibility = "hidden";
                                                    sub_object = '';
                                                    structure_load();
                                                    success_alert("Object created successfully");


                                                },
                                                error: function(response) {
                                                    alert("dsad");
                                                }
                                            });
                                        }
                                    }

                                    function add_model_object(object) {
                                        let sub_text = document.getElementById("new_sub_object").value;
                                        if (sub_text == "") {
                                            var popup = document.getElementById("label2");
                                            popup.style.visibility = "visible";
                                            popup.innerText = "Needs to be filled *";
                                        } else {
                                            if (sub_object != "") {
                                                var popup = document.getElementById("label2");
                                                popup.style.visibility = "hidden";
                                                /*var bb = "box" + previous;
                                                var hh = "hid" + previous;
                                                var pj = document.getElementById(bb).value;
                                                var jj = document.getElementById(hh).value;*/
                                                /*$.ajax({
                                                    url: "../objects/insert-sub_object.php",
                                                    method: "POST",
                                                    data: {
                                                        name: q,
                                                        sup: pj,
                                                        id: jj
                                                    },
                                                    success: function(data) {

                                                    }
                                                });*/
                                                var ele = document.getElementsByName('Icons');
                                                var sub_icon = "";
                                                for (i = 0; i < ele.length; i++) {
                                                    if (ele[i].checked) {
                                                        //alert(ele[i].value);
                                                        //document.getElementById().sty

                                                        sub_icon = document.getElementById("ic" + (i + 1)).className;
                                                        // alert(sub_icon);
                                                        //sub_icon = (ele[i].value);
                                                    }
                                                    //document.getElementById("result").innerHTML = "Gender: " + ele[i].value;
                                                }
                                                document.getElementById("new_sub_object").value = "";
                                                $.ajax({
                                                    url: '{{ route('structureSubCreate') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        name: sub_text,
                                                        id: sub_object,
                                                        icon: sub_icon

                                                    },
                                                    success: function(response) {
                                                        structure_load();
                                                        sub_object = "";
                                                        document.getElementById("h_controler").innerHTML = "Control panel : ";
                                                        success_alert("New sub-object is saved");



                                                    },
                                                    error: function(response) {
                                                        alert("dsad");
                                                    }
                                                });
                                                /*var newa = document.getElementById("res");
                                                newa.value = "";
                                                var input4 = 0;*/
                                                //document.getElementById("new_object").value = "";
                                                /*var ChA = JSON.parse(input4);
                                                $.ajax({
                                                    url: "../objects/load_object3.php",
                                                    method: "POST",
                                                    data: {
                                                        input: ChA
                                                    },
                                                    success: function(data) {
                                                        $("#res").html(data);
                                                        success_alert("New sub-object is saved");
                                                    }
                                                });*/
                                            } else {
                                                var popup = document.getElementById("label2");
                                                popup.style.visibility = "visible";
                                                popup.innerText = "Sub object needs to be selected*";
                                            }

                                        }
                                    }

                                    function delete_object() {
                                        //alert("sd");

                                        if (sub_object != "") {
                                            var popup3 = document.getElementById("label4");

                                            popup3.style.visibility = "hidden";
                                            //alert("Asd");


                                            $.ajax({
                                                url: '{{ route('structureDelete') }}',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    id: sub_object

                                                },
                                                success: function(response) {
                                                    //alert(response);
                                                    structure_load();
                                                    sub_object = "";
                                                    document.getElementById("h_controler").innerHTML = "Control panel : ";
                                                },
                                                error: function(response) {
                                                    alert("dsad");
                                                }
                                            });


                                        } else {
                                            var popup = document.getElementById("label4");
                                            popup.style.visibility = "visible";
                                            popup.innerText = "Sub object needs to be selected*";
                                        }
                                    }

                                    function rename_object() {
                                        let rename = document.getElementById("rename_input").value;
                                        if (rename == "") {
                                            var popup = document.getElementById("label3");
                                            popup.style.visibility = "visible";
                                            popup.innerText = "Needs to be filled *";
                                        } else {

                                            if (sub_object != "") {
                                                var popup = document.getElementById("label3");
                                                popup.style.visibility = "hidden";
                                                /*var bb = "box" + previous;
                                                var hh = "hid" + previous;
                                                var pj = document.getElementById(bb).value;
                                                var jj = document.getElementById(hh).value;
                                                var var_return;
                                                $.ajax({
                                                    url: "../objects/rename_object.php",
                                                    method: "POST",
                                                    dataType: "json",
                                                    cache: false,
                                                    async: false,
                                                    data: {
                                                        name: q,
                                                        sup: pj,
                                                        id: jj
                                                    },
                                                    success: function(data) {

                                                        var_return = data;
                                                    }
                                                });
                                                

                                                var newa = document.getElementById("res");
                                                newa.value = "";
                                                var input4 = 0;
                                                var ChA = JSON.parse(input4);
                                                $.ajax({
                                                    url: "../objects/load_object3.php",
                                                    method: "POST",
                                                    data: {
                                                        input: ChA
                                                    },
                                                    success: function(data) {
                                                        $("#res").html(data);
                                                        if (var_return == 0) {
                                                            success_alert("Object was renamed successfully");
                                                        } else {
                                                            error_alert("Error occur");

                                                        }
                                                    }
                                                });*/
                                                var ele = document.getElementsByName('Icons');
                                                var sub_icon = "";
                                                for (i = 0; i < ele.length; i++) {
                                                    if (ele[i].checked) {

                                                        sub_icon = document.getElementById("ic" + (i + 1)).className;
                                 
                                                    }
                                                }
                                                $.ajax({
                                                    url: '{{ route('structureRename') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        name: rename,
                                                        id: sub_object,
                                                        icon: sub_icon
                                                    },
                                                    success: function(response) {
                                                        structure_load();
                                                        sub_object = "";
                                                        //alert(response);
                                                        document.getElementById("rename_input").value = "";
                                                        document.getElementById("h_controler").innerHTML = "Control panel : ";
                                                        success_alert("New sub-object is saved");



                                                    },
                                                    error: function(response) {
                                                        alert("dsad");
                                                    }
                                                });
                                            } else {
                                                var popup = document.getElementById("label3");
                                                popup.style.visibility = "visible";
                                                popup.innerText = "Sub object needs to be selected*";
                                            }

                                        }
                                    }



                                    function submit_subtable() {
                                        //let q = document.getElementById("new_sub_object").value;
                                    }
                                </script>
                                <script>
                                    $(document).ready(function() {
                                        var height1 = $('#col1').height();
                                        var height2 = $('#col2').height();

                                        var maxHeight = Math.max(height1, height2);

                                        $('#col1, #col2').height(maxHeight);
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

                                    function sure_delete() {
                                        Swal.fire({
                                            icon: "warning",
                                            title: "Do you want to delete object?",
                                            text: "Such action is irreversible and will also delete shifts located on seleted object",
                                            showCancelButton: true,
                                            confirmButtonText: "Delete object",
                                        }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.isConfirmed) {
                                                //change_data()
                                                deletefce();

                                            }
                                        });
                                    }
                                </script>




                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card p-3 ">
                            <p id=""></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</body>

</html>
