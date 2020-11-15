jQuery('select#special-call').change(setCallDesc);
jQuery(document).ready(setCallDesc);

function setCallDesc() {
    sign = jQuery('select#special-call').first().val();
    jQuery.get('/special-calls/show/' + sign, function (data, status) {
        jQuery('div#call-desc').html(data);
    });
}
