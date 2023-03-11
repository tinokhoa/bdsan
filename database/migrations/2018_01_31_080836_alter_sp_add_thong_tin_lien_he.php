<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSpAddThongTinLienHe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(<<<'SQL'
            ALTER TABLE "sp"
            ADD "nguoilienhe" character varying(100) NULL,
            ADD "sdtlienhe" character varying(100) NULL;
            COMMENT ON TABLE "sp" IS '';
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
            ALTER TABLE "sp"
            DROP "nguoilienhe",
            DROP "sdtlienhe";
            COMMENT ON TABLE "sp" IS '';
SQL
        );
    }
}
