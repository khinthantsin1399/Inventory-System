var product = [];
var coldef = [
    "id",
    "name",
    "code",
    {
        data: 'category',
        render: function(data, type, full, meta) {
            return full.category_name;
        },
    },
    {
        data: 'brand',
        render: function(data, type, full, meta) {
            return full.brand_name;
        },
    },
    {
        data: 'image',
        render: function(data, type, full, meta) {
            if (full.image_path) {
                return '<img src="' + full.image_path + '" class="table-profile-img" style="width: 75px; height: 75px; object-fit: cover;" alt="">';
            } else {
                return '<img src="' + "/img/no-image-icon.png" + '" class="table-profile-img" style="width: 75px; height: 75px; object-fit: cover;" alt="">';
            }
        }
    },
    "price",
    {
        data: 'quantity',
        render: function(data, type, full, meta) {
            return full.quantity === 0 ? '0' : full.quantity ?? '';
        }
    },
    "description",
    {
        data: 'id',
        render: function (data, type, full, meta) {
            var deleteUrl = PRODUCT_DELETE_URL.replace('resourceId', full.id);
            var editUrl = PRODUCT_EDIT_URL.replace('resourceId', full.id);
            var detailUrl = PRODUCT_DETAIL_URL.replace('resourceId', full.id);
            deleteBtn = '';
            deleteBtn = '<button class="btn btn-outline btn-danger delete-btn mr15 mb10" data-url="' + deleteUrl + '" data-id="' + full.id + '"">Delete</button>';
            editBtn = '';
            editBtn = '<a class="btn btn-success btn-md mr15 mb10" href="' + editUrl + '">Edit</a>';
            detailBtn = '';
            detailBtn = '<a class="btn btn-success btn-md mb10" href="' + detailUrl + '">Detail</a>';
            return '<div class="btn-action-group">' + deleteBtn + editBtn + detailBtn + '</div>';
        }
    }
]

var table = $("#product_list_table")
    .on("preXhr.dt", function (e, settings, data) {
        data._token = $('meta[name="csrf-token"]').attr("content");
        data.filter = {};
        // for category filter
        var categoryIdList = CATEGORY_LIST.map(category => category.id);
        var categoryFilter = parseInt($('#category_filter').val());
        if (categoryIdList.indexOf(categoryFilter) >= 0) {
            data.filter.category = categoryFilter;
        }
        // for brand filter
        var brandIdList = BRAND_LIST.map(brand => brand.id);
        var brandFilter = parseInt($('#brand_filter').val());
        if (brandIdList.includes(brandFilter)) {
            data.filter.brand = brandFilter;
        }
        var input = $('#searchInput').val();
        if (input && input.trim() !== '') {
            data.filter.searchData = input.trim();
        }
    })
    .DataTable({
        order: [],
        processing: true,
        serverSide: true,
        deferRender: true,
        columnDefs: map_datatable_columns(coldef, {
            disabled_cols: [],
        }),
        autoWidth: true,
        fixedColumns: true,
        ajax: {
            url: $("#product_list_table").data("url"),
            method: "POST",
            dataSrc: function (json) {
                recordsTotal = json.recordsTotal;
                return json.data;
            },
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
        drawCallback: function () {
            $("#table_count").html("Total&nbsp;&nbsp;<strong>" + recordsTotal + "</strong>" + "&nbsp;&nbsp;Entries&nbsp;&nbsp;&nbsp;");
        },
        stateSave: false,
    });

$('.search-right').addClass('d-flex align-items-center gap-2');
$('#category_filter_container, #brand_filter_container, .search-box').addClass('ms-2');
$("#category_filter_container").appendTo($('#main_table div.search-right'));
$("#brand_filter_container").appendTo($('#main_table div.search-right'));
$(".search-box").appendTo($('#main_table div.search-right'));
$(".row-count").prepend($('#table_count'));

$('#category_filter').change(function () {
    table.draw();
});

$('#brand_filter').change(function () {
    table.draw();
});

$('#searchBtn').on('click', function () {
    table.draw();
});

$('#clearBtn').on('click', function () {
    $('#searchInput').val('');
    table.draw();
});

$("#product_output_csv").on('click', function () {
    $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'product': product,
            'order': table.order(),
        },
        success: function (response) {
            var universalBOM = "\uFEFF";
            var url = window.URL.createObjectURL(new Blob([response]));
            var link = document.createElement('a');
            var month = String(new Date().getMonth() + 1).padStart(2, '0');
            var date = String(new Date().getDate()).padStart(2, '0');
            var filename = "PRODUCT_" + new Date().getFullYear() + month + date + ".csv";
            link.href = url;
            link.setAttribute('href', 'data:text/csv; charset=utf-8,' + encodeURIComponent(universalBOM + response));
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
        },
    });
});
