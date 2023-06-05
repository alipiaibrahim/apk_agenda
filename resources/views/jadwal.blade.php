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
                                <th>HARI</th>
                                <th>MAPEL</th>
                                <th>JAM MULAI</th>
                                <th>JAM AKHIR</th>
                                <th>KELAS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($jadwals as $jadwal)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $jadwal->gurus }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->mapel }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>{{ $jadwal->kelas }}</td>

                                    <td>
                                        <div class="btn-group" roles="group" aria-label="Basic Example">
                                            <button type="button" id="btn-edit-jadwal" class="btn" data-toggle="modal"
                                                data-target="#modalEdit" data-id="{{ $jadwal->id }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" id="btn-delete-jadwal" class="btn" data-toggle="modal"
                                                data-target="#modalDelete" data-id="{{ $jadwal->id }}"
                                                data-gurus="{{ $jadwal->gurus }}"><i class="fa fa-trash"></i></button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jadwal.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="gurus">Nama</label>
                            <div class="input-group">
                                <select name="gurus" id="gurus" placeholder="Masukkan Nama Guru"
                                    aria-label="Example select with button addon">
                                    <option selected>Pilih....</option>
                                    @php
                                        $data = App\Models\jadwal::get();
                                    @endphp
                                    @foreach ($data as $key)
                                        <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <input type="text" class="form-control" placeholder="Masukan hari" name="hari"
                                    id="hari" required />
                            </div>
                            <div class="form-group">
                                <label for="mapel">Mapel</label>
                                <input type="text" id="date" class="date form-control" name="mapel" id="tanggal"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="times" class="form-control" placeholder="Masukan jam_mulai" name="jam_mulai"
                                    id="jam_mulai" required />
                            </div>
                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="times" class="form-control" placeholder="Masukan jam_selesai"
                                    name="jam_selesai" id="jam_selesai" required />
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" placeholder="Masukan kelas" name="kelas"
                                    id="kelas" required />
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
                    <form method="post" action="{{ route('admin.jadwal.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit-gurus">Kategori</label>
                                    <div class="input-group">
                                        <select name="gurus" id="edit-gurus" placeholder="Input Name"
                                            aria-label="Example select with button addon">
                                            @php
                                                $data = App\Models\Jadwal::get();
                                            @endphp
                                            @foreach ($data as $key)
                                                <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="edit-hari">Hari</label>
                                    <input type="text" class="form-control" name="hari" id="edit-hari" required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-mapel">Mapel</label>
                                    <input type="text" class="date form-control" name="mapel" id="edit-mapel"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-jam_mulai">Jam Mulai</label>
                                    <input type="text" class="form-control" name="jam_mulai" id="edit-jam_mulai"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-jam_selesai">Jam Selesai</label>
                                    <input type="text" class="form-control" name="jam_selesai" id="edit-jam_selesai"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-kelas">Kelas</label>
                                    <input type="text" class="form-control" name="kelas" id="edit-kelas"
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus Jadwal <strong class="" id="delete-gurus"></strong>?
                    <form method="post" action="{{ route('admin.jadwal.delete') }}" enctype="multipart/form-data">
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
            $(document).on('click', '#btn-delete-jadwal', function() {
                let id = $(this).data('id');
                let gurus = $(this).data('gurus');
                $('#delete-id').val(id);
                $('#delete-gurus').text(gurus);
                console.log("hallo");
            });
            $(document).on('click', '#btn-edit-jadwal', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: baseurl + '/admin/ajaxadmin/dataJadwal/' + id,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#edit-gurus').val(res.gurus);
                        $('#edit-hari').val(res.hari);
                        $('#edit-mapel').val(res.mapel);
                        $('#edit-jam_mulai').val(res.jam_mulai);
                        $('#edit-jam_selesai').val(res.jam_selesai);
                        $('#edit-kelas').val(res.kelas);
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
