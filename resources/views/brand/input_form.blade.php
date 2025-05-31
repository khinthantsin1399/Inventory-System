<div class="mb20">
    <div class="row m-0 border border-bottom-0">
        {{ Form::label('name', 'Name', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
            {{ Form::text('name', old('name', $brand->name ?? null), [
                'id' => 'name',
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => 'Enter Name',
            ]) }}
            @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row m-0 border">
        {{ Form::label('description', 'Description', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
            {{ Form::text('description', old('description', $brand->description ?? null), [
                'id' => 'description',
                'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                'placeholder' => 'Enter Description',
            ]) }}
            @error('description')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
