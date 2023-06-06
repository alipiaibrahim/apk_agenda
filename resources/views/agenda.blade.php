@extends('adminlte::page')
@section('title', 'Pengelolaan Data Agenda')
@section('content_header')
    <h1 class="text-center text-bold" style="font-family:Arial, Helvetica, sans-serif">PENGELOLAAN DATA AGENDA</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Data Agenda') }}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i
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
                                    <td>{{ $agenda->pengguna->name }}</td>
                                    <td>{{ $agenda->tanggal }}</td>
                                    <td>{{ $agenda->isi_agenda }}</td>
                                    <td>
                                        <div class="btn-group" roles="group" aria-label="Basic Example">
                                        <button type="button" id="btn-edit-agenda" class="btn btn-success"
                                                        data-toggle="modal" data-target="#ubahModal"
                                                        data-id="{{ $agenda->id }}">Edit</button>
                                                        <a class="btn btn-danger" href="agenda/delete/{{ $agenda->id}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data?')">Hapus</a>
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
                    <form method="post" action="{{ route('admin.agenda.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="users">Pilih Guru</label>
                            <select name="users" id="users" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($pengguna as $key)
                            <option value="{{$key->id}}">{{$key->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="isi_agenda">Isi Agenda</label>
                            <input type="text" class="form-control" name="isi_agenda" id="isi_agenda" required />
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
                    <form method="post" action="{{ route('admin.agenda.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                        <label for="users">Pilih Guru</label>
                            <select name="users" id="edit-users" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($pengguna as $key)
                            <option value="{{$key->id}}">{{$key->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="edit-tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-isi_agenda">Isi Agenda</label>
                            <input type="text" class="form-control" name="isi_agenda" id="edit-isi_agenda" required />
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


            $(document).on('click', '#btn-edit-agenda', function() {
                let id = $(this).data('id');

                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataAgenda') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-users').val(res.users);
                        $('#edit-tanggal').val(res.tanggal);
                        $('#edit-isi_agenda').val(res.isi_agenda);
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