<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send JS Variable to Controller</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!--<h1>Send JavaScript Variable to Controller</h1>

    <button id="sendData">Send Data</button>

    <div id="responseMessage"></div>
    <table id="targetTable" border="1">
        <thead>
            <tr class="new-row">
                <th>Col 1</th>
                <th>Col 2</th>
                <th>Col 3</th>
            </tr>
        </thead>
        <tbody>
            <tr class="new-row">
                <td><span class="event" id="a" draggable="true">Move Me</span></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="new-row">
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <p><button id='addRow'>Add Row</button></p>
    <p>
        You can successfully drag the "Move Me" block to any cell in the first two rows.<br />But add a new row with the
        "Add Row" button, and you can't drop that block into any new row.
    </p>-->
    <div class="row h-25">
    </div>
    <div class="row" style="position: relative; overflow: auto; width: 100%; max-height: 80vh;height: 100vh">
        <div class="col-6">
            <div class="card bg-dark" style="height: 100vh">
                <p>
                    dsa
                </p>
              
                  
            </div>
        </div>
    </div>
    <script>
        // JavaScript variable to send to the controller
        var jsVar = 1;

        // When the button is clicked, send the JavaScript variable via AJAX
        //$('#sendData').click(function() {
        $.ajax({
            url: '{{ route('structureGet') }}', // Route for sending data
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token for security
                js_var: jsVar // Send the JavaScript variable here
            },
            success: function(response) {
                // Show the response from the controller
                // $('#responseMessage').html(response.message);
                alert(response.message);
            },
            error: function(response) {

                // Handle any error that occurs
                //$('#responseMessage').html('An error occurred.');
            }
        });
        //});
    </script>

    <script>
        $(function() {
            $('.event').on("dragstart", function(event) {
                var dt = event.originalEvent.dataTransfer;
                dt.setData('Text', $(this).attr('id'));
            });
            initnewrows();
            $('#addRow').on('click', function() {
                $('#targetTable > tbody:last-child').append(
                    '<tr class="new-row"><td></td><td></td><td></td></tr>');
                initnewrows();
            });
        });

        function initnewrows() {
            $('table tr.new-row td').on("dragenter dragover drop", function(event) {
                event.preventDefault();
                if (event.type === 'drop') {
                    var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
                    de = $('#' + data).detach();
                    de.appendTo($(this));
                }
            });
            $('table tr.new-row').removeClass('new-row');
        }
    </script>

</body>

</html>
