@extends('layouts.admin')
@section('title')
    Artikel
@endsection

@push('css-after')
<link  href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<style>
.note-editor{
  background: #ffff;
z-index: 10000000000000
}</style>
@endpush
@push('js-after')
<!-- include summernote css/js -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
          $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('semua-data-artikel') }}",
          columns: [
                  { data: 'id', name: 'id' },
                  { 
                    data: function(data){
                      return `<img src="/img/${data['img']}" width="100px">`;
                    },  
                    "orderable": "false",
                    name: 'img'
                  },
                  { data: 'judul', name: 'judul' },
                  { data: 'kategori', name: 'kategori' },
                  { data: 'action', name: 'action' }
              ]
      });
    });

    function editartikel(data){
      $("#editartikel").modal("show");
      $("#edit-id").val(data.id);
      $("#edit-judul").val(data.judul);
      $("#edit-isi").summernote("code", data.isi);
      $("#edit-kategori").val(data.kategori);
      $("#edit-video").val(data.video);
      console.log(data);
    }
    function deleteartikel(id){
      $("#delete-id").val(id);
      $("#deleteartikel").modal("show");
    }
    </script>
@endpush

@section('menu-topbar')
<a href="/tambah-artikel">Tambah Artikel</a>   
@endsection
@section('content')
    
<div class="container-fluid">
    <table class="table table-bordered" id="table">
      <thead>
          <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Action</th>
          </tr>
      </thead>
    </table>
</div>

@include('admin.artikel.edit')
@include('admin.artikel.delete')

@endsection