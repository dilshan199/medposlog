$(document).ready(function() {
    $('body').on('click', '#editButton', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#editModal').show();
            $('#clinic_id_2').val(data.clinic_id);
            $('#clinic_2').val(data.clinic_followup);
        })
     });

     $('#updateCategory').click(function() {
        var clinic_id = $('#clinic_id_2').val();
        var clinic_followup = $('#clinic_2').val();
        var _token = $('#_token').val();
        var url = 'update/'+ clinic_id;
        // Send form data using ajax
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': _token, 'clinic_id': clinic_id, 'clinic_followup': clinic_followup},
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
