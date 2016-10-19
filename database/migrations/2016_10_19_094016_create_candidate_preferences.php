<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatePreferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_preferences'))
        {
            Schema::create('ri_candidate_preferences', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->integer('job_type')->unsigned();
                $table->integer('employment_type')->unsigned();
                $table->integer('industry')->unsigned();
                $table->text('recommended_companies')->nullable();
                $table->text('dream_companies')->nullable();
                $table->text('preferred_skills')->nullable();
                $table->text('companies_interviewed_with')->nullable();
                $table->text('preferred_roles')->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);
                $table->timestamps();
            });

            Schema::table('ri_candidate_preferences', function (Blueprint $table) {
                $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('job_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
                $table->foreign('employment_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
                $table->foreign('industry')->references('id')->on('ri_list_entities')->onDelete('cascade');
            });
        }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_preferences');
    }
}
