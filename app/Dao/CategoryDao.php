<?php

namespace App\Dao;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryDao implements CategoryDaoInterface
{
    /**
     * get category list for datatable
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Collection
     */
	public function getCategoryListForDataTable($request)
	{
		return Category::withCount('products as product_count')->get();
	}

	/**
	 * create category
	 *
	 * @param Request $request
	 */
	public function createCategory($categoryData)
	{
		Category::create($categoryData);
	}

	/**
	 * delete category
	 *
	 * @param Integer $categoryId
	 * @return void
	 */
	public function deleteCategory($categoryId) 
	{
		Category::where('id', $categoryId)->delete();
	}

	/**
	 * get category by id
	 *
	 * @param Integer $categoryId
	 * @return object|null
	 */
	public function getCategoryById($categoryId)
	{
		return Category::find($categoryId);
	}

	/**
	 * update category
	 *
	 * @param Array $categoryData
	 * @param Integer $categoryId
	 * @return void
	 */
	public function updateCategory($categoryData, $categoryId)
	{
		Category::where('id', $categoryId)->update($categoryData);
	}

	/**
    * get all categories
    *
    */
	public function getAllCategories()
	{
		return Category::all();
	}
}
