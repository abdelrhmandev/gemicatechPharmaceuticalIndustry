<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blocks')->delete();

        DB::table('blocks')->insert([
            ['title' => 'Installation','description' => ' We offer a fully-integrated service package, trust Gemicatech from product selection right through to installation & beyond.'],
            ['title' => 'Servicing & Repair', 'description' => ' We provide a full spectrum of servicing & functional repair capabilities from software related issues to highly technical repairs.'],
            ['title' => 'Spare Parts Supply', 'description' => ' Spare parts may be supplied on a periodic basis as part of Gemicatech Service Contract.'],
            ['title' => 'Qualification', 'description' => '  We have a proven track record of providing cutting-edge analytical instruments and will custom-make a solution that\'s just right for you.'],
        ]);

    }
}
