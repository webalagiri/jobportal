<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_certification'))
        {
            Schema::create('ri_candidate_certification', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->string('course_name');
                $table->integer('course_type')->unsigned();
                $table->string('institution', 255);
                $table->string('location', 1000)->nullable();
                $table->integer('city')->unsigned();
                $table->integer('country')->unsigned();
                $table->date('year_of_completion');
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_certification', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('city')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('country')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_certification');
    }
}
