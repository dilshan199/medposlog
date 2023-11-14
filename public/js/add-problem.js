$(document).ready(function() {
    $('#addProblem').click(function() {
        // Get form input values
        var problem = $('#problem_2').val();

        // Sending AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'add-problem',
            data: 'problem='+problem,
            success:function(data){
                alert('Problem added successfully');
                location.reload();
            },
            error:function(data){
                alert('Record not saved');
            }
        });
    });
});
