<?php

namespace App\Exports;

use App\Http\Traits\ExportTrait;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\DefaultValueBinder;

class ProductExport extends DefaultValueBinder implements FromView, WithCustomValueBinder
{
    use ExportTrait;

    private $productList;

    /**
     * Create a new controller instance
     *
     * @param object $productList
     */
    public function __construct($getProductList)
    {
        $this->productList = $getProductList;
    }

    /**
     * to show product list in csv
     *
     * @return View
     */
    public function view(): View
    {
        return view('product.product_csv', [
            'productList' => $this->productList,
        ]);
    }
}
