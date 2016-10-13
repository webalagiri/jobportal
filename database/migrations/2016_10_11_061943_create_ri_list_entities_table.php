<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiListEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_list_entities')) {
            Schema::create('ri_list_entities', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('list_entity_name', 255);
                $table->string('code', 255)->nullable();
                $table->integer('list_group_id')->unsigned();
                $table->smallInteger('sequence_no')->nullable();
                $table->tinyInteger('delete_status')->default(1);
                $table->string('created_by', 255)->default('RI_Admin');
                $table->string('updated_by', 255)->default('RI_Admin');
                $table->timestamps();
            });
        }

        Schema::table('ri_list_entities', function (Blueprint $table) {
            $table->foreign('list_group_id')->references('id')->on('ri_list_group')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ri_list_entities');
    }
}
