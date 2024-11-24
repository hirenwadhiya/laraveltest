<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title', 255)->change();
            $table->string('slug', 255)->change();
            $table->string('author', 255)->change();
            $table->index(['title', 'slug']);
        });
        Schema::table('sources', function (Blueprint $table) {
            $table->index(['name']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->index(['name']);
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['title', 'slug']);
        });
        Schema::table('sources', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });
    }
};
