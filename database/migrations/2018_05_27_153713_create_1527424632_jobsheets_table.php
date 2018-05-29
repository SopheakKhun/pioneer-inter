<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527424632JobsheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('jobsheets')) {
            Schema::create('jobsheets', function (Blueprint $table) {
                $table->increments('id');
                $table->datetime('finish_date')->nullable();
                $table->string('diagnose')->nullable();
                $table->text('add_info')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobsheets');
    }
}
