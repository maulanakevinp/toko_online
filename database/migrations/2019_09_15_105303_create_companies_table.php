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
            $table->string('name',60);
            $table->text('description');
            $table->text('bukalapak')->nullable();
            $table->text('tokopedia')->nullable();
            $table->text('olx')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('line')->nullable();
            $table->text('address');
            $table->string('phone_number', 16);
            $table->string('whatsapp_number', 16);
            $table->string('email',60);
            $table->text('maps');
            $table->text('testimonial');
            $table->string('bca',30)->nullable();
            $table->string('bni',30)->nullable();
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
