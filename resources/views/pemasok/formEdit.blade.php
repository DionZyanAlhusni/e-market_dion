<div class="modal fade" id="pemasokFormEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="pemasok" class="form-buat-edit">
            @csrf
            @method("put")
              <div class="form-group row">
                  <label for="nama_pemasok" class="col-sm-3 col-form-label">Edit Pemasok</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control nama-pemasok-edit" id="nama_pemasok" data-id-pemasok placeholder="Nama pemasok" name="nama_pemasok">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
      </div>
    </div>
  </div>
  @push('script')
  <script>
  $("#pemasokFormEdit").on("show.bs.modal", function (e) {
    let button = $(e.relatedTarget)
    let id = button.data("id-pemasok")
    let nama = button.data("nama_pemasok")
    let inputEdit = $(".nama-pemasok-edit")
    inputEdit.val(nama)

    $(".form-buat-edit").attr("action", "pemasok/" + id)
  })


  </script>

  @endpush
