<head>
  <title>Product</title>
</head>
<table>
  <thead>
      <tr>
          <th>No</th>
          <th>Id</th>
          <th>Name</th>
          <th>Code</th>
          <th>Category</th>
          <th>Brand</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Description</th>
      </tr>
  </thead>
  <tbody>
      @foreach($productList as $product)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->code }}</td>
              <td>{{ $product->category_name }}</td>
              <td>{{ $product->brand_name }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->quantity }}</td>
              <td>{{ $product->description }}</td>
          </tr>
      @endforeach
  </tbody>
</table>
