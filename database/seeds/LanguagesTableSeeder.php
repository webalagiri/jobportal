<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ['id' => 56, 'list_entity_name' => 'Assamese', 'list_group_id' => 7, 'sequence_no' => 1],
            ['id' => 57, 'list_entity_name' => 'Bengali', 'list_group_id' => 7, 'sequence_no' => 2],
            ['id' => 58, 'list_entity_name' => 'Bihari', 'list_group_id' => 7, 'sequence_no' => 3],
            ['id' => 59, 'list_entity_name' => 'English', 'list_group_id' => 7, 'sequence_no' => 4],
            ['id' => 60, 'list_entity_name' => 'Chinese', 'list_group_id' => 7, 'sequence_no' => 5],
            ['id' => 61, 'list_entity_name' => 'Arabic', 'list_group_id' => 7, 'sequence_no' => 6],
            ['id' => 62, 'list_entity_name' => 'Danish', 'list_group_id' => 7, 'sequence_no' => 7],
            ['id' => 63, 'list_entity_name' => 'French', 'list_group_id' => 7, 'sequence_no' => 8],
            ['id' => 64, 'list_entity_name' => 'German', 'list_group_id' => 7, 'sequence_no' => 9],
            ['id' => 65, 'list_entity_name' => 'Gujarathi', 'list_group_id' => 7, 'sequence_no' => 10],
            ['id' => 66, 'list_entity_name' => 'Hindi', 'list_group_id' => 7, 'sequence_no' => 11],
            ['id' => 67, 'list_entity_name' => 'Italian', 'list_group_id' => 7, 'sequence_no' => 12],
            ['id' => 68, 'list_entity_name' => 'Japanese', 'list_group_id' => 7, 'sequence_no' => 13],
            ['id' => 69, 'list_entity_name' => 'Kannada', 'list_group_id' => 7, 'sequence_no' => 14],
            ['id' => 70, 'list_entity_name' => 'Kashmiri', 'list_group_id' => 7, 'sequence_no' => 15],
            ['id' => 71, 'list_entity_name' => 'Latin', 'list_group_id' => 7, 'sequence_no' => 16],
            ['id' => 72, 'list_entity_name' => 'Malayalam', 'list_group_id' => 7, 'sequence_no' => 17],
            ['id' => 73, 'list_entity_name' => 'Marathi', 'list_group_id' => 7, 'sequence_no' => 18],
            ['id' => 74, 'list_entity_name' => 'Oriya', 'list_group_id' => 7, 'sequence_no' => 19],
            ['id' => 75, 'list_entity_name' => 'Punjabi', 'list_group_id' => 7, 'sequence_no' => 20],
            ['id' => 76, 'list_entity_name' => 'Sanskrit', 'list_group_id' => 7, 'sequence_no' => 21],
            ['id' => 77, 'list_entity_name' => 'Sindhi', 'list_group_id' => 7, 'sequence_no' => 22],
            ['id' => 78, 'list_entity_name' => 'Spanish', 'list_group_id' => 7, 'sequence_no' => 23],
            ['id' => 79, 'list_entity_name' => 'Tamil', 'list_group_id' => 7, 'sequence_no' => 24],
            ['id' => 80, 'list_entity_name' => 'Telugu', 'list_group_id' => 7, 'sequence_no' => 25],
            ['id' => 81, 'list_entity_name' => 'Urdu', 'list_group_id' => 7, 'sequence_no' => 26],

        ];

        DB::table('ri_list_entities')->insert($languages);
    }
}
