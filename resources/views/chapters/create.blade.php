@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add Story</h1>
        <form id="add-story-form" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" class="form-control" id="title" name="chapter_title" required>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="story_chapter" name="story_chapter"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Add Story</button>
            <a class="btn btn-danger mt-2" href="/stories/{{ $story->id }}/edit"> Back </a>
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

        const form = document.getElementById('add-story-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(form);
            const response = await fetch('/stories/{{ $story->id }}/chapters', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const data = await response.json();
                // console.log(data);
                alert("data berhasil disimpan");
                // location.reload(true);
                window.location.href = "/stories/{{ $story->id }}/edit"
            } else {
                const errors = await response.json();
                alert("data gagal disimpan, periksa data anda");

            }
        });
    </script>
@endsection
