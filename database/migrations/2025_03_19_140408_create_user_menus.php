<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_menus', function (Blueprint $table) {
            $table->comment('User 메뉴 테이블');
            $table->id()->comment('아이디');
            $table->string('name')->comment('메뉴명');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('상위메뉴아이디');
            $table->string('url')->nullable()->comment('경로');
            $table->string('icon')->nullable()->comment('아이콘명');
            $table->integer('level')->default(7)->comment('권한');
            $table->integer('sort_order')->default(0)->comment('정렬순서');
            $table->enum('use_check',['Y','N'])->default('Y')->comment('사용유무');
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('user_menus')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_menus');
    }
};
