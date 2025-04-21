<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Film Populer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Daftar Film Populer dari TMDb</h1>

    {{-- Form Pencarian --}}
    <form action="{{ route('movies.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Cari film..." required>
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Tampilkan Error Jika Ada --}}
    @if (!empty($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    {{-- Daftar Film --}}
    <div class="row">
        @forelse ($movies as $movie)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if ($movie['poster_path'])
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie['title'] }}</h5>
                        <p class="card-text">{{ Str::limit($movie['overview'], 100) }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Rilis: {{ $movie['release_date'] ?? '-' }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Tidak ada film ditemukan.</div>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>
