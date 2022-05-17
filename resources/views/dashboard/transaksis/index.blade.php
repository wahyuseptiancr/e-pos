@extends('layouts.app')
@section('title', 'Transactions')

@section('title-header', 'Transactions')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transactions</li>
@endsection

@section('action_btn')
    <a href="{{route('transactions.create')}}" class="btn btn-default">Tambah Data</a>
@endsection

@section('content')
    {{-- modal --}}
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" onsubmit="return false">
                        <div class="form-group">
                            <label for="">Dari tanggal</label>
                            <input type="date" name="dari" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Sampai tanggal</label>
                            <input type="date" name="sampai" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="filterData()"  class="btn btn-primary btn-sm">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="filterModalProduk" tabindex="-1" role="dialog" aria-labelledby="filterModalProdukLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalProdukLabel">Filter transaksi penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-block btn-success" onclick="filderPenjualan('desc')">
                                    Penjualan Tertinggi
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-block btn-danger" onclick="filderPenjualan('asc')">
                                    Penjualan Terendah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Transactions</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Jumlah Terjual / Dibeli </th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Jenis Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var urlAjax = "{{ route('data.transactions') }}";
        var tableTransaksi = $('#table-data').DataTable({
        processing: true,
        serverSide: true,
        responsive: false,
        ajax: urlAjax,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {
                data: 'product_name'
            },
            {
                data: 'product_stock'
            },
            {
                data: 'qty'
            },
            {
                data: 'tanggal_transaksi'
            },
            {
                data: 'product_type'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari Data",
            lengthMenu: "Menampilkan _MENU_ data",
            zeroRecords: "Data tidak ditemukan",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ data)",
            paginate: {
                previous: '<i class="fa fa-angle-left"></i>',
                next: "<i class='fa fa-angle-right'></i>",
            }
        },
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                title: 'Data Transactions',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-sm btn-danger',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5]
                },
            },
            {
                title: "Filter Data",
                text: '<i class="fas fa-search"></i> Filter Data',
                className: 'btn btn-default btn-sm',
                action: function (e, dt, node, config) {
                    e.preventDefault();
                    $('#filterModal').modal('show');
                }
            },
            {
                title: 'Filter Produk Terjual',
                text: '<i class="fas fa-chart-bar"></i> Filter Produk Terjual',
                className: 'btn btn-default btn-sm',
                action: function (e, dt, node, config) {
                    e.preventDefault();
                    $('#filterModalProduk').modal('show')
                }
            },
            {
                title: "Reload",
                text: '<i class="fas fa-sync-alt"></i> Reload',
                className: 'btn btn-default btn-sm',
                action: function (e, dt, node, config) {
                    urlAjax = "{{ route('data.transactions') }}";
                    tableTransaksi.ajax.url(urlAjax).load();
                }
            }
        ],
    });

    function filterData() {
        var dari = $('input[name=dari]').val();
        var sampai = $('input[name=sampai]').val();
        urlAjax = urlAjax + '?filter=' + dari + '$' + sampai;
        tableTransaksi.ajax.url(urlAjax).load();

        console.log(urlAjax);
        $('#filterModal').modal('hide');
    }

    function filderPenjualan(sort) {
        urlAjax = "{{ route('data.transactions') }}" + '?sort=' + sort;
        tableTransaksi.ajax.url(urlAjax).load();
        $('#filterModalProduk').modal('hide');
    }


        function deleteData(id){
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('transactions') }}" + '/' + id,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            tableTransaksi.ajax.reload();
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Data gagal dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            tableTransaksi.ajax.reload();
                        }
                    });
                }
            }) 
        }
    </script>
@endsection