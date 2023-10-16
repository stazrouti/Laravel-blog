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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('user_id')->nullable(); // If you want to associate visits with users
            $table->string('ip_address', 45); // IPv6 support
            $table->timestamp('visit_date');
            $table->timestamps();
            
            // Define foreign key constraints if 'user_id' is used
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visite');
    }
};
