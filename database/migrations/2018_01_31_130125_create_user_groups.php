<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(<<<'SQL'
            CREATE TABLE "user_groups" (
                "id" serial NOT NULL,
                "name" varchar(100) NOT NULL,
                "permissions" TEXT,
                CONSTRAINT user_groups_pk PRIMARY KEY ("id")
            ) WITH (
              OIDS=FALSE
            );
            
            ALTER TABLE "users"
            ADD "user_group" integer NULL;
            COMMENT ON TABLE "users" IS '';
            
            ALTER TABLE "users" ADD CONSTRAINT "users_fk0" FOREIGN KEY ("user_group") REFERENCES "user_groups"("id");
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
            DROP CONSTRAINT "users_fk0";
            
            ALTER TABLE "users"
            DROP "user_group";
            COMMENT ON TABLE "users" IS '';
            
            DROP TABLE "user_groups";
SQL
        );
    }
}
