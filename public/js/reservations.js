$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
    }
});

jQuery('select#call-sign').change(fillTable);
jQuery(document).ready(fillTable);

function fillTable() {
    tableData = jQuery('table#ajax-table>tbody').first();
    tableData.html('<tr><td class="font-weight-bold text-center" colspan="13">Loading...</td></tr>');

    sign = jQuery('select#call-sign').first().val();

    jQuery.post('/special-calls/reservations', {'call-sign': sign}, function (data, status) {
        if (status === 'success') {
            if (data.data.length > 0) {
                tableData.empty();
                for (i = 0, len = data.data.length; i < len; i++) {
                    tr = '<tr>';
                    tr += '<td>' + data.data[i].id + '</td>';
                    if (data.data[i].approved === 1)
                        tr += '<td class="text-center"><input type="checkbox" checked></td>';
                    else
                        tr += '<td class="text-center"><input type="checkbox"></td>';

                    tr +=
                        '<td contenteditable="true">' + data.data[i].operatorCall + '</td>' +
                        '<td contenteditable="true">' + data.data[i].qso + '</td>' +
                        '<td contenteditable="true">' + data.data[i].fromTime + '</td>' +
                        '<td contenteditable="true">' + data.data[i].toTime + '</td>' +
                        '<td contenteditable="true">' + data.data[i].specialCall + '</td>' +
                        '<td contenteditable="true">' + data.data[i].frequencies + '</td>' +
                        '<td contenteditable="true">' + data.data[i].modes + '</td>' +
                        '<td contenteditable="true">' + data.data[i].operatorName + '</td>' +
                        '<td contenteditable="true">' + data.data[i].operatorEmail + '</td>' +
                        '<td contenteditable="true">' + data.data[i].operatorPhone + '</td>';
                    tr += '<td>';
                    tr += "<button class=\"btn btn-primary mr-2\" onclick=\"btnAction('update', this)\">Update</button>";
                    tr += "<button class=\"btn btn-warning mr-2\" onclick=\"btnAction('restore', this)\">Restore</button>";
                    tr += "<button class=\"btn btn-danger\" onclick=\"btnAction('delete', this)\">Delete</button>";
                    tr += '</td>';
                    tr += '</tr>';
                    tableData.append(tr);
                }
            }
            else {
                tableData.html('<tr><td class="font-weight-bold text-center" colspan="13">No data...</td></tr>');
            }
        }
        else {
            tableData.html('<tr><td class="font-weight-bold text-center" colspan="13">Error!</td></tr>');
        }
    });
}

function btnAction(action, btn) {
    trDom = btn.parentElement.parentElement;
    trData = trDom.children;

    actionData = {
        action: action,
        id: trData[0].innerText,
        approved: trData[1].firstElementChild.checked,
        operatorCall: trData[2].innerText,
        qso: trData[3].innerText,
        fromTime: trData[4].innerText,
        toTime: trData[5].innerText,
        specialCall: trData[6].innerText,
        frequencies: trData[7].innerText,
        modes: trData[8].innerText,
        operatorName: trData[9].innerText,
        operatorEmail: trData[10].innerText,
        operatorPhone: trData[11].innerText
    };

    if (actionData.action == 'delete') {
        if (confirm("Are you sure you want to delete reservation #" + actionData.id + " made by " + actionData.operatorCall + "?") === true)
            trDom.remove();
        else return;
    }

    jQuery.post('/api/reservations', actionData, function (response, status) {
        if (status === 'success') {
            try {
                // Handle various actions
                if (response.action == "update") {
                    jQuery('#notice').html("Record #" + actionData.id + " updated.");
                } else if (response.action == "restore") {
                    trData[1].firstElementChild.checked = response.approved == 1;
                    trData[2].innerText = response.operatorCall;
                    trData[3].innerText = response.qso;
                    trData[4].innerText = response.fromTime;
                    trData[5].innerText = response.toTime;
                    trData[6].innerText = response.specialCall;
                    trData[7].innerText = response.frequencies;
                    trData[8].innerText = response.modes;
                    trData[9].innerText = response.operatorName;
                    trData[10].innerText = response.operatorEmail;
                    trData[11].innerText = response.operatorPhone;
                    jQuery('#notice').html("Record's #" + actionData.id + " data restored.");
                } else if (response.action == "delete") {
                    jQuery('#notice').html("Record #" + actionData.id + " deleted.");
                } else {
                    console.log("No action?");
                    //console.log(data);
                }
            } catch {
                //console.log(data);
                alert("Bad input data!");
            }
        }
        else {
            console.log('AJAX error');
            alert("Bad input data!");
        }
    });
}
