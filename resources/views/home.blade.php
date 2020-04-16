@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My favorite books</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(count($books))
                        @include('partials._books_table')
                    @else
                        <h3 class="text-center">
                            <span class="badge badge-info">There are still no uploaded books</span>
                        </h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
