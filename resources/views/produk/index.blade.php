@extends('templates.layout')

@push('style')

@endpush

@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Produk</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormProduk">
                Tambah Produk
            </button>

            <a href="{{route('export_produk') }}" class="btn btn-success" target="_blank">Export XLS</a>

            <table class="table table-sm table-hover table-stripped table-bordered" id="tbl-produk">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $p)
                  <tr>
                    <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
                    <td>{{ $p->nama_produk }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#produkForEdit" data-nama_produk="{{ $p->nama_produk }}" data-id-produk="{{ $p->id }}"><i class="fas fa-edit"></i></button>
                        <form action="{{ route('produk.destroy', $p->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete"  data-nama_produk="{{ $p->nama_produk }}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        @include('produk.form')
        @include('produk.formEdit')
    </section>
@endsection
@push('script')
<script>
    $('#success-alert').fadeTo(5000, 500).slideUp(500, function(){
      $("#success-alert").slideUp(500);
    })

    $('#error-alert').fadeTo(10000, 500).slideUp(500, function(){
      $("#error-alert").slideUp(500);
    })

    $(function(){
      $('#tbl-produk').DataTable()

    })
    // dialog hapus data
    $('.btn-delete').on('click', function(e){
        let nama_produk = $(this).closest('tr').find('td:eq(0)').text();
        Swal.fire({
          icon: 'error',
          title: 'Hapus Data',
          html: `Apakah data <b>${nama_produk}</b> akan dihapus?`,
          confirmButtonText: 'Ya',
          denyButtonText: 'Tidak',
          showDenyButton: true,
          focusConfirm: false
        }).then((result) => {
          if (result.isConfirmed) $(e.target).closest('form').submit()
          else swal.close()
        })
      })
  </script>
@endpush
