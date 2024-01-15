<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    public function index($storyId)
    {
        $chapters = Chapter::where('story_id', $storyId)->get();

        return response()->json($chapters);
    }

    public function show($storyId, $chapterId)
    {
        $chapter = Chapter::where('story_id', $storyId)->findOrFail($chapterId);

        return response()->json($chapter);
    }

    public function store(Request $request, $storyId)
    {
        $validator = Validator::make($request->all(), [
            'chapter_title' => 'required',
            'story_chapter' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $chapter = new Chapter();
        $chapter->chapter_title = $request->input('chapter_title');
        $chapter->story_chapter = $request->input('story_chapter');
        $chapter->story_id = $storyId;
        $chapter->save();

        return response()->json($chapter, 201);
    }

    public function update(Request $request, $storyId, $chapterId)
    {
        $validator = Validator::make($request->all(), [
            'chapter_title' => 'required',
            'story_chapter' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $chapter = Chapter::where('story_id', $storyId)->findOrFail($chapterId);
        $chapter->chapter_title = $request->input('chapter_title');
        $chapter->story_chapter = $request->input('story_chapter');
        $chapter->save();

        return response()->json($chapter);
    }

    public function destroy($storyId, $chapterId)
    {
        $chapter = Chapter::where('story_id', $storyId)->findOrFail($chapterId);
        $chapter->delete();

        return response()->json(null, 204);
    }
}
