<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateEmployment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_employment'))
        {
            Schema::create('ri_candidate_employment', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->string('company_name', 255);
                $table->string('designation', 255);
                $table->integer('experience_years')->unsigned()->nullable;
                $table->integer('experience_months')->unsigned()->nullable();
                $table->integer('employment_status')->unsigned();
                $table->integer('duration_from_years')->unsigned()->nullable;
                $table->integer('duration_from_months')->unsigned()->nullable();
                $table->integer('duration_to_years')->unsigned()->nullable;
                $table->integer('duration_to_months')->unsigned()->nullable();
                $table->string('annual_salary',1000)->nullable();
                $table->integer('notice_period')->unsigned()->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);
                //$table->double('expected_salary', 12, 2)->nullable();

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_employment', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employment_status')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('notice_period')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_employment');
    }
}
