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
                    <div class="card-header">
                        {{ __('Pengelolaan User') }}

                        {{-- <button class="btn btn-secondary float-right" data-toggle="modal"><a href="{{ route('admin.print.drugs') }}" target="_blank"><i class="fa fa-print"></i> Cetak PDF</a></button> --}}
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#tambahUserModal"><i
                                class="fa fa-plus"></i> Tambah Data</button>
                        <div class="btn-group mb-5" role="group" aria-label="Basis Example">
                        </div>
                        <div class="table-responsive">
                            <table id="table-data" class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>TANGGAL</th>
                                        <th>NO TELEPON</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL</th>
                                        <th>PASSWORD</th>
                                        <th>ROLES</th>
                                        <th>PHOTO</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach ($users as $pengguna)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $pengguna->name }}</td>
                                            <td>{{ $pengguna->tanggal }}</td>
                                            <td>{{ $pengguna->no_tlp }}</td>
                                            <td>{{ $pengguna->username }}</td>
                                            <td>{{ $pengguna->email }}</td>
                                            <td>{{ $pengguna->password }}</td>
                                            <td>{{ $pengguna->roles_id }}</td>

                                            <td>
                                                @if ($pengguna->photo !== null)
                                                    <img src="{{ asset('storage/photo_user/' . $pengguna->photo) }}"
                                                        width="100px" />
                                                @else
                                                    [gambar tidak tersedia]
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" id="btn-edit-pengguna" class="btn btn-success"
                                                        data-toggle="modal" data-target="#editUserModal"
                                                        data-id="{{ $pengguna->id }}">Edit</button>
                                                        <a class="btn btn-danger" href="user/delete/{{ $pengguna->id}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data?')">Hapus</a>
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
        </div>
    </div>
    </div>
    </div>
    <div>

        <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('admin.pengguna.submit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" required />
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" id="date" class="date form-control" name="tanggal" id="tanggal"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="no_tlp">No Telepon</label>
                                <input type="text" class="form-control" name="no_tlp" id="no_tlp" required />
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" id="password" required />
                            </div>
                            <div class="form-group">
                                <label for="roles_id">Roles ID</label>
                                <select id="roles_id" name="roles_id">
                                    <option selected>Pilih</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            {{-- <div class="form-group">
                  <label for="roles_id">Roles</label>
                  <input type="text" class="form-control" name="roles_id" id="roles_id" required/>
              </div> --}}

                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo" />
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

        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Obat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('admin.pengguna.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit-name">Nama</label>
                                        <input type="text" class="form-control" name="name" id="edit-name"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-tanggal">Tanggal</label>
                                        <input type="date" id="edit-tanggal" class="date form-control" name="tanggal"
                                            id="edit-tanggal" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-no_tlp">No Telepon</label>
                                        <input type="text" class="form-control" name="no_tlp" id="edit-no_tlp"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-username">Username</label>
                                        <input type="text" class="form-control" name="username" id="edit-username"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-email">Email</label>
                                        <input type="text" class="form-control" name="email" id="edit-email"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-password">Password</label>
                                        <input type="text" class="form-control" name="password" id="edit-password"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-roles_id">Roles ID</label>
                                        <select id="edit-roles_id" name="roles_id">
                                            <option selected>Pilih</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                      <label for="edit-roles_id">Roles</label>
                      <input type="text" class="form-control" name="roles_id" id="edit-roles_id" required/>
                  {{-- </div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="image-area"></div>
                                    <div class="form-group">
                                        <label for="edit-photo">Photo</label>
                                        <input type="file" class="form-control" name="photo" id="edit-photo" />
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id" />
                        <input type="hidden" name="old_photo" id="edit-old_photo" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Update</button>
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

@section('css')
    <style>
        input[type=text],
        select,
        textarea {
            width: 100%;
            /* Full width */
            padding: 12px;
            /* Some padding */
            border: 1px solid #ccc;
            /* Gray border */
            border-radius: 4px;
            /* Rounded borders */
            box-sizing: border-box;
            /* Make sure that padding and width stays in place */
            margin-top: 6px;
            /* Add a top margin */
            margin-bottom: 16px;
            /* Bottom margin */
            resize: vertical
                /* Allow the user to vertically resize the textarea (not horizontally) */
        }
    </style>
@stop
@section('js')
    <script>
        $(function() {


            $(document).on('click', '#btn-edit-pengguna', function() {
                let id = $(this).data('id');

                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataUser') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-name').val(res.name);
                        $('#edit-tanggal').val(res.tanggal);
                        $('#edit-no_tlp').val(res.no_tlp);
                        $('#edit-username').val(res.username);
                        $('#edit-email').val(res.email);
                        $('#edit-password').val(res.password);
                        $('#edit-roles_id').val(res.roles_id);

                        $('#edit-id').val(res.id);
                        $('#edit-old_photo').val(res.photo);

                        if (res.photo !== null) {
                            $('#image-area').append(
                                "<img src='" + baseurl + "/storage/photo_pengguna/" + res
                                .photo + "' width='200px'/>"
                            );
                        } else {
                            $('#image-area').append('[Gambar tidak tersedia]');
                        }
                    },
                });
            });

        });

    </script>
@stop
@section('js')
    <script></script>