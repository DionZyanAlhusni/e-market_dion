<div class="modal fade" id="pembelianForEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="pembelian" class="form-buat-edit">
            @csrf
            @method("put")
              <div class="form-group row">
                  <label for="nama_pembelian" class="col-sm-3 col-form-label">Edit pembelian</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control nama-pembelian-edit" id="nama_pembelian" data-id-pembelian placeholder="Nama Pembelian" name="nama_pembelian">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
      </div>
    </div>
  </div>
  @push('script')
  <script>
  $("#pembelianForEdit").on("show.bs.modal", function (e) {
    let button = $(e.relatedTarget)
    let id = button.data("id-pembelian")
    let nama = button.data("nama_pembelian")
    let inputEdit = $(".nama-pembelian-edit")
    inputEdit.val(nama)

    $(".form-buat-edit").attr("action", "pembelian/" + id)
  })


  </script>

  @endpush
