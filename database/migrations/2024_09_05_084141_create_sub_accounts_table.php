<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('sub_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->decimal('balance', 10, 2)->default(0);
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_accounts');
    }
}
