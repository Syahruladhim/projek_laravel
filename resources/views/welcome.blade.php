<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Pendukung Keputusan</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-digital-trend.css') }}">
</head>
<body>

    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
              <i class="fa fa-line-chart"></i>
              Rise and Shine
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#about" class="nav-link smoothScroll">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link contact">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero hero-bg d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 col-12 d-flex flex-column justify-content-center align-items-center">
                    <div class="hero-text">
                        <h1 class="text-white" data-aos="fade-up">Sistem Pendukung keputusan pembagian beras miskin.</h1>
                        <a href="{{ route('login') }}" class="custom-btn btn-bg btn mt-3" data-aos="fade-up" data-aos-delay="100">Mulai sekarang!</a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="hero-image" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset('assets/images/working-girl.png') }}" class="img-fluid" alt="working girl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="about section-padding pb-0" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto col-md-10 col-12">
                    <div class="about-info">
                        <h2 class="mb-4" data-aos="fade-up">Kenapa harus <strong>sistem Pendukung keputusan</strong> pembagian raskin ?</h2>
                        <p class="mb-0" data-aos="fade-up">karena agar bantuan dari pemerintahan jatuh kepada tangan yang tepat.</p>
                    </div>
                    <div class="about-image" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('assets/images/office.png') }}" class="img-fluid" alt="office">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCRIPTS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
