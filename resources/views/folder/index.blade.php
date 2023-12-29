@extends('layouts.app')

@section('content')

<main id="main">
    
   <section id="breadcrumbs" class="breadcrumbs">
   <div class="container">
   
       <div class="d-flex justify-content-between align-items-center">
       <h2>Daftar Folder</h2>
       <ol>
           <li><a href="{{ route('home') }}">Beranda</a></li>
           <li>Daftar Folder</li>
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
                              data-target="#modal-add-folder">Tambah Folder Baru</button>
                        </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <table id="folder-table" class="table table-hover table-bordered" style="width: 100%">
                           <thead>
                              <tr>
                                    <th class="text-center">Nama Folder</th>
                                    <th class="text-center">Jumlah Dokumen</th>
                                    <th class="text-center">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($folders as $folder)
                                    <tr>
                                       <td>{{ $folder->name }}</td>
                                       <td class="text-center">{{ $folder->documents_count }}</td>
                                       <td class="text-center">
                                          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#modal-update-folder-{{ $folder->id }}">Edit</button>
                                          <form method="POST" style="display:inline"
                                                action="{{ route('folder.destroy', $folder->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                   class="btn btn-sm btn-danger button-delete-folder">Delete</button>
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
            folderTable = $('#folder-table').DataTable({
                orderCellsTop: true,
                scrollX: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
            });
        });
    </script>

    <script>
        // Sweet Alert 2 - Delete Confirmation
        $('.button-delete-folder').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();

            Swal.fire({
                title: `Peringatan!`,
                html: `Menghapus folder juga akan menghapus SEMUA dokumen yang ada di dalamnya!`,
                icon: "error",
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonText: 'Tidak, batalkan',
                confirmButtonText: 'Tetap hapus',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection

<div class="modal fade" id="modal-add-folder" tabindex="-1" aria-labelledby="modal-add-folder" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('folder.store') }}" method="post" enctype="multipart/form-data" lang="id">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="label-modal-add-folder">Tambah Folder Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-folder-name" class="col-form-label">Nama Folder:</label>
                        <input type="text" class="form-control" id="add-folder-name" name="name"
                            value="{{ old('name', '') }}" required>
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

@foreach ($folders as $folder)
    <div class="modal fade" id="modal-update-folder-{{ $folder->id }}" tabindex="-1"
        aria-labelledby="modal-update-folder-{{ $folder->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('folder.update', $folder->id) }}" method="POST" enctype="multipart/form-data"
                    lang="id">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="label-modal-update-folder-{{ $folder->id }}">Update Folder
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update-folder-name-{{ $folder->id }}" class="col-form-label">Nama
                                Folder:</label>
                            <input type="text" class="form-control" id="update-folder-name-{{ $folder->id }}"
                                name="name" placeholder="Masukkan nama folder yang diinginkan"
                                value="{{ $folder->name }}" required>
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
