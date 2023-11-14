$(document).ready(function() {
    $('#addDrug').click(function() {
        // Get form input feilds
        var code = $('#code').val();
        var drug_name = $('#drug_name_2').val();

        // Sending ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'add-normal-drugs',
            data: {'code': code, 'drug_name': drug_name},
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
