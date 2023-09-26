@extends('templates.layout')

@push('style')

@endpush

@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pelanggan</h3>

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
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFormpelanggan">
                Tambah pelanggan
            </button>
            <table class="table table-sm table-hover table-stripped table-bordered" id="tbl-pelanggan">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama pelanggan</th>
                    <th scope="col">Kode Pelanggan</th>
                    <th scope="col">NO Hp</th>
                    <th scope="col">alamat</th>
                    <th scope="col">email</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $pem)
                  <tr>
                    <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
                    <td>{{ $pem->nama_pelanggan }}</td>
                    <td>{{ $pem->kode_pelanggan }}</td>
                    <td>{{ $pem->no_telp }}</td>
                    <td>{{ $pem->alamat }}</td>
                    <td>{{ $pem->email }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-mode="edit" data-target="#modalFormpelanggan"
                        data-id="{{ $pem->id }}"
                        data-nama_pelanggan="{{ $pem->nama_pelanggan }}"
                        data-kode_pelanggan="{{ $pem->kode_pelanggan }}"
                        data-alamat="{{ $pem->alamat }}"
                        data-no_telp="{{ $pem->no_telp }}"
                        data-email="{{ $pem->email }}"
                        ><i class="fas fa-edit"></i></button>
                        {{-- <form action="pelanggan/{{ $p->id }}" method="GET" style="display: inline;">
                            @csrf
                            @method('GET')
                        </form> --}}
                        <form action="pelanggan/{{ $pem->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-delete" data-nama_pelanggan="{{ $pem->nama_pelanggan }}"><i class="fas fa-trash-alt"></i></button>
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
        @include('pelanggan.form')
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
      $('#tbl-pelanggan').DataTable()

    })
    // dialog hapus data
    $('.btn-delete').on('click', function(e){
        let nama_pelanggan = $(this).closest('tr').find('td:eq(0)').text();
        Swal.fire({
          icon: 'error',
          title: 'Hapus Data',
          html: `Apakah data <b>${nama_pelanggan}</b> akan dihapus?`,
          confirmButtonText: 'Ya',
          denyButtonText: 'Tidak',
          showDenyButton: true,
          focusConfirm: false
        }).then((result) => {
          if (result.isConfirmed) $(e.target).closest('form').submit()
          else swal.close()
        })
      })


      // Form Modal
      $('#modalFormpelanggan').on('show.bs.modal', function(e){
        const btn = $(e.relatedTarget)
        console.log(btn.data('mode'))
        const mode = btn.data('mode')
        const nama_pelanggan = btn.data('nama_pelanggan')
        const kode_pelanggan = btn.data('kode_pelanggan')
        const alamat = btn.data('alamat')
        const no_telp = btn.data('no_telp')
        const email = btn.data('email')
        const id = btn.data('id')
        const modal = $(this)
        if(mode === 'edit'){
          modal.find('.modal-title').text('Edit Data Pelanggan')
          modal.find('#nama_pelanggan').val(nama_pelanggan)
          modal.find('#kode_pelanggan').val(kode_pelanggan)
          modal.find('#alamat').val(alamat)
          modal.find('#no_telp').val(no_telp)
          modal.find('#email').val(email)
          modal.find('.modal-body form').attr('action','{{ url("pelanggan") }}/'+id)
          modal.find('#method').html('@method("PATCH")')
        }else{
          modal.find('.modal-title').text('Input Data Pelanggan')
          modal.find('#nama_pelanggan').val('')
          modal.find('#method').html('')
          modal.find('.modal-body form').attr('action','{{ url("pelanggan") }}')
        }
      })
  </script>
@endpush
