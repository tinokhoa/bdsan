<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(<<<'SQL'
            INSERT INTO "user_groups" ("name", "permissions")
VALUES ('Admin', 'C_LIST,C_ADD,C_EDIT,C_DELETE,R_LIST,R_ADD,R_EDIT,R_DELETE,R_PROFILE_ADD,R_PROFILE_DELETE,R_PROFILE_VIEW,U_LIST,U_ADD,U_EDIT,U_DELETE,U_PERMISSION');

            INSERT INTO "user_groups" ("name", "permissions")
VALUES ('Friend', 'R_LIST,R_ADD,R_EDIT,R_PROFILE_ADD,U_LIST,U_ADD,U_EDIT,U_DELETE');

            INSERT INTO "user_groups" ("name", "permissions")
VALUES ('Friend of Friend', 'R_PROFILE_VIEW');
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
            DELETE FROM "user_groups";
SQL
        );
    }
}
