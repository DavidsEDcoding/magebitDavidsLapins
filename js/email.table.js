
$(document).ready(function () {
    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

var emails_asc = true;
var date_asc = false;
function sortTableByEmail() {
    let rows = $("table").find("tbody > tr");
    rows.sort(function (a, b) {
        var value1 = $(a).children("td").eq(1).text()
        var value2 = $(b).children("td").eq(1).text()
        return asc_or_desc(value1, value2, emails_asc)
    });
    $.each(rows, function (index, row) {
        $("tbody").append(row)
    })

    emails_asc = !emails_asc;
}

function sortTableByDate() {
    let rows = $("table").find("tbody > tr");
    rows.sort(function (a, b) {
        var value1 = $(a).children("td").eq(2).text()
        var value2 = $(b).children("td").eq(2).text()
        return asc_or_desc(value1, value2, date_asc)
    });
    $.each(rows, function (index, row) {
        $("tbody").append(row)
    })

    date_asc = !date_asc;
}
function asc_or_desc(v1, v2, asc) {
    if (asc) {
        return (v1 < v2) ? -1 : (v1 > v2 ? 1 : 0)
    }
    else {
        return (v1 > v2) ? -1 : (v1 < v2 ? 1 : 0)
    }
}