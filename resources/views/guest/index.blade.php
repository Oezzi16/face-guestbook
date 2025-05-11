<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Tamu</h2>
        <a href="{{ route('guest.create') }}" class="btn btn-primary mb-3">Tambah Tamu</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Keperluan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guests as $guest)
                <tr>
                    <td><img src="/{{ $guest->photo_path }}" width="50"></td>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->email }}</td>
                    <td>{{ $guest->phone }}</td>
                    <td>{{ $guest->message }}</td>
                    <td>
                        
                        <form action="{{ route('guest.destroy', $guest->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>