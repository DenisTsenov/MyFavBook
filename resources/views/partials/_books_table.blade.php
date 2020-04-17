@csrf
<div class="table-responsive" id="table_data">
    <table class="table table-striped table-borderless">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">IBSN</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>
                    {{ $book->id }}
                </td>
                <td>
                    {{ $book->name }}
                </td>
                <td>
                    {{ $book->isbn }}
                </td>
                <td data-toggle="tooltip" data-placement="top"
                    title="{{ strlen($book->description) > 10 ? $book->description : ''}}">
                    {{ strlen($book->description) > 10 ? substr($book->description, 0, 10) . '...':  $book->description}}
                </td>
                <td>
                    @if(\Auth::user()->admin)
                        <a href="{{ route('book.edit', [$book->id]) }}" class="btn btn-light">Edit</a>
                    @endif
                    <a href="{{ route('book.show.content', [$book->id]) }}" class="btn btn-info">Show</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $books->links() !!}
    <span id="url" data-url="{{ route('pagination.fetch') }}"></span>
</div>

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];

                fetch_data(page)
            });

            function fetch_data(page) {
                let _token = $("input[name=_token]").val();
                let url    = $('#url').data('url');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {_token: _token, page: page},
                    success: function (data) {
                        $('#table_data').html(data);
                    }
                });
            }
        });
    </script>
@endpush