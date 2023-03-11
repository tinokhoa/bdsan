<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
            <label>Đơn giá đất thẩm định (đồng / m<sup>2</sup>)</label>
            <input type="text" name="kl_dongia" class="form-control inputmask-float"
                   value="{!! old('kl_dongia', $sp_hoso->kl_dongia) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-8">
        <div class="form-group">
            <label>Tính thanh khoản</label>
            <input type="text" name="kl_thanhkhoan" class="form-control"
                   value="{!! old('kl_thanhkhoan', $sp_hoso->kl_thanhkhoan) !!}">
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Phương pháp thẩm định giá</label>
            <input type="text" name="kl_phuongphap" class="form-control"
                   value="{!! old('kl_phuongphap', $sp_hoso->kl_phuongphap) !!}">
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Cơ sở kết luận</label>
            <textarea type="text" name="kl_coso" class="form-control editor">{!! old('kl_coso', $sp_hoso->kl_coso) !!}</textarea>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Lưu ý</label>
            <textarea type="text" name="kl_luuy" class="form-control editor">{!! old('kl_luuy', $sp_hoso->kl_luuy) !!}</textarea>
        </div>
    </div>
</div>