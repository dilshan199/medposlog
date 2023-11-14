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
        Schema::create('patient', function (Blueprint $table) {
            $table->bigIncrements('patient_id');
            $table->string('title', 15)->nullable();
            $table->string('name', 255)->nullable(false);
            $table->string('nic', 12)->nullable(false);
            $table->integer('contact_no')->nullable(false);
            $table->integer('age')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            //
        });
    }
};
