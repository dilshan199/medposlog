$(document).ready(function() {
    $('#addInvestigation').click(function() {
        // Get form input values
        var investigation = $('#investigation_2').val();

        // Sending AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'add-investigation',
            data: 'investigation='+investigation,
            success:function(data){
                alert('Investigation added successfully');
                location.reload();
            },
            error:function(data){
                alert('Record not saved');
            }
        });
    });
});
