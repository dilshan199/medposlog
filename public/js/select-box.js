$(document).ready(function() {
    $('.click-in-txt').click(function() {
        var id = $(this).attr('id');
        if(id == 'investigation_3'){
            $('#todayInvestigation').css('display', 'block');
            $('#nextVisit').css('display', 'none');
        }else{
            $('#nextVisit').css('display','block');
            $('#todayInvestigation').css('display', 'none');
        }
    });
});
