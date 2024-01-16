@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add Story</h1>
        <form id="add-story-form" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title: </label>
                <input value="{{ $chapter->chapter_title }}" type="text" class="form-control" id="title"
                    name="chapter_title" disabled>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="story_chapter" name="story_chapter" disabled>
                    {{ $chapter->story_chapter }}
                </textarea>
            </div>

            <a class="btn btn-danger mt-2" href="/stories/{{ $chapter->story_id }}/edit"> Back </a>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#story_chapter'))
            .then(editor => {
                console.log(editor);
                editor.model.document.on('change:data', () => {
                    const data = editor.getData();
                    document.querySelector('#story_chapter').value = data;
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
