<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatePersonalProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_candidate_personal_profile'))
        {
            Schema::create('ri_candidate_personal_profile', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('candidate_id')->unsigned();
                $table->string('candidate_name', 500);
                $table->string('email', 255)->nullable();
                $table->string('phone', 255)->nullable();
                $table->string('mobile', 255)->nullable();
                $table->string('location', 1000)->nullable();
                $table->text('address');
                $table->integer('city')->unsigned();
                $table->integer('country')->unsigned();
                $table->string('pincode', 255);
                $table->tinyInteger('gender');
                $table->date('date_of_birth');
                $table->tinyInteger('marital_status');
                $table->boolean('physically_challenged')->nullable();
                $table->text('photo')->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);

                $table->timestamps();
            });
        }

        Schema::table('ri_candidate_personal_profile', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('ri_candidate_personal_profile');
    }
}
