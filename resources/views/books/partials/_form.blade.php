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
        <input id="image" type="file" name="image" required>
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
        @isset($book->id)
            <a class="btn btn-danger" href="{{ route('book.destroy', [$book->id]) }}">
                {{ __('Delete')}}
            </a>
        @endisset
    </div>
</div>
