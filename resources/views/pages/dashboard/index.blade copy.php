@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => null,
    ],
])
@section('title', 'Dasbor')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/iconly.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body py-4-5 px-4">
							<div class="row">
								<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
									<div class="stats-icon purple mb-2">
										<i class="iconly-boldUser"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">Pengguna</h6>
									<div class="d-flex align-items-center justify-content-between">
										<h6 class="mb-0 font-extrabold">{{ str_pad($users->count(), 3, '0', STR_PAD_LEFT) }}</h6>
										<a href="{{ route('dashboard.master.users.index') }}">
											Detail
											<i class="bi bi-chevron-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body py-4-5 px-4">
							<div class="row">
								<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
									<div class="stats-icon purple mb-2">
										<i class="iconly-boldUser"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">Penanggung Jawab</h6>
									<div class="d-flex align-items-center justify-content-between">
										<h6 class="mb-0 font-extrabold">{{ str_pad($pics->count(), 3, '0', STR_PAD_LEFT) }}</h6>
										<a href="{{ route('dashboard.master.pics.index') }}">
											Detail
											<i class="bi bi-chevron-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body py-4-5 px-4">
							<div class="row">
								<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
									<div class="stats-icon purple mb-2">
										<i class="iconly-boldCalendar"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">Kegiatan</h6>
									<div class="d-flex align-items-center justify-content-between">
										<h6 class="mb-0 font-extrabold">{{ str_pad($activities->count(), 3, '0', STR_PAD_LEFT) }}</h6>
										<a href="{{ route('dashboard.activities.index') }}">
											Detail
											<i class="bi bi-chevron-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body py-4-5 px-4">
							<div class="row">
								<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
									<div class="stats-icon purple mb-2">
										<i class="iconly-boldImage"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">Dokumentasi</h6>
									<div class="d-flex align-items-center justify-content-between">
										<h6 class="mb-0 font-extrabold">{{ str_pad($documentations->count(), 3, '0', STR_PAD_LEFT) }}</h6>
										<a href="{{ route('dashboard.documentations.index') }}">
											Detail
											<i class="bi bi-chevron-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@if (auth()->user()->isAdmin() || auth()->user()->isManager())
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="card-title pl-1">Grafik Kegiatan</h4>
						<div class="d-flex gap-2">
							<select
								name="year"
								id="year"
								class="form-select form-select-sm"
								onchange="updateUrlWithYear(this.value)"
							>
								@foreach ($activityYears as $year)
									<option value="{{ $year }}" {{ $year == request('year') ? 'selected' : '' }}>{{ $year }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<div id="chart-activity-by-department"></div>
							</div>
							<div class="col-8">
								<div id="chart-activity-by-year"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</section>
@endsection
@push('scripts')
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="{{ asset('js/extensions/apexcharts.min.js') }}"></script>
	<script>
		$(function() {
			const year = @json(request('year')) || new Date().getFullYear();
			const departments = @json($departments);
			$.ajax({
				url: "{{ route('dashboard.activities.index') }}" + "?year=" + year,
				type: "GET",
				success: function(response) {
					const activitiesData = response.data;

					const chartActivityByDepartmentLabels = Object.values(departments).map(department => department);
					const departmentCounts = activitiesData.reduce((counts, activity) => {
						const department = activity.pic.department;
						counts[department] = (counts[department] || 0) + 1;
						return counts;
					}, {});
					const chartActivityByDepartmentSeries = chartActivityByDepartmentLabels.map(department => departmentCounts[department] || 0);
					new ApexCharts(
						document.getElementById("chart-activity-by-department"), {
							series: chartActivityByDepartmentSeries,
							labels: chartActivityByDepartmentLabels,
							colors: ["#ff6f61", "#ffc107", "#28a745"],
							chart: {
								type: "donut",
								width: "100%",
								height: "350px",
							},
							legend: {
								position: "bottom",
							},
							plotOptions: {
								pie: {
									donut: {
										size: "30%",
									}
								}
							}
						}
					).render();

					const monthCounts = Array(12).fill(0);
					activitiesData.forEach(activity => {
						const dateParts = activity.date.split("/"); // Pisahkan tanggal, bulan, dan tahun
						const day = parseInt(dateParts[0], 10);
						const month = parseInt(dateParts[1], 10) - 1; // Bulan di JavaScript dimulai dari 0
						const year = parseInt(dateParts[2], 10);

						const date = new Date(year, month, day); // Buat objek Date

						if (!isNaN(date.getTime())) { // Pastikan tanggal valid
							const monthIndex = date.getMonth();
							monthCounts[monthIndex]++;
						} else {
							console.error(`Invalid date format for: ${activity.date}`);
						}
					});
					new ApexCharts(
						document.querySelector("#chart-activity-by-year"), {
							annotations: {
								position: "back",
							},
							dataLabels: {
								enabled: false,
							},
							chart: {
								type: "bar",
								height: 300,
							},
							fill: {
								opacity: 1,
							},
							plotOptions: {
								bar: {
									borderRadius: 4,
									horizontal: false,
								},
							},
							series: [{
								name: "Jumlah Kegiatan",
								data: monthCounts,
							}],
							colors: ["#435ebe"],
							xaxis: {
								categories: [
									"Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
									"Jul", "Agu", "Sep", "Okt", "Nov", "Des"
								]
							},
							yaxis: {
								title: {
									text: "Jumlah Kegiatan"
								},
								labels: {
									formatter: function(val) {
										return Number.isInteger(val) ? val : '';
									}
								},
							}
						}
					).render();
				},
				error: function(xhr, status, error) {
					console.error("Error fetching data:", error);
					console.log(xhr.responseJSON);
				},
			});
		});
	</script>
	<script>
		function updateUrlWithYear(year) {
			// Redirect to the current URL with the selected year as a query parameter
			const baseUrl = window.location.origin + window.location.pathname;
			const urlParams = new URLSearchParams(window.location.search);
			urlParams.set('year', year); // Set the year parameter
			window.location.href = `${baseUrl}?${urlParams.toString()}`;
		}
	</script>
@endpush
