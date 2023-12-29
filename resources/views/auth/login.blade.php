<!doctype html>
<html lang="en">

<head>
    <title>Jaya Marlin Persada | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/storage/assets/auth/css/style.css">
    <link href="/storage/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="/storage/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/storage/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/storage/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/storage/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="/storage/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <style>
        #utama {
            background:
                linear-gradient(rgba(13, 110, 255, 0.7),
                    rgba(0, 0, 0, 0.3)),
                url('/storage/assets/img/backgroundjmp.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
            width: 100%;
        }

        .warnaabu {
            background-color: rgb(255 255 255 / 50%);
        }

        .tulisantengah {
            text-align: center;
        }
    </style>

</head>

<body id="utama" class="img js-fullheight">
    <section class="ftco-section">
        <div class="container" style="margin-top:100px;">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">DocumentJMP</h2>
                    <h2 class="heading-section" style="font-size: 21px;">Jaya Marlin Persada</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="/signin" method="post" class="signin-form">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Masukkan Email Address Anda" required>
                                @error('email')
                                    <div><small class="text-danger mb-3">{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password"
                                    placeholder="Masukkan Password Anda" required>
                                @error('password')
                                    <div><small class="text-danger mb-3">{{ $message }}</small></div>
                                @enderror
                            </div>
                            @if (session('fail'))
                                <div class="alert alert-danger" role="alert"
                                    style="text-align: center; background-color: rgb(228, 52, 52); color: white">
                                    {{ session('fail') }}
                                </div>
                            @endif

                            <div class="form-group d-md-flex">&nbsp;</div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">&nbsp;</div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="services">
        <div class="container">

            <div class="row">
                @foreach ($documents as $document)
                    <div class="col-md-4">
                        <div class="icon-box warnaabu">
                            <h4><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAABNZJREFUaEPtmWnIVkUUx3+SSJG2falUijYqKagwCpP2haiIVltJghKz+hCYRdBiUFF9aN+DKKJ9sU00NaPI0kgRsn2jNIJo36APNf+YiXGauffMvc9rvOD54uszc5b/nDPnnDl3BMOcRgxz+1kP4P/2YI0HDgBeXUcGHwS8YtFlBTAduAOYDVxhEdxjz63ADGAq8GCbHAuAYHyQdQFwW5vgjuuXA1d53r8sINoA6CRyxu4EfNzRyBLb7sDKzOI5wH0lpiYA5wNyZ0olgZsCpwPHAVsDW/h/xf818B2wBngWeAj4OSP7POD2zO/nAvfmQJQAlE4+J2gicBFwaqVHFN83AcsTvhKI7MHlAEwA3s0Yo7twV/T7vu7vK4EjKg1Ptz8HXA28HS2UQOwMfBgLKHngEuDaROCd/v8buPC4BZCSQdINwCyX5XR5RTrxeyIFM4EbU4VNd+A6L1CGBuM3AZ4CDi1YvhiY69ZfB75xRqz2+8Y5720F7AccBexf4Jc3FIq/+fWQAa8BLqu5A2FvXLxGu3BZAuyWEfSCM1jKvjK6ZFt/uodn9i91h7BP9HtjAW1Lo7H8512cHp0oVCY524F60mh4uu1Ml6nuBjZKFh52afoMi0wrAF3WtAJ/Dhw2gHogj85zHhmbGHxhIY2vtc0CYE/gnUT4B8Akn9stB9W2R8YrPLdJNm4PfNbEbAGgi6k4DPQtoNz/RZtVleu7Am8CShSBHgem9AFwrK+csQxlkNcMxoV0GLZaDutE4IlEturNWyV9bULV0h5YcyLR3i4AxJ56/BFXvE7rAmDzTIwrRr80nL62dAWg8FwW6fjRtRybdQGgFBf342/4QmS0vzMAyVcBjLPSIa74Lcopbgoh5eLYdSrz11ut7+EBqbjZeV9pNJD0Sv9/qAmALurkiKPxMmVkdw0hiVJL/nQkU3+fUAtAD5YdIqbt3AtJxctKfQDskbTZKwDVoyoP/AJsHHGMcg3Vn1bre4aQLu33ka4fXFgpqVQB+AkYE3GowOReUSVMfTwgvdIfSHrjAvfvQtMdeB/QAyLQLq7VVQthpT4AVJVXRYreA/TQqvKA0pbmM4EOts5qrAgb9qlJnB+tvwzkWu/G0eL9vlUOctbFTCjo0gPm0giAXmbTaj1wMvBYxKTH914Vp9snhPQmj0PmeOCZWgC6NCrjMe0IfGIE0RVAbqig1+CvtQC0X3GoeAykmY6KjIW6Aljgul21DoH0XD2mpLCtG9UDXAJiKvYlyb4uAHLtuwYIC7sCEF+ajfSg2buyKls8pjStvj/O9y9m3uFryWrzgDanZV2/fQSoN9K4cBCkkYta6PGJMNUD1aMiWQCIWRNjTY5jGupHfXaQlSKxAhCf7oLuREwq8Xo3zOnohrP80CwdqzxqnbXWAFBsKkYVqykpO2mCpym0hdTlqjipuqekCYja+N8tgmoASJ66RJ12aTSoFKjRokYkGi1+CmzoY1txLr4jk3dGbOdLfgqhTthEtQAkdCTwgP8WYFJi3KTB7cWZNryRvQuAIFDu17Su5A2j3f94TAkiHq9beQfynVhjFw121TvVUOkDR42MgQAICvViOsV9HDnJZZYt/QtKn5r+8PUifGJShtHwyhznTYj6hFDVSQ3V5vUAhupkrXKHvQf+Bknk1TEL+kg4AAAAAElFTkSuQmCC" />
                                {{ $document->expired_at->format('d/m/Y') }}</h4>
                            <h4 class="tulisantengah"><a href="#">{{ $document->name }}</a></h4>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Services Section -->
    <script src="/storage/app/public/assets/imgjs/jquery.min.js"></script>
    <script src="/storage/app/public/assets/imgjs/popper.js"></script>
    <script src="/storage/app/public/assets/imgjs/bootstrap.min.js"></script>
    <script src="/storage/app/public/assets/imgjs/main.js"></script>
    <!-- Vendor JS Files -->
    <script src="/storage/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/storage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/storage/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/storage/assets/vendor/php-email-form/validate.js"></script>
    <script src="/storage/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/storage/assets/vendor/venobox/venobox.min.js"></script>
    <script src="/storage/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="/storage/assets/vendor/owl.carousel/owl.carousel.min.js"></script>

    <script type="text/javascript" src="/storage/assets/DataTables/datatables.min.js"></script>

    <!-- Template Main JS File -->
    <script src="/storage/assets/js/main.js"></script>
</body>

</html>
