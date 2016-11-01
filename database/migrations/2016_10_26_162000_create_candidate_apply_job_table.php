<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateApplyJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_apply_job'))
        {
            Schema::create('ri_candidate_apply_job', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('job_id')->unsigned();
                $table->integer('company_id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);
                $table->timestamps();

                $table->unique(array('job_id', 'company_id', 'candidate_id'));
            });

            Schema::table('ri_candidate_apply_job', function (Blueprint $table) {
                $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('job_id')->references('id')->on('ri_jobs')->onDelete('cascade');
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
        Schema::drop('ri_candidate_apply_job');
    }
}
