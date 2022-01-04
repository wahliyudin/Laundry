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
                        <a href="{{ route('paket.create') }}" class="btn btn-success btn-md">Add Paket</a>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Estimasi Pekerjaan</th>
                                        <th>Keterangan</th>
                                        <th>Is Active?</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pakets as $item)
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->harga, 0, '', '.') }} / kilo</td>
                                            <td>{{ $item->estimasi }} Hari</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                @if ($item->is_active === 'aktif')
                                                <a href="{{ route('isactive.update', $item->id) }}" class="btn btn-info btn-sm">{{ $item->is_active }}</a>
                                                @else
                                                <a href="{{ route('isactive.update', $item->id) }}" class="btn btn-danger btn-sm">{{ $item->is_active }}</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('paket.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalCenter{{ $item->id }}">Delete</a>
                                            </td>
                                        </tr>
                                        @include('admin.modal.paket.delete')
                                    @endforeach
                                </tbody>
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
