@extends('admin.layouts.loginlayout')

@section('content')
<div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>

      <div class="card-body">        

        @if(session('errMsg'))
          <div class="alert alert-danger">{{ session('errMsg') }}</div>
        @endif

        <form action="{{ url('/admin/login') }}" method="post">
          
          @csrf

          <div class="form-group">
            <div class="form-label-group">
              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-label-group">
              <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>          
          <button class="btn btn-primary btn-block">Login</button>
        </form>        
      </div>
    </div>
@stop