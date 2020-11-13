$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
    }
});

jQuery('select#call-sign').change(fillTable);
jQuery(document).ready(fillTable);

function fillTable() {
    sign = jQuery('select#call-sign').first().val();
    jQuery.post('/api/activities', {'call-sign': sign}, function (data, status) {
        console.log(data);
    });
}
