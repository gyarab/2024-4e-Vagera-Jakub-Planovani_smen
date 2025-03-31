<div class="favorite-list-item">
    @if($user)
        <div id="fav_img{{ $user->id }}" data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            {{--style="background-image: url('{{ Chatify::getUserWithAvatar($user)->avatar }}');"--}}>
            <script>
                getURL({{ $user->id }});

                function getURL(request) {
                    $.ajax({
                        url: '{{ route('showProfileImageChat') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: request,
                        },
                        success: function(response) {


                            document.getElementById("fav_img"+request).style.backgroundImage = "url(" + response.url +")";


                        },
                        error: function(xhr, status, error) {

                        }
                    });

                }
            </script>
        </div>
        <p>{{ strlen($user->last_name ) > 6 ? substr($user->last_name,0,6).'..' : $user->last_name }}</p>
    @endif
</div>
