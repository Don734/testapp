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
            $table->string('name', 100)->nullable();
            $table->string('score', 100)->nullable();
            $table->string('codeprod', 100)->nullable();
            $table->string('unit', 100)->nullable();
            $table->string('weight')->nullable();
            $table->float('size')->nullable()->unsigned();
            $table->float('weight_one_material')->nullable()->unsigned();
            $table->integer('comingcur')->default('0')->nullable()->unsigned();
            $table->integer('comingprev')->default('0')->nullable()->unsigned();
            $table->integer('expenscur')->default('0')->nullable()->unsigned();
            $table->integer('expensprev')->default('0')->nullable()->unsigned();
            $table->integer('balancecur')->default('0')->nullable()->unsigned();
            $table->integer('balanceprev')->default('0')->nullable()->unsigned();
            $table->float('size_unit')->nullable()->unsigned();
            $table->float('general_weight')->nullable()->unsigned();
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
