@extends('templates.layout')

@push('style')

@endpush

@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pembelian</h3>

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
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFormPembelian">
                Tambah pembelian
            </button>
            <table class="table table-sm table-hover table-stripped table-bordered" id="tbl-pembelian">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pembelian</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pembelian as $p)
                  <tr>
                    <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
                    <td>{{ $p->nama_pembelian }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pembelianForEdit" data-nama_pembelian="{{ $p->nama_pembelian }}" data-id-pembelian="{{ $p->id }}"><i class="fas fa-edit"></i></button>
                        <form action="{{ route('pembelian.destroy', $p->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete"  data-nama_pembelian="{{ $p->nama_pembelian }}"><i class="fas fa-trash-alt"></i></button>
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
        @include('pembelian.form')
        @include('pembelian.formEdit')
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
      $('#tbl-pembelian').DataTable()

    })
    // dialog hapus data
    $('.btn-delete').on('click', function(e){
        let nama_pembelian = $(this).closest('tr').find('td:eq(0)').text();
        Swal.fire({
          icon: 'error',
          title: 'Hapus Data',
          html: `Apakah data <b>${nama_pembelian}</b> akan dihapus?`,
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
