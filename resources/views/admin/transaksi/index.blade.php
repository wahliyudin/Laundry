@extends('layouts.admin-master')
@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Data Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-success btn-md">Add Transaksi</a>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Ref No</th>
                                        <th>Customer</th>
                                        <th>Status Bayar</th>
                                        <th>Status Pengerjaan</th>
                                        <th>Grand Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksis as $item)
                                        <tr>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->no_reference }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>
                                                @if ($item->status_bayar === 'belum bayar')
                                                    <span class="btn btn-warning btn-sm">{{ $item->status_bayar }}</span>
                                                @else
                                                    <span class="btn btn-success btn-sm">{{ $item->status_bayar }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @switch($item->status_pengerjaan)
                                                    @case('selesai')
                                                        <span
                                                            class="btn btn-success btn-sm">{{ $item->status_pengerjaan }}</span>
                                                    @break
                                                    @case('menunggu')
                                                        <span
                                                            class="btn btn-secondary btn-sm">{{ $item->status_pengerjaan }}</span>
                                                    @break
                                                    @default
                                                        <span class="btn btn-info btn-sm">{{ $item->status_pengerjaan }}</span>
                                                @endswitch
                                            </td>
                                            <td>Rp.{{ number_format($item->grand_total, 0, '', '.') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('transaksi.edit', $item->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-transaksi{{ $item->id }}">Update Status Bayar</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-transaksi-status-pengerjaan{{ $item->id }}">Update Status Pengerjaan</a>
                                                        <a class="dropdown-item" href="{{ route('transaksi.show', $item->id) }}">view</a>
                                                        <a class="dropdown-item" href="{{ route('transaksi.export', $item->id) }}">Cetak Stuck</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#transaksi-delete{{ $item->id }}">Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('admin.modal.transaksi.status-bayar')
                                        @include('admin.modal.transaksi.status-pengerjaan')
                                        @include('admin.modal.transaksi.delete')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <div class="float-right d-flex">
                                        <span>Total</span>
                                        <span style="margin-left: 10px;">Rp {{ number_format($total, 0, '', '.') }}</span>
                                    </div>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection
