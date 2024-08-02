<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        DB::table('settings')->insert([
            [
                'key'         => 'site_title',
                'label'       => 'Site Title',
                'value'       => 'Hello,New Site Title',
                'type'        =>'text',
            ],[
                'key'         => 'site_logo',
                'label'       => 'Site logo',
                'value'       => 'uploads/logo.png',
                'type'        =>'image',
            ],[
                'key'         => 'site_description',
                'label'       => 'Description',
                'value'       => 'Hello,New Site Description',
                'type'        =>'image',
            ]
            ,[
                'key'         => 'site_favicon',
                'label'       => 'Site Favicon',
                'value'       => 'uploads/favicon.png',
                'type'        =>'image',
            ],[
                'key'         => 'site_email',
                'label'       => 'Email Address',
                'value'       => 'admin@test.com',
                'type'        =>'email'
            ],[
                'key'         => 'site_contact_email',
                'label'       => 'Contact form email address',
                'value'       => 'contact@test.com',
                'type'        =>'email'
            ], [
                'key'         => 'site_phone',
                'label'       => 'Phone',
                'value'       => '+855122545',
                'type'        =>'phone'
            ],[
                'key'         => 'site_mobile',
                'label'       => 'Mobile',
                'value'       => '0123658455',
                'type'        =>'mobile'
            ],[
                'key'         => 'site_address',
                'label'       => 'Site Address',
                'value'       => 'Cairo,Egypt',
                'type'        =>'textarea'
            ],[
                'key'         => 'site_google_map_location',
                'label'       => 'Site Google Map Location (latitude,longitude)',
                'value'       => '27.12072911846673, 28.548187701894005',
                'type'        =>'google_map'
            ]

        ]);

    }
}
