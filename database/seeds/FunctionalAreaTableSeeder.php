<?php

use Illuminate\Database\Seeder;

class FunctionalAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $functionalAreas = [
            ['id' => 35, 'list_entity_name' => 'Human Resource', 'list_group_id' => 6, 'sequence_no' => 1],
            ['id' => 36, 'list_entity_name' => 'Marketing', 'list_group_id' => 6, 'sequence_no' => 2],
            ['id' => 37, 'list_entity_name' => 'Customer Service Support', 'list_group_id' => 6, 'sequence_no' => 3],
            ['id' => 38, 'list_entity_name' => 'Sales', 'list_group_id' => 6, 'sequence_no' => 4],
            ['id' => 39, 'list_entity_name' => 'Accounting', 'list_group_id' => 6, 'sequence_no' => 5],
            ['id' => 40, 'list_entity_name' => 'Finance', 'list_group_id' => 6, 'sequence_no' => 6],
            ['id' => 41, 'list_entity_name' => 'Distribution', 'list_group_id' =>6, 'sequence_no' => 7],
            ['id' => 42, 'list_entity_name' => 'Research and Development', 'list_group_id' => 6, 'sequence_no' => 8],
            ['id' => 43, 'list_entity_name' => 'Administration', 'list_group_id' => 6, 'sequence_no' => 9],
            ['id' => 44, 'list_entity_name' => 'Management', 'list_group_id' => 6, 'sequence_no' => 10],
            ['id' => 45, 'list_entity_name' => 'Production', 'list_group_id' => 6, 'sequence_no' => 11],
            ['id' => 46, 'list_entity_name' => 'Operations', 'list_group_id' => 6, 'sequence_no' => 12],
            ['id' => 47, 'list_entity_name' => 'IT', 'list_group_id' => 6, 'sequence_no' => 13],
            ['id' => 48, 'list_entity_name' => 'Purchase', 'list_group_id' => 6, 'sequence_no' => 14],
            ['id' => 49, 'list_entity_name' => 'Legal', 'list_group_id' => 6, 'sequence_no' => 15],
        ];

        DB::table('ri_list_entities')->insert($functionalAreas);
    }
}
