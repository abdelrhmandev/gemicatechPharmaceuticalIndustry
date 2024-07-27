<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_networks')->delete();

        DB::table('social_networks')->insert([
            ['title'=>'Facebook','icon'=>'facebook','link'=>'https://www.facebook.com/'],
            ['title'=>'Youtube','icon'=>'youtube','link'=>'https://www.youtube.com/'],
            ['title'=>'Instagram','icon'=>'intagram','link'=>'https://www.instagram.com/'],
            ['title'=>'X','icon'=>'x','link'=>'https://x.com/?lang=en'],
            ['title'=>'Linkedin','icon'=>'linkedin','link'=>'https://www.linkedin.com/'],
            ['tilte'=>'Google','icon'=>'google','link'=>'https://www.google.com/'],
            ['title'=>'Pinterest','icon'=>'pinterest','link'=>'https://www.pinterest.com/']
        ]);

    }
}
