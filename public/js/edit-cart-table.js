$(document).ready(function(){

    // Show Input element
    $('.edit').click(function(){
        $('.textedit').hide();
        $(this).next('.textedit').show().focus();
        $(this).hide();
    });

    // Save data
    $(".textedit").on('focusout',function(){

        // Get edit id, field name and value
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();;

        // Hide Input element
        $(this).hide();

        // Hide and Change Text of the container with input elmeent
        $(this).prev('.edit').show();
        $(this).prev('.edit').text(value);

        // Sending AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: 'update-cart',
            type: 'post',
            data: { 'field':field_name, 'value':value, 'id':edit_id },
            success:function(response){

            }
        });

    });

});
