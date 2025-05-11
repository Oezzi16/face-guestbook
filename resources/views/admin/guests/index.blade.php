@extends('admin.layouts.app')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Tamu</h3>
                <div class="card-tools d-flex gap-2">
                    <!-- Filter Tanggal -->
                    <form action="{{ route('admin.guests.index') }}" method="GET" class="d-flex gap-2">
                        <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}" placeholder="Tanggal Mulai">
                        <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}" placeholder="Tanggal Akhir">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="{{ route('admin.guests.print', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
                           class="btn btn-danger btn-sm" target="_blank">
                            <i class="bi bi-printer"></i> Cetak
                        </a>
                        <a href="{{ route('admin.guests.index')}}" 
                           class="btn btn-default border btn-sm">
                            <i class="bi bi-trash"></i> Reset
                        </a>
                    </form>

                    <!-- Form Pencarian -->
                    <form action="{{ route('admin.guests.search') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Cari..." value="{{ $search ?? '' }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guests as $guest)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($guest->photo_path)
                                    <img src="{{ asset($guest->photo_path) }}" alt="Foto {{ $guest->name }}" width="50">
                                @else
                                    <span class="badge bg-secondary">No Photo</span>
                                @endif
                            </td>
                            <td>{{ $guest->name }}</td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->phone }}</td>
                            <td>{{ Str::limit($guest->message, 30) }}</td>
                            <td>{{ $guest->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $guests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection