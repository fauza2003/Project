<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - GoCinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layout.header')

    <div class="container py-5">
        <h2>Search Results for: "{{ $searchTerm }}"</h2>

        @if($movies->isEmpty())
            <p>No movies found matching your search.</p>
        @else
            <div class="row">
                @foreach($movies as $movie)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('assets/' . strtolower(str_replace(' ', '', $movie->title)) . '.webp') }}" class="card-img-top" alt="{{ $movie->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="card-text">{{ $movie->description }}</p>
                                <p class="card-text">⭐ {{ $movie->rating }} | Genre: {{ $movie->genre }}</p>
                                <a href="{{ route('order', ['movieTitle' => $movie->title]) }}" class="btn btn-primary">Pesan Tiket</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
