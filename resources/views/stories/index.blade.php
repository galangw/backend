@extends('layout.app')

@section('content')
    <h1>Story List</h1>
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by title or author" id="search-input">
                </div>
            </form>
        </div>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Synopsis</th>
                <th scope="col">Category</th>
                <th scope="col">Tags</th>
                <th scope="col">Status</th>
                <th scope="col">Cover</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stories as $story)
                <tr>
                    <td>{{ $story->title }}</td>
                    <td>{{ $story->author }}</td>
                    <td>{{ $story->synopsis }}</td>
                    <td>{{ $story->category }}</td>
                    <td>{{ $story->tags }}</td>
                    <td>{{ $story->status }}</td>
                    <td>{{ $story->story_cover }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var input = $(this).val().toLowerCase();
                $('tbody tr').each(function() {
                    var title = $(this).find('td:eq(0)').text().toLowerCase();
                    var author = $(this).find('td:eq(1)').text().toLowerCase();
                    if (title.indexOf(input) !== -1 || author.indexOf(input) !== -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endsection
