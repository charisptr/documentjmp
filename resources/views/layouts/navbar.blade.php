<!-- ======= Header ======= -->

<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

        <a href="{{ route('home') }}" class="logo"><img src="/storage/assets/img/logojayamarlin.png" alt=""
                class="img-fluid"></a>


        <nav class="nav-menu d-none d-lg-block offset-3">

            <ul>
                <li> <a style="{{ request()->routeIs('home') ? 'color: white;background-color:red;' : '' }} padding: 6px 6px 6px 6px;"
                        href="{{ route('home') }}">BERANDA</a>
                </li>

                <li class="drop-down "><a style="padding: 6px 6px 6px 6px;" href="javascript:void(0)">DOKUMEN</a>
                    <ul>
                        <li class="{{ request()->routeIs('paluutama.index') ? 'active' : '' }}"><a
                                href="{{ route('paluutama.index') }}">Palu Utama</a></li>
                        <li class="{{ request()->routeIs('tbuniversal.index') ? 'active' : '' }}"><a
                                href="{{ route('tbuniversal.index') }}">TB Universal</a></li>
                        <li class="{{ request()->routeIs('jayapatriot.index') ? 'active' : '' }}"><a
                                href="{{ route('jayapatriot.index') }}">Jaya Patriot</a></li>
                    </ul>
                </li>

                <li>
                    <a style="{{ request()->routeIs('bantuan.index') ? 'color: white;background-color:red;' : '' }} padding: 6px 6px 6px 6px;"
                        href="{{ route('bantuan.index') }}">BANTUAN & KONTAK</a>
                </li>

                <li class="drop-down offset-7"><a href="javascript:void(0)">{{ Session::get('name') }}</a>
                    <ul>
                        <li><a type="button" data-toggle="modal" data-target="#logout"><i class="bx bx-log-out"></i>
                                Logout</a></li>
                    </ul>
                </li>
            </ul>

        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->


<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Keluar Akun</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <h5>Apakah Anda Yakin ingin Keluar dari Document Reminder JMP ?</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                <a type="submit" href="{{ route('signout') }}" class="btn btn-success"><i class="bx bx-log-out"></i>
                    Ya, Keluar</a>
            </div>
        </div>
    </div>
</div>
