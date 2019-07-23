<form method="POST" action="{{ route("edit-artikel") }}" enctype="multipart/form-data">
  @csrf

<div class="modal fade" id="editartikel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Artikel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
            <input id="edit-id" type="hidden" class="form-control" name="id">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Judul:</label>
            <input id="edit-judul" type="text" class="form-control" name="judul">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Kategori:</label>
            <input id="edit-kategori" type="text" class="form-control" name="kategori">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Image:</label>
            <input type="file" class="form-control" name="image">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Video:</label>
            <input id="edit-video" type="text" class="form-control" name="video">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Isi:</label>
            <textarea id="edit-isi" class="form-control" name="isi"></textarea>
          </div>

      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-block">
              Simpan
          </button>
      </div>
    </div>
  </div>
</div>


</form>