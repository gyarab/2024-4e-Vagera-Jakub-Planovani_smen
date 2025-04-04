<!DOCTYPE html>
<html lang="en">

<head>
    <title>Calendar editor</title>
    <link rel="icon" type="image/x-icon" href="{{ URL('images/cropped_imageic.ico') }}">

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
    @include('vendor.Chatify.pages.header-manager')
    @include('vendor.Chatify.pages.sidebar-manager')
    @include('admin.scripts')

    <div class="height-100 bg-light">



        <input type="hidden" id="kpk" name="kpk" value="2024-01">
        <div>
            <input type="hidden" id="help" name="help">
            <input type="hidden" id="help2" name="help2">
            <input type="hidden" id="hideYM">

            <header>



            </header>


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
                                            $(function() {
                                                $('#textModal').keyup(function() {


                                                    var characterCount = $(this).val().length,
                                                        current = $('#current'),
                                                        maximum = $('#maximum'),
                                                        theCount = $('#textcount');

                                                    current.text(characterCount);


                                                    if (characterCount < 70) {
                                                        current.css('color', '#666');
                                                    }
                                                    if (characterCount > 70 && characterCount < 90) {
                                                        current.css('color', '#6d5555');
                                                    }
                                                    if (characterCount > 90 && characterCount < 100) {
                                                        current.css('color', '#793535');
                                                    }
                                                    if (characterCount > 100 && characterCount < 120) {
                                                        current.css('color', '#841c1c');
                                                    }
                                                    if (characterCount > 120 && characterCount < 139) {
                                                        current.css('color', '#8f0001');
                                                    }

                                                    if (characterCount >= 140) {
                                                        maximum.css('color', '#8f0001');
                                                        current.css('color', '#8f0001');
                                                        theCount.css('font-weight', 'bold');
                                                    } else {
                                                        maximum.css('color', '#666');
                                                        theCount.css('font-weight', 'normal');
                                                    }


                                                });
                                            });
                                            var details_id_global = 0;
                                            var repeat_counter = 0;

                                            function openDetails(id_cell) {
                                                document.getElementById("closeOffer").style.display = "none";
                                                document.getElementById("offerShift").style.display = "none";
                                                var row_id = id_cell.substring(3);
                                                details_id_global = row_id;
                                                var text_content = $("#tx" + row_id).val();
                                                document.getElementById("textModal").value = text_content;
                                                var characterCount = $("#tx" + row_id).val().length,
                                                    current = $('#current'),
                                                    maximum = $('#maximum'),
                                                    theCount = $('#textcount');

                                                current.text(characterCount);


                                                if (characterCount < 70) {
                                                    current.css('color', '#666');
                                                }
                                                if (characterCount > 70 && characterCount < 90) {
                                                    current.css('color', '#6d5555');
                                                }
                                                if (characterCount > 90 && characterCount < 100) {
                                                    current.css('color', '#793535');
                                                }
                                                if (characterCount > 100 && characterCount < 120) {
                                                    current.css('color', '#841c1c');
                                                }
                                                if (characterCount > 120 && characterCount < 139) {
                                                    current.css('color', '#8f0001');
                                                }

                                                if (characterCount >= 140) {
                                                    maximum.css('color', '#8f0001');
                                                    current.css('color', '#8f0001');
                                                    theCount.css('font-weight', 'bold');
                                                } else {
                                                    maximum.css('color', '#666');
                                                    theCount.css('font-weight', 'normal');
                                                }
                                                var main_cut = details_id_global.substring(2);
                                                var day_offer = details_id_global.substring(0, 2);
                                                var id_shift_check = document.getElementById('i00' + main_cut).value;
                                                $.ajax({
                                                    url: '{{ route('getShiftOffer') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        shift: id_shift_check,
                                                        year: currYear,
                                                        month: currMonth,
                                                        day: day_offer

                                                    },
                                                    success: function(response) {


                                                        if (offer_array.includes(details_id_global) == false && response == 0) {
                                                            document.getElementById("closeOffer").style.display = "none";
                                                            document.getElementById("offerShift").style.display = "inline";
                                                        } else {
                                                            document.getElementById("closeOffer").style.display = "inline";
                                                            document.getElementById("offerShift").style.display = "none";
                                                        }


                                                    },
                                                    error: function(xhr, status, error) {
                                                        error_fetch_alert('Error fetching:');
                                                    }
                                                });
                                      
                                            }

                                            function getShiftCheck(inserted_id) {
                                                var main_cut = inserted_id.substring(2);
                                                var day_offer = inserted_id.substring(0, 2);
                                                var id_shift_check = document.getElementById('i00' + main_cut).value;
                                                var final_response_offer;


                                                $.ajax({
                                                    url: '{{ route('getShiftOffer') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        shift: id_shift_check,
                                                        year: currYear,
                                                        month: currMonth,
                                                        day: day_offer

                                                    },
                                                    success: function(response) {
                                              
                                                        if (offer_array.includes(selected_picker_cell) == true || response == 1) {
                                                            cancel_offer(selected_picker_cell);
                                                        } else {
                                                            document.getElementById("hn" + selected_picker_cell).value = picker_global_id;
                                                            document.getElementById("bn" + selected_picker_cell).value = document.getElementById(
                                                                    'name_selected')
                                                                .innerText;
                                                        }
                                                        load_employee_table();

                                                    },
                                                    error: function(xhr, status, error) {
                                                        error_fetch_alert('Error fetching:');
                                                    }
                                                });


                                            }
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
                                <script>
                                    $('#detailModal').on('hidden.bs.modal', function() {
                                      
                                        document.getElementById("closeOffer").style.display = "none";
                                        document.getElementById("offerShift").style.display = "none";
                                    });

                                    function saveDetails() {

                                        var modal_text = document.getElementById("textModal").value;
                                        document.getElementById("tx" + details_id_global).innerHTML = modal_text;
                                        if (modal_text == "" || modal_text == null) {
                                            document.getElementById("cdt-" + details_id_global).innerHTML =
                                                '<i class="bi bi-chat-left-dots text-light"></i>';

                                        } else {
                                            document.getElementById("cdt-" + details_id_global).innerHTML =
                                                '<i class="bi bi-chat-left-dots-fill text-light"></i>';

                                        }
                                    }

                                    function offerShift() {


                                        var is_vacant = document.getElementById("hn" + details_id_global).value;
                                        if (is_vacant == 0 || is_vacant == null || is_vacant == "") {
                                            insertOffer();
                                        } else {
                                            question_alert();
                                        }
                                    }

                                    var offer_array_date = new Array();

                                    function insertOffer() {

                                        var main_cut = details_id_global.substring(2);
                                        var day_offer = details_id_global.substring(0, 2);
                                        var id_shift_check = document.getElementById('i00' + main_cut).value;
                                        document.getElementById("hn" + details_id_global).value = "";
                                        document.getElementById("bn" + details_id_global).value = "--vacant--";
                                        offer_array.push(details_id_global);
                                    

                                        document.getElementById("closeOffer").style.display = "inline";
                                        document.getElementById("offerShift").style.display = "none";
                        

                                    }

                                    function closeOffer() {
                                        var main_cut = details_id_global.substring(2);
                                        var day_offer = details_id_global.substring(0, 2);
                                        var id_shift_check = document.getElementById('i00' + main_cut).value;

                                        $.ajax({
                                            url: '{{ route('deleteOffer') }}',
                                            type: 'POST',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                shift: id_shift_check,
                                                year: currYear,
                                                month: currMonth,
                                                day: day_offer

                                            },
                                            success: function(response) {

                                                document.getElementById("closeOffer").style.display = "none";
                                                document.getElementById("offerShift").style.display = "inline";


                                            },
                                            error: function(xhr, status, error) {
                                                error_fetch_alert('Error fetching:');
                                            }
                                        });
                                    }
                                </script>
                      
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                <div class="col-12">



                </div>
                <script>
                    const detailModal = document.getElementById('detailModal')
                    const detailInput = document.getElementById('detailOpener')

                    detailModal.addEventListener('shown.bs.modal', () => {
                        detailInput.focus()
                    })
                </script>
            

                <!-- Modal -->
                <div class="modal fade w-100" id="usersModal" tabindex="-1" data-bs-backdrop="false"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="container modal-dialog modal-dialog-centered w-100 modal-xl ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Employee selector

                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-1">
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <div class="col-12">

                                                <select id="role_picker" placeholder="Search..."
                                                    class="form-select form-select-sm" multiple>
                                                    <option value='|--ALL--|' selected>ALL</option>
                                                    <option value='admin'>Administrator</option>
                                                    <option value='manager'>Management</option>
                                                    <option value='fulltime'>Full-time</option>
                                                    <option value='parttime'>Part-time</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="input-group mb-3">
                                            <input type="text" placeholder="Search..." class="form-control"
                                                id="searchUser" name="searchUser" style="height: 42px">
                                            <div class="input-group-append">
                                                <span class="input-group-text" style="height: 42px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-search">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65"
                                                            y2="16.65"></line>
                                                    </svg>
                                                </span>
                                            </div>
                                            <script>
                                                var picker_global_id = 0;
                                                var selected_picker_cell = "";
                                                var search_text = "";
                                                var id_shfft = 0;
                                                var role_picker = new Array();
                                                role_picker.push("|--ALL--|");
                                                $("#searchUser").keyup(function() {
                                                    search_text = $(this).val();

                                                    $.ajax({
                                                        url: '{{ route('calendarEmployeeSearch') }}',
                                                        type: 'POST',
                                                        data: {
                                                            _token: '{{ csrf_token() }}',
                                                            roles: role_picker,
                                                            search_text: search_text,
                                                            shift: id_shfft
                                                        },
                                                        success: function(response) {

                                                            document.getElementById("assign_employees").innerHTML = response.asign_response;

                                                            document.getElementById("all_employees").innerHTML = response.all_response;

                                                        },
                                                        error: function(xhr, status, error) {
                                                            error_fetch_alert('Error fetching:');
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <script>
                                            new MultiSelectTag('role_picker', {
                                                rounded: true, // default true
                                                shadow: false, // default false
                                                placeholder: 'Search', // default Search...
                                                tagColor: {
                                                    textColor: '#000000',
                                                    borderColor: '#000000',
                                                    bgColor: '#f7f7f7',
                                                },
                                                onChange: function(values) {
                                                    role_picker = [];
                                                    console.log(values)

                                                    values.forEach(item => {
                                                        role_picker.push(`${item.value}`);

                                                    });
                                                    $.ajax({
                                                        url: '{{ route('calendarEmployeeSearch') }}',
                                                        type: 'POST',
                                                        data: {
                                                            _token: '{{ csrf_token() }}',
                                                            roles: role_picker,
                                                            search_text: search_text,
                                                            shift: id_shfft
                                                        },
                                                        success: function(response) {

                                                            document.getElementById("assign_employees").innerHTML = response
                                                                .asign_response;

                                                            document.getElementById("all_employees").innerHTML = response.all_response;

                                                        },
                                                        error: function(xhr, status, error) {
                                                            error_fetch_alert('Error fetching:');
                                                        }
                                                    });

                                                }
                                            })


                                            function userSelector(element_value) {
                                 
                                                selected_picker_cell = element_value.substring(2);
                                                var id_user = document.getElementById("hn" + element_value.substring(2)).value;
                                                search_text = document.getElementById("searchUser").value;
                                                id_shfft = document.getElementById("i00-" + element_value.substring(5)).value;
                                     
                                            
                                                if (id_user == 0 || id_user == null || id_user == "") {
                                                    document.getElementById("modalName").innerHTML = "Name: <strong id='name_selected'> Vacant </strong>";
                                                    document.getElementById("modalRole").innerHTML = "Position: //";
                                                    $('#modalImage').attr('src',
                                                        'https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-profile-picture-suitable-social-media-profiles-icons-screensavers-as-templatex9xa_719432-1040.jpg?semt=ais_hybrid'
                                                    );

                                                } else {
                                                    picker_global_id = id_user;
                                                    $.ajax({
                                                        url: '{{ route('getNameRole') }}',
                                                        type: 'POST',
                                                        data: {
                                                            _token: '{{ csrf_token() }}',
                                                            id: id_user,
                                                        },
                                                        success: function(response) {
                                                            document.getElementById("modalName").innerHTML = "Name: <strong id='name_selected'>" +
                                                                response.name +
                                                                "</strong>";
                                                            document.getElementById("modalRole").innerHTML = "Position: " + response.role;


                                                        },
                                                        error: function(xhr, status, error) {
                                                            alert('Error fetching image:', error);
                                                        }
                                                    });
                                                    $.ajax({
                                                        url: '{{ route('showImagePersonal') }}',
                                                        type: 'POST',
                                                        data: {
                                                            _token: '{{ csrf_token() }}',
                                                            id: id_user,
                                                        },
                                                        success: function(response) {
                                                            $('#modalImage').attr('src', response.url);

                                                        },
                                                        error: function(xhr, status, error) {
                                                            error_fetch_alert('Error fetching image:');
                                                        }
                                                    });
                                                }
                                           
                                                var myElem3 = document.getElementById("time-" + id_user);

                                                if (myElem3 != null) {
                                                    var comtents1 = document.getElementById("time-" + id_user).innerHTML;
                                        
                                                    document.getElementById("modalHours").innerHTML = "Hours: " + comtents1;

                                                } else {
                                                    document.getElementById("modalHours").innerHTML = "Hours: 0 h 0 min";

                                                }

                                                var myElem2 = document.getElementById("count-" + id_user);
                                                if (myElem2 != null) {
                                                    var comtents2 = document.getElementById("count-" + id_user).innerHTML;
                                                    document.getElementById("modalAmount").innerHTML = "Amount: " + comtents2;

                                                } else {
                                                    document.getElementById("modalAmount").innerHTML = "Amount: 0 ";

                                                }

                                                $.ajax({
                                                    url: '{{ route('calendarEmployeeSearch') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        roles: role_picker,
                                                        search_text: search_text,
                                                        shift: id_shfft
                                                    },
                                                    success: function(response) {

                                                        document.getElementById("assign_employees").innerHTML = response.asign_response;

                                                        document.getElementById("all_employees").innerHTML = response.all_response;

                                                    },
                                                    error: function(xhr, status, error) {
                                                        error_fetch_alert('Error fetching:');
                                                    }
                                                });
                                            }

                                            function pickUser(id_user) {
                                                picker_global_id = id_user.substring(4);
                                                $.ajax({
                                                    url: '{{ route('showImagePersonal') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        id: id_user.substring(4),
                                                    },
                                                    success: function(response) {
                                             
                                                        $('#modalImage').attr('src', response.url);

                                                    },
                                                    error: function(xhr, status, error) {
                                                        error_fetch_alert('Error fetching image:');
                                                    }
                                                });
                                                $.ajax({
                                                    url: '{{ route('getNameRole') }}',
                                                    type: 'POST',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                        id: id_user.substring(4),
                                                    },
                                                    success: function(response) {
                                                    
                                                        document.getElementById("modalName").innerHTML = "Name: <strong id='name_selected'>" +
                                                            response.name +
                                                            "</strong>";
                                                        document.getElementById("modalRole").innerHTML = "Position: " + response.role;
                                                        var myElem = document.getElementById("time-" + id_user.substring(4));
                                                        if (myElem != null) {
                                                            var comtents1 = document.getElementById("time-" + id_user.substring(4)).innerHTML;
                                                            document.getElementById("modalHours").innerHTML = "Hours: " + comtents1;

                                                        } else {
                                                            document.getElementById("modalHours").innerHTML = "Hours: 0 h 0 min";

                                                        }
                                                        var myElem2 = document.getElementById("count-" + id_user.substring(4));
                                                        if (myElem2 != null) {
                                                            var comtents2 = document.getElementById("count-" + id_user.substring(4)).innerHTML;
                                                            document.getElementById("modalAmount").innerHTML = "Amount: " + comtents2;

                                                        } else {
                                                            document.getElementById("modalAmount").innerHTML = "Amount: 0 ";

                                                        }
                                                        // $('#modalName').attr('src', response.url);

                                                    },
                                                    error: function(xhr, status, error) {
                                                        error_fetch_alert('Error fetching image:');
                                                    }
                                                });
                                            }

                                            function vacateUser() {
                                                picker_global_id = 0;
                                                document.getElementById("modalName").innerHTML = "Name: <strong id='name_selected'> Vacant </strong>";
                                                document.getElementById("modalRole").innerHTML = "Position: //";
                                                $('#modalImage').attr('src',
                                                    'https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-profile-picture-suitable-social-media-profiles-icons-screensavers-as-templatex9xa_719432-1040.jpg?semt=ais_hybrid'
                                                );
                                                document.getElementById("modalHours").innerHTML = "Hours: 0 h 0 min";
                                                document.getElementById("modalAmount").innerHTML = "Amount: 0 ";
                                            }
                                        </script>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5>Profile</h5>
                                                <hr>
                                                <center><img id="modalImage"
                                                        src="https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-profile-picture-suitable-social-media-profiles-icons-screensavers-as-templatex9xa_719432-1040.jpg?semt=ais_hybrid"
                                                        alt="Admin" class="rounded-circle object-fit-cover"
                                                        style="height: 130px; width: 130px;border: 2p"></center>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                                <p id="modalName" class="m-0">Name: // </p>
                                                <p id="modalRole" class="m-0">Position: // </p>
                                                <p id="modalHours" class="m-0">Hours: //</p>
                                                <p id="modalAmount" class="m-0">Amount: //</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                                <center>
                                                    <input onclick="vacateUser()" type="button"
                                                        class="btn btn-primary" value="Vacate">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <center>
                                                    <h5>Assigned employees</h5>
                                                </center>
                                                <hr>
                                                <div id="assign_employees"></div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <center>
                                                    <h5>All employees</h5>
                                                </center>
                                                <hr>
                                                <div id="all_employees">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer float-start">
                                <div class=" ">
                                    <button onclick="saveUser()" class="btn btn-outline-primary"
                                        data-bs-dismiss="modal">
                                        Save
                                    </button>
                                    <script>
                                        function saveUser() {
                                            if (picker_global_id == 0) {
                                                document.getElementById("hn" + selected_picker_cell).value = "";
                                                document.getElementById("bn" + selected_picker_cell).value = "--vacant--";
                                            } else {
                                                getShiftCheck(selected_picker_cell);
                                             
                                            }
                                            load_employee_table();
                                        }
                                    </script>
                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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



            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card p-2 mb-2">
                        <div class="row">
                            <div class="col-2">
                                <h6 class="mt-1">Controllers:</h6>

                            </div>
                            <div class="col-2">
                            <div class="form-check">
                                <input class="form-check-input d-inline" type="checkbox" value="" onclick="deleteCheck()" id="flexCheckDefault" checked>
                                <label class="form-check-label d-inline" for="flexCheckDefault">
                                  Save deleting
                                </label>
                                <script>
                                    var controlDelete = true;
                                    function deleteCheck(){
                                        if(controlDelete == true){
                                            controlDelete = false;
 
                                        }else{
                                            controlDelete = true;
                                        }
                                    }
                                </script>
                              </div>
                            </div>

                            <div class="col-8">

                                <input type="button" name="save" class="btn btn-success btn-sm"
                                    style="float:right" value="Save the shedule" id="butsave">

                                <input type="button" name="algorithm" class="btn btn-warning btn-sm mx-3"
                                    style="float:right" onclick="algorithm_alert()" value="Algorithm selection"
                                    id="btnalgorithm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
        

                <script></script>

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
                            error_fetch_alert('Error fetching image render:');
                        }
                    });
                }



                var f_load = 0;
                var obj_search = new Array();
                var pos_search = new Array();
                function cal_obj_load(input_obj) {
           
                    $.ajax({
                        url: '{{ route('cal_obj_load') }}',
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
                            error_fetch_alert('Error fetching image cal:');
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
                                     
                                        </div>
                                    </table>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <script>
           
            </script>
            <script>
                var modal = "";
                var btn = "";
                var idbtn = "xcxcz";
                var qkk = "alsd";

          

            </script>
            <script>
                $(document).ready(function() {
                    var id = 1;
                 
                    /*creating new click event for save button*/
                    $("#butsave").click(function() {
                        var from = new Array();
                        var to = new Array();
                        var date_simple = new Array();
                        var nameid = new Array();
                        var name = new Array();
                        var area = new Array();
                        var id_shift = new Array();
                        var id_shift_delete = new Array();
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
                                    id_shift.push($("#i00-" + p).val());
                                    nameid.push($("#hn" + q + "-" + p).val());
                                    name.push($("#bn" + q + "-" + p).val());
                                    area.push($("#tx" + q + "-" + p).val());
                                    var ids = $("#i00-" + p).val();
                                    if (id_shift_delete.includes(ids)) {} else {
                                        id_shift_delete.push(ids);
                                    }
                                    var ym = $("#current_load_date").val();

                                    let h = ym + "-" + q;
                                    date_simple.push(h);
                                }

                            }
                        }

                        var fromTime = JSON.stringify(from);
                        var toTime = JSON.stringify(to);
                        var idArr = JSON.stringify(id_shift);
                        var dateArr = JSON.stringify(date_simple);
                        var deleteArr = JSON.stringify(id_shift_delete);
                        var nameidArr = JSON.stringify(nameid);
                        var nameArr = JSON.stringify(name);
                        var areaArr = JSON.stringify(area);
                        var year_month = $("#current_load_date").val();
                        var offer_array_save = new Array();
                        if (offer_array.length != null) {
                            for (var f = 0; f < offer_array.length; f++) {
                                var cut = offer_array[f].substring(2);
                                offer_array_save[f] = offer_array[f] + "-" + document.getElementById('i00' + cut)
                                    .value;
                            }
                        }
                        $.ajax({
                            url: '{{ route('insertCalendarData') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                from: from,
                                to: to,
                                dateym: year_month,
                                id_shift: id_shift,
                                date: date_simple,
                                id_delete: id_shift_delete,
                                namesid: nameid,
                                name: name,
                                area: area,
                                offer: offer_array_save

                            },
                            success: function(data) {
                                success_alert("Calendar successfully saved");
                            },
                            error: function(xhr, status, error) {
                                error_fetch_alert('Error fetching imagesss:');
                            }

                        });
        
                    });
                });

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
                            error_fetch_alert('Error fetching image table:');
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
                /**
                 * Tato cast by byla vygenerovana Gemini 2.0 
                 * */
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
                /**
                 * Konec Gemini 2.0
                */

                async function cell_selector() {
                    let ajax1Promises = [];
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
                                        for(var k = 0; k < (response.idArr).length; k++ ){
                                           
                            

                            
                                            returnedNames.push(response.namesArr[k]);
                                            returnedIds.push(response.idArr[k]);
                                            document.getElementById("hn" + mark_cell[k]).value = (response.idArr)[k];
                                            document.getElementById("bn" + mark_cell[k]).value = (response.namesArr)[k];
                                        }
                                        for(var k = 0; k < (response.idArr).length; k++ ){
                                            document.getElementById("hn" + mark_cell[k]).value = returnedIds[k];
                                            document.getElementById("bn" + mark_cell[k]).value = returnedNames[k];
                                        }
                              

                                    }


                                },
                                error: function(xhr, status, error) {
                                    error_fetch_alert('Error fetching:');
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

                
                            var output_arr = new Array();
                            output_arr = [];
                
                            mark_cell = [];
                            final_posible_combination = [];
                        }
                    }
                    success_alert("Algorithm finished successfully");
                    load_employee_table();


                }



               
                    /*
                    * Prvni filtrace algoritmu
                     */

                function algorithm(from, to, id, date, element, nposition, cur_id, cur_from, cur_to, mk_cell) {
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
                            error_fetch_alert('Error alg:');
                        }
                    });

                   ;
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
                        let cll = "background-color:#303030; color:white;";
                        let ppp = '<div><td>';
                        let ddd = '<div><td id="';
                        let xxx = "-";
                        let jjj = '">';
                        let ccc = '" style="min-width:153px;height:195px;border:solid black;background-color: ';
                        let zzz = ';">';
                        let qqq = "</td></div>";
                        let ttt = "<button>+</button>";
                        let mmm =
                            '<center><button class="btn btn-outline-light" style="border-radius: 20%; " onClick="reply_click(this.id)" id="b';
                        let nnn = '"><i class="bi bi-plus "></i></button></center>';
                        let bbb = "<br>";
                        let ia = '<input type="time" value="';
                        let ib = '">';
                        let ib1 = '">';
                        let xcx =
                            '<button align="right" style="font-size: 10px;pading: 10px" onClick="canceled(this.id)">X</button>';
                        let b1 =
                            '<button class="btn-close btn-close-white" style="border: 1px blackfont-size: 12px;padding-top: 10px;padding-left: 10px" onClick="canceled(this.id)" id="x';
                        let bt =
                            '<button class="btn btn-danger" style="border: 1px solid black;font-size:12px;padding-bottom 10px:" onClick="canceled(this.id)" id="x';
                        let b2 = '"></button><br><input type="button" id="bn';
                        let b7 = '<br><br><br><input type="button" id="bn';
                        let b3 = '" onClick="Open_name(this.id)" style="margin-top:0px" value="';
                        let b6 = '"><br><input type="hidden" id="hn';
                        let b4 = '" value="';
                        let b5 =
                            '"></center><br><div class="mb-3"><textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea></div></div>';
                        let t1 =
                            '<div class="form-group"><center><p class="text-light" style="display:inline;font-size:14px;float:left;margin-top:5px;margin-bottom:5px">FROM:</p><input type="time" style="height: 30px;width: 75px;font-size:13px;display:inline;float:right" id="tf'; /**class="form-control" */
                        let t3 = '<div class="form-group"><center><label for="tf';
                        let t4 =
                            '" class="text-light" style="display:inline;font-size:14px;float:left;clear: left;">FROM:</label><input type="time" style="height: 30px;width: 75px;font-size:12px;display:inline;float:right;clear: right;" class="form-control" id="tf';
                        let t2 =
                            '<p class="text-light" style="display:inline;font-size:14px;float:left;margin-top:7px;margin-bottom:10px;clear: left;">TO:</p><input type="time" style="height: 30px;width: 75px;font-size:13px;display:inline;float:right;clear: right;margin-bottom:5px" id="tt'; /**class="form-control" */
                        let t5 = '<label for="tt';
                        let t6 =
                            '" class="text-light" style="display:inline;font-size:17px;float:left">TO:</label><input type="time" style="height: 30px;width: 75px;font-size:10px;display:inline;float:right" class="form-control" id="tt';

                        let tv = '" value="';
                        let open = '--vacant--';
                        let s = "background-color:#585858;color:white;";
                        let ii = "";
                        let cen = "</center>";
                        let bt2 = '"><i class="bi bi-trash"></i></button>';
                        let txa =
                            '<div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label">Example textarea</label><textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea></div>';


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
                            '<div class="col-8 p-0"><input class="form-control" onkeyup="CalculateKey(this.id, event)" type="time" style="font-size:13px;border-radius: 0 !important;" title="Time selector" id="tf';
                        let timepicker_first_body = '" value="';
                        let timepicker_first_end =
                            '"></div></div></div></div><div class="row mb-1" style="padding-left:12px; padding-right:12px;"><div class="col-4 p-0 bg-light d-flex justify-content-center text-align-center rounded-right"><span style="font-size:13px;margin-top: 6px">To</span></div>';
                        let timepicker_second_start =
                            '<div class="col-8 p-0"><input type="time" class="form-control" onkeyup="CalculateKey(this.id, event)" style="font-size:13px; border-radius: 0 !important;" title="Time selector" id="tt';
                        let timepicker_second_body = '" value="';
                        let timepicker_second_end =
                            '"</div></div></div><div class="row"><div class="col-12"><div class="text-center">';
                        let employee_selector_start = '<input type="button" id="bn';
                        let employee_selector_end =
                            '" onClick="userSelector(this.id)" title="Employee selector" class="form-control"  data-bs-toggle="modal" data-bs-target="#usersModal" style="height: 32px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size:12px" value="';
                        let em_hidden_selector_start = '"><input type="hidden" id="hn';
                        let em_hidden_selector_body = '" value="';
                        let em_hidden_selector_end = '"></div></div></div><div class="row"><div class="col-12">';
                        let textarea_start = '<textarea class="form-control" id="tx';
                        let textarea_body =
                            '" style="height: 40px;font-size:12px;margin-top:3px;display: none" title="Comment" rows="1">';
                        let textarea_end =
                            '</textarea></div></div><div class="row mt-1" style="padding-left:13px; padding-right:13px;"><div class="col-7 p-0">';

                        let delete_start =
                            '<button class="btn btn-danger align-top" style="border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" title="Delete" onClick="canceled(this.id)" id="x';
                        let delete_end =
                            '"><i class="bi bi-trash"></i></button><button id="dt-';
                        let details_start =
                            '" type="button" class="btn btn-secondary" onclick="openDetails(this.id)" data-bs-toggle="modal" data-bs-target="#detailModal" style="border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" ><i class="bi bi-three-dots"></i></button><div id="cdt-';
                        let details_end =
                            '" style="float: right;font-size:22px;margin-top: -2px;width: 25px;height: 25px;padding:0px"><i class="bi bi-chat-left-dots-fill text-light"></i></div></div><div class="col-5 p-0">';
                        let details_end_empty =
                            '" style="float: right;font-size:22px;margin-top: -2px;width: 25px;height: 25px;padding:0px"><i class="bi bi-chat-left-dots text-light"></i></div></div><div class="col-5 p-0">';
                        let paste_start =
                            '<button type="button" class="btn btn-primary" style="border: 1px solid black;font-size:15px;margin-top:2px;margin-left:2px;width: 25px;height: 25px;padding:0px;float:right" title="Paste" onClick="paste_cell(this.id)" id="pa';
                        let paste_end = '">P</button>';
                        let copy_start =
                            '<button type="button" class="btn btn-primary" style="border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:right" title="Copy" onClick="copy_cell(this.id)" id="co';
                        let copy_end = '">C</button></div></div></div></td>';





                        if (day == "Monday") {
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
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                        }

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
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                    }


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
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                        }
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
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                    }
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
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                        }
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
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                    }
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
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                        }
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
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                    }
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
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                        }
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
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                    }
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
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                        }
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
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                    }
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
                                        if (str3 == "" || str3 == null) {
                                            var comment_icon = details_end_empty;
                                        } else {
                                            var comment_icon = details_end;
                                        }
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
                                    if (str3 == "" || str3 == null) {
                                        var comment_icon = details_end_empty;
                                    } else {
                                        var comment_icon = details_end;
                                    }
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
                        url: '{{ route('pickLoaderCalendarEditor') }}',
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
                            error_fetch_alert('Error fetching imageaa _ filter:');
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
                                    error_fetch_alert('Error fetching image');
                                }

                            });

                        },
                        error: function(xhr, status, error) {
                            error_fetch_alert('Error fetching imagecc:');
                        }

                    });
                  
                }

           




            </script>
            <script>
                

                function reply_click(clicked_id) {
                    let result123 = clicked_id.substring(1, 7);
                    let cha = document.getElementById(result123);
                    let final = "";
                    let btn1 =
                        '<button align="right" style="position:absolute;top: 0px;right: 0px;font-size: 8px;" onClick="canceled(this.id)" id="x';
                    let btn2 = '">x</button><br><br><br><br><br><input type="button" id="bn';
                    let btn3 = '" onClick="Open_name(this.id)" value="--vacant--"><input type="hidden" id="hn';
                    let btn4 = '" value=""></center></div>';
                    let val = "00:00";
                    let brr = "<br>";
                    let tm1 =
                        '<div class="form-group"><center><p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:5px;margin-bottom:5px">FROM:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;" class="form-control" id="tf';
                    let tm2 =
                        '<p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:7px;margin-bottom:10px;clear: left;">TO:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;margin-bottom:5px" class="form-control" id="tt';
                    let tmv = '" value="';
                    let tmc = '">';
                    let tmc2 = '">';
                    let bt =
                        '<button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:12px;" onClick="canceled(this.id)" id="x';
                    let bt2 = '"><i class="bi bi-trash"></i></button>';

                    let = "";

                    let progress_start1 = '<div class="progress mx-1" id="pb-'

                    let progress_start2 =
                        '" style="height: 7px;"><div class="progress-bar bg-light" role="progressbar" style="width: ';
                    let progress_fill = '%" aria-valuenow="';

                    let progress_middle =
                        '" aria-valuemin="0" aria-valuemax="100"></div><div class="progress-bar bg-warning" role="progressbar" style="width: ';
                    let progress_end = '" aria-valuemin="0" aria-valuemax="100"></div></div>';

                    let new_start =
                        '<div style="margin: 5px;width: 140px"><div class="row"><div class="col-12"><div class="row mb-1" style="padding-left:12px; padding-right:12px;"><div class="col-4 p-0 bg-light d-flex justify-content-center text-align-center rounded-right"><span style="font-size:13px;margin-top: 6px" id="basic-addon1">From</span></div>';
                    let timepicker_first_start =
                        '<div class="col-8 p-0"><input class="form-control" type="time" onkeyup="CalculateKey(this.id, event)" style="font-size:13px;border-radius: 0 !important;" title="Time selector" id="tf';
                    let timepicker_first_body = '" value="';
                    let timepicker_first_end =
                        '"></div></div></div></div><div class="row"><div class="col-12"><div class="row mb-1" style="padding-left:12px; padding-right:12px;"><div class="col-4 p-0 bg-light d-flex justify-content-center text-align-center rounded-right"><span style="font-size:13px;margin-top: 6px" id="basic-addon1">To</span></div>';
                    let timepicker_second_start =
                        '<div class="col-8 p-0"><input type="time" class="form-control" onkeyup="CalculateKey(this.id, event)" style="font-size:13px;border-radius: 0 !important;" title="Time selector" id="tt';
                    let timepicker_second_body = '" value="';
                    let timepicker_second_end =
                        '"></div></div></div></div><div class="row"><div class="col-12"><div class="text-center">';
                    let employee_selector_start = '<input type="button" id="bn';
                    let employee_selector_end =
                        '" onClick="userSelector(this.id)" title="Employee selector" class="form-control" data-bs-toggle="modal" data-bs-target="#usersModal" style="height: 32px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size:12px" value="--vacant--';
                    let em_hidden_selector_start = '"><input type="hidden" id="hn';
                    let em_hidden_selector_body = '" value="';
                    let em_hidden_selector_end = '"></div></div></div><div class="row"><div class="col-12">';
                    let textarea_start = '<textarea class="form-control" id="tx';
                    let textarea_body =
                        '" style="height: 40px;font-size:12px;margin-top:3px;display: none" title="Comment" rows="1">';
                    let textarea_end =
                        '</textarea></div></div><div class="row mt-1" style="padding-left:13px; padding-right:13px"><div class="col-7 p-0">';
                    let delete_start =
                        '<button class="btn btn-danger align-top" style="border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" title="Delete" onClick="canceled(this.id)" id="x';
                    let delete_end =
                        '"><i class="bi bi-trash"></i></button><button id="dt-';
                    let details_start =
                        '" type="button" class="btn btn-secondary" onclick="openDetails(this.id)" data-bs-toggle="modal" data-bs-target="#detailModal" style="border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" ><i class="bi bi-three-dots"></i></button><div id="cdt-'
                    let details_end =
                        '" style="float: right;font-size:22px;margin-top: -2px;width: 25px;height: 25px;padding:0px"><i class="bi bi-chat-left-dots text-light"></i></div></div><div class="col-5 p-0">';
                    // let details_end_empty =
                    //   '" style="float: right;font-size:22px;margin-top: -2px;width: 25px;height: 25px;padding:0px"><i class="bi bi-chat-left-dots-fill text-light"></i></div></div><div class="col-6 p-0">';
                    let paste_start =
                        '<button type="button" class="btn btn-primary" style="border: 1px solid black;font-size:15px;margin-top:2px;margin-left:2px;width: 25px;height: 25px;padding:0px;float:right" title="Paste" onClick="paste_cell(this.id)" id="pa';
                    let paste_end = '">P</button>';
                    let copy_start =
                        '<button type="button" class="btn btn-primary" style="border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:right" title="Copy" onClick="copy_cell(this.id)" id="co';
                    let copy_end = '">C</button></div></div></div></td>';

                    let str1 = "00:00:00";
                    let str2 = "00:00:00";
                    doneChnages = true;

                    final = progress_start1 + result123 + progress_start2 + fromBarCalculator(str1) + progress_fill +
                        fromBarCalculator(str1) + progress_middle + toBarCalculator(str1, str2) + progress_fill + toBarCalculator(
                            str1, str2) + progress_end + new_start + timepicker_first_start + result123 + timepicker_first_body +
                        val + timepicker_first_end +
                        timepicker_second_start + result123 + timepicker_second_body + val + timepicker_second_end +
                        employee_selector_start + result123 + employee_selector_end + em_hidden_selector_start + result123 +
                        em_hidden_selector_body + em_hidden_selector_end + textarea_start + result123 + textarea_body +
                        textarea_end + delete_start + result123 + delete_end + result123 + details_start + result123 + details_end +
                        paste_start + result123 + paste_end + copy_start +
                        result123 + copy_end;

                    cha.innerHTML = final;
                    load_employee_table();
                }



                function canceled(clicked_id) {
                    if(controlDelete == true ){
                        question_delete_alert(clicked_id);

                    }else{
                        
                        deleteCell(clicked_id);
                    }
               
                }
                function deleteCell(clicked_id){
                    let result123 = clicked_id.substring(1, 7);
                    let cha = document.getElementById(result123);
                    let can = "";
                    let mmm =
                        '<center><button class="btn btn-outline-light" style="border-radius: 20%;" onClick="reply_click(this.id)" id="b';
                    let nnn = '"><i class="bi bi-plus fa-10x"></i></button></center>';
                    can = mmm + result123 + nnn;
                    cha.innerHTML = can;
                    doneChnages = true;
                    load_employee_table();  
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
                function error_fetch_alert(message) {
                    Swal.fire({
                        title: "Error fetching data",
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
                function algorithm_alert() {
                    Swal.fire({
                        title: "Do you want to start algorithm ?",
                        text: "It will fill vacant shifts",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirm"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            cell_selector();
                        
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
