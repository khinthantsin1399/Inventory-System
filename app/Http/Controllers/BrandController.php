<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Services\BrandServiceInterface;

class BrandController extends Controller 
{
    private $brandService;

    /**
    * Constructor function
    *
    * @param BrandServiceInterface $brandService
    */
    public function __construct(BrandServiceInterface $brandService) 
    {
        $this->brandService = $brandService;
    }

    /**
    * show brand list
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function showList() 
    {
        return view('brand.list');
    }

    /**
    * get brand list for datatable
    *
    * @param Request $request
    * @return json
    */
    public function getBrandListForDataTable(Request $request) 
    {
        $brandData = $this->brandService->getBrandListForDataTable($request);
        $total = $brandData->count();
        $ids = $brandData->pluck( 'id' );
        $brandData = $brandData->slice($request->start ?: 0, $request->length ?: 10)->values();
        return response()->json( [
            'draw' => intval($request->draw ?: 0) + 1,
            'recordsTotal' => $total,
            'recordsFiltered' => $total ?: 1,
            'data' => $brandData,
            'brandIds' => $ids,
        ]);
    }

    /**
    * show brand create
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function showCreate() 
    {
        return view('brand.create');
    }

    /**
    * create brand
    * @param  BrandRequest $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function actionCreate(BrandRequest $request) 
    {
        $this->brandService->createBrand($request);
        return redirect()->route('brand.list.show')
        ->with('flash_message', __('Added Successfully!'));
    }

    /**
    * show brand edit
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function showEdit(Request $request) 
    {
        $brand = $this->brandService->getBrandById($request->id);
        return view('brand.edit', compact('brand'));
    }

    /**
    * update brand
    * @param  BrandRequest $request
    * @param integer $brandId
    * @return \Illuminate\Http\RedirectResponse
    */
    Public function actionUpdate(BrandRequest $request, $brandId) 
    {
        $this->brandService->updateBrand( $request, $brandId );
        return redirect()->route('brand.list.show')
        ->with('flash_message', __('Updated Successfully!'));
    }

    /**
    * delete brand
    *
    * @return void
    */
    public function deleteBrand(Request $request) 
    {
        $this->brandService->deleteBrand($request->id);
    }
}
