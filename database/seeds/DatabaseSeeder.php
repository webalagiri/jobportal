<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ListGroupTableSeeder::class);
        $this->call(CompanyTypeSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(FunctionalAreaTableSeeder::class);
        $this->call(IndustryAreaTableSeeder::class);
        $this->call(ContractTypeTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
    }
}
