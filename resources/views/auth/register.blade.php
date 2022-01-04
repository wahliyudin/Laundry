@extends('layouts.auth-master')
@section('content')
    <div class="account-box" style="margin-top: 160px;">
        <div class="account-wrapper">
            <h3 class="account-title">Register</h3>
            
            <!-- Account Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>No WA</label>
                    <input id="no_wa" type="number" class="form-control @error('no_wa') is-invalid @enderror" name="no_wa"
                        value="{{ old('no_wa') }}" required autocomplete="no_wa" autofocus>

                    @error('no_wa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="col-md-10">
                        <div class="radio d-flex">
                            <label>
                                <input type="radio" value="Pria" name="jenis_kelamin"> Pria
                            </label>
                            <label class="ml-3">
                                <input type="radio" value="Wanita" name="jenis_kelamin"> Wanita
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                        value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>

                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Repeat Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" type="submit">Register</button>
                </div>
                <div class="account-footer">
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
            <!-- /Account Form -->
        </div>
    </div>
@endsection
