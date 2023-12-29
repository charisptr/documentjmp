@extends('layouts.app')
@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero">
   <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

   <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

   <div class="carousel-inner" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url(/storage/assets/img/kapaljmp.jpg)">
      <div class="carousel-container">
         <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Selamat Datang di DocumentJMP</h2>
            <h3 class="animate__animated animate__fadeInUp text-white">Jaya Marlin Persada</h3>
         </div>
      </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url(/storage/assets/img/backgroundjmp.jpg)">
      <div class="carousel-container">
         <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Selamat Datang di DocumentJMP</h2>
            <h3 class="animate__animated animate__fadeInUp text-white">Jaya Marlin Persada</h3>
         </div>
      </div>
      </div>    

   </div>

   <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
   </a>

   <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
   </a>

</div>
</section><!-- End Hero -->

<main id="main">

<!-- ======= Clients Section ======= -->
<section id="clients" class="clients section-bg">
   <div class="container">

      <div class="row">

      <div class="col-lg-12 col-md-12 col-12 d-flex align-items-center justify-content-center">
         <img src="/storage/assets/img/linkterkait.png" class="img-fluid" alt="">
      </div>      

      </div>

   </div>
</section><!-- End Clients Section -->

<!-- ======= Services Section ======= -->
<section id="services" class="services">
   <div class="container">

      <div class="section-title">
      <h2>Document</h2>
      <p>Document Reminder</p>
      </div>

      <div class="row">
         @foreach ($documents as $document)         
         <div class="col-md-4">
            <div class="icon-box">
               <i class="bx bx-alarm-exclamation"></i>
               <h4>{{ $document->expired_at->format('d/m/Y') }}</h4>
               <h4><a href="#">{{ $document->name }}</a></h4>            
               <h4><a class="btn btn-danger text-white" style="text-decoration:none;" href="{{ route('document.download', $document->id) }}">Download Dokumen</a></h4>
            </div>
         </div>                  
         @endforeach
      </div>

   </div>
</section><!-- End Services Section -->


</main><!-- End #main -->


@endsection