<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_projects'))
        {
            Schema::create('ri_candidate_projects', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->string('client', 255);
                $table->text('project_title');
                $table->integer('duration_years_from')->unsigned()->nullable;
                $table->integer('duration_months_from')->unsigned()->nullable();
                $table->integer('duration_years_to')->unsigned()->nullable;
                $table->integer('duration_months_to')->unsigned()->nullable();
                $table->integer('project_location')->unsigned()->nullable;
                $table->integer('employment_status')->unsigned()->nullable;
                $table->text('project_details')->nullable();
                $table->text('skills')->nullable();
                $table->text('role_description')->nullable();
                $table->integer('role')->unsigned()->nullable;
                $table->integer('team_size')->unsigned()->nullable;
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_projects', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_location')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('employment_status')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('role')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('team_size')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_projects');
    }
}
