$(document).ready(function() {
    $('body').on('click', '#editButton', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#editModal').show();
            $('#frequency_id_2').val(data.frequency_id);
            $('#frequency_2').val(data.frequency);
        })
     });

     $('#updateCategory').click(function() {
        var frequency_id = $('#frequency_id_2').val();
        var frequency = $('#frequency_2').val();
        var _token = $('#_token').val();
        var url = 'update/'+ frequency_id;
        // Send form data using ajax
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': _token, 'frequency_id': frequency_id, 'frequency': frequency},
            success: function(data){
                alert("Record updated successfully...");
                location.reload();
            },
            error: function(data){
                alert('Sorry! Can\'t update record...');
                location.reload();
            }
        });

     });

     $('#closeBtn').click(function() {
        $('#editModal').hide();
     });

     $('#closeBtn_2').click(function() {
        $('#editModal').hide();
     });
});
