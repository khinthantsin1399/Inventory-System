<div class="mb20">
    <div class="row m-0 border border-bottom-0">
        {{ Form::label('name', 'Product Name', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
            {{ Form::text('name', old('name', $product->name ?? null), [
                'id' => 'name',
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => 'Enter Name',
            ]) }}
            @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row m-0 border border-bottom-0">
        {{ Form::label('code', 'Product Code', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
            {{ Form::text('code', old('code', $product->code ?? null), [
                'id' => 'code',
                'class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''),
                'placeholder' => 'Enter Code',
            ]) }}
            @error('code')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row m-0 border border-bottom-0">
        {{ Form::label('category', 'Category', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">

            <select class="selectpicker form-control" data-live-search="true" data-size="6" title="Choose Category"
            name="category_id">
            @foreach ($categoryList as $categoryData)
                <option value="{{ $categoryData->id }}"
                    {{ old('category_id', $product->category_id ?? null) == $categoryData->id ? 'selected' : '' }}>
                    {{ $categoryData->name }}
                </option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="row m-0 border border-bottom-0">
        {{ Form::label('brand', 'Brand', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">

            <select class="selectpicker form-control" data-live-search="true" data-size="6" title="Choose Brand"
            name="brand_id">
            @foreach ($brandList as $brandData)
                <option value="{{ $brandData->id }}"
                    {{ old('brand_id', $product->brand_id ?? null) == $brandData->id ? 'selected' : '' }}>
                    {{ $brandData->name }}
                </option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="row m-0 border border-bottom-0">
        {{ Form::label('price', 'Price', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
                {{ Form::text('price', old('price', $product->price ?? null), [
                    'id' => 'price',
                    'class' => 'form-control decimal-field' . ($errors->has('price') ? ' is-invalid' : ''),
                    'placeholder' => 'Enter Price',
                ]) }}
                @error('price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
        </select>
        </div>
    </div>

    <div class="row m-0 border border-bottom-0">
        {{ Form::label('quantity', 'Quantity', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
                {{ Form::text('quantity', old('quantity', $product->quantity ?? null), [
                    'id' => 'quantity',
                    'class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''),
                    'placeholder' => 'Enter Quantity',
                ]) }}
                @error('quantity')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
        </select>
        </div>
    </div>

    <div class="row m-0 border border-bottom-0">
        {{ Form::label('description', 'Description', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
            {{ Form::textarea('description', old('description', $product->description ?? null), [
                'id' => 'description',
                'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                'placeholder' => 'Enter Description',
            ]) }}
            @error('description')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row m-0 border">
        {{ Form::label('image', 'Image', ['class' => 'col-sm-3 k-bg-gray al']) }}
        <div class="col-sm-9 p-2 sp-input">
            <div id="img-preview">
                @php
                    $imageUrl = old('image', isset($product->image) ? CustomFile::tmpUrl(['product_images', $product->image], '+2days') : '');
                @endphp
    
                {{ Form::hidden('upload_file_path', old('upload_file_path'), ['id' => 'tmp-img']) }}
                {{ Form::hidden('image_url', $imageUrl) }}
                {{ Form::hidden('image_name', old('image_name')) }}
                {{ Form::hidden('image', old('image', $_resource->image ?? null)) }}
    
                <i id="image_delete" class="bi bi-x-circle image-delete-btn" {{ isset($product->image) ? '' : 'hidden' }}></i>
                <img id="image_displayer" src="{{ $imageUrl ?: '/img/no-image-icon.png' }}" class="img-responsive w100" alt="Image cannot be displayed.">
            </div>
    
            <input type="file" id="image_input" accept="image/*" data-type="image"
                class="image-input d-none {{ $imageUrl ? 'image-delete' : 'image-select' }}">
            <label id="image_select" for="image_input" class="text-primary">Choose File</label>
    
            <label class="error mb10 image_url_error" id="image-error-box"></label>
        </div>
    </div>
    

</div>
@push('javascript')
<script>
    const URL_UPLOAD_IMG = @json(route('tmpfile.upload'));
    const TMP_FILE_DELETE = @json(route('tmpfile.delete'));
    const IMG_TYPES = @json(config('constants.IMG_TYPES'));
    const IMG_LENGTH = @json(config('constants.IMG_NAME_MAX_LENGTH'));
    const IMG_SIZE = @json(config('constants.MAX_IMG_SIZE'));
</script>
<script src="{{ asset('scripts/product/input_form.js') }}"></script>
@endpush
