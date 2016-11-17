<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateJobProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_job_profile'))
        {
            Schema::create('ri_candidate_job_profile', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->string('profile_name', 255)->nullable();
                $table->text('profile_details')->nullable();
                $table->double('current_salary', 12, 2)->nullable();
                $table->double('expected_salary', 12, 2)->nullable();
                $table->string('job_title', 1000)->nullable();
                $table->text('skills')->nullable();
                $table->integer('total_experience_years')->nullable();
                $table->integer('total_experience_months')->nullable();
                //$table->string('current_location', 255)->nullable();
                //$table->string('preferred_location', 255)->nullable();
                $table->integer('current_location')->unsigned()->nullable();
                $table->integer('preferred_location')->unsigned()->nullable();
                $table->text('resume')->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_job_profile', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('current_location')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('preferred_location')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_job_profile');
    }
}
