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
            Schema::create('categories', function (Blueprint $table) {
                $table->id(); // Auto-incremental primary key
                $table->string('name'); // Category name
                $table->text('description')->nullable(); // Category description (nullable)
                $table->timestamps(); // Created_at and updated_at timestamps
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
