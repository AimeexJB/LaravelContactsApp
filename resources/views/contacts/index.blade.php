@extends('layouts.app')

@section('content')
<!-- <p>Bitches</p> -->

@if (count($contacts) === 0)
	<p>There are no Contacts </p>

@else
<div class="container">
	<h2>Contacts <a class="btn btn-info" href="{{ route('contacts.create') }}">Add</a></h2>

	@if (Session::has('message'))
		<div class="alert alert-success">
			{{ Session::get('message') }}
			
		</div>
	@endif



	<table class="table">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Address</th>
				<th>Email</th> 
				<th>Phone Number</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($contacts as $contact)
				<tr>
					<td>{{ $contact->firstName }}</td>
					<td>{{ $contact->lastName }}</td>
					<td>{{ $contact->address }}</td>
					<td>{{ $contact->email }}</td>
					<td>{{ $contact->phoneNumber }}</td>
					<td>
						

						<form method="POST" action="{{ route('contacts.destroy', $contact->id) }}" >
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-default">View</a>
							<a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary">Edit</a>
							<button type="submit" class="btn btn-danger"> Delete</button>
						</form>
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<hr>

</div>
	

@endif

@endsection