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

    public function create()
    {
        return view('stories.create');
    }

    public function show($id)
    {
        $story = Story::with('chapters')->findOrFail($id);

        // return response()->json($story);
        return view('stories.show', ['story' => $story]);
    }

    public function store(Request $request)
    {
        try {
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
            $path = $request->file('story_cover')->store();
            // $url = Storage::url($path);
            $story = Story::create([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'synopsis' => $request->input('synopsis'),
                'category' => $request->input('category'),
                'story_cover' => $path, // Menyimpan path gambar ke dalam database
                'tags' => $request->input('tags'),
                'status' => $request->input('status'),
            ]);

            return response()->json($story, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add story.'], 500);
        }
    }

    public function edit($id)
    {
        $story = Story::with('chapters')->findOrFail($id);

        // return response()->json($story);
        return view('stories.edit', ['story' => $story]);
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
            $path = $request->file('story_cover')->store();
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

        // Hapus file gambar terkait dengan cerita
        if ($story->story_cover) {
            Storage::delete($story->story_cover);
        }

        // dd($story->story_cover);
        $story->delete();

        return redirect('/stories');
    }
}
