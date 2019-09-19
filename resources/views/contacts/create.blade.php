@extends('layouts.app')

@section('content')

<div class="container">

	<h2>Add New Contact</h2>

	<hr>

	<form method="POST" action="{{ route('contacts.store') }}">

		{{ csrf_field() }} <!-- cross site request forgery. generates a hidden input field with this token -->

		<table class="table">

			 <div class="form-group">
			    <label>First Name</label>
			    <input type="firstName" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="{{ old('firstName') }}">
			    @if ($errors->has('firstName'))
			    	<p class="text-danger"> 
			    		{{ $errors->first('firstName') }}
			    	</p>
			    @endif
			</div>

			<div class="form-group">
			    <label>Last Name</label>
			    <input type="lastName" class="form-control" id="lastName" name="lastName" placeholder="Last Name" value="{{ old('lastName') }}">
			    @if ($errors->has('lastName'))
			    	<p class="text-danger"> 
			    		{{ $errors->first('lastName') }}
			    	</p>
			    @endif
			</div>

			<div class="form-group">
			    <label>Address</label>
			    <input type="address" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
			    @if ($errors->has('address'))
			    	<p class="text-danger"> 
			    		{{ $errors->first('address') }}
			    	</p>
			    @endif
			</div>

			<div class="form-group">
			    <label>Email</label>
			    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
			    @if ($errors->has('email'))
			    	<p class="text-danger"> 
			    		{{ $errors->first('email') }}
			    	</p>
			    @endif
			</div>

			<div class="form-group">
			    <label>Phone Number</label>
			    <input type="phoneNumber" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" value="{{ old('phoneNumber') }}">
			    @if ($errors->has('phoneNumber'))
			    	<p class="text-danger"> 
			    		{{ $errors->first('phoneNumber') }}
			    	</p>
			    @endif
			</div>

			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" id="submit" value="submit" class="btn btn-info" />
					<a href="{{ route('contacts.index') }}" class="btn btn-link">Cancel</a>
				</td>
			</tr>
			
		</table>
		
	</form>

</div>

@endsection