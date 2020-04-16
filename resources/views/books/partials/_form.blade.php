@csrf
<div class="form-group row">
    <label for="name"
           class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" value="{{ $book->name ?? old('name') }}"
               class="form-control @error('name') is-invalid @enderror"
               name="name" required
               autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="isbn"
           class="col-md-4 col-form-label text-md-right">{{ __('ISBN') }}</label>

    <div class="col-md-6">
        <input id="isbn" type="text"
               class="form-control @error('isbn') is-invalid @enderror"
               name="isbn" value="{{ $book->isbn ?? old('isbn') }}" required
               autocomplete="isbn" autofocus>

        @error('isbn')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="description"
           class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

    <div class="col-md-6">
            <textarea id="description"
                      class="form-control @error('description') is-invalid @enderror"
                      name="description" required autocomplete="email"
                      rows="10" cols="50">{{ $book->description ?? old('description') }}</textarea>
        @error('description')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="image"
           class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

    <div class="col-md-6">
        <input id="image" type="file" name="image" required class="@error('image') is-invalid @enderror" >
        @error('image')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($book->id) ? __('Edit') :__('Create') }}
        </button>
        @if(\Auth::user()->admin && isset($book))
            <button type="button" data-val="{{ $book->id  }}"
                    data-url="{{ route('book.destroy', [$book->id]) }}"
                    class="btn btn-danger ml-5" id="btn_delete">Delete
            </button>
        @endif
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#btn_delete').on('click', function () {
                let url    = $(this).data('url');
                let book   = $(this).val();
                let _token = $("input[name=_token]").val();

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {book: book, _token: _token},
                    success: function (response) {
                        window.location = response.response;
                    }
                });
            });
        });
    </script>
@endpush
