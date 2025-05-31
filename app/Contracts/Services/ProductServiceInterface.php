<?php

namespace App\Contracts\Services;

interface ProductServiceInterface
{
    public function getProductListForDataTable($request);

    public function createProduct($request);

    public function deleteProduct($productId);

    public function getProductById($productId);

    public function updateProduct($product, $productId);

    public function getTotalStockValue();

    public function getProductListInCsv($request);
}