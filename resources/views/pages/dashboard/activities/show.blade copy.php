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
@push('css')
	<style>
		#messageContainer::-webkit-scrollbar {
			width: 5px;
		}

		#messageContainer::-webkit-scrollbar-track {
			background: #f1f1f100;
		}

		#messageContainer::-webkit-scrollbar-thumb {
			background: #5873d3;
		}

		#messageContainer::-webkit-scrollbar-thumb:hover {
			background: #3950a3;
		}
	</style>
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Detail {{ $activity->name }}</h4>
					<div class="d-flex gap-2">
						@can('confirm', $activity)
							<x-modal.confirm
								route="{{ route('dashboard.activities.confirm', $activity->uuid) }}"
								method="PATCH"
								id="confirm"
								title="Konfirmasi"
							>
								<x-slot:btn>
									<i class="bi bi-check-circle"></i>
									Konfirmasi
								</x-slot>
								Konfirmasi Kegiatan <b>{{ $activity->name }}</b>
							</x-modal.confirm>
						@endcan
						@can('notifyPic', $activity)
							<x-modal.confirm
								route="{{ route('dashboard.activities.notifyPic', $activity->uuid) }}"
								method="PATCH"
								id="notifyPic"
								title="Ingatkan Penanggung Jawab"
							>
								<x-slot:btn>
									<i class="bi bi-check-circle"></i>
									Ingatkan
								</x-slot>
								Ingatkan penanggung jawab untuk melengkapi data
							</x-modal.confirm>
						@endcan
						@can('update', $activity)
							<a href="{{ route('dashboard.activities.edit', $activity->uuid) }}" class="btn btn-success btn-sm">
								<i class="bi bi-pencil-square"></i>
								Edit
							</a>
							<x-modal.delete
								:id="'deleteModal-' . $activity->uuid"
								:route="route('dashboard.activities.destroy', $activity->uuid)"
								:data="$activity->name"
								text="Hapus"
							/>
						@endcan
					</div>
				</div>
				<div class="card-body px-4">
					<table class="table-striped table-detail table">
						<tr>
							<th>Nama Kegiatan</th>
							<td>{{ $activity->name }}</td>
						</tr>
						<tr>
							<th>Penanggung Jawab</th>
							<td>{{ $activity->pic->user->name }}</td>
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
					@if ($documentations->count() > 0)
						<div class="row gallery">
							@foreach ($documentations as $key => $documentation)
								<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
									<div
										class="position-relative rounded-3 cursor-pointer overflow-hidden"
										data-bs-toggle="modal"
										data-bs-target="#galleryModal{{ $key }}"
									>
										<img
											class="w-100 object-fit-cover"
											height="150"
											src="{{ asset('storage/uploads/documentations/' . $documentation[0]->documentation) }}"
										/>
										<small class="w-100 bg-dark position-absolute start-50 translate-middle-x bottom-0 text-center text-white" style="--bs-bg-opacity: .5;">{{ app('format')->dateIndo($key) }}</small>
									</div>
								</div>
								<div
									class="modal fade"
									id="galleryModal{{ $key }}"
									tabindex="-1"
									role="dialog"
									aria-labelledby="galleryModal{{ $key }}Title"
									aria-hidden="true"
								>
									<div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="galleryModal{{ $key }}Title">Dokumentasi {{ app('format')->dateIndo($key) }}</h5>
												<button
													type="button"
													class="close"
													data-bs-dismiss="modal"
													aria-label="Close"
												>
													<i data-feather="x"></i>
												</button>
											</div>
											<div class="modal-body">
												<div
													id="Gallerycarousel{{ $key }}"
													class="carousel slide carousel-fade"
													data-bs-ride="carousel"
												>
													<div class="carousel-indicators">
														@foreach ($documentation as $index => $item)
															<button
																type="button"
																data-bs-target="#Gallerycarousel{{ $key }}"
																data-bs-slide-to="{{ $index }}"
																class="{{ $index === 0 ? 'active' : '' }}"
																aria-current="{{ $index === 0 ? 'true' : '' }}"
																aria-label="Slide {{ $index + 1 }}"
															></button>
														@endforeach
													</div>
													<div class="carousel-inner">
														@foreach ($documentation as $index => $item)
															<div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
																<img class="d-block w-100" src="{{ asset('storage/uploads/documentations/' . $item->documentation) }}">
															</div>
														@endforeach
													</div>
													<a
														class="carousel-control-prev"
														href="#Gallerycarousel{{ $key }}"
														role="button"
														type="button"
														data-bs-slide="prev"
													>
														<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													</a>
													<a
														class="carousel-control-next"
														href="#Gallerycarousel{{ $key }}"
														role="button"
														data-bs-slide="next"
													>
														<span class="carousel-control-next-icon" aria-hidden="true"></span>
													</a>
												</div>
											</div>
											<div class="modal-footer">
												<button
													type="button"
													class="btn btn-secondary"
													data-bs-dismiss="modal"
												>Close</button>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					@else
						<p>Data tidak ditemukan</p>
					@endif
				</div>
			</div>
		</div>
		{{-- <div class="col-12">
			<div id="message" class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Masukan & Saran</h4>
					<div class="d-flex gap-2"></div>
				</div>
				<div class="card-body px-4">
					<div class="bg-primary-subtle px-5 py-3">
						<div id="messageContainer" class="d-flex flex-column mb-3 gap-3" style="max-height: 65vh; overflow: auto;">
							@foreach ($activity->messages as $message)
								<div class="rounded border bg-white p-3">
									<div class="d-flex align-items-center mb-1">
										<h6 class="mb-0">{{ $message->user->name }}</h6>
										<span class="ms-2">-</span>
										<small class="ms-2">{{ app('format')->chatTime($message->created_at) }}</small>
									</div>
									<div>{{ $message->content }}</div>
								</div>
							@endforeach
						</div>
						<form action="{{ route('dashboard.messages.store') }}" method="POST">
							@csrf
							<input type="hidden" name="activity_id" value="{{ $activity->id }}">
							<div class="d-flex gap-3">
								<input type="text" class="form-control" name="content" placeholder="Tulis Pesan.." />
								<button type="submit" class="btn btn-primary d-flex gap-2">
									<span>Kirim</span>
									<i class="bi bi-send-fill"></i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> --}}
	</section>
@endsection
@push('scripts')
	<script>
		// Mengambil elemen div yang ingin di-scroll
		var messageContainer = document.getElementById('messageContainer');

		// Melakukan scroll ke bagian bawah setelah konten dirender
		messageContainer.scrollTop = messageContainer.scrollHeight;
	</script>
@endpush
