@if (count($errors) > 0)
   <script>
      Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: '<ul>' +
               @foreach ($errors->all() as $error)
                  '<li>{{ $error }}</li>' +
               @endforeach
            '</ul>',
      });
   </script>
@endif
@if ($message = Session::get('success'))
   <script>
      Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ $message }}',
      });
   </script>
@endif