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
            $table->integer('stock');
            $table->unsignedBigInteger('type_id');
            $table->integer('price');
            $table->string('bukalapak')->nullable();
            $table->string('tokopedia')->nullable();
            $table->string('olx')->nullable();
            $table->text('description');
            $table->text('specification')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')->on('types')
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
