<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label>Pháp lý</label>
            <select name="pl_dm_phap_ly" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_phap_ly']) !!}">
                <option value="{!! old('pl_dm_phap_ly', $sp_hoso->pl_dm_phap_ly) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label>Pháp lý đất</label>
            <select name="pl_dm_phap_ly_dat" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_phap_ly_dat']) !!}">
                <option value="{!! old('pl_dm_phap_ly_dat', $sp_hoso->pl_dm_phap_ly_dat) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label>Pháp lý nhà</label>
            <select name="pl_dm_phap_ly_nha" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_phap_ly_nha']) !!}">
                <option value="{!! old('pl_dm_phap_ly_nha', $sp_hoso->pl_dm_phap_ly_nha) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
            <label>Số thửa</label>
            <input type="text" name="pl_sothua" class="form-control" maxlength="20" value="{!! old('pl_sothua', $sp_hoso->pl_sothua) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
            <label>Tờ bản đồ số</label>
            <input type="text" name="pl_tobando" class="form-control" maxlength="20" value="{!! old('pl_tobando', $sp_hoso->pl_tobando) !!}">
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Mô tả pháp lý</label>
            <textarea type="text" name="pl_mota" class="form-control editor">{!! old('pl_mota', $sp_hoso->pl_mota) !!}</textarea>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label>Hình thức giao đất</label>
            <input type="text" name="pl_hinhthucgiaodat" class="form-control" maxlength="200" value="{!! old('pl_hinhthucgiaodat', $sp_hoso->pl_hinhthucgiaodat) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label>Mục đích sử dụng</label>
            <input type="text" name="pl_mucdichsudung" class="form-control" maxlength="100" value="{!! old('pl_mucdichsudung', $sp_hoso->pl_mucdichsudung) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label>Chủ sở hữu</label>
            <input type="text" name="pl_chusohuu" class="form-control" maxlength="200" value="{!! old('pl_chusohuu', $sp_hoso->pl_chusohuu) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label>Người đứng vay</label>
            <input type="text" name="pl_nguoidungvay" class="form-control" maxlength="100" value="{!! old('pl_nguoidungvay', $sp_hoso->pl_nguoidungvay) !!}">
        </div>
    </div>
</div>