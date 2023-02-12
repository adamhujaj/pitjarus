<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ReportProduct;
use App\Models\Store;
use App\Models\Brand;
class ReportProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   // public function index()
    //{ 
      //  $dtreportproduct =ReportProduct::paginate(10);
        //return view('show',compact('dtreportproduct'));
    //}
    public function index()
    {
        $selectedAreas = [];
if (isset($request->area_name) && is_array($request->area_name)) {
    $selectedAreas = $request->area_name;
}
        // Mendapatkan semua data report products
        $reportProducts = ReportProduct::with(['product', 'product.brand', 'store', 'store.account', 'store.area'])->get();
    
        // Mengelompokkan data report products berdasarkan store area
        $reports = [];
        foreach ($reportProducts as $reportProduct) {
            $areaId = $reportProduct->store->area->area_id;
            if (!isset($reports[$areaId])) {
                $reports[$areaId] = [
                    'area_name' => $reportProduct->store->area->area_name,
                    'products' => []
                ];
            }
    
            $productId = $reportProduct->product->product_id;
            if (!isset($reports[$areaId]['products'][$productId])) {
                $reports[$areaId]['products'][$productId] = [
                    'product_name' => $reportProduct->product->product_name,
                    'brand_name' => $reportProduct->product->brand->brand_name,
                    'compliance' => 0,
                    'total' => 0
                ];
            }
    
            $reports[$areaId]['products'][$productId]['compliance'] += $reportProduct->compliance;
            $reports[$areaId]['products'][$productId]['total'] += 1;
        }
    
        // Menghitung persentase compliance untuk setiap produk dalam setiap area
        foreach ($reports as &$report) {
            foreach ($report['products'] as &$product) {
                $product['compliance'] = $product['compliance'] / $product['total'] * 100;
            }
        }
    
        
        return view('reportProducts.index', compact('reports'));
    }
        
    /*public function index()
    {
        $reportProducts = ReportProduct::with('product', 'product.brand', 'store', 'store.account', 'store.area')->get();
        $averageCompliances = [];

        foreach ($reportProducts as $reportProduct) {
            $areaId = $reportProduct->store->area->area_id;
    
            if (!array_key_exists($areaId, $averageCompliances)) {
                $averageCompliances[$areaId] = [
                    'area_name' => $reportProduct->store->area->area_name,
                    'total_compliance' => 0,
                    'total_row' => 0,
                ];
            }
    
            $averageCompliances[$areaId]['total_compliance'] += $reportProduct->compliance;
            $averageCompliances[$areaId]['total_row'] += 1;
        }
    
        foreach ($averageCompliances as $key => $value) {
            $averageCompliances[$key]['average_compliance'] = $value['total_compliance'] / $value['total_row'] * 100;
        }
    
        return view('reportProducts.index', compact('reportProducts','averageCompliances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
