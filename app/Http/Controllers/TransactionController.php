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
        $products = Product::all()->where('stock', '>', '0');

        return view('admin.transaction.index', compact("transactionDetails", "members", "products"));
    }


    public function api(Request $request)
    {


        
        $transactions = Transaction::with("transactionDetails", "member");
        $datatables = datatables()->of($transactions)
                                // ->addColumn('product', function($transaction){
                                //     foreach ($transaction->transactionDetails() as $key => $value) {
                                //         $prod = $value->products()->name;
                                //         return $prod;
                                //     }
                                // })
                                // ->addColumn('merk', function($transaction){
                                //     return $transaction->transactionDetails->products->merk;
                                // })
                                // ->addColumn('quantity', function($transaction){
                                //     return $transaction->transactionDetails->quantity;
                                // })
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
        
        $transactionDetails = new TransactionDetail;
        $products = new Product;
        $transactions = Transaction::create($request->toArray());
        foreach ($request->product_id as $key => $product_id) {
            $harga = ($products->where("id", $product_id)->sum('sell_price'));
            $jumlah = intval($request->qty[$key]);
            

            $sub_total = ($harga * $jumlah);
            
            if ($request->qty[$key] < $products->where("id", $product_id)->sum('stock')) {
                $transactions->transactionDetails()->create([
                    "product_id" => intval($product_id),
                    "quantity" => intval($request->qty[$key]),
                    "sub_total" => $sub_total     
                ]);
            } 
        }
        
        $transaksi_terakhir = $transactions->id;
        //Stok Berkurang
        foreach ($request->product_id as $key => $product_id) {
            $products->where('id', $product_id)->decrement('stock', ($request->qty[$key]));
        }
        $arah = "transactions/{$transaksi_terakhir}";

        return redirect($arah);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction_details = TransactionDetail::all();
        $transactions = Transaction::all();

        function subtotal($tran){
            $sub_total=[];
            foreach ($tran->transactionDetails as $key => $value) {
                $sub_total []= $value->sub_total;                                        
            }
            $total = array_sum($sub_total);
            return "Rp".number_format($total,'0', ',', '.');
        }

        $subtotal = subtotal($transaction);
        
        $cashier = $transaction->member->name;
        $date = date('d M Y (H:i:s)', strtotime($transaction->created_at));
        return view('admin.detail.detail', compact('transaction', 'subtotal', 'transactions', 'cashier', 'date'));
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
