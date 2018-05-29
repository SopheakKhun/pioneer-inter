<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0aab3a6976eRelationshipsToRequestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requestings', function(Blueprint $table) {
            if (!Schema::hasColumn('requestings', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '164712_5b0a9fbc40436')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('requestings', function(Blueprint $table) {
            if(Schema::hasColumn('requestings', 'user_id')) {
                $table->dropForeign('164712_5b0a9fbc40436');
                $table->dropIndex('164712_5b0a9fbc40436');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
