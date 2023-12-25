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
        Schema::create('prescription_item', function (Blueprint $table) {
            $table->bigIncrements('prescription_raw_id');
            $table->unsignedBigInteger('prescription_id')->nullable();
            $table->foreign('prescription_id')->references('prescription_id')->on('prescription')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('drug_id')->nullable();
            $table->foreign('drug_id')->references('drug_id')->on('drugs')->onUpdate('cascade')->onDelete('set null');
            $table->string('drug_name', 50)->nullable();
            $table->string('dose', 15)->nullable();
            $table->string('frequency', 15)->nullable();
            $table->string('days', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_item');
    }
};
