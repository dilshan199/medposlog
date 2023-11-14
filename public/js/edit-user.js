$(document).ready(function() {
    $('body').on('click', '#editButton', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#editModal').show();
            $('#user_id_2').val(data.user_id);
            $('#user_type_2').val(data.user_type);
            $('#user_name_2').val(data.user_name);
        })
     });

     $('#updateCategory').click(function() {
        var user_id = $('#user_id_2').val();
        var user_type = $('#user_type_2').val();
        var user_name = $('#user_name_2').val();
        var _token = $('#_token').val();
        var url = 'update/'+ user_id;
        // Send form data using ajax
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': _token, 'user_id': user_id, 'user_type': user_type, 'user_name': user_name},
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
