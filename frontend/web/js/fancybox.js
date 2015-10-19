/**
 *
 * Created by npr on 7/7/2015 AD.
 */
$(document).ready(function(){
    $(".fancyBoxPDF").click(function() {
        $.fancybox({
            type: 'html',
            'autoDimensions': false,
            'autoScale': false,
            'content': '<embed src="' + this.href + '#nameddest=self&page=1&view=FitH,0&zoom=80,0,0" type="application/pdf" height="700" width="700" />',
            'onClosed': function() {
                $("#fancybox-inner").empty();
            }
        });
        return false;
    }); // pdf
});