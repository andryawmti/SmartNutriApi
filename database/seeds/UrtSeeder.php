<?php

use Illuminate\Database\Seeder;

class UrtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urt_list = [
            [
                'slug' => 'Bh',
                'name' => 'buah',
            ],
            [
                'slug' => 'Bj',
                'name' => 'biji',
            ],
            [
                'slug' => 'Bsr',
                'name' => 'besar',
            ],
            [
                'slug' => 'Ptg',
                'name' => 'potong',
            ],
            [
                'slug' => 'Sdg',
                'name' => 'sedang',
            ],
            [
                'slug' => 'gls',
                'name' => 'gelas',
            ],
            [
                'slug' => 'Sdm',
                'name' => 'sendok makan',
            ],
            [
                'slug' => 'Sdt',
                'name' => 'sendok teh',
            ],
            [
                'slug' => 'Btr',
                'name' => 'butir',
            ],
            [
                'slug' => 'Btn',
                'name' => 'beton',
            ],
            [
                'slug' => 'Rbs',
                'name' => 'Rebus',
            ],
            [
                'slug' => 'Ckr',
                'name' => 'cangkir',
            ],
        ];

        foreach ($urt_list as $urt) {
            \App\Urt::create($urt);
        }
    }
}
