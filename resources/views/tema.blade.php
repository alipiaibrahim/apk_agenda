@extends('adminlte::page')
@section('title', 'Pengelolaan Data Tema')
@section('content_header')
    <h1 class="text-center text-bold" style="font-family:Arial, Helvetica, sans-serif">PENGELOLAAN DATA TEMA</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Data Tema') }}</div>
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
                                <th>TANGGAL</th>
                                <th>TEMA</th>
                                <th>ISI AGENDA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($temas as $tema)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $tema->topik->nama }}</td>
                                    <td>{{ $tema->tanggal }}</td>
                                    <td>{{ $tema->tema }}</td>
                                    <td>{{ $tema->agenda->isi_agenda }}</td>
                                    <td>
                                        <div class="btn-group" roles="group" aria-label="Basic Example">
                                            <button type="button" id="btn-edit-agenda" class="btn btn-success"
                                                data-toggle="modal" data-target="#ubahModal"
                                                data-id="{{ $tema->id }}">Edit</button>
                                            <a class="btn btn-danger" href="tema/delete/{{ $tema->id }}"
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
                    <form method="post" action="{{ route('admin.tema.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="topiks">Topik</label>
                            <select name="topiks" id="topiks" class="form-control">
                                <option value="">Pilih Isi Topik</option>
                                @foreach ($topik as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="tema">Tema</label>
                            <input type="text" class="form-control" name="tema" id="tema" required />
                        </div>
                        <div class="form-group">
                            <label for="agendas">Pilih Isi Kegiatan</label>
                            <select name="agendas" id="agendas" class="form-control">
                                <option value="">Pilih Isi Agenda</option>
                                @foreach ($agenda as $key)
                                    <option value="{{ $key->id }}">{{ $key->isi_agenda }}</option>
                                @endforeach
                            </select>
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
                    <form method="post" action="{{ route('admin.tema.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-topiks">Topik</label>
                            <select name="topiks" id="edit-topiks" class="form-control">
                                <option value="">Pilih Isi Topik</option>
                                @foreach ($topik as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="edit-tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-tema">Tema</label>
                            <input type="text" class="form-control" name="tema" id="edit-tema" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-agendas">Pilih Isi Kegiatan</label>
                            <select name="agendas" id="edit-agendas" class="form-control">
                                <option value="">Pilih Isi Agenda</option>
                                @foreach ($agenda as $key)
                                    <option value="{{ $key->id }}">{{ $key->isi_agenda }}</option>
                                @endforeach
                            </select>
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


                $(document).on('click', '#btn-edit-agenda', function() {
                    let id = $(this).data('id');

                    $('#image-area').empty();

                    $.ajax({
                        type: "get",
                        url: "{{ url('/admin/ajaxadmin/dataTema') }}/" + id,
                        dataType: 'json',
                        success: function(res) {
                            $('#edit-topiks').val(res.topiks);
                            $('#edit-tanggal').val(res.tanggal);
                            $('#edit-tema').val(res.tema);
                            $('#edit-agendas').val(res.agendas);
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
