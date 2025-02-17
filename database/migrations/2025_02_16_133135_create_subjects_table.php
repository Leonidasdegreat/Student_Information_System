<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
        Schema::create('subjects', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Subject name
            $table->string('code')->unique(); // Subject code (e.g., MATH101)
            $table->timestamps(); // Created at and updated at timestamps
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
