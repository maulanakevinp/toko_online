<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('type_id');
            $table->string('photo1');
            $table->integer('price');
            $table->string('bukalapak');
            $table->string('tokopedia');
            $table->string('olx');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')->on('types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('photo1')
                ->references('photo1')->on('photos')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
