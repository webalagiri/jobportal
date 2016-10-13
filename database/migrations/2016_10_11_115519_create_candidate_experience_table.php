<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_experience'))
        {
            Schema::create('ri_candidate_experience', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->string('company_name', 255);
                $table->string('company_location', 1000)->nullable();
                $table->text('company_address');
                $table->integer('city')->unsigned();
                $table->integer('country')->unsigned();
                $table->string('pincode', 255);
                $table->integer('job_industry_area')->unsigned();
                $table->integer('job_functional_area')->unsigned();
                $table->integer('contract_type')->unsigned();
                $table->string('designation', 255);
                $table->text('job_description')->nullable();
                $table->text('responsibilities')->nullable();
                $table->text('achievements')->nullable();
                $table->double('annual_salary', 12, 2);
                $table->date('from_date');
                $table->date('to_date');
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_experience', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('country')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_industry_area')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_functional_area')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('contract_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_experience');
    }
}
