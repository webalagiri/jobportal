<?php

use Illuminate\Database\Seeder;

class ListGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listGroups = [
            ['id' => 1, 'list_group_name' => 'Country'],
            ['id' => 2, 'list_group_name' => 'States'],
            ['id' => 3, 'list_group_name' => 'Cities'],
            ['id' => 4, 'list_group_name' => 'Company Type'],
            ['id' => 5, 'list_group_name' => 'Industry Area'],
            ['id' => 6, 'list_group_name' => 'Functional Area'],
            ['id' => 7, 'list_group_name' => 'Languages'],
            ['id' => 8, 'list_group_name' => 'Proficiency'],
            ['id' => 9, 'list_group_name' => 'Contract Type'],
            ['id' => 10, 'list_group_name' => 'Interview Type'],
            ['id' => 11, 'list_group_name' => 'Interview Status'],
            ['id' => 12, 'list_group_name' => 'Job Type'],
        ];

        DB::table('ri_list_group')->insert($listGroups);
    }
}
