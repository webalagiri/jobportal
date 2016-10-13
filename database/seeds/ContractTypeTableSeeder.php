<?php

use Illuminate\Database\Seeder;

class ContractTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contractTypes = [
            ['id' => 50, 'list_entity_name' => 'Full Time', 'list_group_id' => 9, 'sequence_no' => 1],
            ['id' => 51, 'list_entity_name' => 'Part Time', 'list_group_id' => 9, 'sequence_no' => 2],
            ['id' => 52, 'list_entity_name' => 'Contract', 'list_group_id' => 9, 'sequence_no' => 3],
            ['id' => 53, 'list_entity_name' => 'Permanent', 'list_group_id' => 9, 'sequence_no' => 4],
            ['id' => 54, 'list_entity_name' => 'Temporary', 'list_group_id' => 9, 'sequence_no' => 5],
        ];

        DB::table('ri_list_entities')->insert($contractTypes);
    }
}
