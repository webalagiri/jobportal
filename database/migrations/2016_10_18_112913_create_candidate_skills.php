<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_skills'))
        {
            Schema::create('ri_candidate_skills', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('candidate_id')->unsigned();
                $table->string('skill_name', 255);
                $table->integer('skill_version')->unsigned()->nullable();
                $table->integer('last_used')->unsigned()->nullable();
                $table->integer('experience_years')->unsigned()->nullable;
                $table->integer('experience_months')->unsigned()->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_skills', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_skills');
    }
}
