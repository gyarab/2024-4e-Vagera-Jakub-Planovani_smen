<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show')
                    // change icon
                    toggle.classList.toggle('bx-x')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')

                })

            }

        }
      
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
                                    //document.getElementById("user-name").innerHTML = response.first_name + " "+ response.middle_name + " "  + response.last_name;


                                },
                                error: function(xhr, status, error) {
                                    alert('Error fetching image:', error);
                                }
                            });
                            
                        
        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
    });
</script>