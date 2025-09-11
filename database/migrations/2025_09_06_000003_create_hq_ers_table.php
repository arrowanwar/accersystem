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
        Schema::create('hq_ers', function (Blueprint $table) {
             $table->id();
            $table->string('hq_er_no')->unique();
            $table->date('date')->index();
            $table->unsignedTinyInteger('section')->comment('1,2');
            $table->string('nothi_no')->nullable();
            $table->unsignedTinyInteger('code')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hq_ers');
    }
};
