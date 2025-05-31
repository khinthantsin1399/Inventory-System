<?php

namespace App\Dao;

use App\Contracts\Dao\ProductDaoInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use DB;

class ProductDao implements ProductDaoInterface
{
    /**
     * get product list for datatable
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getProductListForDataTable($request)
    {
      $filters = $request['filter'] ?? [];

      $query = Product::whereNull('deleted_at');

      if (!empty($filters['category'])) {
          $query->where('category_id', $filters['category']);
      }

      if (!empty($filters['brand'])) {
          $query->where('brand_id', $filters['brand']);
      }

      if (!empty($filters['searchData'])) {
          $search = $filters['searchData'];
          $query->where(function ($q) use ($search) {
              $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
          });
      }

      return $query->get();
    }

    /**
     * create product
     *
     * @param Request $request
     */
    public function createProduct($request)
    {
      return Product::create($request);
    }

    /**
     * update image name
     *
     * @param integer $productId
     * @param array $imageName
     */
    public function updateImageName($productId, $imageName): void
    {
        Product::whereId($productId)->update($imageName);
    }

    /**
     * get product by id
     *
     * @param integer $productId
     */
    public function getProductById($productId)
    {
      return Product::where('id', $productId)
                      ->where('deleted_at', null)
                      ->first();
    }

    /**
     * update product
     *
     * @param array $rrequest
     * @param integer $productId
     * @return void
     */
    public function updateProduct($product, $productId)
    {
        Product::where('id', $productId)->update($product);
    }

    /**
     * delete product
     *
     * @param integer $productId
     * @return void
     */
    public function deleteProduct($productId)
    {
      $product = Product::find($productId);
      $product->delete();
    }

    /**
     * get total stock value
     *
     */
    public function getTotalStockValue()
    {
      return Product::whereNull('deleted_at')
      ->select(DB::raw('SUM(price * quantity) as total'))
      ->value('total');
    }
    
    /**
     * get product list for download csv
     *
     * @param  $request
     */
    public function getProductListForCsv($request)
    {
        $order = $request->input('order');
        $orderColumn = [
            '0' => 'id',
            '1' => 'name',
            '2' => 'code',
            '3' => 'category',
            '4' => 'brand',
            '5' => 'price',
            '5' => 'quantity',
            '6' => 'description',
        ];
        $orderBy = empty($order) ? 'products.id' : $orderColumn[$request->input('order.0.0')];
        $orderDir = $request->input('order.0.1', 'asc');

        return Product::where('deleted_at', null)
            ->orderBy($orderBy, $orderDir)
            ->get();
    }
} 