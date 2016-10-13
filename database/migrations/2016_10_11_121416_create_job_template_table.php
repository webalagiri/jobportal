<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_job_template'))
        {
            Schema::create('ri_job_template', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                //$table->integer('company_id');
                $table->string('template_name', 255);
                $table->string('post_name', 255);
                $table->text('post_details', 255)->nullable();
                $table->integer('job_post_type')->unsigned();
                $table->integer('job_contract_type')->unsigned();
                $table->integer('no_vacancy')->nullable();
                $table->text('job_experience')->nullable();
                $table->integer('job_min_experience')->nullable();
                $table->integer('job_max_experience')->nullable();
                $table->double('job_salary_min', 12, 2)->nullable();
                $table->double('job_salary_max', 12, 2)->nullable();
                $table->text('job_skills')->nullable();
                $table->integer('job_industry_area')->unsigned();
                $table->integer('job_functional_area')->unsigned();
                $table->integer('template_created_by')->unsigned();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_job_template', function (Blueprint $table) {
            //$table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_post_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_industry_area')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_functional_area')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_contract_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('template_created_by')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_job_template');
    }
}
