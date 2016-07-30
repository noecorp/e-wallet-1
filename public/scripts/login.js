

jQuery(document).ready(function() {
    jQuery('#register-btn').click(function() {
        jQuery('.login-form').hide();
        jQuery('.register-form').show();
    });

    jQuery('#register-back-btn').click(function() {
        jQuery('.login-form').show();
        jQuery('.register-form').hide();
    });
});