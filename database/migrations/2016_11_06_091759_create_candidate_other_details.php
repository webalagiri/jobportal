<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateOtherDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_other_details'))
        {
            Schema::create('ri_candidate_other_details', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->tinyInteger('passport_availability')->nullable();
                $table->tinyInteger('driving_license')->nullable();
                $table->integer('passport_expiry_year')->unsigned()->nullable();
                $table->integer('candidate_category')->unsigned()->nullable();
                $table->tinyInteger('physically_challenged')->nullable();
                $table->string('profile_name', 255)->nullable();
                $table->text('url')->nullable();
                $table->integer('work_permit')->unsigned()->nullable();
                $table->integer('other_countries')->unsigned()->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);
                $table->timestamps();
            });

            Schema::table('ri_candidate_other_details', function (Blueprint $table) {
                $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('candidate_category')->references('id')->on('ri_list_entities')->onDelete('cascade');
                $table->foreign('work_permit')->references('id')->on('ri_list_entities')->onDelete('cascade');
                $table->foreign('other_countries')->references('id')->on('ri_list_entities')->onDelete('cascade');
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
        Schema::drop('ri_candidate_other_details');
    }
}
