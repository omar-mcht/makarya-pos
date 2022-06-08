<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Member;
use App\Models\TransactionDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionDetails = TransactionDetail::all();
        $members = Member::all();
        $products = Product::all();

        return view('admin.transaction.index', compact("transactionDetails", "members", "products"));
    }


    public function api(Request $request)
    {


        
        $transactions = Transaction::with("transactionDetails", "member");
        $datatables = datatables()->of($transactions)
                                // ->addColumn('name', function($transaction){
                                //     foreach ($transaction->transactionDetails() as $key => $value) {
                                //         $prod = 
                                //     }
                                //     return $transaction->transactionDetails('products');
                                // })
                                // ->addColumn('merk', function($transaction){
                                //     return $transaction->transactionDetails->products->merk;
                                // })
                                // ->addColumn('quantity', function($transaction){
                                //     return $transaction->transactionDetails->quantity;
                                // })
                                ->addColumn('a', function($transaction){
                                    $isi = [];
                                    foreach ($transaction->transactionDetails as $key => $value) {
                                        $isi[]= $value->products->name;
                                    }
                                    return $isi;
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
        // $this->validate($request,[
        //     'member_id' => ['required'],
        //     'date_start' => ['required'],
        // ]);



        // $product_id = $request->product_id;
        // $qty = $request->qty;

        // for ($i=0; $i < count($product_id); $i++) { 
        //     $transaction = new Transaction();
        //     $transactionDetails = $transaction->transactionDetails();
            
        //     // $transaction->member_id = "1";

        //     $transactionDetails->product_id = $product_id[$i];
        //     $transactionDetails->quantity = $qty[$i];
        //     $transactionDetails->sub_total = "100000";

           
        //     $transactionDetails->save();

        // }
        
        $transactions = Transaction::create($request->toArray());
        foreach ($request->product_id as $key => $product_id) {
            $transactions->transactionDetails()->create([
                "product_id" => intval($product_id),
                "quantity" => intval($request->qty[$key]),
                "sub_total" => "100000"
            ]);
        }
        
        // $bukus = new Book;
        // foreach ($request->book_id as $key => $book_id) {
        //     $bukus->where('id', $book_id)->decrement('qty');
        // }

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
