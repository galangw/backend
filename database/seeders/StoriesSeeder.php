<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed stories
        $stories = [
            [
                'title' => 'Story 1',
                'author' => 'Author 1',
                'synopsis' => 'Synopsis 1',
                'category' => 'Financial',
                'story_cover' => 'story1.jpg',
                'tags' => 'Tag 1, Tag 2',
                'status' => 'Publish',
            ],
            [
                'title' => 'Story 2',
                'author' => 'Author 2',
                'synopsis' => 'Synopsis 2',
                'category' => 'Technology',
                'story_cover' => 'story2.jpg',
                'tags' => 'Tag 3, Tag 4',
                'status' => 'Draft',
            ],
            // Add more stories here
        ];

        foreach ($stories as $storyData) {
            $story = Story::create($storyData);

            // Seed chapters for each story
            $chapters = [
                [
                    'chapter_title' => 'Chapter 1',
                    'story_chapter' => 'Chapter 1 content',
                ],
                [
                    'chapter_title' => 'Chapter 2',
                    'story_chapter' => 'Chapter 2 content',
                ],
                // Add more chapters here
            ];

            foreach ($chapters as $chapterData) {
                $chapter = new Chapter($chapterData);
                $story->chapters()->save($chapter);
            }
        }
    }
}
