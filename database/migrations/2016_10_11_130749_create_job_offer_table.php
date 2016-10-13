<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_job_offer'))
        {
            Schema::create('ri_job_offer', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('job_application_id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->integer('company_id')->unsigned();
                $table->integer('offer_letter_status')->unsigned();
                $table->date('offer_letter_date');
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_job_offer', function (Blueprint $table) {
            $table->foreign('job_application_id', 'job_offer_job_application_id_foreign')->references('id')->on('ri_job_application')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('ri_job_offer');
    }
}
