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
                                <th>NAMA</th>
                                <th>TANGGAL LAHIR</th>
                                <th>ALAMAT</th>
                                <th>EMAIL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($gurus as $guru)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $guru->nama }}</td>
                                    <td>{{ $guru->tanggal }}</td>
                                    <td>{{ $guru->alamat }}</td>
                                    <td>{{ $guru->email }}</td>
                                    <td>
                                        <div class="btn-group" roles="group" aria-label="Basic Example">
                                            <button type="button" id="btn-edit-guru" class="btn" data-toggle="modal"
                                                data-target="#modalEdit" data-id="{{ $guru->id }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" id="btn-delete-guru" class="btn" data-toggle="modal"
                                                data-target="#modalDelete" data-id="{{ $guru->id }}"
                                                data-nama="{{ $guru->nama }}"><i class="fa fa-trash"></i></button>
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
                    <form method="post" action="{{ route('admin.guru.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Guru</label>
                            <input type="text" class="form-control" placeholder="Masukan nama guru" name="nama"
                                id="nama" required />
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" id="date" class="date form-control" name="tanggal" id="tanggal"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" placeholder="Masukan alamat" name="alamat"
                                id="alamat" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Masukan email" name="email"
                                id="email" required />
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
                    <form method="post" action="{{ route('admin.guru.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="edit-nama">Nama Guru</label>
                                    <input type="text" class="form-control" name="nama" id="edit-nama" required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-tanggal">Tanggal</label>
                                    <input type="text" class="date form-control" name="tanggal" id="edit-tanggal"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="edit-alamat"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-email">Email</label>
                                    <input type="text" class="form-control" name="email" id="edit-email"
                                        required />
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
                    <form method="post" action="{{ route('admin.guru.delete') }}" enctype="multipart/form-data">
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
                let nama = $(this).data('nama');
                $('#delete-id').val(id);
                $('#delete-nama').text(nama);
                console.log("hallo");
            });
            $(document).on('click', '#btn-edit-guru', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: baseurl + '/admin/ajaxadmin/dataGuru/' + id,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#edit-nama').val(res.nama);
                        $('#edit-tanggal').val(res.tanggal);
                        $('#edit-alamat').val(res.alamat);
                        $('#edit-email').val(res.email);
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
