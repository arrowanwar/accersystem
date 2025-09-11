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
        Schema::create('field_office_ers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hq_er_id');
            $table->unsignedBigInteger('officer_id');
            $table->unsignedBigInteger('officer_endorsement_id');
            $table->unsignedBigInteger('accused_service_info_id')->nullable();
            $table->unsignedBigInteger('accused_present_add_info_id')->nullable();
            $table->unsignedBigInteger('accused_permanent_add_info_id')->nullable();
            $table->timestamps();
            $table->foreign('hq_er_id')->references('id')->on('hq_ers')->cascadeOnUpdate()->cascadeOnDelete();
              $table->foreign('officer_id')->references('id')->on('officers')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('officer_endorsement_id')->references('id')->on('officer_endorsements')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('accused_service_info_id')->references('id')->on('accused_service_infos')->nullOnDelete();
            $table->foreign('accused_present_add_info_id')->references('id')->on('accused_present_add_infos')->nullOnDelete();
            $table->foreign('accused_permanent_add_info_id')->references('id')->on('accused_permanent_add_infos')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_office_ers');
    }
};
