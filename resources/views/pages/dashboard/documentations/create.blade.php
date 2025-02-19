@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Dokumentasi' => route('dashboard.documentations.index'),
        'Tambah Data' => null,
    ],
])
@section('title', 'Tambah Dokumentasi')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond-plugin-image-preview.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<div>
						<h4 class="card-title pl-1">Form Tambah Dokumentasi</h4>
						<p class="card-subtitle">Dokumentasi Kegiatan {{ $activity->name }}</p>
					</div>
				</div>
				<div class="card-body px-4">
					<x-form.layout.horizontal action="{{ route('dashboard.documentations.store') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="activity_id" value="{{ $activity->id }}">
						<x-form.input layout="horizontal" name="date" label="Tanggal Dokumentasi" type="date" :value="$activity->date" />
						<x-form.input layout="horizontal" type="file" name="documentations[]" label="Dokumentasi" class="multiple-files-filepond" help-block="Unggah 1 atau lebih gambar dengan format jpg, png atau webp." multiple />
					</x-form.layout.horizontal>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-size.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-type.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-crop.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-exif-orientation.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-filter.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-preview.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-resize.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond.js') }}"></script>
	<script>
		FilePond.registerPlugin(
			FilePondPluginImagePreview,
			FilePondPluginImageCrop,
			FilePondPluginImageExifOrientation,
			FilePondPluginImageFilter,
			FilePondPluginImageResize,
			FilePondPluginFileValidateSize,
			FilePondPluginFileValidateType,
		)

		FilePond.create(document.querySelector(".multiple-files-filepond"), {
			credits: null,
			allowImagePreview: true,
			allowMultiple: true,
			allowFileEncode: false,
			required: false,
			storeAsFile: true,
			acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "image/webp"],
		})
	</script>
@endpush
