<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSpHosoAnh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(<<<'SQL'

        
            ALTER TABLE "sp_hoso_anh"
            ALTER "dm_loai_anh" TYPE integer,
            ALTER "dm_loai_anh" DROP DEFAULT,
            ALTER "dm_loai_anh" DROP NOT NULL;
            COMMENT ON COLUMN "sp_hoso_anh"."dm_loai_anh" IS '';
            COMMENT ON TABLE "sp_hoso_anh" IS '';
        
        
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

            ALTER TABLE "sp_hoso_anh"
            ALTER "dm_loai_anh" TYPE integer,
            ALTER "dm_loai_anh" DROP DEFAULT,
            ALTER "dm_loai_anh" SET NOT NULL;
            COMMENT ON COLUMN "sp_hoso_anh"."dm_loai_anh" IS '';
            COMMENT ON TABLE "sp_hoso_anh" IS '';

SQL
);
    }
}
