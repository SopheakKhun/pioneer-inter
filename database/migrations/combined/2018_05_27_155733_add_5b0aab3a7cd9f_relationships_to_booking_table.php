<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0aab3a7cd9fRelationshipsToBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function(Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '164713_5b0aa37e64b42')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bookings', 'requesting_id')) {
                $table->integer('requesting_id')->unsigned()->nullable();
                $table->foreign('requesting_id', '164713_5b0aa37e73b33')->references('id')->on('requestings')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function(Blueprint $table) {
            if(Schema::hasColumn('bookings', 'user_id')) {
                $table->dropForeign('164713_5b0aa37e64b42');
                $table->dropIndex('164713_5b0aa37e64b42');
                $table->dropColumn('user_id');
            }
            if(Schema::hasColumn('bookings', 'requesting_id')) {
                $table->dropForeign('164713_5b0aa37e73b33');
                $table->dropIndex('164713_5b0aa37e73b33');
                $table->dropColumn('requesting_id');
            }
            
        });
    }
}
