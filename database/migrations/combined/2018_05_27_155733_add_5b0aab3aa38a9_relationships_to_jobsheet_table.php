<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0aab3aa38a9RelationshipsToJobsheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobsheets', function(Blueprint $table) {
            if (!Schema::hasColumn('jobsheets', 'booking_id')) {
                $table->integer('booking_id')->unsigned()->nullable();
                $table->foreign('booking_id', '164714_5b0aa67c8b4c8')->references('id')->on('bookings')->onDelete('cascade');
                }
                if (!Schema::hasColumn('jobsheets', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '164714_5b0aa67c97336')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('jobsheets', 'requesting_id')) {
                $table->integer('requesting_id')->unsigned()->nullable();
                $table->foreign('requesting_id', '164714_5b0aa67ca30d0')->references('id')->on('requestings')->onDelete('cascade');
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
        Schema::table('jobsheets', function(Blueprint $table) {
            if(Schema::hasColumn('jobsheets', 'booking_id')) {
                $table->dropForeign('164714_5b0aa67c8b4c8');
                $table->dropIndex('164714_5b0aa67c8b4c8');
                $table->dropColumn('booking_id');
            }
            if(Schema::hasColumn('jobsheets', 'user_id')) {
                $table->dropForeign('164714_5b0aa67c97336');
                $table->dropIndex('164714_5b0aa67c97336');
                $table->dropColumn('user_id');
            }
            if(Schema::hasColumn('jobsheets', 'requesting_id')) {
                $table->dropForeign('164714_5b0aa67ca30d0');
                $table->dropIndex('164714_5b0aa67ca30d0');
                $table->dropColumn('requesting_id');
            }
            
        });
    }
}
