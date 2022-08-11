$('.js-alert-set').css('display', 'flex').hide().fadeIn(750);

$('#js-alert').not('#js-alert-important').delay(3000).fadeOut(400);

$('#js-alert-close').on('click', function() {
    $("[id^=js-alert]").delay(200).fadeOut(400);
});
