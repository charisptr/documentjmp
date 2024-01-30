@extends('layouts.app')

@section('content')
    <main id="main">

        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Dokumen Palu Utama</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li>Dokumen Palu Utama</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <div class="container mt-2 mb-4">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="row" style="padding-bottom: 25px">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-add-doc"><i class="bx bx-plus-circle"></i> Tambah
                                        Dokumen</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="docs-table" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nama File</th>
                                                <th class="text-center">Tanggal Expired</th>
                                                <th class="text-center">Peringatan</th>
                                                <th class="text-center">Status Expired</th>
                                                <th class="text-center">Link</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center"><input id="filter-name" type="text"
                                                        class="form-control" placeholder="Filter Nama File"></th>
                                                <th class="text-center"><input id="filter-expired-at" type="text"
                                                        class="form-control" placeholder="Filter Tanggal Expired"></th>
                                                <th></th>
                                                <th class="text-center">
                                                    <select id="filter-expired-status" class="form-select"
                                                        aria-label="Default select example">
                                                        <option selected value="">Semua</option>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Akan Expired">Akan Expired</option>
                                                        <option value="Expired">Expired</option>
                                                    </select>
                                                </th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $nowTime = now();
                                            @endphp
                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td>{{ $document->name }}</td>
                                                    <td class="text-center">
                                                        {{ $document->expired_at->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ $document->warning }}
                                                        {{ $document->format === 'day' ? 'Hari' : ($document->format === 'month' ? 'Bulan' : ($document->format === 'year' ? 'Tahun' : 'Invalid format.')) }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            // Your PHP code here
                                                            $customModifier = '+' . $document->warning . ' ' . $document->format . '';
                                                            $nowTimeexp = (clone $nowTime)->modify($customModifier);
                                                        @endphp
                                                        @if ($nowTime >= $document->expired_at)
                                                            <span class="badge bg-danger">Expired</span>
                                                        @elseif ($nowTimeexp >= $document->expired_at)
                                                            <span class="badge bg-warning">Akan Expired</span>
                                                        @else
                                                            <span class="badge bg-success">Aktif</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center"><a
                                                            href="{{ route('paluutama.download', $document->id) }}">Download</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#modal-update-doc-{{ $document->id }}"><i
                                                                class="bx bx-edit"></i> Ubah</button>
                                                        <form method="POST" style="display:inline"
                                                            action="{{ route('paluutama.destroy', $document->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger button-delete-document"><i
                                                                    class="bx bx-trash"></i> Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('moreJS')
    <script>
        // Datatables
        $(document).ready(function() {
            const filenameColIdx = 1;
            const expAtColIdx = 2;
            const expStatusColIdx = 3;

            docsTable = $('#docs-table').DataTable({
                orderCellsTop: true,
                scrollX: true,
                order: [
                    [expAtColIdx, 'asc']
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
            });

            $('#filter-name').on('keyup', function() {
                docsTable
                    .columns(filenameColIdx)
                    .search(this.value)
                    .draw();
            });

            $('#filter-expired-at').on('keyup', function() {
                docsTable
                    .columns(expAtColIdx)
                    .search(this.value)
                    .draw();
            });

            $('#filter-expired-status').on('change', function() {
                var value = $(this).find(":selected").val()
                docsTable
                    .columns(expStatusColIdx)
                    .search((value != "") ? "^" + value + "$" : value, true, false, true)
                    .draw();
            });
        });
    </script>

    <script>
        // Sweet Alert 2 - Delete Confirmation
        $('.button-delete-document').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();

            Swal.fire({
                title: `Hapus dokumen?`,
                text: "Dokumen yang sudah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Tidak, batalkan',
                confirmButtonText: 'Ya, hapus',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection

@section('moreCSS')
    <style>
        .dataTables_filter {
            display: none;
        }
    </style>
@endsection

<div class="modal fade" id="modal-add-doc" tabindex="-1" aria-labelledby="modal-add-doc" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('paluutama.store') }}" method="post" enctype="multipart/form-data" lang="id">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="label-modal-add-doc">Tambah Dokumen Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-doc-folder" class="col-form-label">Dokumen:</label>
                        <input type="text" class="form-control" id="add-doc-folder" value="Palu Utama" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="add-doc-filename" class="col-form-label">Nama File: <span
                                style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="add-doc-filename" name="name"
                            value="{{ old('name', '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-doc-filename" class="col-form-label">Peringatan: <span
                                style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="add-doc-filename" name="warning"
                            value="{{ old('warning', '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-doc-filename" class="col-form-label">Format: <span style="color: red;">*
                                hari/bulan/tahun</span></label>
                        <select class="form-control" id="add-doc-filename" name="format" required>
                            <option value="day" {{ old('format') == 'hari' ? 'selected' : '' }}>hari</option>
                            <option value="month" {{ old('format') == 'bulan' ? 'selected' : '' }}>bulan</option>
                            <option value="year" {{ old('format') == 'tahun' ? 'selected' : '' }}>tahun</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-doc-exp-date" class="col-form-label">Tanggal Expired: <span
                                style="color: red;">*</span></label>
                        <input type="date" class="form-control" id="add-doc-exp-date" name="expired_at"
                            value="{{ old('expired_at', '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-doc-file" class="col-form-label">Upload File: <span
                                style="color: red;">*</span></label>
                        <input type="file" class="form-control" id="add-doc-file" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($documents as $document)
    <div class="modal fade" id="modal-update-doc-{{ $document->id }}" tabindex="-1"
        aria-labelledby="modal-update-doc-{{ $document->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('paluutama.update', $document->id) }}" method="POST"
                    enctype="multipart/form-data" lang="id">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="label-modal-update-doc-{{ $document->id }}">Update Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update-doc-folder-{{ $document->id }}"
                                class="col-form-label">Dokumen:</label>
                            <input type="text" class="form-control" id="add-doc-folder" value="Palu Utama"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="update-doc-filename-{{ $document->id }}" class="col-form-label">Nama
                                File:</label>
                            <input type="text" class="form-control" id="update-doc-filename-{{ $document->id }}"
                                name="name" placeholder="Masukkan judul/nama file yang diinginkan"
                                value="{{ $document->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-doc-filename-{{ $document->id }}" class="col-form-label">Peringatan
                                :</label>
                            <input type="text" class="form-control" id="update-doc-filename-{{ $document->id }}"
                                name="warning" placeholder="Masukkan angka untuk set peringatan"
                                value="{{ $document->warning }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-doc-filename-{{ $document->id }}" class="col-form-label">Format
                                :</label>

                            <select class="form-control" id="update-doc-filename-{{ $document->id }}" name="format"
                                required>
                                <option value="day" {{ $document->format === 'day' ? 'selected' : '' }}>hari
                                </option>
                                <option value="month" {{ $document->format === 'month' ? 'selected' : '' }}>bulan
                                </option>
                                <option value="year" {{ $document->format === 'year' ? 'selected' : '' }}>tahun
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="update-doc-exp-date-{{ $document->id }}" class="col-form-label">Tanggal
                                Expired:</label>
                            <input type="date" class="form-control" id="update-doc-exp-date-{{ $document->id }}"
                                name="expired_at" value="{{ $document->expired_at->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-doc-file-{{ $document->id }}" class="col-form-label">Upload
                                File:</label>
                            <input type="file" class="form-control" id="update-doc-file-{{ $document->id }}"
                                name="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
