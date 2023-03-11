<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSpHosoAddTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(<<<'SQL'
            ALTER TABLE "sp_hoso"
            ADD "created_at" timestamp NULL,
            ADD "updated_at" timestamp NULL;
            COMMENT ON TABLE "sp_hoso" IS '';
SQL
        );
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(<<<'SQL'
            ALTER TABLE "sp_hoso"
            DROP "created_at",
            DROP "updated_at";
            COMMENT ON TABLE "sp_hoso" IS '';
SQL
        );
    }
}
