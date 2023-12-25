$(document).ready(function() {
    $(window).on("load",function(){
        $('body').print({
            //Add link with attrbute media=print
            mediaPrint : false,
            //Print in a hidden iframe
            iframe : false,
            //Log to console when printing is done via a deffered callback
            deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
        });
    })
})
