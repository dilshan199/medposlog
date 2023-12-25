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
        Schema::create('prescription', function (Blueprint $table) {
            $table->bigIncrements('prescription_id');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('patient_id')->on('patient')->onUpdate('cascade')->onDelete('set null');
            $table->date('check_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescription', function (Blueprint $table) {
            //
        });
    }
};
