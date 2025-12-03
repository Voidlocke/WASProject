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
        Schema::table('reviews', function (Blueprint $table) {
            $table->float('comfort',1 )->nullable()->after('rating');
            $table->float('staff', 1)->nullable()->after('comfort');
            $table->float('facilities', 1)->nullable()->after('staff');
            $table->float('value', 1)->nullable()->after('facilities');
            $table->string('property_photos')->nullable()->after('review_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('comfort');
            $table->dropColumn('staff');
            $table->dropColumn('facilities');
            $table->dropColumn('value');
            $table->dropColumn('property_photos');
        });
    }
};
