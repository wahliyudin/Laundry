@extends('layouts.admin-master')
@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Vertical Form</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Vertical Form</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Two Column Vertical Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('paket.update', $paket->id) }}">
                            @csrf
                            @method('PUT')
                            <h4 class="card-title">Add Paket</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" value="{{ $paket->nama }}" class="form-control">
                                        @error('nama')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Per Kilo</label>
                                        <input type="number" name="harga" value="{{ $paket->harga }}" class="form-control">
                                        @error('harga')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Estimasi Pengerjaan (*hari)</label>
                                        <input type="number" name="estimasi" value="{{ $paket->estimasi }}" class="form-control">
                                        @error('estimasi')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control" cols="30" rows="6">{{ $paket->keterangan }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endsection
