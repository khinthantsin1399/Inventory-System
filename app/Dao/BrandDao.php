<?php

namespace App\Dao;

use App\Contracts\Dao\BrandDaoInterface;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandDao implements BrandDaoInterface
{
    /**
     * get brand list for datatable
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getBrandListForDataTable($request)
    {
        return Brand::withCount('products as product_count')->get();
    }

    /**
     * create brand
     *
     * @param Request $request
     * @return void
     */
    public function createBrand($brandData)
    {
        Brand::create($brandData);
    }

    /**
     * delete brand
     *
     * @param Integer $brandId
     * @return void
     */
    public function deleteBrand($brandId) 
    {
        Brand::where('id', $brandId)->delete();
    }

    /**
     * get brand by id
     *
     * @param Integer $brandId
     * @return object|null
     */
    public function getBrandById($brandId)
    {
        return Brand::find($brandId);
    }

    /**
     * update brand
     *
     * @param Array $brandData
     * @param Integer $brandId
     * @return void
     */
    public function updateBrand($brandData, $brandId)
    {
        Brand::where('id', $brandId)->update($brandData);
    }

    /**
        * get brand list
    */
    public function getAllBrands()
    {
        return Brand::all();
    }

}