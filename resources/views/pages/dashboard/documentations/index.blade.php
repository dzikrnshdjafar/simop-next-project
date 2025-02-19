@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Dokumentasi' => null,
    ],
])
@section('title', 'Dokumentasi')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Dokumentasi Kegiatan</h4>
				</div>
				<div class="card-body px-4">
					@if ($documentations->count() > 0)
						<div class="row gallery">
							@foreach ($documentations as $key => $documentation)
								<div class="col-6 col-sm-6 col-lg-3 mt-md-0 mb-md-0 mb-2 mt-2">
									<div class="position-relative rounded-3 cursor-pointer overflow-hidden" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $key }}">
										<img class="w-100 object-fit-cover" height="150" src="{{ asset('storage/uploads/documentations/' . $documentation[0]->documentation) }}" />
										<small class="w-100 bg-dark position-absolute start-50 translate-middle-x bottom-0 text-center text-white" style="--bs-bg-opacity: .5;">{{ app('format')->dateIndo($key) }}</small>
									</div>
								</div>
								<div class="modal fade" id="galleryModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="galleryModal{{ $key }}Title" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="galleryModal{{ $key }}Title">Dokumentasi {{ app('format')->dateIndo($key) }}</h5>
												<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
													<i data-feather="x"></i>
												</button>
											</div>
											<div class="modal-body">
												<div id="Gallerycarousel{{ $key }}" class="carousel slide carousel-fade" data-bs-ride="carousel">
													<div class="carousel-indicators">
														@foreach ($documentation as $index => $item)
															<button type="button" data-bs-target="#Gallerycarousel{{ $key }}" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
														@endforeach
													</div>
													<div class="carousel-inner">
														@foreach ($documentation as $index => $item)
															<div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
																<img class="d-block w-100" src="{{ asset('storage/uploads/documentations/' . $item->documentation) }}">
															</div>
														@endforeach
													</div>
													<a class="carousel-control-prev" href="#Gallerycarousel{{ $key }}" role="button" type="button" data-bs-slide="prev">
														<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													</a>
													<a class="carousel-control-next" href="#Gallerycarousel{{ $key }}" role="button" data-bs-slide="next">
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
							@endforeach
						</div>
					@else
						<p>Data tidak ditemukan</p>
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection
