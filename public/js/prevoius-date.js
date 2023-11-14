function getPrevoiusDate(val){
    // Sending AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: 'get-history',
        data: 'patient_id='+val,
        success: function(data){
            $('#check_date_1').html(data);
        }
    });
}
