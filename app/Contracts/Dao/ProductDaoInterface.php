<?php

namespace App\Contracts\Dao;

interface ProductDaoInterface {
    public function getProductListForDataTable($request);

    public function createProduct($request);

    public function updateImageName($productId, $imageName);

    public function getProductById($productId);

    public function updateProduct($product, $productId);

    public function deleteProduct($productId);

    public function getTotalStockValue();

    public function getProductListForCsv($request);
}
