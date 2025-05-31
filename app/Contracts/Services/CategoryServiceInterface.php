<?php

namespace App\Contracts\Services;

interface CategoryServiceInterface
{
    public function getCategoryListForDataTable($request);

    public function createCategory($request);

    public function deleteCategory($categoryId);

    public function getCategoryById($categoryId);

    public function updateCategory($request, $categoryId);
    
    public function getAllCategories();
}
