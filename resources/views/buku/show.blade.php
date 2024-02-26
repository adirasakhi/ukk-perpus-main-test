<div class="modal-body">
    <img src="{{ asset('path/to/book/image.jpg') }}" class="img-thumbnail">
    <h3 class="card-text">{{ $book->judul }}</h3>
    <h5 class="card-text">{{ $book->penulis }}</h5>
    <h5 class="card-text">{{ $book->penerbit }}</h5>
    <h5 class="card-text">{{ $book->tahun_terbit }}</h5>
    <p class="card-text">{{ $book->sinopsis }}</p>
    <span class="ms-auto text-warning fw-bold d-block text-center fs-4 rate">★4/5</span>
</div>
