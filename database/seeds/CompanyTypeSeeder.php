<?php

use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyTypes = [
            ['id' => 1, 'list_entity_name' => 'Government', 'list_group_id' => 4, 'sequence_no' => 1],
            ['id' => 2, 'list_entity_name' => 'Private Limited', 'list_group_id' => 4, 'sequence_no' => 2],
            ['id' => 3, 'list_entity_name' => 'Public Limited', 'list_group_id' => 4, 'sequence_no' => 3],
        ];

        DB::table('ri_list_entities')->insert($companyTypes);
    }
}
