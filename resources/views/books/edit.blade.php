@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit ' . $book->name) }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('book.update', [$book->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @include('books.partials._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
