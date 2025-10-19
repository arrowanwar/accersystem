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
        Schema::create('hq_endorse_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hq_er_id');
            $table->string('memo_no')->default('')->index();
            $table->date('date')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hq_er_id')->references('id')->on('hq_ers')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hq_endorse_orders');
    }
};
