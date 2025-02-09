<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumns('products', ['size', 'color', 'material', 'brand'])) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('size')->nullable()->after('category');
                $table->string('color')->nullable()->after('size');
                $table->string('material')->nullable()->after('color');
                $table->string('brand')->nullable()->after('material');
            });
        }
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['size', 'color', 'material', 'brand']);
        });
    }
}; 