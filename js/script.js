jQuery("#create-button").click(() => {
    jQuery("#create-form").css('display', "inline-block");
    jQuery("#create-form").addClass('fade-in');
    jQuery("#join-form").css('display', "none");
});

jQuery("#join-button").click(() => {
    jQuery("#join-form").css('display', "inline-block");
    jQuery("#join-form").addClass('fade-in');
    jQuery("#create-form").css('display', "none");
});
