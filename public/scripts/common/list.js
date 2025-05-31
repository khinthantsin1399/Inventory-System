
$(document).ready(function () {
  $(document).on("click", ".delete-btn", function () {
    let button = $(this);
    deleteUrl = button.data('url');
    resourceId = button.data('id');
    $.ajax({
      url: deleteUrl,
      type: 'POST',
      data: {
        '_token': $('meta[name="csrf-token"]').attr("content"), // Laravel expects this to simulate DELETE
        'id' : resourceId,
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            processData: false,
            contentType: false,
            success: function (data, status, jqXHR) {
                table.draw();
            },
        });
    });

    // Redraw table on click Hamburger menu
    $('.bx-menu').on('click', function () {
        setTimeout(function () {
            table.columns.adjust().draw();
        }, 500);
    });
});

/**
 * set up datatable setting
 * @param {array} coldef 
 * @returns 
 */
function datatable_setting(coldef, url = $("#data-list-table").data("url"), tableId = null) {
    return {
        language: {
            searchPlaceholder: ""
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        scrollX: true,
        responsive: true,
        "ordering": false,
        columnDefs: map_datatable_columns(coldef),
        ajax: {
            url: url,
            method: "post",
            dataSrc: function (json) {
                recordsTotal = json.recordsTotal;
                return json.data;
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        },
      dom: "<'search-option mb20'<'search-right'BlZ>>" +
      "<'count-option'<'row-count'> <'list-option p-0 clearfix'p>>" +
      "<'relative'rt>" +
      "<'list-option border-top mt40 pt15'p>",
      scrollX: true,
      pageLength: 10,
      lengthMenu: [
          [10, 25, 50, 100],
          [10, 25, 50, 100],
      ],
      autoWidth: false,
      fixedColumns: false,
      drawCallback: function() {
          $("#table_count").html("Total&nbsp;&nbsp;<strong>" + recordsTotal + "</strong>" + "&nbsp;&nbsp;entries&nbsp;&nbsp;&nbsp;");
      },
      stateSave: false,
    }
}
