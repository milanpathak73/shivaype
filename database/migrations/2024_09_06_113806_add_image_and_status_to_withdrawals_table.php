<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('status');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending')->change();
        });
    }

    public function down()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->string('status')->default('Pending')->change();
        });
    }


};
