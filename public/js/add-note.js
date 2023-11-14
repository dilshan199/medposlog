$(document).ready(function() {
    $('#addNote').click(function() {
        // Get form input values
        var note = $('#note_2').val();

        // Sending AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'add-note',
            data: 'note='+note,
            success:function(data){
                alert('Special note added successfully');
                location.reload();
            },
            error:function(data){
                alert('Record not saved');
            }
        });
    });
});
