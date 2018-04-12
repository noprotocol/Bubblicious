<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSourcesAddLotOfFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->integer('w_political')->nullable();
            $table->integer('w_progressive')->nullable();
            $table->integer('w_age')->nullable();
            $table->integer('ws_entertainment')->nullable();
            $table->integer('ws_foreign')->nullable();
            $table->integer('ws_political')->nullable();
            $table->integer('ws_sports')->nullable();
            $table->integer('ws_generic')->nullable();
            $table->integer('ws_culture')->nullable();
            $table->integer('ws_economics')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
