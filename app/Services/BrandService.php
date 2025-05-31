<?php

namespace App\Services;

use App\Contracts\Dao\BrandDaoInterface;
use App\Contracts\Services\BrandServiceInterface;

class BrandService implements BrandServiceInterface 
{
    public $brandDao;

    /**
    * Constructor function
    *
    * @param BrandDaoInterface $brandDao
    */
    public function __construct(BrandDaoInterface $brandDao) 
    {
        $this->brandDao = $brandDao;
    }

    /**
    * get brand list for datatable
    *
    * @param Request $request
    * @return Illuminate\Database\Eloquent\Collection
    */
    public function getBrandListForDataTable($request) 
    {
        return $this->brandDao->getBrandListForDataTable($request);
    }

    /**
    * create brand
    *
    * @param Request $request
    * @return void
    */
    public function createBrand($request) 
    {
        $brandData = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $this->brandDao->createBrand($brandData);
    }

    /**
    * delete brand
    *
    * @param Integer $brandId
    * @return void
    */
    public function deleteBrand($brandId)  
    {
        $this->brandDao->deleteBrand($brandId);
    }

    /**
    * get brand by id
    *
    * @param Integer $brandId
    * @return object|null
    */
    public function getBrandById($brandId)
    {
        return $this->brandDao->getBrandById($brandId);
    }

    /**
    * update brand
    *
    * @param Array $brandData
    * @param Integer $brandId
    * @return void
    */
    public function updateBrand($request, $brandId) 
    {
        $brandData = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $this->brandDao->updateBrand($brandData, $brandId);
    }

    /**
    * get brand list
    */
    public function getAllBrands() 
    {
        return $this->brandDao->getAllBrands();
    }
}