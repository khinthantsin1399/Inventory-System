<?php

namespace App\Contracts\Dao;

interface CategoryDaoInterface {
    public function getCategoryListForDataTable($request);

    public function createCategory($categoryData);

    public function deleteCategory($categoryId);

    public function getCategoryById($categoryId);

    public function updateCategory($categoryData, $categoryId);

    public function getAllCategories();
}
