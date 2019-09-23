<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->text('bukalapak')->nullable();
            $table->text('tokopedia')->nullable();
            $table->text('olx')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('line')->nullable();
            $table->text('address');
            $table->string('phone_number', 16);
            $table->string('whatsapp_number', 16);
            $table->string('email');
            $table->text('maps');
            $table->text('testimonial');
            $table->string('photo1');

            $table->foreign('photo1')
                ->references('photo1')->on('photos')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
