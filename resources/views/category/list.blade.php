<x-app-layout>
    @if (session('flash_message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('flash_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-4 mt-4 text-center">
        <h1 class="mb-3" style="font-size: 1.5rem;">Category List</h1>
    </div>
    <a href="{{ route('category.create.show') }}" class="btn btn-success btn-md mr15 mb10">Add Category</a>

    <div class="card">
        <div class="card-body">
            <div id="main_table">
                <span class="table-count" id="table_count"></span>
                <table class="table table-bordered data-table" id="data-list-table"
                    data-url="{{ route('category.list.data') }}">
                    <thead>
                        <tr>
                            <th class="mw50">Id</th>
                            <th class="mw70">Name</th>
                            <th class="mw70">Description</th>
                            <th class="mw70">Product Count</th>
                            <th class="mw100">Action</th>
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
            const CATEGORY_DELETE_URL = @json(route('category.delete', ['id' => 'resourceId']));
            const CATEGORY_EDIT_URL = @json(route('category.edit.show', ['id' => 'resourceId']));
        </script>
        <script src="{{ asset('scripts/common/list.js') }}"></script>
        <script src="{{ asset('scripts/category/list.js') }}"></script>
    @endpush
</x-app-layout>
