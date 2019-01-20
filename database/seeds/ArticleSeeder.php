<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = [
            [
                'admin_id' => 1,
                'title' => 'Article One',
                'content' => 'This is content of article one',
                'photo' => null,
            ],
            [
                'admin_id' => 1,
                'title' => 'Article Two',
                'content' => 'This is content of article two',
                'photo' => null,
            ],
        ];

        foreach ($articles as $a) {
            Article::create($a);
        }
    }
}
