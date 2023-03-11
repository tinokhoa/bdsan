<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AlterUsersAddTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(<<<'SQL'
            ALTER TABLE "users"
            ADD "created_at" timestamp NULL,
            ADD "updated_at" timestamp NULL;
            COMMENT ON TABLE "users" IS '';
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
            ALTER TABLE "users"
            DROP "created_at",
            DROP "updated_at";
            COMMENT ON TABLE "users" IS '';
SQL
        );
    }
}
