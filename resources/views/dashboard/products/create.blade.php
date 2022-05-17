@extends('layouts.app')
@section('title', 'Tambah data produk')

@section('title-header', 'Tambah data produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">data produk</a></li>
    <li class="breadcrumb-item active">Tambah data produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah data produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Nama produk" value="{{ old('name') }}" name="name">

                                    @error('name')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="description">Deskripsi</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        id="description" placeholder="Deskripsi produk" value="{{ old('description') }}"
                                        name="description">

                                    @error('description')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="type_product">Tipe / Jenis</label>
                                    <input type="text" class="form-control @error('type_product') is-invalid @enderror"
                                        id="type_product" placeholder="Stok / Ketersediaan produk (minuman, makanan, pembersih dll)"
                                        name="type_product" value="{{old('type_product')}}">
        
                                    @error('type_product')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                        placeholder="Harga produk" name="price" value="{{old('price')}}">

                                    @error('price')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="stock">Stok / Ketersediaan</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" placeholder="Stok / Ketersediaan produk"
                                        name="stock" value="{{old('stock')}}">

                                    @error('stock')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('products.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
