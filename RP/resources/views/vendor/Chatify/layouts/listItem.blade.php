{{-- -------------------- Saved Messages -------------------- --}}
@if ($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="saved-messages avatar av-m">
                    <span class="far fa-bookmark"></span>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
@if ($get == 'users' && !!$lastMessage)
    <?php
    $lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
    $lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8') . '..' : $lastMessageBody;
    ?>
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                @if ($user->active_status)
                    <span class="activeStatus"></span>
                @endif
                <div class="avatar av-m" {{-- style="background-image: url('{{ $user->avatar }}');" --}}
                    id="avim{{ $user->id }}"style="background-image: url('{{ $user->id }}'); ">
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

                                    document.getElementById("avim" + request).style.backgroundImage = "url(" + response.url +
                                        ")";
                                    
                                },
                                error: function(xhr, status, error) {

                                }
                            });

                        }
                    </script>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user">
                    {{ strlen($user->first_name)+ strlen($user->middle_name) + strlen($user->last_name) > 20 ? trim(substr($user->first_name, 0, 12)) . '..' : $user->first_name ." ". $user->middle_name . " ".$user->last_name}}
                    <span class="contact-item-time"
                        data-time="{{ $lastMessage->created_at }}">{{ $lastMessage->timeAgo }}</span>
                </p>
                <span>
                    {{-- Last Message user indicator --}}
                    {!! $lastMessage->from_id == Auth::user()->id ? '<span class="lastMessageIndicator">You :</span>' : '' !!}
                    {{-- Last message body --}}
                    @if ($lastMessage->attachment == null)
                        {!! $lastMessageBody !!}
                    @else
                        <span class="fas fa-file"></span> Attachment
                    @endif
                </span>
                {{-- New messages counter --}}
                {!! $unseenCounter > 0 ? '<b>' . $unseenCounter . '</b>' : '' !!}
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if ($get == 'search_item')
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div id="search_img{{ $user->id }}" class="avatar av-m" {{-- style="background-image: url('{{ $user->avatar }}');" --}}>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user">
                    {{ strlen($user->first_name)+ strlen($user->middle_name) + strlen($user->last_name) > 20 ? trim(substr($user->first_name, 0, 12)) . '..' : $user->first_name ." ". $user->middle_name . " ".$user->last_name }}
            </td>
            <script>
                getURLSearch({{ $user->id }});

                function getURLSearch(request) {
                    $.ajax({
                        url: '{{ route('showProfileImageChat') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: request,
                        },
                        success: function(response) {


                            document.getElementById("search_img" + request).style.backgroundImage = "url(" + response.url +
                                ")";
                            


                        },
                        error: function(xhr, status, error) {

                        }
                    });

                }
            </script>

        </tr>
    </table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if ($get == 'sharedPhoto')
    <div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif
