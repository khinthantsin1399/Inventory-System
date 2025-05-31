<?php

namespace App\Contracts\Services;

interface BrandServiceInterface {
    public function getBrandListForDataTable($request);

    public function createBrand($request);

    public function deleteBrand($brandId);

    public function getBrandById($brandId);

    public function updateBrand($request, $brandId);

    public function getAllBrands();
}
