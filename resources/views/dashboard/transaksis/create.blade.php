@extends('layouts.app')
@section('title', 'Tambah data transaksi')

@section('title-header', 'Tambah data transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">data transaksi</a></li>
    <li class="breadcrumb-item active">Tambah data transaksi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah data transaksi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="product_id">Pilih Produk</label>
                                    <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                                        <option value="" selected>---Pilih Produk---</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @if (old('product_id') == $product->id) selected @endif>
                                                {{ str()->title($product->name) }}</option>
                                        @endforeach
                                    </select>
        
                                    @error('product_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="qty">Jumlah / Qty</label>
                                    <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty"
                                        placeholder="Jumlah / Qty produk" name="qty" value="{{old('qty')}}">

                                    @error('qty')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('transactions.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
