@extends('layouts.auth')

@section('login')
<div class="login-box">
    <div class="login-logo">
      <a href="#"><b></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" >
        <div class="login-logo">
            <a href="{{ url('/')}}">
                <img src="{{asset('img/logo.png')}}" alt="logo.png" width="150">
            </a>

            <h5>silahkan Masuk Menggunakan</h5>
            <h5>Email : admindemo@gmail.com</h5>
            <h5>password : admindemo</h5>
          </div>
  
      <form action="{{ route('login')}}" method="post">
        @csrf
        <div class="form-group has-feedback @error('email') has-error @enderror">
          <input type="email" name="email" class="form-control" placeholder="Email" required value="{{old('email')}}" autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @error('email')
          <span class="help-block">Email Salah Boss!!</span>
          @enderror
        </div>
        <div class="form-group has-feedback @error('password') has-error @enderror">
          <input type="password" name="password"class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @error('password')
          <span class="help-block">Pastikan email dan password benar</span>
          @enderror
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
</div>
@endsection