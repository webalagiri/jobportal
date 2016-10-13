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
                $table->string('profile_name', 255);
                $table->text('profile_details')->nullable();
                $table->double('current_salary', 12, 2)->nullable();
                $table->double('expected_salary', 12, 2)->nullable();
                $table->text('skills')->nullable();
                $table->integer('total_experience')->nullable();
                $table->text('resume')->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_job_profile', function (Blueprint $table) {
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
        Schema::drop('ri_candidate_job_profile');
    }
}
