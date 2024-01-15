<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function index()
    {
        try {
            $stories = Story::all();
        } catch (\Exception $e) {
            // Handle the exception accordingly
            return view('error', ['message' => $e->getMessage()]);
        }

        return view('stories.index', ['stories' => $stories]);
    }



    public function show($id)
    {
        $story = Story::findOrFail($id);

        return response()->json($story);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
            'category' => 'required',
            'story_cover' => 'required|image', // Validasi bahwa file yang diunggah adalah gambar
            'tags' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Mengunggah gambar ke direktori yang ditentukan
        $path = $request->file('story_cover')->store('story_covers');
        $url = Storage::url($path);
        $story = Story::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'synopsis' => $request->input('synopsis'),
            'category' => $request->input('category'),
            'story_cover' => $url, // Menyimpan path gambar ke dalam database
            'tags' => $request->input('tags'),
            'status' => $request->input('status'),
        ]);

        return response()->json($story, 201);
    }

    public function update(Request $request, $id)
    {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
            'category' => 'required',
            'story_cover' => 'image', // Validasi bahwa file yang diunggah adalah gambar
            'tags' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $story = Story::findOrFail($id);

        // Jika ada gambar yang diunggah, maka unggah dan perbarui path gambar di database
        if ($request->hasFile('story_cover')) {
            // Menghapus gambar lama jika ada
            Storage::delete($story->story_cover);

            // Mengunggah gambar baru ke direktori yang ditentukan
            $path = $request->file('story_cover')->store('story_covers');

            $story->story_cover = $path;
        }
        // return response()->json($story->title);
        $story->title = $request->input('title');
        $story->author = $request->input('author');
        $story->synopsis = $request->input('synopsis');
        $story->category = $request->input('category');
        $story->tags = $request->input('tags');
        $story->status = $request->input('status');
        $story->save();

        return response()->json($story);
    }


    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();

        return response()->json(null, 204);
    }
}
