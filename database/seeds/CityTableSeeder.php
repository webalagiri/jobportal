<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['id' => 4, 'list_entity_name' => 'Ahmedabad', 'list_group_id' => 3, 'sequence_no' => 1],
            ['id' => 5, 'list_entity_name' => 'Alleppey', 'list_group_id' => 3, 'sequence_no' => 2],
            ['id' => 6, 'list_entity_name' => 'Aurangabad', 'list_group_id' => 3, 'sequence_no' => 3],
            ['id' => 7, 'list_entity_name' => 'Bangalore', 'list_group_id' => 3, 'sequence_no' => 4],
            ['id' => 8, 'list_entity_name' => 'Bellary', 'list_group_id' => 3, 'sequence_no' => 5],
            ['id' => 9, 'list_entity_name' => 'Bhilai', 'list_group_id' => 3, 'sequence_no' => 6],
            ['id' => 10, 'list_entity_name' => 'Bhubaneshwar', 'list_group_id' => 3, 'sequence_no' => 7],
            ['id' => 11, 'list_entity_name' => 'Calicut', 'list_group_id' => 3, 'sequence_no' => 8],
            ['id' => 12, 'list_entity_name' => 'Chandigarh', 'list_group_id' => 3, 'sequence_no' => 9],
            ['id' => 13, 'list_entity_name' => 'Chennai', 'list_group_id' => 3, 'sequence_no' => 10],
            ['id' => 14, 'list_entity_name' => 'Cochin', 'list_group_id' => 3, 'sequence_no' => 11],
            ['id' => 15, 'list_entity_name' => 'Coimbatore', 'list_group_id' => 3, 'sequence_no' => 12],
            ['id' => 16, 'list_entity_name' => 'Cuttack', 'list_group_id' => 3, 'sequence_no' => 13],
            ['id' => 17, 'list_entity_name' => 'Dehradun', 'list_group_id' => 3, 'sequence_no' => 14],
            ['id' => 18, 'list_entity_name' => 'Ernakulam', 'list_group_id' => 3, 'sequence_no' => 15],
            ['id' => 19, 'list_entity_name' => 'Erode', 'list_group_id' => 3, 'sequence_no' => 16],
            ['id' => 20, 'list_entity_name' => 'Faridabad', 'list_group_id' => 3, 'sequence_no' => 17],
            ['id' => 21, 'list_entity_name' => 'Ghaziabad', 'list_group_id' => 3, 'sequence_no' => 18],
            ['id' => 22, 'list_entity_name' => 'Goa', 'list_group_id' => 3, 'sequence_no' => 19],
            ['id' => 23, 'list_entity_name' => 'Gorakhpur', 'list_group_id' => 3, 'sequence_no' => 20],
            ['id' => 24, 'list_entity_name' => 'Gulbarga', 'list_group_id' => 3, 'sequence_no' => 21],
            ['id' => 25, 'list_entity_name' => 'Gurgaon', 'list_group_id' => 3, 'sequence_no' => 22],
            ['id' => 26, 'list_entity_name' => 'Haridwar', 'list_group_id' => 3, 'sequence_no' => 23],
            ['id' => 27, 'list_entity_name' => 'Hubli', 'list_group_id' => 3, 'sequence_no' => 24],
            ['id' => 28, 'list_entity_name' => 'Hyderabad', 'list_group_id' => 3, 'sequence_no' =>25],
        ];

        DB::table('ri_list_entities')->insert($cities);
    }
}
