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
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <h4 class="card-title">Personal Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                        @error('name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control">
                                        @error('email')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" class="select">
                                            @if ($user->role === 'admin')
                                                <option selected value="admin">Admin</option>
                                                <option value="customer">customer</option>
                                            @else
                                                <option value="admin">Admin</option>
                                                <option selected value="customer">customer</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" value="{{ $user->password }}"
                                            class="form-control">
                                        @error('password')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Wa Aktif</label>
                                        <input type="number" name="no_wa" value="{{ $user->no_wa }}"
                                            class="form-control">
                                        @error('no_wa')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="select">
                                            @if ($user->jenis_kelamin === 'pria')
                                                <option selected value="pria">Pria</option>
                                                <option value="wanita">Wanita</option>
                                            @else
                                                <option value="pria">Pria</option>
                                                <option selected value="wanita">Wanita</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control" cols="30"
                                            rows="6">{{ $user->alamat }}</textarea>
                                        @error('alamat')
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
