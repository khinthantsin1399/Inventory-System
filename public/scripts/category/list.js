var coldef = [
  "id",
  "name",
    "description",
    {
        data: 'product_count',
        render: function(data, type, full, meta) {
            return full.product_count;
        },
  },
  {
    data: 'id',
    render: function (data, type, full, meta) {
        var deleteUrl = CATEGORY_DELETE_URL.replace('resourceId', full.id);
        var editUrl = CATEGORY_EDIT_URL.replace('resourceId', full.id);
        deleteBtn = '';
            deleteBtn = '<button class="btn btn-outline btn-danger delete-btn mr15" data-url="' + deleteUrl + '" data-id="' + full.id + '"">Delete</button>';
        editBtn = '';
        editBtn = '<a class="btn btn-success btn-md" href="' + editUrl + '">Edit</a>';
      return '<div class="btn-action-group">' + deleteBtn + editBtn + '</div>';
    }
},
]

table = $('#data-list-table').on('preXhr.dt', function (e, settings, data) {
    data._token = $('meta[name="csrf-token"]').attr("content");
}).DataTable(datatable_setting(coldef));

$(".search-button").appendTo($('#main_table div.search-left #user_list_table_filter'));
$("#user_list_table_filter").removeClass().addClass("dataTables_filter_custom");
$(".row-count").prepend($('#table_count'));
