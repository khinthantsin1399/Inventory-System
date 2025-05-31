<x-app-layout>
    @if (session('flash_message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('flash_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-4 mt-4 text-center">
        <h1 class="mb-3" style="font-size: 1.5rem;">Product List</h1>
    </div>
    <div class="search-box">
        <div class="row m-0">
            <div class="col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control mr10" placeholder="Search here..." id="searchInput">
                    <button class="btn btn-success mr15 btn-md rounded-2" type="button" id="searchBtn">
                        Search
                    </button>
                    <button class="btn btn-success btn-md rounded-2" type="button" id="clearBtn">
                        Clear
                    </button>
                </div>
            </div>
        </div>
    </div>
    <span id="category_filter_container" class="mr15">
        <div class="custom-select select-arrow">
            <select id="category_filter" class="form-select">
                <option value="" selected="selected">Filter By Category</option>
                @foreach ($categoryList as $categoryData)
                    <option value="{{ $categoryData->id }}">
                        {{ $categoryData->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </span>
    <span id="brand_filter_container">
        <div class="custom-select select-arrow">
            <select id="brand_filter" class="form-select">
                <option value="" selected="selected">Filter By Brand</option>
                @foreach ($brandList as $brandData)
                    <option value="{{ $brandData->id }}">
                        {{ $brandData->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </span>
    <div class="d-flex justify-content-between align-items-center flex-wrap my-4">
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('product.create.show') }}" class="btn btn-success btn-md">
                Add Product
            </a>

            <button type="button" class="btn btn-outline btn-success" id="product_output_csv"
                data-url="{{ route('product.csv.download') }}">
                Download CSV
            </button>
        </div>
        <div class="card text-white bg-success shadow mb-0 mt-2 mt-md-0" style="min-width: 350px;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Total Stock Value</h6>
                <h5 class="mb-0 fw-bold">{{ number_format($totalStockValue, 2) }} MMK</h5>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div id="main_table">
                <span class="table-count" id="table_count"></span>
                <table class="table table-bordered data-table" id="product_list_table"
                    data-url="{{ route('product.list.data') }}">
                    <thead>
                        <tr>
                            <th class="mw50">ID</th>
                            <th class="mw70">Name</th>
                            <th class="mw50">Code</th>
                            <th class="mw60">Category</th>
                            <th class="mw100">Brand</th>
                            <th class="mw50">Image</th>
                            <th class="mw90">Price</th>
                            <th class="mw90">Quantity</th>
                            <th class="mw50">Description</th>
                            <th class="mw50">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="btn_add_dropdown" class="d-flex justify-content-center mt20 mb40">
            </div>
        </div>
    </div>
    @push('javascript')
        <script>
            const CATEGORY_LIST = @json($categoryList);
            const BRAND_LIST = @json($brandList);
            const PRODUCT_DELETE_URL = @json(route('product.delete', ['id' => 'resourceId']));
            const PRODUCT_EDIT_URL = @json(route('product.edit.show', ['id' => 'resourceId']));
            const PRODUCT_DETAIL_URL = @json(route('product.detail.show', ['id' => 'resourceId']));
        </script>
        <script src="{{ asset('scripts/common/list.js') }}"></script>
        <script src="{{ asset('scripts/product/list.js') }}"></script>
    @endpush
</x-app-layout>
