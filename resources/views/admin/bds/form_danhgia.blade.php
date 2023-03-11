<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <label>Hiện trạng sử dụng</label>
            <input type="text" name="dg_hientrang" class="form-control"
                   value="{!! old('dg_hientrang', $sp_hoso->dg_hientrang) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <label>Hạ tầng kỹ thuật</label>
            <select name="dg_dm_ha_tang" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_ha_tang']) !!}">
                <option value="{!! old('dg_dm_ha_tang', $sp_hoso->dg_dm_ha_tang) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <label>Đặc điểm khu vực</label>
            <input type="text" name="dg_dacdiem" class="form-control"
                   value="{!! old('dg_dacdiem', $sp_hoso->dg_dacdiem) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <label>Sử dụng hiệu quả</label>
            <input type="text" name="dg_hieuqua" class="form-control"
                   value="{!! old('dg_hieuqua', $sp_hoso->dg_hieuqua) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="form-group">
            <label>Tiện kinh doanh?</label>
            <select name="dg_tienkinhdoanh" class="form-control select2">
                <option value="0"
                        {!! (old('dg_tienkinhdoanh', $sp_hoso->dg_tienkinhdoanh) == 0) ? 'selected="selected"': '' !!}>Không</option>
                <option value="1"
                        {!! (old('dg_tienkinhdoanh', $sp_hoso->dg_tienkinhdoanh) == 1) ? 'selected="selected"': '' !!}>Có</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="form-group">
            <label>Tiện làm văn phòng?</label>
            <select name="dg_tienlamvanphong" class="form-control select2">
                <option value="0"
                        {!! (old('dg_tienlamvanphong', $sp_hoso->dg_tienlamvanphong) == 0) ? 'selected="selected"': '' !!}>Không</option>
                <option value="1"
                        {!! (old('dg_tienlamvanphong', $sp_hoso->dg_tienlamvanphong) == 1) ? 'selected="selected"': '' !!}>Có</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="form-group">
            <label>Tiện làm nhà xưởng?</label>
            <select name="dg_tienlamnhaxuong" class="form-control select2">
                <option value="0"
                        {!! (old('dg_tienlamnhaxuong', $sp_hoso->dg_tienlamnhaxuong) == 0) ? 'selected="selected"': '' !!}>Không</option>
                <option value="1"
                        {!! (old('dg_tienlamnhaxuong', $sp_hoso->dg_tienlamnhaxuong) == 1) ? 'selected="selected"': '' !!}>Có</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="form-group">
            <label>Tiện làm sinh thái?</label>
            <select name="dg_tienlamsinhthai" class="form-control select2">
                <option value="0"
                        {!! (old('dg_tienlamsinhthai', $sp_hoso->dg_tienlamsinhthai) == 0) ? 'selected="selected"': '' !!}>Không</option>
                <option value="1"
                        {!! (old('dg_tienlamsinhthai', $sp_hoso->dg_tienlamsinhthai) == 1) ? 'selected="selected"': '' !!}>Có</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Các yếu tố làm tăng giá trị</label>
            <textarea type="text" name="dg_yeutotanggia" class="form-control editor">{!! old('dg_yeutotanggia', $sp_hoso->dg_yeutotanggia) !!}</textarea>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Các yếu tố làm giảm giá trị</label>
            <textarea type="text" name="dg_yeutogiamgia" class="form-control editor">{!! old('dg_yeutogiamgia', $sp_hoso->dg_yeutogiamgia) !!}</textarea>
        </div>
    </div>
</div>