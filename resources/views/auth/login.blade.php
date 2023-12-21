<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Connexion</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 center-container">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Connexion</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
					@csrf

					<div class="row mb-4">
						<label for="email" class="col-md-4 col-form-label text-md-end" >{{ __('Email') }}</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="width: 240px" >

							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-4">
						<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="width: 240px;>

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

			
					<div class="row mb-0">
						<div class="col-md-8 offset-md-4">
            <br>
							<button type="submit" class="btn btn-dark">
								{{ __('Connexion') }}
							</button>

						</div>
					</div>
				</form>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>
<style>
  body {
    background-image: url("{{ asset('assets/img/TAGE.png') }}");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
  }
  .center-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80vh;
 }
</style>



<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>