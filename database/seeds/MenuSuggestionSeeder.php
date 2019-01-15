<?php

use App\MenuSuggestion;
use Illuminate\Database\Seeder;

class MenuSuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuSuggestions = [
            [
                'consultation_id' => 1,
                'menu_id' => 1
            ]
        ];

        foreach ($menuSuggestions as $m) {
            MenuSuggestion::create($m);
        }
    }
}
