<?php

use Illuminate\Database\Seeder;

class IndustryAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industryAreas = [
            ['id' => 29, 'list_entity_name' => 'Banking', 'list_group_id' => 5, 'sequence_no' => 1],
            ['id' => 30, 'list_entity_name' => 'Finance', 'list_group_id' => 5, 'sequence_no' => 2],
            ['id' => 31, 'list_entity_name' => 'Insurance', 'list_group_id' => 5, 'sequence_no' => 3],
            ['id' => 32, 'list_entity_name' => 'Retail', 'list_group_id' => 5, 'sequence_no' => 4],
            ['id' => 33, 'list_entity_name' => 'Manufacturing', 'list_group_id' => 5, 'sequence_no' => 5],
            ['id' => 34, 'list_entity_name' => 'Healthcare', 'list_group_id' => 5, 'sequence_no' => 6],

        ];

        DB::table('ri_list_entities')->insert($industryAreas);
    }
}
