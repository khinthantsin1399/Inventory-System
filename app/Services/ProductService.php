<?php

namespace App\Services;

use App\Contracts\Dao\ProductDaoInterface;
use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Services\SystemFileServiceInterface;
use App\Exports\ProductExport;
use DB;
use CustomFile;

class ProductService implements ProductServiceInterface
{
    public $productDao;
    private $fileService;
    private $imagePath = "product_images";

    /**
     * Constructor function
     *
     * @param ProductDaoInterface $productDao
     * @param SystemFileServiceInterface $fileService
     */
    public function __construct(ProductDaoInterface $productDao, SystemFileServiceInterface $fileService)
    {
        $this->productDao = $productDao;
        $this->fileService = $fileService;
    }

    /**
     * get product list for datatable
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getProductListForDataTable($request)
    {
      $productList = $this->productDao->getProductListForDataTable($request);
      $this->setImagePath($productList);
      return $productList;
    }

    /**
       * create product
       *
       * @param Request $request
       */
    public function createProduct($request)
    {
      return DB::transaction(function () use ($request) {
      $newProduct = $this->productDao->createProduct($request);
      if (!empty($request['image'])) {
          $imageName = $newProduct->id . '_' . $request['image'];
          $this->fileService->saveImageToDirectory($request['upload_file_path'], $imageName, $this->imagePath);
          $this->productDao->updateImageName($newProduct->id, ['image' => $imageName]);
      }
      return $newProduct;
      });
    }
    
    /**
     * get product by id
     *
     * @param integer $productId
     */
    public function getProductById($productId) 
    {
      return $this->productDao->getProductById($productId);
    }

    /**
     * update product
     *
     * @param array $product
     * @param integer $productId
     */
    public function updateProduct($product, $productId)
    {
      $uploadFilePath = $product['upload_file_path'] ?? null;
      $oldProduct = $this->productDao->getProductById($productId);

      if (empty($uploadFilePath) && empty($product['image_url'])) {
          $this->fileService->deleteImageFromDirectory($oldProduct->image, $this->imagePath);
      } elseif (!empty($uploadFilePath)) {
          $imageName = $productId . '_' . $product['image'];
          $product['image'] = $imageName;
          $this->fileService->deleteImageFromDirectory($oldProduct->image, $this->imagePath);
          $this->fileService->saveImageToDirectory($uploadFilePath, $product['image'], $this->imagePath);
      }

      unset($product['upload_file_path']);
      unset($product['image_url']);

      $this->productDao->updateProduct($product, $productId);
    }

    /**
     * delete product
     *
     * @param integer $productId
     * @return void
     */
    public function deleteProduct($productId)
    {
    $this->productDao->deleteProduct($productId);
    }

    /**
     * get total stock value
     *
     */
    public function getTotalStockValue()
    {
    return $this->productDao->getTotalStockValue();
    }

    /**
     * set Product image path
     *
     * @param Collection $productList
     * @return void
     */
    private function setImagePath($productList)
    {
        foreach ($productList as $product) {
            $product->image_path = isset($product->image) ? CustomFile::tmpUrl([$this->imagePath, $product->image], '+2days') : '';
        }
    }

    /**
     * get product list for csv
     *
     */
    public function getProductListInCsv($request)
    {
        $productData = $this->productDao->getProductListForCsv($request);

        $productExport = new ProductExport($productData);
        return $productExport;
    }
}