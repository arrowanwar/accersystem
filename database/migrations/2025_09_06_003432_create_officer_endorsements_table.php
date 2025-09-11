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
        Schema::create('officer_endorsements', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('officer_id');
            $table->unsignedBigInteger('hq_endorse_order_id');
            $table->date('nothi_rcv_date')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('0=pending,1=done');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('officer_id')->references('id')->on('officers')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('hq_endorse_order_id')->references('id')->on('hq_endorse_orders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->index(['officer_id','hq_endorse_order_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officer_endorsements');
    }
};
