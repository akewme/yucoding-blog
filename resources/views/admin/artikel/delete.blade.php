<div class="modal fade" id="deleteartikel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Artikel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route("delete-artikel") }}" enctype="multipart/form-data">
            @csrf
            <input id="delete-id" type="hidden" class="form-control" name="id">
            <div class="form-group">
                <button class="btn btn-primary" data-dismiss="modal">
                    Jangan
                </button>
                <button type="submit" class="btn btn-danger">
                    Iya Delete Aja We
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>