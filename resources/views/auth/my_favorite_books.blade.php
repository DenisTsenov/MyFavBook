@extends('layouts.app')

@section('content')
    <div class="row mt-5 justify-content-center">
        @forelse($user->books as $book)
            <div class="card mx-2 mb-3 cr">
                <img class="card-img-top" src="{{ asset('book_images/' . $book->image) }}"
                     alt="{{ $book->name }}">
                <div class="card-body">
                    <h5 class="card-title">Name: {{ $book->name }}</h5>
                    <p class="card-text">ISBN: <span class="text-danger">{{ $book->isbn }}</span></p>
                    <p class="card-text">Description: {{ $book->description }}</p>
                    <button type="button" data-url="{{ route('book.toggle_favorite', [$book->id]) }}"
                            data-val="{{ $book->id }}" class="btn btn-light remove-btn">Remove
                    </button>
                </div>
            </div>
        @empty
            <h3><span class="badge badge-secondary">You still do not have favorite books</span></h3>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".remove-btn").click(function () {
                let btn    = $(this);
                let url    = $(this).data('url');
                let book   = $(this).data('val');
                let _token = $("input[name=_token]").val();

                $.ajax({
                    url: url + '/remove=true',
                    method: 'POST',
                    data: {book: book, _token: _token,},
                    success: function (data) {
                        btn.closest('.cr').fadeOut(3000);
                    }
                });
            });
        });
    </script>
@endpush