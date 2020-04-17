@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<style>
    .scrollable {
        height: 150px;
        overflow-y: scroll;
    }
</style>
@section('content')

    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">

                @guest
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="content">
            <p>Hello {{ \Auth::user()->first_name }}</p>
            @if(\Auth::user()->admin && count($unapprovedUsers))
                <p>There are some user waiting to approve them</p>
                <div class="scrollable h-50">
                    @foreach($unapprovedUsers as $user)
                        <div class="col-sm-12 ">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p>Name: {{ $user->full_name }}</p>
                                    <p>Email: {{ $user->email }}</p>
                                    <button type="button" class="btn btn-info approve"
                                            data-url="{{ route('user.approve', [$user->id])  }}"
                                            data-user="{{ $user->id }}">Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                </div>
            @elseif(\Auth::user()->admin && !count($unapprovedUsers))
                <h3>There are no users to approve</h3>
            @endif
            <p>This application allows you to create your own favorite books list.</p>
            <p>If you have admin right you can also create and update your amazing list of books.</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".approve").click(function () {
                let buttonApprove = $(this);
                let url           = buttonApprove.data('url');
                let user          = buttonApprove.data('user');
                let _token        = $("input[name=_token]").val();

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {user: user, _token: _token,},
                    success: function (data) {
                        buttonApprove.removeClass('btn-info').addClass('btn-success').text('Successfully approved');
                        buttonApprove.fadeOut(3000, function () {
                            $(this).remove();
                        });
                    }
                });
            });
        });
    </script>
@endpush
