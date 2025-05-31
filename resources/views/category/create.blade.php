<x-app-layout>
    <div class="mb-4 mt-4 text-center">
        <h1 class="mb-3" style="font-size: 1.5rem;">Category Create</h1>
    </div>

    <div class="card mt20 mb50">
        <div class="card-body">
            {{ Form::open(['route' => 'category.create', 'method' => 'POST', 'class' => 'k-form', 'autocomplete' => 'off']) }}

            @include('category.input_form')

            <div class="text-center mb20">
                {{ Form::submit('Create', ['class' => 'btn-confirm']) }}
            </div>

            {{ Form::close() }}
        </div>
    </div>
</x-app-layout>
