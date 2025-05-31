<x-app-layout>
    <div class="container mt-5">
        <div class="mb-4 mt-4 text-center">
            <h1 class="mb-3" style="font-size: 1.5rem;">Product Detail</h1>
        </div>
        <div class="card shadow">
            <div class="row g-0">
                <!-- Product Image -->
                <div class="col-md-5">
                    @php
                        $imageUrl = old(
                            'image',
                            isset($product->image)
                                ? CustomFile::tmpUrl(['product_images', $product->image], '+2days')
                                : '',
                        );
                    @endphp
                    <img id="image_displayer" src="{{ $imageUrl ?: '/img/no-image-icon.png' }}" class="img-responsive"
                        alt="Image cannot be displayed.">
                </div>

                <!-- Product Info -->
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ $product->name }}</h3>

                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label text-muted">Product Code:</label>
                            <div class="col-sm-8">{{ $product->code }}</div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label text-muted">Category:</label>
                            <div class="col-sm-8">{{ $product->category->name }}</div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label text-muted">Brand:</label>
                            <div class="col-sm-8">{{ $product->brand->name }}</div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label text-muted">Price:</label>
                            <div class="col-sm-8">{{ number_format($product->price, 2) }} MMK</div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label text-muted">Quantity:</label>
                            <div class="col-sm-8">{{ $product->quantity }}</div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label text-muted">Description:</label>
                            <div class="col-sm-8">{{ $product->description }}</div>
                        </div>

                        <a href="{{ route('product.edit.show', $product->id) }}" class="btn btn-primary mt-4">Edit
                            Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
