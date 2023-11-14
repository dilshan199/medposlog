$(document).ready(function() {
    $('body').on('click', '#editButton', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#editModal').show();
            $('#investigation_id_2').val(data.investigation_id);
            $('#investigation_2').val(data.investigation);
        })
     });

     $('#updateCategory').click(function() {
        var investigation_id = $('#investigation_id_2').val();
        var investigation = $('#investigation_2').val();
        var _token = $('#_token').val();
        var url = 'update/'+ investigation_id;
        // Send form data using ajax
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': _token, 'investigation_id': investigation_id, 'investigation': investigation},
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
