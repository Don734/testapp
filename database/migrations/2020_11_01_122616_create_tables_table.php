<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('project', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('score', 100)->nullable();
            $table->string('codeprod', 100)->nullable();
            $table->string('unit', 100)->nullable();
            $table->integer('comingcur')->default('0')->nullable();
            $table->integer('comingprev')->default('0')->nullable();
            $table->integer('expenscur')->default('0')->nullable();
            $table->integer('expensprev')->default('0')->nullable();
            $table->integer('balancecur')->default('0')->nullable();
            $table->integer('balanceprev')->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
