<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_job_application'))
        {
            Schema::create('ri_job_application', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('job_id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->integer('company_id')->unsigned();
                $table->integer('preferred_location')->unsigned();
                $table->integer('country')->unsigned();
                $table->integer('contract_type')->unsigned();
                $table->integer('job_type')->unsigned();
                $table->date('job_applied_date');
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_job_application', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('ri_jobs')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('preferred_location')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('country')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('contract_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('job_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_job_application');
    }
}
