$(document).ready(function() {
    $('#addClinic').click(function() {
        // Get form input values
        var clinic_followup = $('#clinic_followup_2').val();

        // Sending AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'add-clinic',
            data: 'clinic_followup='+clinic_followup,
            success:function(data){
                alert('Clinic followup added successfully');
                location.reload();
            },
            error:function(data){
                alert('Record not saved');
            }
        });
    });
});
