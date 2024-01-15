@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detail Story</h1>
        <form id="add-story-form" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" value="{{ $story->title }}" class="form-control" id="title" name="title" disabled>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" value="{{ $story->author }}" class="form-control" id="author" name="author"
                    disabled>
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis:</label>
                <textarea class="form-control" id="synopsis" name="synopsis" disabled>{{ $story->synopsis }}</textarea>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" disabled>
                    <option value="">{{ $story->category }}</option>

                </select>
            </div>

            <div class="form-group">
                <label for="story_cover">Story Cover:</label>
                <img src="{{ Storage::url($story->story_cover) }}" alt="Cover image" style="width:200px;">
            </div>

            <div class="form-group">
                <label for="tags">Tags:</label>
                <input type="text" class="form-control" id="tags" name="tags" disabled
                    value="{{ $story->tags }}">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" disabled>
                    <option value="">{{ $story->status }}</option>

                </select>
                <div class="invalid-feedback"></div>
            </div>


        </form>

    </div>
    <div class="container">
        <h3 class="m-2">Chapter List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Chapter Title</th>
                    <th scope="col">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($story->chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->chapter_title }}</td>
                        <td>{{ $chapter->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/stories" type="submit" class="btn btn-danger mt-2">Back</a>
    </div>
@endsection
