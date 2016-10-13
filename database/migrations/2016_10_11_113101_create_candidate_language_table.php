<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_language'))
        {
            Schema::create('ri_candidate_language', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->integer('language_id')->unsigned();
                $table->tinyInteger('language_read')->nullable();
                $table->tinyInteger('language_write')->nullable();
                $table->tinyInteger('language_speak')->nullable();
                $table->integer('proficiency_level')->unsigned();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_language', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('ri_list_entities')->onDelete('cascade');
            $table->foreign('proficiency_level')->references('id')->on('ri_list_entities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_candidate_language');
    }
}
