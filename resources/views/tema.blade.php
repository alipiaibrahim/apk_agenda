@extends('adminlte::page')
@section('title', 'Pengelolaan Data Guru')
@section('content_header')
    <h1 class="text-center text-bold" style="font-family:Arial, Helvetica, sans-serif">PENGELOLAAN DATA GURU</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Data Guru') }}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah"><i
                                class="fa fa-plus"></i> Tambah Data</button>
                        <hr />
                    </div>
                    <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>TOPIK</th>
                                <th>TANGGAL</th>
                                <th>TEMA</th>
                                <th>DESKRIPSI KEGIATAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($temas as $tema)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $tema->topik }}</td>
                                    <td>{{ $tema->tanggal }}</td>
                                    <td>{{ $tema->tema }}</td>
                                    <td>{{ $tema->isi_kegiatan }}</td>
                                    <td>
                                        <div class="btn-group" roles="group" aria-label="Basic Example">
                                            <button type="button" id="btn-edit-guru" class="btn" data-toggle="modal"
                                                data-target="#modalEdit" data-id="{{ $tema->id }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" id="btn-delete-guru" class="btn" data-toggle="modal"
                                                data-target="#modalDelete" data-id="{{ $tema->id }}"
                                                data-nama="{{ $tema->topik }}"><i class="fa fa-trash"></i></button>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.tema.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="topik">Topik</label>
                            <input type="text" class="form-control" placeholder="Masukan topik guru" name="topik"
                                id="topik" required />
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" id="date" class="date form-control" name="tanggal" id="tanggal"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="tema">Tema</label>
                            <input type="text" class="form-control" placeholder="Masukan tema" name="tema"
                                id="tema" required />
                        </div>
                        <div class="form-group">
                            <label for="isi_kegiatan">Isi Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Masukan isi_kegiatan"
                                name="isi_kegiatan" id="isi_kegiatan" required />
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data -->


    <!-- Modal Edit Data -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.tema.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-topik">Topik</label>
                                    <input type="text" class="form-control" name="topik" id="edit-topik"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-tanggal">Tanggal</label>
                                    <input type="text" class="date form-control" name="tanggal" id="edit-tanggal"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-tema">Tema</label>
                                    <input type="text" class="form-control" name="tema" id="edit-tema" required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-isi_kegiatan">Isi Kegiatan</label>
                                    <input type="text" class="form-control" name="isi_kegiatan"
                                        id="edit-isi_kegiatan" required />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="edit-id" />

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Data -->


    <!-- Modal Delete Data -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus Data Guru <strong class="" id="delete-nama"></strong>?
                    <form method="post" action="{{ route('admin.tema.delete') }}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="delete-id" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <div class="footer" style="text-align: center; color: black;">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.0
        </div>
        <strong>&copy;
            <a href="https://www.instagram.com/ibr.pia/" target="_blank">APOLIA {{ date('Y') }}</a>.</strong> All
        Right reserved.
    </div>
@stop

@section('js')
    <script>
        $(function() {
            $("#date").datepicker({
                format: "yyyy-mm-dd", // Notice the Extra space at the beginning
                autoclose: true,
                todayHighlight: true,
            });
            $(document).on('click', '#btn-delete-guru', function() {
                let id = $(this).data('id');
                let topik = $(this).data('topik');
                $('#delete-id').val(id);
                $('#delete-topik').text(topik);
                console.log("hallo");
            });
            $(document).on('click', '#btn-edit-guru', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: baseurl + '/admin/ajaxadmin/dataTema/' + id,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#edit-topik').val(res.topik);
                        $('#edit-tanggal').val(res.tanggal);
                        $('#edit-tema').val(res.tema);
                        $('#edit-isi_kegiatan').val(res.isi_kegiatan);
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
