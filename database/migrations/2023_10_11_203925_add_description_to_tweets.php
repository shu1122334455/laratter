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
        Schema::table('tweets', function (Blueprint $table) {
            $table->string('description')->nullable(); // 新しいフィールドを追加
        });
    }

    public function down()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->dropColumn('description'); // ロールバック時の処理
        });
    }



    /**
     * Reverse the migrations.
     */
};
