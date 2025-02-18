<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First check if the tables exist before trying to drop them
        if (Schema::hasTable('bookinghistory')) {
            // Drop foreign key first if it exists
            Schema::table('bookinghistory', function (Blueprint $table) {
                // Check if the foreign key exists before dropping
                if (Schema::hasColumn('bookinghistory', 'bookcourts_id')) {
                    $table->dropForeign(['bookcourts_id']);
                }
            });
            // Then drop the table
            Schema::dropIfExists('bookinghistory');
        }

        if (Schema::hasTable('bookcourts')) {
            // Drop foreign key first if it exists
            Schema::table('bookcourts', function (Blueprint $table) {
                // Check if the foreign key exists before dropping
                if (Schema::hasColumn('bookcourts', 'venue_id')) {
                    $table->dropForeign(['venue_id']);
                }
            });
            // Then drop the table
            Schema::dropIfExists('bookcourts');
        }
    }

    public function down()
    {
        // If you need to recreate the tables, put the creation code here
        // But in this case, we don't need to recreate them
    }
}; 