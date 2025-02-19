@extends('layouts.export')
@section('title', 'Laporan Kegiatan')
@section('content')
	<table class="table-striped table">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Tempat</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($activities as $activity)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $activity->name }}</td>
					<td>{{ $activity->place }}</td>
					<td>{{ $activity->formatted_date }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
