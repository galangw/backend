@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add Story</h1>
        <form id="add-story-form" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" required>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis:</label>
                <textarea class="form-control" id="synopsis" name="synopsis" required></textarea>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">-- Select Category --</option>
                    <option value="Financial">Financial</option>
                    <option value="Technology">Technology</option>
                    <option value="Health">Health</option>
                </select>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="story_cover">Story Cover:</label>
                <input type="file" class="form-control" id="story_cover" name="story_cover" required>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="tags">Tags:</label>
                <input type="text" class="form-control" id="tags" name="tags" required>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">-- Select Status --</option>
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                </select>
                <div class="invalid-feedback"></div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Add Story</button>
            <a href="/stories" class="btn btn-danger mt-2">Back</a>

        </form>
    </div>

    <script>
        const form = document.getElementById('add-story-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(form);
            const response = await fetch('/stories', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const data = await response.json();
                alert("data berhasil disimpan");
                location.reload(true);
            } else {
                const errors = await response.json();
                alert("data gagal disimpan, periksa data anda");

            }
        });
    </script>
@endsection
