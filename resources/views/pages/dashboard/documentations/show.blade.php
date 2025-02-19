@php
	use App\Constants\ActivityStatus;
@endphp
@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Kegiatan' => route('dashboard.activities.index'),
        $activity->name => null,
    ],
])
@section('title', 'Detail Kegiatan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Detail {{ $activity->name }}</h4>
					<div class="d-flex gap-2">
						@if (auth()->user()->isAdmin() && $activity->status === ActivityStatus::PENDING)
							<x-modal.confirm route="{{ route('dashboard.activities.confirm', $activity->uuid) }}" method="PATCH" id="confirm" title="Konfirmasi">
								<x-slot:btn>
									<i class="bi bi-check-circle"></i>
									Konfirmasi
								</x-slot>
								Konfirmasi Kegiatan <b>{{ $activity->name }}</b>
							</x-modal.confirm>
						@endif
						@if (auth()->user()->isPic())
							<a href="{{ route('dashboard.activities.edit', $activity->uuid) }}" class="btn btn-success btn-sm">
								<i class="bi bi-pencil-square"></i>
								Edit
							</a>
							<x-modal.delete :id="'deleteModal-' . $activity->uuid" :route="route('dashboard.activities.destroy', $activity->uuid)" :data="$activity->name" text="Hapus" />
						@endif
					</div>
				</div>
				<div class="card-body px-4">
					<table class="table-striped table-detail table">
						<tr>
							<th>Nama Kegiatan</th>
							<td>{{ $activity->name }}</td>
						</tr>
						<tr>
							<th>Tempat</th>
							<td>{{ $activity->place }}</td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td>{{ app('format')->dateIndo($activity->date) }}</td>
						</tr>
						<tr>
							<th>Status</th>
							<td>{{ $activity->status }}</td>
						</tr>
						<tr>
							<th>Lampiran</th>
							<td>
								<a href="{{ asset('storage/uploads/attachments/' . $activity->attachment) }}">{{ $activity->attachment }}</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Dokumentasi</h4>
					<div class="d-flex gap-2">
						@if (auth()->user()->isPic())
							<a href="{{ route('dashboard.documentations.create', ['uuid' => $activity->uuid]) }}" class="btn btn-primary btn-sm">
								<i class="bi bi-plus-circle"></i>
								Tambah Dokumentasi
							</a>
						@endif
					</div>
				</div>
				<div class="card-body px-4">
					<div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100 active" src="https://images.unsplash.com/photo-1633008808000-ce86bff6c1ed?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
							</a>
						</div>
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100" src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80" data-bs-target="#Gallerycarousel" data-bs-slide-to="1">
							</a>
						</div>
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100" src="https://images.unsplash.com/photo-1632951634308-d7889939c125?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" data-bs-target="#Gallerycarousel" data-bs-slide-to="2">
							</a>
						</div>
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100" src="https://images.unsplash.com/photo-1632949107130-fc0d4f747b26?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3OHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" data-bs-target="#Gallerycarousel" data-bs-slide-to="3">
							</a>
						</div>
					</div>
					<div class="row mt-md-4 gallery mt-2" data-bs-toggle="modal" data-bs-target="#galleryModal">
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100 active" src="https://images.unsplash.com/photo-1633008808000-ce86bff6c1ed?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
							</a>
						</div>
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100" src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80" data-bs-target="#Gallerycarousel" data-bs-slide-to="1">
							</a>
						</div>
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100" src="https://images.unsplash.com/photo-1632951634308-d7889939c125?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" data-bs-target="#Gallerycarousel" data-bs-slide-to="2">
							</a>
						</div>
						<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
							<a href="#">
								<img class="w-100" src="https://images.unsplash.com/photo-1632949107130-fc0d4f747b26?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3OHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" data-bs-target="#Gallerycarousel" data-bs-slide-to="3">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('modal')
	<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="galleryModalTitle">Our Gallery Example</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<div class="modal-body">

					<div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
						<div class="carousel-indicators">
							<button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
							<button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
							<button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
							<button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
						</div>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="https://images.unsplash.com/photo-1633008808000-ce86bff6c1ed?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="https://images.unsplash.com/photo-1632951634308-d7889939c125?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="https://images.unsplash.com/photo-1632949107130-fc0d4f747b26?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3OHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60">
							</div>
						</div>
						<a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						</a>
						<a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
						</a>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endsection
