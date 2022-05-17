<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    public function transactions(Request $request)
    {
       $queryTransaction = Transaksi::query();
       if($request->has('filter')){
            $explodeDate = explode('$', $request->filter);
            $fromDate = $explodeDate[0];
            $toDate = $explodeDate[1] . ' 23:59:59';
            $queryTransaction->whereBetween('created_at', [$fromDate, $toDate]);
       }

       if($request->has('sort')){
           $queryTransaction->orderBy('qty', $request->sort);
       }
       $transactions = $queryTransaction->orderByDesc('created_at'); 

       return datatables()->of($transactions->get())
       ->addIndexColumn()
       ->addColumn('product_name', function($trx){
           return str()->title($trx->product->name);
       })
       ->addColumn('product_stock', fn($trx) => $trx->product->stock)
       ->addColumn('product_price', fn($trx) => 'Rp. '.number_format($trx->product->price, 0, ',', '.'))
       ->addColumn('tanggal_transaksi', fn($trx) => $trx->created_at->format('d-m-Y'))
       ->addColumn('product_type', fn($trx) => str()->title($trx->product->type_product))
       ->addColumn('action', function($trx){
            $html = '<a href="'.route('transactions.edit', $trx->id).'" class="btn btn-sm btn-warning">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    
                    <button class="btn btn-sm btn-danger" onclick="deleteData(\''.$trx->id.'\')">
                        <i class="fas fa-trash"></i>
                    </button>
                    ';
            return $html;
       })
       ->make(true);
    }
}
