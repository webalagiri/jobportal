<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_job_interview'))
        {
            Schema::create('ri_job_interview', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                //$table->integer('job_application_id')->unsigned();
                $table->integer('job_application_id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->integer('company_id')->unsigned();
                $table->integer('interview_location')->unsigned();
                //$table->integer('interview_type_id')->unsigned();
                //$table->integer('interview_status_id')->unsigned();
                $table->date('interview_date');
                $table->time('interview_time');
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_job_interview', function (Blueprint $table) {
            //$table->foreign('job_application_id', 'job_interview_job_application_id_foreign')->references('id')->on('ri_job_application')->onDelete('cascade');
            $table->foreign('job_application_id', 'ri_job_interview_job_application_id_foreign')->references('id')->on('ri_candidate_apply_job')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('interview_location')->references('id')->on('ri_list_entities')->onDelete('cascade');
            //$table->foreign('interview_type_id')->references('id')->on('ri_list_entities')->onDelete('cascade');
            //$table->foreign('interview_status_id')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_job_interview');
    }
}
