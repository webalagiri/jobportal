<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_jobs'))
        {
            Schema::create('ri_jobs', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('company_id')->unsigned();
                $table->string('job_post_name', 255);
                $table->string('job_description', 255)->nullable();
                $table->integer('location')->unsigned()->nullable();
                $table->integer('job_post_type')->unsigned();
                $table->integer('job_post_vacancy')->unsigned()->nullable();
                $table->text('job_experience')->nullable();
                $table->integer('job_experience_min')->unsigned()->nullable();
                $table->integer('job_experience_max')->unsigned()->nullable();
                $table->integer('job_salary_min')->unsigned()->nullable();
                $table->integer('job_salary_max')->unsigned()->nullable();
                $table->text('job_skills')->nullable();
                $table->integer('job_industry_area')->unsigned();
                $table->integer('job_functional_area')->unsigned();
                $table->date('job_active_from')->nullable();
                $table->date('job_active_to')->nullable();
                $table->tinyInteger('job_status');
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_jobs', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('location')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_post_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_industry_area')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_functional_area')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_jobs');
    }
}
