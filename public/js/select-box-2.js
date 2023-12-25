$(document).ready(function() {
    $('.click-in-txt-2').click(function() {
        var id = $(this).attr('id');
        if(id == 'problem_3'){
            $('#problemList').css('display', 'block');
            $('#CproblemList').css('display', 'none');
        }else{
            $('#CproblemList').css('display','block');
            $('#problemList').css('display', 'none');
        }
    });
});
