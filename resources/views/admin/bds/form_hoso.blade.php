<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <label>Tiêu đề / Tên BĐS <sup>*</sup></label>
            <input type="text" name="sp_ten" class="form-control" maxlength="200" required value="{!! old('sp_ten', $sp->ten) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-md-3 col-sm-6">
        <div class="form-group">
            <label>Loại BĐS <sup>*</sup></label>
            <select name="sp_dm_loai_bds" class="form-control select2" required data-source="{!! route('admin.category', ['type' => 'dm_loai_bds']) !!}">
                <option value="{!! old('sp_dm_loai_bds', $sp->dm_loai_bds) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-md-3 col-sm-6">
        <div class="form-group">
            <label>Kiểu BĐS <sup>*</sup></label>
            <select name="sp_dm_kieu_bds" class="form-control select2" required data-source="{!! route('admin.category', ['type' => 'dm_kieu_bds']) !!}">
                <option value="{!! old('sp_dm_kieu_bds', $sp->dm_kieu_bds) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Giá trị (đồng) <sup>*</sup></label>
            <input type="text" name="sp_giatri" class="form-control inputmask-integer" required value="{!! old('sp_giatri', $sp->giatri) !!}">
        </div>
    </div>
{{--</div>--}}

{{--<div class="panel panel-info">
    <div class="panel-heading">ĐỊA CHỈ</div>
    <div class="panel-body">--}}
{{--<div class="row">--}}
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label>Địa chỉ <sup>*</sup></label>
            <input type="text" name="sp_diachi" class="form-control" maxlength="100" value="{!! old('sp_diachi', $sp->diachi) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label>Đường <sup>*</sup></label>
            <select name="sp_dm_hc_duong" class="form-control select2" required data-source="{!! route('admin.category', ['type' => 'dm_hc_duong']) !!}">
                <option value="{!! old('sp_dm_hc_duong', $sp->dm_hc_duong) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label>Tỉnh / TP</label>
            <select id="dm_hc_tinh" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_tinh']) !!}">
                @if ($sp->dm_hc_xa)
                    <option value="{!! $sp->DmHcXa()->first()->DmHcHuyen()->first()->DmHcTinh()->first()->id !!}"></option>
                @else
                    <option></option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label>Quận / Huyện</label>
            <select id="dm_hc_huyen" class="form-control select2"
                    data-source-mode="short" data-source-parent="#dm_hc_tinh"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_huyen']) !!}">
                @if ($sp->dm_hc_xa)
                    <option value="{!! $sp->DmHcXa()->first()->DmHcHuyen()->first()->id !!}"></option>
                @else
                    <option></option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label>Xã / Phường <sup>*</sup></label>
            <select name="sp_dm_hc_xa" class="form-control select2" required
                    data-source-mode="short" data-source-parent="#dm_hc_huyen"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_xa']) !!}">
                <option value="{!! old('sp_dm_hc_xa', $sp->dm_hc_xa) !!}"></option>
            </select>
        </div>
    </div>
</div>
    {{--</div>
</div>--}}

<div class="panel panel-info">
    <div class="panel-heading">THÔNG TIN THẨM ĐỊNH</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Tài sản thẩm định</label>
                    <input type="text" name="ttlq_taisan" class="form-control" maxlength="200" value="{!! old('ttlq_taisan', $sp_hoso->ttlq_taisan) !!}">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Mục đích thẩm định</label>
                    <input type="text" name="ttlq_mucdich" class="form-control" maxlength="200" value="{!! old('ttlq_mucdich', $sp_hoso->ttlq_mucdich) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <label>Đơn vị yêu cầu</label>
                    <input type="text" name="ttlq_donviyeucau" class="form-control" maxlength="200" value="{!! old('ttlq_donviyeucau', $sp_hoso->ttlq_donviyeucau) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <label>Email nhận kết quả</label>
                    <input type="text" name="ttlq_email" class="form-control" maxlength="200" value="{!! old('ttlq_email', $sp_hoso->ttlq_email) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label>Ngày nhận yêu cầu</label>
                    <input type="text" name="ttlq_ngayyeucau" class="form-control datepicker" value="{!! old('ttlq_ngayyeucau', $sp_hoso->ttlq_ngayyeucau) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label>Ngày nhận hồ sơ</label>
                    <input type="text" name="ttlq_ngaynhanhoso" class="form-control datepicker" value="{!! old('ttlq_ngaynhanhoso', $sp_hoso->ttlq_ngaynhanhoso) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label>Ngày đi thẩm định</label>
                    <input type="text" name="ttlq_ngaydithamdinh" class="form-control datepicker" value="{!! old('ttlq_ngaydithamdinh', $sp_hoso->ttlq_ngaydithamdinh) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label>Ngày lập báo cáo khảo sát</label>
                    <input type="text" name="ttlq_ngaylapbaocao" class="form-control datepicker" value="{!! old('ttlq_ngaylapbaocao', $sp_hoso->ttlq_ngaylapbaocao) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label>Ngày lập biên bản</label>
                    <input type="text" name="ttlq_ngaylapbienban" class="form-control datepicker" value="{!! old('ttlq_ngaylapbienban', $sp_hoso->ttlq_ngaylapbienban) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label>Đã đầy đủ hồ sơ?</label>
                    <select name="ttlq_dayduhoso" class="form-control select2">
                        <option value="0" {!! (old('ttlq_dayduhoso', $sp_hoso->ttlq_dayduhoso) == 0) ? 'selected="selected"': '' !!}>Chưa đầy đủ</option>
                        <option value="1" {!! (old('ttlq_dayduhoso', $sp_hoso->ttlq_dayduhoso) == 1) ? 'selected="selected"': '' !!}>Đã đầy đủ</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-info">
    <div class="panel-heading">THÀNH PHẦN THẨM ĐỊNH</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Đơn vị thẩm định</label>
                    <select name="tptd_dm_don_vi" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_don_vi']) !!}">
                        <option value="{!! old('tptd_dm_don_vi', $sp_hoso->tptd_dm_don_vi) !!}"></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Trực tiếp thẩm định</label>
                    <input type="text" name="tptd_tructiep" class="form-control" maxlength="200" value="{!! old('tptd_tructiep', $sp_hoso->tptd_tructiep) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Chức vụ</label>
                    <input type="text" name="tptd_tructiep_cv" class="form-control" maxlength="100" value="{!! old('tptd_tructiep_cv', $sp_hoso->tptd_tructiep_cv) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Thành viên tham gia</label>
                    <input type="text" name="tptd_thamgia" class="form-control" maxlength="200" value="{!! old('tptd_thamgia', $sp_hoso->tptd_thamgia) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Chức vụ</label>
                    <input type="text" name="tptd_thamgia_cv" class="form-control" maxlength="100" value="{!! old('tptd_thamgia_cv', $sp_hoso->tptd_thamgia_cv) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Thành viên kiểm soát</label>
                    <input type="text" name="tptd_kiemsoat" class="form-control" maxlength="200" value="{!! old('tptd_kiemsoat', $sp_hoso->tptd_kiemsoat) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Chức vụ</label>
                    <input type="text" name="tptd_kiemsoat_cv" class="form-control" maxlength="100" value="{!! old('tptd_kiemsoat_cv', $sp_hoso->tptd_kiemsoat_cv) !!}">
                </div>
            </div>
        </div>
    </div>
</div>