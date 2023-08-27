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
        Schema::table('users', function (Blueprint $table) {
            // DB::statement('ALTER TABLE users CHANGE name username VARCHAR(255)'); 
            // I did this code above because renameColumn has errors
            // It says sql syntax error, the renameColumn outputs "PDO::prepare("alter table `users` rename column `name` to `username`")"
            // But it worked when I type the DB::statement above
            $table->renameColumn('name','username'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('username','name');
        });
    }
};
