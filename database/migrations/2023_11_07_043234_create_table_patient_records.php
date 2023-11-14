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
        Schema::create('patient_records', function (Blueprint $table) {
            $table->bigIncrements('pr_id');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('patient_id')->on('patient')->onUpdate('cascade')->onDelete('set null');
            $table->string('sh', 15)->nullable();
            $table->string('kg', 15)->nullable();
            $table->string('bp', 15)->nullable();
            $table->string('allegic_status', 15)->nullable();
            $table->string('allegic_desc', 255)->nullable();
            $table->string('investigation', 255)->nullable();
            $table->string('next_day_investigation', 255)->nullable();
            $table->string('clinic_followup', 255)->nullable();
            $table->string('note', 3000)->nullable();
            $table->string('problem', 3000)->nullable();
            $table->date('check_date')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_records', function (Blueprint $table) {
            //
        });
    }
};
