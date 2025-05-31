<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Services\CategoryServiceInterface;

class CategoryController extends Controller 
{

    private $categoryService;

    /**
    * Constructor function
    *
    * @param CategoryServiceInterface $categoryService
    */
    public function __construct(CategoryServiceInterface $categoryService) 
    {
        $this->categoryService = $categoryService;
    }

    /**
    * show category list
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function showList() 
    {
        return view('category.list');

    }

    /**
    * get category list for datatable
    *
    * @param Request $request
    * @return json
    */
    public function getCategoryListForDataTable(Request $request) 
    {
        $categoryData = $this->categoryService->getCategoryListForDataTable($request);
        $total = $categoryData->count();
        $ids = $categoryData->pluck('id');
        $categoryData = $categoryData->slice($request->start ?: 0, $request->length ?: 10)->values();
        return response()->json([
            'draw' => intval($request->draw ?: 0) + 1,
            'recordsTotal' => $total,
            'recordsFiltered' => $total ?: 1,
            'data' => $categoryData,
            'categoryIds' => $ids,
        ]);
    }

    /**
    * show category create
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function showCreate() 
    {
        return view('category.create');
    }

    /**
    * create category
    * @param  CategoryRequest $request
    * @param integer $categoryId
    * @return \Illuminate\Http\RedirectResponse
    */
    public function actionCreate(CategoryRequest $request) 
    {
        $this->categoryService->createCategory($request);
        return redirect()->route('category.list.show')
        ->with('flash_message', __('Added Successfully!'));
    }

    /**
    * show category edit
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function showEdit(Request $request) 
    {
        $category = $this->categoryService->getCategoryById($request->id);
        return view('category.edit', compact('category'));
    }

    /**
    * update category
    * @param  CategoryRequest $request
    * @param integer $categoryId
    * @return \Illuminate\Http\RedirectResponse
    */
    Public function actionUpdate(CategoryRequest $request, $categoryId) {
        $this->categoryService->updateCategory($request, $categoryId);
        return redirect()->route('category.list.show')
        ->with('flash_message', __('Updated Successfully!'));
    }

    /**
    * delete category
    *
    * @return void
    */
    public function deleteCategory(Request $request)
    {
        $this->categoryService->deleteCategory($request->id);
    }
}
