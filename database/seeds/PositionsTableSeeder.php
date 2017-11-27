<?php

use Illuminate\Database\Seeder;

/**
 * Class PositionsTableSeeder
 */
class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = json_decode(file_get_contents(public_path('positions.json')), true);
        DB::table('positions')->insert($positions);
    }
}
