<?php

use Illuminate\Database\Seeder;

/**
 * Class CollaboratorsTableSeeder
 */
class CollaboratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds
     * @return void
     */
    public function run()
    {
        $collaborators = json_decode(file_get_contents(public_path('collaborators.json')), true);

        for ($i = 0; $i < 50; $i++) {
            $insert = array_slice($collaborators, $i * 1000, 1000);
            DB::table('collaborators')->insert($insert);
        }
    }
}
