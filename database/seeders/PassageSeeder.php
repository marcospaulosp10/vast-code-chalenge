<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Passage;

class PassageSeeder extends Seeder
{
    public function run(): void
    {
        $texts = [
            "Typing speed is a valuable skill in the modern world. Whether you're writing code, chatting online, or taking notes, typing faster saves time and increases productivity.",
            "Learning to type accurately is more important than typing fast. Accuracy ensures that you spend less time fixing mistakes and more time focusing on your work.",
            "Technology continues to evolve every day. From artificial intelligence to space exploration, humanity is pushing the boundaries of innovation.",
            "Discipline and consistency are the keys to mastering any skill. Even ten minutes of focused practice a day can lead to significant improvement over time.",
            "Reading daily not only improves vocabulary but also helps develop critical thinking and empathy. Books are windows into other people's worlds.",
            "Exercise benefits both the body and the mind. Regular physical activity can reduce stress, improve mood, and increase overall well-being.",
            "In software development, clean and readable code is more valuable than complex one-liners. Maintainability ensures long-term success.",
            "Typing tests are an effective way to measure your progress. They highlight areas that need improvement and motivate you to keep practicing.",
            "Communication is one of the most essential skills in the workplace. Listening carefully is as important as speaking clearly.",
            "Time management allows you to balance work, rest, and leisure. Knowing how to prioritise tasks is crucial for productivity and mental health."
        ];

        foreach ($texts as $text) {
            Passage::create([
                'body' => $text,
                'words_count' => str_word_count($text),
            ]);
        }
    }
}
