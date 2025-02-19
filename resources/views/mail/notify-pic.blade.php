<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pemberitahuan</title>
		<style>
			body {
				font-family: Arial, sans-serif;
				line-height: 1.6;
				color: #333;
				background-color: #f9f9f9;
				padding: 20px;
			}

			.container {
				max-width: 600px;
				background: #ffffff;
				padding: 20px;
				margin: 0 auto;
				border-radius: 5px;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			}

			.btn {
				display: inline-block;
				padding: 10px 15px;
				color: #fff;
				background: #007bff;
				text-decoration: none;
				border-radius: 5px;
			}

			.btn:hover {
				background: #0056b3;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<h2>Pemberitahuan untuk Melengkapi Data</h2>
			<p>Yth. {{ $activity->pic->user->name }},</p>
			<p>Mohon segera melengkapi data yang diperlukan untuk proses selanjutnya. Silakan klik tombol di bawah untuk mengakses formulir pengisian data.</p>
			<p>
				<a href="{{ $url }}" class="btn">Lengkapi Data</a>
			</p>
			<p>Terima kasih atas perhatian dan kerjasamanya.</p>
			<p>Salam</p>
		</div>
	</body>

</html>
