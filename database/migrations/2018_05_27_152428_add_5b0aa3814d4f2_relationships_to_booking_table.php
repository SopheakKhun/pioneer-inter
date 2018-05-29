<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0aa3814d4f2RelationshipsToBookingTable extends Migration
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
            
        });
    }
}
