$(document).ready(function() {
    $('#update').click(function() {

        // Sending AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'update',
            data: {
                'allegic_status' : $('#allegic_status').val(),
                'allegic_des' : $('#allegic_des').val(),
                'check_date' : $('#check_date').val(),
                'kg' : $('#kg').val(),
                'bp' : $('#bp').val(),
                'investigation' : $('#investigation_3').val(),
                'next_day_investigation' : $('#next_day_investigation').val(),
                'problem' : $('#problem_3').val(),
                'current_problem' : $('#problem_4').val(),
                'clinic_followup' : $('#clinic_followup_3').val(),
                'note' : $('#note_3').val()

            },
            success:function(data){
                location.reload();
            }
        });
    });
});
