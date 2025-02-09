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
    <link rel="stylesheet"
        href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Document</title>
</head>

<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <x-guest-layout>
        <!-- Session Status -->


        <div>
            <center><x-input-label for="ver" :value="__('Enter verfification code')" /></center>
            <x-text-input id="ver" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>



        <div class=" mt-4">
            <center>
                <x-primary-button class="ms-3" onclick="send_verification()">
                    {{ __('Verify') }}
                </x-primary-button>
            </center>
        </div>
        <script>
            function send_verification() {
                var code = document.getElementById("ver").value;
                $.ajax({
                    url: '{{ route('verification_action') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        code: code, 

                    },
                    success: function(response) {
                        if(response == "success"){
                            success_alert("Account was verified successfully");
                            document.getElementById("ver").value = "";
                        }else{
                            error_alert("Incorrect code");
                        }
                    },
                    error: function(response) {
                      error_alert("Connection failed");

                    }
                });
            }

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
        </script>
    </x-guest-layout>
</body>

</html>
