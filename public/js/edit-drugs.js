$(document).ready(function() {
    $('body').on('click', '#editButton', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#editModal').show();
            $('#drug_id_2').val(data.drug_id);
            $('#code_2').val(data.code);
            $('#drug_name_2').val(data.drug_name);
            $('#dosage_2').val(data.dosage);
        })
     });

     $('#updateCategory').click(function() {
        var drug_id = $('#drug_id_2').val();
        var code = $('#code_2').val();
        var drug_name = $('#drug_name_2').val();
        var dosage = $('#dosage_2').val();
        var _token = $('#_token').val();
        var url = 'update/'+ drug_id;
        // Send form data using ajax
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': _token, 'drug_id': drug_id, 'code': code, 'drug_name': drug_name, 'dosage': dosage},
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
