@extends('layouts.app')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Bantuan & Kontak</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li>Bantuan & Kontak</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container mb-4">

                <div class="section-title">
                    <h2>Bantuan & Kontak</h2>
                    <p>FAQ DocumentJMP</p>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#tab-1">Cara Upload</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-2">Arti Warna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-3">Penjelasan Waktu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-4">Kontak</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9 mt-4 mt-lg-0">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Tata Cara Upload</h3>
                                        <ol>
                                            <li>Tekan tombol dokumen</li>
                                            <li>Pilih folder dokumen</li>
                                            <li>Tekan tombol "Tambah Dokumen"</li>
                                            <li>Isi Nama File, tanggal expired, dan upload dokumen</li>
                                        </ol>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="assets/img/features-1.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Arti Warna pada Dokumen</h3>
                                        <ul>
                                            <li>Merah = Dokumen Expired (Harus segera diperbaharui)</li>
                                            <li>Kuning = Dokumen mendekati Expired (Harus segera diperbaharui)</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="assets/img/features-2.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Penjelasan Waktu</h3>
                                        <ul>
                                            <li>Expired = Melewati batas akhir waktu berlaku</li>
                                            <li>Akan Expired = 7 hari mendekati batas akhir waktu berlaku</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="assets/img/features-3.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-4">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Kontak</h3>
                                        <ul>
                                            <li><iconify-icon icon="ic:outline-email"></iconify-icon>Email = <a
                                                    href="mailto:documentjmp@gmail.com">documentjmp@gmail.com</a>
                                            </li>
                                            <li><i class="bx bxl-whatsapp"></i>Whatsapp = <a
                                                    href="https://wa.me/+6281391076230" target="_blank"
                                                    rel="noopener noreferrer">081391076230</a></li>
                                        </ul>

                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="assets/img/features-3.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Features Section -->


    </main><!-- End #main -->
@endsection
