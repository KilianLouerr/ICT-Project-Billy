@extends('layout')
@section('title', 'Punten beheren')
@section('content')
<section>
	<h2>Punten beheren</h2>
</section>
<section>
	<div class="grid-vertical-to-horizontal">
		<div>
			<label>Punten toevoegen</label><br>
			<form action="/addLocation" method="POST">
				@csrf
				<table>
					<tr>
						<td>
							<label>Naam punt:</label>
						</td>
						<td>
							<input name="name"></input><br>
							@error('name')
							<div class="error" style="color: red;">{{ $message }}</div>
							@enderror
						</td>
					</tr>
					<tr>
						<td>
							@csrf
							<label>Beschrijving:</label>
						</td>
						<td>
							<input name="description"></input><br>
							@error('description')
							<div class="error" style="color: red;">{{ $message }}</div>
							@enderror
						</td>
						<td><button type="submit" class="button">Toevoegen</button></td>
					</tr>
				</table>
			</form>
		</div>
		<div>
			<label>Punten:</label>
			<form action="/removeSelectedLocations" method="POST" id="removeLocationForm">
				@csrf
				<table>
					@if(count($points) == 0)
					<tr>
						<td colspan="2">Geen punten</td>
					</tr>
					@else
					@foreach ($points as $point)
					<tr>
						<td>
							<input type="checkbox" name="point_id[]" value="{{ $point['id'] }}">
						</td>
						<td>
							<table>
								<tr>
									<td>
										<strong>{{ $point['name'] }}</strong>
									</td>
									<td>
										{{ $point['description'] }}
									</td>
								</tr>
							</table>
						</td>
					</tr>
					@endforeach
					@endif
				</table>
				<button type="submit" class="button">Verwijderen</button>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="{{ asset('js/manageLocation.js') }}"></script>
@endsection
 