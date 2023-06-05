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
                                <th>TANGGAL</th>
                                <th>ISI AGENDA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($agendas as $agenda)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $agenda->name }}</td>
                                    <td>{{ $agenda->tanggal }}</td>
                                    <td>{{ $agenda->isi_agenda }}</td>
                                    <td>
                                        <div class="btn-group" roles="group" aria-label="Basic Example">
                                            <button type="button" id="btn-edit-guru" class="btn" data-toggle="modal"
                                                data-target="#modalEdit" data-id="{{ $agenda->id }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" id="btn-delete-guru" class="btn" data-toggle="modal"
                                                data-target="#modalDelete" data-id="{{ $agenda->id }}"
                                                data-nama="{{ $agenda->users }}"><i class="fa fa-trash"></i></button>
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
                    <form method="post" action="{{ route('admin.agenda.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="users">Nama Guru</label>
                            <div class="input-group">
                                <select name="users" id="users" placeholder="Input Users"
                                    aria-label="Example select with button addon" class="form-control" required />
                                <option selected>Pilih....</option>
                                @php
                                    $data = App\Models\User::get();
                                @endphp
                                @foreach ($data as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" id="date" class="date form-control" name="tanggal" id="tanggal"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="isi_agenda">Isi Agenda</label>
                                <input type="text" class="form-control" placeholder="Masukan isi agenda"
                                    name="isi_agenda" id="isi_agenda" required />
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
                    <form method="post" action="{{ route('admin.agenda.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                                <div class="form-group">
                                    <label for="edit-users">Nama Guru</label>
                                    <div class="input-group">
                                        <select name="edit-users" id="edit-users" placeholder="Input Users"
                                            aria-label="Example select with button addon" class="form-control" required />
                                        <option selected>Pilih....</option>
                                        @php
                                            $data = App\Models\User::get();
                                        @endphp
                                        @foreach ($data as $key)
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-tanggal">Tanggal</label>
                                        <input type="text" class="date form-control" name="tanggal" id="edit-tanggal"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-isi_agenda">Isi Agenda</label>
                                        <input type="text" class="form-control" name="isi_agenda"
                                            id="edit-isi_agenda" required />
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
