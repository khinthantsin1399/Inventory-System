<?php

namespace App\Services;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Contracts\Services\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface 
{
    public $categoryDao;

    /**
    * Constructor function
    *
    * @param CategoryDaoInterface $categoryDao
    */
    public function __construct(CategoryDaoInterface $categoryDao) 
    {
        $this->categoryDao = $categoryDao;
    }

    /**
    * get category list for datatable
    *
    * @param Request $request
    * @return Illuminate\Database\Eloquent\Collection
    */
    public function getCategoryListForDataTable($request) 
    {
        return $this->categoryDao->getCategoryListForDataTable($request);
    }

    /**
    * create category
    *
    * @param Request $request
    * @return void
    */
    public function createCategory($request) 
    {
        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $this->categoryDao->createCategory($categoryData);
    }

    /**
    * delete category
    *
    * @param Integer $categoryId
    * @return void
    */
    public function deleteCategory($categoryId) 
    {
        $this->categoryDao->deleteCategory($categoryId);
    }

    /**
    * get category by id
    *
    * @param Integer $categoryId
    * @return object|null
    */
    public function getCategoryById($categoryId) 
    {
        return $this->categoryDao->getCategoryById($categoryId);
    }

    /**
    * update category
    *
    * @param Array $categoryData
    * @param Integer $categoryId
    * @return void
    */
    public function updateCategory($request, $categoryId) 
    {
        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $this->categoryDao->updateCategory($categoryData, $categoryId);
    }

    /**
    * get all categories
    *
    */
    public function getAllCategories() 
    {
        return $this->categoryDao->getAllCategories();
    }

}