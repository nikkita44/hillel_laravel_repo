<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('editorial_changes', function (Blueprint $table) {
            $table->unsignedBigInteger('changeable_id');
            $table->string('changeable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('editorial_changes', function (Blueprint $table) {
            $table->dropColumn('changeable_id');
            $table->dropColumn('changeable_type');
        });
    }
};
