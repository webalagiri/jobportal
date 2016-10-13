<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiListGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ri_list_group')) {
            Schema::create('ri_list_group', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('list_group_name', 255);
                $table->string('code', 255)->nullable();
                $table->tinyInteger('delete_status')->default(1);
                $table->string('created_by', 255)->default('RI_Admin');
                $table->string('updated_by', 255)->default('RI_Admin');
                $table->timestamps();
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
        Schema::drop('ri_list_group');
    }
}
