<?php

namespace App\Contracts\Dao;

interface BrandDaoInterface {
    public function getBrandListForDataTable($request);

    public function createBrand($brandData);

    public function deleteBrand($brandId);

    public function getBrandById($brandId);

    public function updateBrand($brandData,$brandId );

    public function getAllBrands();
}
