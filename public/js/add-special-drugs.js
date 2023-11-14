$(document).ready(function() {
    $('#addSpecialDrugs').click(function() {
        // Get form input feilds
        var code_1 = $('#code_2').val();
        var drug_name_1 = $('#drug_name_4').val();

        // Sending ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'add-special-drugs',
            data: {'code': code_1, 'drug_name': drug_name_1},
            success:function(data){
                alert('Drug added successfully');
                location.reload();
            },
            error:function(data){
                alert('Can\'t save drug. Use Drug manage section to add new drug');
            }
        });
    });
});
