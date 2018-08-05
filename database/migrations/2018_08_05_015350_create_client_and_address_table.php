<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAndAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('email', 45);
            $table->string('doc', 14)->unique();
            $table->date('bithdate')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lograudoro', 50); 
            $table->string('numero', 6);
            $table->string('cep', 7);
            $table->string('cidade', 50);
            $table->string('complemento', 50);
            $table->string('bairro', 50);
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clients');
            $table->softDeletes();
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
        Schema::dropIfExists('address');
        Schema::dropIfExists('clients');
    }
}
