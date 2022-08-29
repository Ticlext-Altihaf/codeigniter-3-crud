<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		@import url("https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap");

		*, *:after, *:before {
			box-sizing: border-box;
		}

		body {
			font-family: "DM Sans", sans-serif;
			line-height: 1.5;
			background-color: #f1f3fb;
			padding: 0 2rem;
		}

		img {
			max-width: 100%;
			display: block;
		}

		input {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			border-radius: 0;
		}

		.card {
			margin: 2rem auto;
			display: flex;
			flex-direction: column;
			width: 100%;
			max-width: 425px;
			background-color: #FFF;
			border-radius: 10px;
			box-shadow: 0 10px 20px 0 rgba(153, 153, 153, 0.25);
			padding: 0.75rem;
		}

		.card-image {
			border-radius: 8px;
			overflow: hidden;
			padding-bottom: 65%;
			background-size: 150%;
			background-position: 0 5%;
			position: relative;
		}

		.card-heading {
			position: absolute;
			left: 10%;
			top: 15%;
			right: 10%;
			font-size: 1.75rem;
			font-weight: 700;
			color: #242424;
			line-height: 1.222;
		}

		.card-heading small {
			display: block;
			font-size: 0.75em;
			font-weight: 400;
			margin-top: 0.25em;
		}

		.card-form {
			padding: 2rem 1rem 0;
		}

		.input {
			display: flex;
			flex-direction: column-reverse;
			position: relative;
			padding-top: 1.5rem;
		}

		.input + .input {
			margin-top: 1.5rem;
		}

		.input-label {
			color: #8597a3;
			position: absolute;
			top: 1.5rem;
			transition: 0.25s ease;
		}

		.input-field {
			border: 0;
			z-index: 1;
			background-color: transparent;
			border-bottom: 2px solid #eee;
			font: inherit;
			font-size: 1.125rem;
			padding: 0.25rem 0;
		}

		.input-field:focus, .input-field:valid {
			outline: 0;
			border-bottom-color: #6658d3;
		}

		.input-field:focus + .input-label, .input-field:valid + .input-label {
			color: #6658d3;
			transform: translateY(-1.5rem);
		}

		.action {
			margin-top: 2rem;
		}

		.action-button {
			font: inherit;
			font-size: 1.25rem;
			padding: 1em;
			width: 100%;
			font-weight: 500;
			background-color: #6658d3;
			border-radius: 6px;
			color: #FFF;
			border: 0;
		}

		.action-button:focus {
			outline: 0;
		}

		.card-info {
			padding: 1rem 1rem;
			text-align: center;
			font-size: 0.875rem;
			color: #8597a3;
		}

		.card-info a {
			display: block;
			color: #6658d3;
			text-decoration: none;
		}
	</style>
	<title>Edit User</title>
</head>
<body>
<div class="container">
	<!-- code here -->
	<div class="card">
		<div class="card-image">
			<h2 class="card-heading">
				Get started
				<small>Let us edit your account</small>
			</h2>
		</div>
		<form class="card-form" method="post">
			<div class="input">
				<input type="text" class="input-field" value="<?php echo $nama ?>" name="nama" required>
				<label class="input-label">Nama</label>
			</div>
			<div class="input">
				<input type="text" class="input-field" value="<?php echo $alamat ?>" name="alamat" required>
				<label class="input-label">Alamat</label>
			</div>
			<div class="input">
				<input type="text"  class="input-field" value="<?php echo $perkerjaan ?>" name="perkerjaan" required>
				<label class="input-label">Perkerjaan</label>
			</div>
			<div class="action">
				<button class="action-button">Edit</button>
			</div>
		</form>
		<div class="card-info">
			<p>By editing you are agreeing to our <a href="#">Terms and Conditions</a></p>
		</div>
	</div>
</div>
</body>
</html>
