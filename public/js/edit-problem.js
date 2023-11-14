$(document).ready(function() {
    $('body').on('click', '#editButton', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#editModal').show();
            $('#problem_id_2').val(data.problem_id);
            $('#problem_2').val(data.problem);
        })
     });

     $('#updateCategory').click(function() {
        var problem_id = $('#problem_id_2').val();
        var problem = $('#problem_2').val();
        var _token = $('#_token').val();
        var url = 'update/'+ problem_id;
        // Send form data using ajax
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': _token, 'problem_id': problem_id, 'problem': problem},
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
