<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueryNoticesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('query_notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('controller', 120);
            $table->string('function', 50);
            $table->string('query', 500);
            $table->string('time');
            $table->integer('is_deal')->default(0);
            $table->timestamps();
            $table->index(['controller', 'function', 'query']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('query_notices');
    }
}
