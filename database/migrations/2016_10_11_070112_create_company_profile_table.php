<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_company_profile'))
        {
            Schema::create('ri_company_profile', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('company_id')->unsigned();
                $table->string('company_name', 255);
                $table->string('description', 255)->nullable();
                $table->integer('company_type')->unsigned();
                $table->string('email', 255)->nullable();
                $table->string('phone', 255)->nullable();
                $table->string('location', 1000)->nullable();
                $table->text('address');
                $table->integer('city')->unsigned();
                $table->integer('country')->unsigned();
                $table->string('pincode', 255);
                $table->text('company_logo')->nullable();
                $table->string('contact_person', 255)->nullable();
                $table->string('contact_person_mobile', 255)->nullable();
                $table->string('created_by', 255);
                $table->string('updated_by', 255);
                $table->timestamps();
            });
        }

        Schema::table('ri_company_profile', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_type')->references('id')->on('ri_list_entities')->onDelete('cascade');
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
        Schema::drop('ri_company_profile');
    }
}
