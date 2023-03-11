<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDatabaseStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TABLE "dm_hc_tinh" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_hc_tinh_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_hc_huyen" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				"dm_hc_tinh" int NOT NULL,
				CONSTRAINT dm_hc_huyen_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_hc_xa" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				"dm_hc_huyen" int NOT NULL,
				CONSTRAINT dm_hc_xa_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_hc_duong" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_hc_duong_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_loai_bds" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_loai_bds_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_kieu_bds" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_kieu_bds_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_phap_ly" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_phap_ly_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_phap_ly_dat" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_phap_ly_dat_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_phap_ly_nha" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_phap_ly_nha_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_loai_anh" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_loai_anh_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_vlxd" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_vlxd_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_ket_cau" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_ket_cau_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_ha_tang" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_ha_tang_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "dm_don_vi" (
				"id" serial NOT NULL,
				"giatri" varchar(100) NOT NULL,
				"diengiai" varchar(200),
				"trangthai" int NOT NULL,
				CONSTRAINT dm_don_vi_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "sp" (
				"id" serial NOT NULL,
				"ten" varchar(200) NOT NULL,
				"diachi" varchar(100) NOT NULL,
				"giatri" float8 NOT NULL,
				"noidung" TEXT NOT NULL,
				"dm_loai_bds" int NOT NULL,
				"dm_kieu_bds" int NOT NULL,
				"dm_hc_duong" int NOT NULL,
				"dm_hc_xa" int NOT NULL,
				"created_at" TIMESTAMP NOT NULL,
				"updated_at" TIMESTAMP NOT NULL,
				CONSTRAINT sp_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "sp_hoso" (
				"id" serial NOT NULL,
				"id_sp" int NOT NULL,
				"pl_dm_phap_ly" int,
				"pl_dm_phap_ly_dat" int,
				"pl_dm_phap_ly_nha" int,
				"pl_sothua" varchar(20),
				"pl_tobando" varchar(20),
				"pl_mota" TEXT,
				"pl_hinhthucgiaodat" varchar(200),
				"pl_mucdichsudung" varchar(100),
				"pl_chusohuu" varchar(200),
				"pl_nguoidungvay" varchar(100),
				"vt_dm_hc_duong" int,
				"vt_huong" int,
				"vt_somattien" int,
				"vt_logioihienhuu" int,
				"vt_logioiquyhoach" int,
				"vt_mota" TEXT,
				"vt_longtitude" float8,
				"vt_latitude" float8,
				"nha_dtxd" float8,
				"nha_dtsd" float8,
				"nha_chatluongconlai" int,
				"nha_giaxaydung" float8,
				"nha_ketcau" varchar(200),
				"nha_sotang" int,
				"nha_phongkhach" int,
				"nha_phongngu" int,
				"nha_phongwc" int,
				"nha_namxaydung" int,
				"nha_dm_vlxd" int,
				"nha_thangmay" int,
				"nha_santhuong" int,
				"nha_chodexehoi" int,
				"nha_anninh" int,
				"dat_ngang" float8,
				"dat_dai" float8,
				"dat_nohau" float8,
				"dat_tongdientich" float8,
				"dg_hientrang" varchar(200),
				"dg_dacdiem" varchar(200),
				"dg_hieuqua" varchar(200),
				"dg_dm_ha_tang" int,
				"dg_yeutotanggia" TEXT,
				"dg_yeutogiamgia" TEXT,
				"tt_chuyennhuong" TEXT,
				"tt_phuongangia" TEXT,
				"kl_dongia" float8,
				"kl_thanhkhoan" varchar(200),
				"kl_coso" TEXT,
				"kl_luuy" TEXT,
				"ttlq_taisan" varchar(200),
				"ttlq_mucdich" varchar(200),
				"ttlq_donviyeucau" varchar(200),
				"ttlq_email" varchar(200),
				"ttlq_ngayyeucau" DATE,
				"ttlq_ngaynhanhoso" DATE,
				"ttlq_ngaydithamdinh" DATE,
				"ttlq_ngaylapbaocao" DATE,
				"ttlq_ngaylapbienban" DATE,
				"ttlq_dayduhoso" int,
				"tptd_dm_don_vi" int,
				"tptd_tructiep" varchar(200),
				"tptd_tructiep_cv" varchar(100),
				"tptd_thamgia" varchar(200),
				"tptd_thamgia_cv" varchar(100),
				"tptd_kiemsoat" varchar(200),
				"tptd_kiemsoat_cv" varchar(100),
				"ghichu" TEXT,
				CONSTRAINT sp_hoso_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "sp_hoso_anh" (
				"id" serial NOT NULL,
				"dm_loai_anh" int NOT NULL,
				"id_sp_hoso" int NOT NULL,
				"path" varchar(200) NOT NULL,
				CONSTRAINT sp_hoso_anh_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "sp_hoso_tep" (
				"id" serial NOT NULL,
				"id_sp_hoso" int NOT NULL,
				"path" varchar(200) NOT NULL,
				CONSTRAINT sp_hoso_tep_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "sp_hoso_nha_kientruc" (
				"id" serial NOT NULL,
				"id_sp_hoso" int NOT NULL,
				"dm_ketcau" int NOT NULL,
				"loai" varchar(100),
				"hientrang" varchar(100),
				"chatluong" varchar(100),
				CONSTRAINT sp_hoso_nha_kientruc_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			CREATE TABLE "sp_hoso_dat" (
				"id" serial NOT NULL,
				"id_sp_hoso" int NOT NULL,
				"loaidat" varchar(100) NOT NULL,
				"dientich" float8,
				"giathamdinh" float8,
				"tinhgia" float8,
				"ghichu" float8,
				CONSTRAINT sp_hoso_dat_pk PRIMARY KEY ("id")
			) WITH (
			  OIDS=FALSE
			);
			
			ALTER TABLE "dm_hc_huyen" ADD CONSTRAINT "dm_hc_huyen_fk0" FOREIGN KEY ("dm_hc_tinh") REFERENCES "dm_hc_tinh"("id");
			ALTER TABLE "dm_hc_xa" ADD CONSTRAINT "dm_hc_xa_fk0" FOREIGN KEY ("dm_hc_huyen") REFERENCES "dm_hc_huyen"("id");
			ALTER TABLE "sp" ADD CONSTRAINT "sp_fk0" FOREIGN KEY ("dm_loai_bds") REFERENCES "dm_loai_bds"("id");
			ALTER TABLE "sp" ADD CONSTRAINT "sp_fk1" FOREIGN KEY ("dm_kieu_bds") REFERENCES "dm_kieu_bds"("id");
			ALTER TABLE "sp" ADD CONSTRAINT "sp_fk2" FOREIGN KEY ("dm_hc_duong") REFERENCES "dm_hc_duong"("id");
			ALTER TABLE "sp" ADD CONSTRAINT "sp_fk3" FOREIGN KEY ("dm_hc_xa") REFERENCES "dm_hc_xa"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk0" FOREIGN KEY ("id_sp") REFERENCES "sp"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk1" FOREIGN KEY ("pl_dm_phap_ly") REFERENCES "dm_phap_ly"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk2" FOREIGN KEY ("pl_dm_phap_ly_dat") REFERENCES "dm_phap_ly_dat"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk3" FOREIGN KEY ("pl_dm_phap_ly_nha") REFERENCES "dm_phap_ly_nha"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk4" FOREIGN KEY ("vt_dm_hc_duong") REFERENCES "dm_hc_duong"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk5" FOREIGN KEY ("nha_dm_vlxd") REFERENCES "dm_vlxd"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk6" FOREIGN KEY ("dg_dm_ha_tang") REFERENCES "dm_ha_tang"("id");
			ALTER TABLE "sp_hoso" ADD CONSTRAINT "sp_hoso_fk7" FOREIGN KEY ("tptd_dm_don_vi") REFERENCES "dm_don_vi"("id");
			ALTER TABLE "sp_hoso_anh" ADD CONSTRAINT "sp_hoso_anh_fk0" FOREIGN KEY ("dm_loai_anh") REFERENCES "dm_loai_anh"("id");
			ALTER TABLE "sp_hoso_anh" ADD CONSTRAINT "sp_hoso_anh_fk1" FOREIGN KEY ("id_sp_hoso") REFERENCES "sp_hoso"("id");
			ALTER TABLE "sp_hoso_tep" ADD CONSTRAINT "sp_hoso_tep_fk0" FOREIGN KEY ("id_sp_hoso") REFERENCES "sp_hoso"("id");
			ALTER TABLE "sp_hoso_nha_kientruc" ADD CONSTRAINT "sp_hoso_nha_kientruc_fk0" FOREIGN KEY ("id_sp_hoso") REFERENCES "sp_hoso"("id");
			ALTER TABLE "sp_hoso_nha_kientruc" ADD CONSTRAINT "sp_hoso_nha_kientruc_fk1" FOREIGN KEY ("dm_ketcau") REFERENCES "dm_ket_cau"("id");
			ALTER TABLE "sp_hoso_dat" ADD CONSTRAINT "sp_hoso_dat_fk0" FOREIGN KEY ("id_sp_hoso") REFERENCES "sp_hoso"("id");
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::unprepareed('
			ALTER TABLE "dm_hc_huyen" DROP CONSTRAINT IF EXISTS "dm_hc_huyen_fk0";
			ALTER TABLE "dm_hc_xa" DROP CONSTRAINT IF EXISTS "dm_hc_xa_fk0";
			ALTER TABLE "sp" DROP CONSTRAINT IF EXISTS "sp_fk0";
			ALTER TABLE "sp" DROP CONSTRAINT IF EXISTS "sp_fk1";
			ALTER TABLE "sp" DROP CONSTRAINT IF EXISTS "sp_fk2";
			ALTER TABLE "sp" DROP CONSTRAINT IF EXISTS "sp_fk3";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk0";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk1";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk2";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk3";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk4";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk5";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk6";
			ALTER TABLE "sp_hoso" DROP CONSTRAINT IF EXISTS "sp_hoso_fk7";
			ALTER TABLE "sp_hoso_anh" DROP CONSTRAINT IF EXISTS "sp_hoso_anh_fk0";
			ALTER TABLE "sp_hoso_anh" DROP CONSTRAINT IF EXISTS "sp_hoso_anh_fk1";
			ALTER TABLE "sp_hoso_tep" DROP CONSTRAINT IF EXISTS "sp_hoso_tep_fk0";
			ALTER TABLE "sp_hoso_nha_kientruc" DROP CONSTRAINT IF EXISTS "sp_hoso_nha_kientruc_fk0";
			ALTER TABLE "sp_hoso_nha_kientruc" DROP CONSTRAINT IF EXISTS "sp_hoso_nha_kientruc_fk1";
			ALTER TABLE "sp_hoso_dat" DROP CONSTRAINT IF EXISTS "sp_hoso_dat_fk0";
			DROP TABLE IF EXISTS "dm_hc_tinh";
			DROP TABLE IF EXISTS "dm_hc_huyen";
			DROP TABLE IF EXISTS "dm_hc_xa";
			DROP TABLE IF EXISTS "dm_hc_duong";
			DROP TABLE IF EXISTS "dm_loai_bds";
			DROP TABLE IF EXISTS "dm_kieu_bds";
			DROP TABLE IF EXISTS "dm_phap_ly";
			DROP TABLE IF EXISTS "dm_phap_ly_dat";
			DROP TABLE IF EXISTS "dm_phap_ly_nha";
			DROP TABLE IF EXISTS "dm_loai_anh";
			DROP TABLE IF EXISTS "dm_vlxd";
			DROP TABLE IF EXISTS "dm_ket_cau";
			DROP TABLE IF EXISTS "dm_ha_tang";
			DROP TABLE IF EXISTS "dm_don_vi";
			DROP TABLE IF EXISTS "sp";
			DROP TABLE IF EXISTS "sp_hoso";
			DROP TABLE IF EXISTS "sp_hoso_anh";
			DROP TABLE IF EXISTS "sp_hoso_tep";
			DROP TABLE IF EXISTS "sp_hoso_nha_kientruc";
			DROP TABLE IF EXISTS "sp_hoso_dat";
	    ');
    }
}
