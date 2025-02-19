@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Kegiatan' => route('dashboard.activities.index'),
        'Tambah Data' => null,
    ],
])
@section('title', 'Tambah Kegiatan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Form Tambah Kegiatan</h4>
				</div>
				<div class="card-body px-4">
					<x-form.layout.horizontal action="{{ route('dashboard.activities.store') }}" method="POST" enctype="multipart/form-data">
						<x-form.input layout="horizontal" name="name" label="Nama Kegiatan" placeholder="Nama Kegiatan.." />
						<x-form.input layout="horizontal" name="place" label="Tempat Kegiatan" placeholder="Tempat Kegiatan.." />
						<x-form.input layout="horizontal" name="date" label="Tanggal Kegiatan" placeholder="Tanggal Kegiatan.." type="date" />
						<x-form.input layout="horizontal" name="attachment" label="Lampiran" type="file" />
					</x-form.layout.horizontal>
				</div>
			</div>
		</div>
	</section>
@endsection
