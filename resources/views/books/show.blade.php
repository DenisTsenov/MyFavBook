@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Review ' . $book->name) }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('storage/book_images/' . $book->image) }}"
                                     alt="{{ $book->name }} image">
                            </div>
                            <div class="col-6">
                                Name: {{ $book->name }}<br>
                                Description:<p class="font-weight-normal"> {{ $book->description }}</p>
                                ISBN: {{ $book->isbn }}
                                <hr>
                                <div class="form-check">
                                    <input type="checkbox" {{ $isFavorite ? 'checked' : '' }} class="form-check-input"
                                           id="favorite" name="add_to_fav">
                                    <input type="hidden" id="book" value="{{ $book->id }}">
                                    <label class="form-check-label" for="favorite">Add book to favorite</label>
                                </div>
                                <span id="url" data-url="{{ route('book.toggle_favorite', [$book->id]) }}"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#favorite").change(function () {
                let url    = $('#url').data('url');
                let book   = $('#book').val();
                let _token = $("input[name=_token]").val();

                if (this.checked) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {book: book, _token: _token,},
                        success: function (data) {
                            let elem = '<div class="alert alert-success" id="add" role="alert">\n' +
                                '  Successfully added!\n' +
                                '</div>';

                            $('.card-header').append(elem).find('#add').fadeOut(3000, function () {
                                $(this).remove();
                            });
                        }
                    });
                } else {
                    $.ajax({
                        url: url + '/remove=true',
                        method: 'POST',
                        data: {book: book, _token: _token,},
                        success: function (data) {
                            let elem = '<div class="alert alert-success" id="remove" role="alert">\n' +
                                '  Successfully removed!\n' +
                                '</div>';

                            $('.card-header').append(elem).find('#remove').fadeOut(3000, function () {
                                $(this).remove();
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
