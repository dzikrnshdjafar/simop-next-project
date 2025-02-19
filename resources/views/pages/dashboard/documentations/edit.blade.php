@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Kegiatan' => route('dashboard.activities.index'),
        $activity->name => route('dashboard.activities.show', $activity->uuid),
        'Edit' => null,
    ],
])
@section('title', 'Edit Kegiatan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Form Edit Kegiatan</h4>
				</div>
				<div class="card-body px-4">
					<x-form.layout.horizontal action="{{ route('dashboard.activities.update', $activity->uuid) }}" method="PUT" submit-text="Perbarui" enctype="multipart/form-data">
						<x-form.input layout="horizontal" name="name" label="Nama Kegiatan" placeholder="Nama Kegiatan.." :value="$activity->name" />
						<x-form.input layout="horizontal" name="place" label="Tempat Kegiatan" placeholder="Tempat Kegiatan.." :value="$activity->place" />
						<x-form.input layout="horizontal" name="date" label="Tanggal Kegiatan" placeholder="Tanggal Kegiatan.." type="date" :value="$activity->date" />
						<x-form.input layout="horizontal" name="attachment" label="Lampiran" type="file" :value="$activity->attachment" />
					</x-form.layout.horizontal>
				</div>
			</div>
		</div>
	</section>
@endsection
