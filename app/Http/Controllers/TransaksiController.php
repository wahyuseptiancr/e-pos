<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreOrUpdateTransaksi;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.transaksis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all(['id', 'name']);
        return view('dashboard.transaksis.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateTransaksi $request)
    {
        $validated = $request->validated() + [
            'created_at' => now()  
        ];

        $product = Product::findOrFail($validated['product_id']);

        if($validated['qty'] > $product->stock){
            return back()->with('error', 'Stok / ketersediaan produk kurang dari yang diminta');
        }

        $newTransaksi = Transaksi::create($validated);

        $product->update([
            'stock' => $product->stock - $validated['qty'],
            'updated_at' => now() 
        ]);

        return redirect(route('transactions.index'))->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Transaksi::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $products = Product::all(['id', 'name']);

        return view('dashboard.transaksis.edit', compact('transaksi', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateTransaksi $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now()
        ];

        $transaksi = Transaksi::findOrFail($id);
        $product = Product::findOrFail($transaksi->product_id);
        if($transaksi->qty > $validated['qty']){
            $product->update([
                'stock' => $product->stock + ($transaksi->qty - $validated['qty']),
                'updated_at' => now()
            ]);
        }elseif($transaksi->qty < $validated['qty']){
            $product->update([
                'stock' => $product->stock - ($validated['qty'] - $transaksi->qty),
                'updated_at' => now()
            ]);
        }

        if($validated['product_id'] != $transaksi->product_id){
            if($validated['qty'] > $product->stock){
                return back()->with('error', 'Stok / ketersediaan produk kurang dari yang diminta');
            }
            $product->update([
                'stock' => $product->stock - $validated['qty'],
                'updated_at' => now()
            ]);
        }

        $transaksi->update($validated);

        return redirect(route('transactions.index'))->with('success', 'Transaksi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $product = Product::findOrFail($transaksi->product_id);
        $product->update([
            'stock' => $product->stock + $transaksi->qty,
            'updated_at' => now()
        ]);
        $transaksi->delete();
        
        if(request()->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dihapus'
            ]);
        }

        return redirect(route('transactions.index'))->with('success', 'Transaksi berhasil dihapus');
    }
}
