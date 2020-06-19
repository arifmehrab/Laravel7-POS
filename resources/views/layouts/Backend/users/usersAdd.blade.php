@extends('layouts.Backend.master')
@section('content')
<div class="row">
  		<div class="col-lg-2"></div>
  		<div class="col-lg-8">
                  <a class="btn btn-success" href="{{ route('users.view') }}">View Employees</a>
  			<h2 class="py-3 text-center">Employees Resistation</h2>
            <form class="form" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
            	@csrf
            	<div class="form-group">

            		<label>userRole</label>
            		<select id="userType" name="userRole" class="form-control @error('userRole') Invalid @enderror">
            			<option value="">*Select User Role*</option>
            			<option value="admin">Admin</option>
            			<option value="user">User</option>
            		</select>
            		@error('userRole')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>
            	<div class="form-group">
            		<label>Name</label>
            		<input type="text" name="name" class="form-control @error('name') Invalid @enderror">
            		@error('name')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>
            	<div class="form-group">
            		<label>Email</label>
            		<input type="email" name="email" class="form-control @error('name') Invalid @enderror">
            		@error('email')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror

            	</div>
            	<div class="form-group">
            		<label>Password</label>
            		<input type="password" name="password" class="form-control @error('password') Invalid @enderror">
            		@error('password')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>
            	
            	<div class="form-group">
            		<label>Mobile</label>
            		<input type="number" name="mobile" class="form-control @error('mobile') Invalid @enderror">
            		@error('mobile ')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>

                  <div class="form-group">
                        <label>Shop Name</label>
                        <input type="text" name="shopName" class="form-control @error('shopName') Invalid @enderror">
                        @error('shopName ')
                        <strong class="alert alert-danger">{{ $message }}</strong>
                        @enderror
                  </div>

            	<div class="form-group">
            		<label>Address</label>
            		<input type="text" name="address" class="form-control @error('address') Invalid @enderror">
            		@error('address ')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>

            	<div class="form-group">
            		<label>Profile</label>
            		<input type="file" name="image" class="form-control @error('image') Invalid @enderror">
            		@error('image ')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>

            	<div class="form-group">
            		<input type="submit" name="submit" class="form-control btn btn-success btn-block">
            	</div>
            </form>
  		</div>
  		<div class="col-lg-2"></div>
  	</div>
@endsection