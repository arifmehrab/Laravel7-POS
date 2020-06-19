@extends('layouts.Backend.master')
@section('content')
<div class="row">
  		<div class="col-lg-2"></div>
  		<div class="col-lg-8">
                  <a class="btn btn-success" href="{{ route('users.view') }}">View Users</a>
  			<h2 class="py-3 text-center">User Resistation</h2>
            <form class="form" method="post" action="{{ route('users.update', $edits->id) }}" enctype="multipart/form-data">
            	@csrf
            	<div class="form-group">

            		<label>userRole</label>
            		<select id="userType" name="userRole" class="form-control @error('userRole') Invalid @enderror">
            			<option value="admin" @if($edits->userRole == 'admin')selected @endif>Admin</option>
            			<option value="user" @if($edits->userRole == 'user') selected @endif>User</option>
            		</select>
            		@error('userRole')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>
            	<div class="form-group">
            		<label>Name</label>
            		<input type="text" name="name" class="form-control @error('name') Invalid @enderror" value="{{ $edits->name }}">
            		@error('name')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>
            	<div class="form-group">
            		<label>Email</label>
            		<input type="email" name="email" class="form-control @error('name') Invalid @enderror" value="{{ $edits->email }}">
            		@error('email')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror

            	</div>
            	
            	<div class="form-group">
            		<label>Mobile</label>
            		<input type="number" name="mobile" class="form-control @error('mobile') Invalid @enderror" value="{{ $edits->number }}">
            		@error('mobile ')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>

                  <div class="form-group">
                        <label>Shop Name</label>
                        <input type="text" name="shopName" class="form-control @error('shopName') Invalid @enderror" value="{{ $edits->shopName }}">
                        @error('shopName ')
                        <strong class="alert alert-danger">{{ $message }}</strong>
                        @enderror
                  </div>

            	<div class="form-group">
            		<label>Address</label>
            		<input type="text" name="address" class="form-control @error('address') Invalid @enderror" value="{{ $edits->address }}">
            		@error('address ')
            		<strong class="alert alert-danger">{{ $message }}</strong>
            		@enderror
            	</div>

            	<div class="form-group">
            		<label>Profile</label>
            		<input type="file" name="image" class="form-control @error('image') Invalid @enderror">
                        <img width="200" src="{{ asset('assets/Backend/images/'.$edits->profile) }}">
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