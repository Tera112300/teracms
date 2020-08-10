<?php

use Illuminate\Database\Seeder;

class BlogInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_infos')->insert([
            'name' => 'DemoTheme',
            'description' => 'DemoThemeのキャッチフレーズです。',
            'twitter_url' => 'https://twitter.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'facebook_url' => 'https://www.facebook.com/',
        ]);
    }
}
