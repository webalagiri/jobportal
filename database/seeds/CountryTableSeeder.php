<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['id' => 55, 'list_entity_name' => 'India', 'list_group_id' => 1, 'sequence_no' => 2],
        ];

        DB::table('ri_list_entities')->insert($countries);
    }
}
