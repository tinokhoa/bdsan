<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSpHosoDat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('sp_hoso_dat', function (Blueprint $table) {
	    	$table->text('ghichu')->change();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('sp_hoso_dat', function (Blueprint $table) {
		    $table->double('ghichu')->change();
	    });
    }
}
