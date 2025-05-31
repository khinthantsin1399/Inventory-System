<?php

namespace App\Http\Controllers;
use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\BrandServiceInterface;
use App\Http\Requests\ProductRequest;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ProductController extends Controller 
{

    private $productService;
    private $categoryService;
    private $brandService;

    /**
    * Constructor function
    *
    * @param ProductServiceInterface $productService
    * @param CategoryServiceInterface $categoryService
    * @param BrandServiceInterface $brandService
    */
    public function __construct(ProductServiceInterface $productService, CategoryServiceInterface $categoryService, BrandServiceInterface $brandService) 
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
    }

    /**
    * show product list
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function showList() 
    {
        $categoryList = $this->categoryService->getAllCategories();
        $brandList = $this->brandService->getAllBrands();
        $totalStockValue = $this->productService->getTotalStockValue();
        return view('product.list', compact('categoryList', 'brandList', 'totalStockValue'));
    }

    /**
    * get product list for datatable
    *
    * @param Request $request
    * @return json
    */
    public function getProductListForDataTable(Request $request)
    {
        $productData = $this->productService->getProductListForDataTable($request);
        logger($productData);
        $total = $productData->count();
        $ids = $productData->pluck('id');
        $productData = $productData->slice($request->start ?: 0, $request->length ?: 10)->values();
        return response()->json([
            'draw' => intval($request->draw ?: 0) + 1,
            'recordsTotal' => $total,
            'recordsFiltered' => $total ?: 1,
            'data' => $productData,
            'ProductIds' => $ids,
        ]);
    }


    /**
    * show product detail
    *
    * @param Request $request
    */
    public function showDetail(Request $request) 
    {
        $product = $this->productService->getProductById($request->id);
        return view('product.detail', compact('product'));
    }


    /**
    * show product create
    */
    public function showCreate() 
    {
        $categoryList = $this->categoryService->getAllCategories();
        $brandList = $this->brandService->getAllBrands();
        return view('product.create', compact('categoryList', 'brandList'));
    }

    /**
    * Store a newly created resource in storage.
    */
    public function actionCreate(ProductRequest $request) 
    {
        $this->productService->createProduct($request->validated());
        return redirect()->route('product.list.show')
        ->with('flash_message', __('Added Successfully!'));
    }

    /**
    * Display the specified resource.
    */
    public function showEdit(Request $request) 
      {
        $product = $this->productService->getProductById($request->id);
        $categoryList = $this->categoryService->getAllCategories();
        $brandList = $this->brandService->getAllBrands();
        return view('product.edit', compact('product', 'categoryList', 'brandList'));
    }

    /**
    * update product
    * @param  ProductRequest $request
    * @param integer $productId
    * @return \Illuminate\Http\RedirectResponse
    */
    Public function actionUpdate(ProductRequest $request, $productId)
    {
        $this->productService->updateProduct($request->validated(), $productId);
        return redirect()->route('product.list.show')
        ->with('flash_message', __('Updated Successfully!'));
    }

    /**
    * delete product
    * @param Request $request
    * @return void
    */
    public function deleteProduct(Request $request)
    {
        $this->productService->deleteProduct($request->id);
    }

    /**
     * product list download
     *
     * @return Excel
     */
    public function downloadProductCsv()
    {
        $fileName = "Product" . date('Ymd') . ".csv";
        $csvText = $this->productService->getProductListInCsv(request());
        return Excel::download($csvText, $fileName);
    }
}
