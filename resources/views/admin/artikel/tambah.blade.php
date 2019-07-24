@extends('layouts.admin')

@section('title')
    Tambah Artikel
@endsection


@push('css-after')
<style>
.note-editor{
  background: #ffff;
  z-index: 10000000000000
}
</style>
@endpush


@section('content')
<div class="container">
        <form method="POST" action="{{ route("tambah-artikel") }}" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Judul:</label>
            <input placeholder="Masukkan Judul" type="text" class="form-control" name="judul">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Kategori:</label>
            <input placeholder="Masukkan Kategori" type="text" class="form-control" name="kategori">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Image:</label>
            <input type="file" class="form-control" name="image">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Video:</label>
            <input placeholder="Masukkan Link Video Youtube" type="text" class="form-control" name="video">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Isi:</label>
            <textarea id="edit-isi" name="isi"></textarea>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">
                  Simpan
              </button>
          </div>
        </form>
</div>
  @endsection

@push('js-after')
    <script>
        $("#edit-isi").summernote()
    </script>
@endpush