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
        Schema::create('accused_service_infos', function (Blueprint $table) {
             $table->id();
            $table->string('name');
            $table->string('post')->nullable();
            $table->string('office_full_name')->nullable();
            $table->string('office_short_name')->nullable();
            $table->string('thana')->nullable();
            $table->string('district')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accused_service_infos');
    }
};
