@extends('adminlte::page')
@section('title', 'Pengelolaan Data Topik')
@section('content_header')
    <h1 class="text-center text-bold" style="font-family:Arial, Helvetica, sans-serif">PENGELOLAAN DATA TOPIK</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Data Topik') }}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i
                                class="fa fa-plus"></i> Tambah Data</button>
                        <hr />
                    </div>
                    <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>TOPIK</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($topiks as $topik)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $topik->nama }}</td>
                                    <td>
                                        <div class="btn-group" roles="group" aria-label="Basic Example">
                                            <button type="button" id="btn-edit-topik" class="btn btn-success"
                                                data-toggle="modal" data-target="#ubahModal"
                                                data-id="{{ $topik->id }}">Edit</button>
                                            <a class="btn btn-danger" href="topik/delete/{{ $topik->id }}"
                                                onclick="return confirm('Apakah Anda Yakin Menghapus Data?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.topik.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Topik</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Ubah Tingkatan -->
    <div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Agenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.topik.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-nama">Topik</label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required />
                        </div>
                </div>


                <div class="modal-footer">
                    <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Data -->


    @stop

    @section('footer')
    @stop

    @section('js')
        <script>
            $(function() {


                $(document).on('click', '#btn-edit-topik', function() {
                    let id = $(this).data('id');

                    $('#image-area').empty();

                    $.ajax({
                        type: "get",
                        url: "{{ url('/admin/ajaxadmin/dataTopik') }}/" + id,
                        dataType: 'json',
                        success: function(res) {
                            $('#edit-nama').val(res.nama);
                            $('#edit-id').val(res.id);

                        },
                    });
                });

            });
        </script>
    @stop
    @section('js')
        <script></script>
    @stop
