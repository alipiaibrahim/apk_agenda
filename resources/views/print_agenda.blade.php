<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">LAPORAN DATA AGENDA</h1>
    <p class="text-center">TAHUN 2023</p>
    <br>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>TANGGAL</th>
                <th>ISI AGENDA</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($agenda as $agenda)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $agenda->pengguna->name }}</td>
                    <td>{{ $agenda->tanggal }}</td>
                    <td>{{ $agenda->isi_agenda }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
