@extends('layouts.app')

@section('content')

<div class="container">

	<h2>Contact Details</h2>

	<table class="table">
		<tr>
			<td>First Name</td>
			<td>
				{{ $contact->firstName }}
			</td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td>
				{{ $contact->lastName }}
			</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>
				{{ $contact->address }}
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>
				{{ $contact->email }}
			</td>
		</tr>
		<tr>
			<td>Phone Number</td>
			<td>
				{{ $contact->phoneNumber }}
			</td>
		</tr>
		</table>

		<h2>Pets</h2>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Age</th>
                <th>Type</th>
                <th>Breed</th>
            </thead>
            <tbody>
                @foreach ($contact->pets()->get() as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->age }}</td>
                    <td>{{ $pet->type }}</td>
                    <td>{{ $pet->breed }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

		<a href="{{ route('contacts.index') }}" class="btn btn-link">Back</a>
		
			
		
	


</div>

@endsection