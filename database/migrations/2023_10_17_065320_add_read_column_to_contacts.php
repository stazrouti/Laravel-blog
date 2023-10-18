<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReadColumnToContacts extends Migration
{
    public function up()
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->boolean('read')->default(false); // 'read' column with a default value of false
        });
    }

    public function down()
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn('read');
        });
    }
}
