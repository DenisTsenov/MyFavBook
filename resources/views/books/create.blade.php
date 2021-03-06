@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create book') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                            @include('books.partials._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
