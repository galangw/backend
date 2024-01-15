@extends('layout.app')

@section('content')
    <h1>Story List</h1>
    <div class="row">
        <div class="col-md-8">
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by title or author" id="search-input">

                </div>
            </form>
        </div>

        <div class="col-md-2 text-end">
            <div class="input-group-append justify-content-end">
                <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                    data-target="#filter-modal">Filter</button>
            </div>
        </div>
        <div class="col-md-2 text-center">
            <div class="input-group-append justify-content-end">
                <a class="btn btn-primary" href="/stories/create">
                    Add
                    Story
                </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="filter-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filter-modal-label">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="category-select">Category</label>
                            <select class="form-control" id="category-select">
                                <option value="">All</option>
                                <option value="Financial">Financial</option>
                                <option value="Technology">Technology</option>
                                <option value="Health">Health</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status-select">Status</label>
                            <select class="form-control" id="status-select">
                                <option value="">All</option>
                                <option value="Publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="filter-button">Apply
                        Filter</button>
                </div>
            </div>
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
                <th scope="col">Action</th>
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
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#storyCoverModal{{ $story->id }}">Show Image</button>

                        <!-- Modal -->
                        <div class="modal fade" id="storyCoverModal{{ $story->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="storyCoverModalLabel{{ $story->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="storyCoverModalLabel{{ $story->id }}">Story Cover
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ Storage::url($story->story_cover) }}" alt="Cover image"
                                            style="width:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <div class="cols m-1">
                                <a href="{{ url('/stories/' . $story->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                            <div class="cols m-1">
                                <a href="{{ url('/stories/' . $story->id . '/edit') }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="cols m-1">
                                <form id="delete-form-{{ $story->id }}" action="{{ url('/stories/' . $story->id) }}"
                                    method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button" class="btn btn-danger"
                                        onclick="deleteStory({{ $story->id }})"
                                        data-id="{{ $story->id }}">Delete</button>
                                </form>
                            </div>
                        </div>

                    </td>
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
                    if (input === '' || title.indexOf(input) !== -1 || author.indexOf(input) !== -
                        1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('#filter-button').on('click', function() {
                var category = $('#category-select').val().toLowerCase();
                var status = $('#status-select').val().toLowerCase();
                $('tbody tr').each(function() {
                    var categoryValue = $(this).find('td:eq(3)').text().trim().toLowerCase();
                    var statusValue = $(this).find('td:eq(5)').text().trim().toLowerCase();
                    if ((category === '' || categoryValue === category) &&
                        (status === '' || statusValue === status)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#filter-modal').modal('hide');
            });
        });

        function deleteStory(id) {
            if (confirm("Are you sure you want to delete this story?")) {
                var form = document.getElementById('delete-form-' + id);
                form.submit();
            }
        }
    </script>
@endsection
