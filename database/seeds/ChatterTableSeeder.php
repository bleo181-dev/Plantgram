<?php

use Illuminate\Database\Seeder;

class ChatterTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {



        // CREATE THE CATEGORIES

        \DB::table('chatter_categories')->delete();

        \DB::table('chatter_categories')->insert([
            0 => [
                'id'         => 1,
                'parent_id'  => null,
                'order'      => 1,
                'name'       => 'JustChatting',
                'color'      => '#0074D9',
                'slug'       => 'justchatting',
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'id'         => 2,
                'parent_id'  => null,
                'order'      => 2,
                'name'       => 'Problemi',
                'color'      => '#FF4136',
                'slug'       => 'problemi',
                'created_at' => null,
                'updated_at' => null,
            ],
            2 => [
                'id'         => 3,
                'parent_id'  => null,
                'order'      => 3,
                'name'       => 'Consigli',
                'color'      => '#39CCCC',
                'slug'       => 'consigli',
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id'         => 4,
                'parent_id'  => null,
                'order'      => 4,
                'name'       => 'Condivisioni',
                'color'      => '#2ECC40',
                'slug'       => 'condivisioni',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);

        // CREATE THE DISCUSSIONS

        \DB::table('chatter_discussion')->delete();

        \DB::table('chatter_discussion')->insert([
            0 => [
                'id'                  => 3,
                'chatter_category_id' => 1,
                'title'               => 'Titolo post',
                'user_id'             => 1,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:27:56',
                'updated_at'          => '2016-08-18 14:27:56',
                'slug'                => 'titolo post',
                'color'               => '#239900',
            ]
        ]);

        // CREATE THE POSTS

        \DB::table('chatter_post')->delete();

        \DB::table('chatter_post')->insert([
                    0 => [
                        'id'                    => 1,
                        'chatter_discussion_id' => 3,
                        'user_id'               => 1,
                        'body'                  => '<p>Ciao, questo è un post! foto piedini nei commenti???</p>',
                        'created_at' => '2022-01-23 14:27:56',
                        'updated_at' => '2022-01-24 14:27:56',
                    ],
                    1 => [
                        'id'                    => 2,
                        'chatter_discussion_id' => 3,
                        'user_id'               => 1,
                        'body'                  => '<p>Beccati sta GIF di Keanu Reeves</p>
                    <p><img src="https://media.giphy.com/media/j5QcmXoFWl4Q0/giphy.gif" alt="" width="366" height="229" /></p>',
                        'created_at' => '2022-01-25 15:01:25',
                        'updated_at' => '2022-01-25 15:01:25',
                    ]
                ]);
    }
}
