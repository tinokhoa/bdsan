<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmHuong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(<<<'SQL'

            CREATE TABLE "dm_huong" (
                "id" serial NOT NULL,
                "giatri" varchar(100) NOT NULL,
                "diengiai" varchar(200),
                "trangthai" int NOT NULL,
                CONSTRAINT dm_huong_pk PRIMARY KEY ("id")
            ) WITH (
              OIDS=FALSE
            );
            
            ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk8" FOREIGN KEY ("vt_huong") REFERENCES "dm_huong"("id");
        
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
        
            ALTER TABLE "sp_hoso" DROP CONSTRAINT "sp_hoso_fk8";
            DROP TABLE IF EXISTS "dm_huong";
        
SQL
);
    }
}
