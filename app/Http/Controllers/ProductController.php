<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.product.index', compact("suppliers", "categories"));
    }

    public function api()
    {
        $products = Product::with("category", "supplier");
        $datatables = datatables()->of($products)
                                ->addColumn('supplier', function($product){
                                    return $product->supplier->name;
                                })
                                ->addColumn('category', function($product){
                                    return $product->category->name;
                                })
                                ->addIndexColumn();

        return $datatables->make(true);
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
        {
            $this->validate($request,[
                'name' => ['required'],
                'merk' => ['required'],
                'sell_price' => ['required'],
                'buy_price' => ['required'],
                'stock' => ['required'],
                'category_id' => ['required'],
                'supplier_id' => ['required']
            ]);
    
            Product::create($request->all());
    
            return redirect('products');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'name' => ['required'],
            'merk' => ['required'],
            'sell_price' => ['required'],
            'buy_price' => ['required'],
            'stock' => ['required'],
            'category_id' => ['required'],
            'supplier_id' => ['required']
        ]);

        $product->update($request->all());

        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
