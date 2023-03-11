<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSpHoso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sp_hoso', function (Blueprint $table) {
        	$table->integer('dg_tienkinhdoanh')->nullable();
        	$table->integer('dg_tienlamvanphong')->nullable();
        	$table->integer('dg_tienlamnhaxuong')->nullable();
        	$table->integer('dg_tienlamsinhthai')->nullable();
        	$table->string('kl_phuongphap', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('sp_hoso', function (Blueprint $table) {
	    	$table->dropColumn('dg_tienkinhdoanh');
	    	$table->dropColumn('dg_tienlamvanphong');
	    	$table->dropColumn('dg_tienlamnhaxuong');
	    	$table->dropColumn('dg_tienlamsinhthai');
	    	$table->dropColumn('kl_phuongphap');
	    });
    }
}
