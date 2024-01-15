@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detail Story</h1>
        <form id="add-story-form" action="/story/{{ $story->id }}?_method=PUT" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" value="{{ $story->title }}" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" value="{{ $story->author }}" class="form-control" id="author" name="author">
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis:</label>
                <textarea class="form-control" id="synopsis" name="synopsis">{{ $story->synopsis }}</textarea>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">-- Select Category --</option>
                    <option value="Financial" {{ strtolower($story->category) == 'financial' ? 'selected' : '' }}>Financial
                    </option>
                    <option value="Technology" {{ strtolower($story->category) == 'technology' ? 'selected' : '' }}>
                        Technology</option>
                    <option value="Health" {{ strtolower($story->category) == 'health' ? 'selected' : '' }}>Health</option>
                </select>
            </div>


            <div class="form-group">
                <label for="story_cover">Current Image:</label>
                <img src="{{ Storage::url($story->story_cover) }}" alt="Cover image" style="width:200px;">
            </div>
            <div class="form-group">
                <label for="story_cover">Change Image:</label>
                <input type="file" class="form-control" id="story_cover" name="story_cover">
            </div>
            <div class="form-group">
                <label for="tags">Tags:</label>
                <input type="text" class="form-control" id="tags" name="tags" value="{{ $story->tags }}">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="Publish" {{ strtolower($story->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                    <option value="Draft" {{ strtolower($story->status) == 'draft' ? 'selected' : '' }}>Draft</option>

                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>


        </form>

    </div>
    <div class="container">
        <div class="row mt-2">
            <div class="col-8">
                <h3 class="">Chapter List</h3>

            </div>
            <div class="col-4">
                <a href="/stories/{{ $story->id }}/chapters/create" class=" btn btn-success"> Add Chapter</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Chapter Title</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($story->chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->chapter_title }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($chapter->updated_at)->format('d F Y') }}
                        </td>


                        <td>
                            <div class="d-flex justify-content-start">
                                <div class="cols m-1">
                                    <a href="{{ url('/stories/' . $story->id . '/chapters/' . $chapter->id) }}"
                                        class="btn btn-primary">Detail</a>
                                </div>
                                <div class="cols m-1">
                                    <a href="{{ url('/stories/' . $story->id . '/chapters/' . $chapter->id . '/edit') }}"
                                        class="btn btn-primary">Edit</a>
                                </div>
                                <div class="cols m-1">
                                    <form id="delete-form-{{ $chapter->id }}"
                                        action="{{ url('/stories/' . $story->id . '/chapters/' . $chapter->id) }}"
                                        method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteStory({{ $chapter->id }})"
                                            data-id="{{ $story->id }}">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/stories" type="submit" class="btn btn-danger mt-2">Back</a>
    </div>
    <script>
        function deleteStory(id) {
            if (confirm("Are you sure you want to delete this story?")) {
                var form = document.getElementById('delete-form-' + id);
                form.submit();
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        }
        const form = document.getElementById('add-story-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(form);
            const response = await fetch('/story/{{ $story->id }}?_method=PUT', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const data = await response.json();
                alert("data berhasil disimpan");
                location.reload(true);
                // console.log(data);
            } else {
                const errors = await response.json();
                alert("data gagal disimpan, periksa data anda");

            }
        });
    </script>
@endsection
