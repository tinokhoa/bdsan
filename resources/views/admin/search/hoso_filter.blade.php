<div class="row">
    <form method="post">

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Loại BĐS</label>
            <select name="dm_loai_bds" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_loai_bds']) !!}">
                <option value="{!! $spFilterCriteria['dm_loai_bds'] !!}"></option>
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Kiểu BĐS</label>
            <select name="dm_kieu_bds" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_kieu_bds']) !!}">
                <option value="{!! $spFilterCriteria['dm_kieu_bds'] !!}"></option>
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Tỉnh / TP</label>
            <select name="dm_hc_tinh" id="dm_hc_tinh" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_tinh']) !!}">
                <option value="{!! $spFilterCriteria['dm_hc_tinh'] !!}"></option>
            </select>
        </div>
        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Q. / Huyện</label>
            <select name="dm_hc_huyen" id="dm_hc_huyen" class="form-control select2"
                    data-source-mode="short" data-source-parent="#dm_hc_tinh"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_huyen']) !!}">
                <option value="{!! $spFilterCriteria['dm_hc_huyen'] !!}"></option>
            </select>
        </div>
        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Xã / P.</label>
            <select name="dm_hc_xa" class="form-control select2"
                    data-source-mode="short" data-source-parent="#dm_hc_huyen"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_xa']) !!}">
                <option value="{!! $spFilterCriteria['dm_hc_xa'] !!}"></option>
            </select>
        </div>

        {{--<div class="form-group col-md-4 col-sm-4 col-xs-6">
            <label>Đơn vị hành chính</label>
            <select name="dm_hc_xa" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_xa']) !!}">
                <option value="{!! $spFilterCriteria['dm_hc_xa'] !!}"></option>
            </select>
        </div>--}}

        <div class="form-group col-md-1 col-sm-4 col-xs-6">
            <label>DT từ</label>
            <input class="form-control inputmask-integer" name="dien_tich_min" value="{!! $spFilterCriteria['dien_tich_min'] !!}" />
        </div>

        <div class="form-group col-md-1 col-sm-4 col-xs-6">
            <label>DT đến</label>
            <input class="form-control inputmask-integer" name="dien_tich_max" value="{!! $spFilterCriteria['dien_tich_max'] !!}" />
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Số tầng</label>
            <select class="form-control select2" name="nha_sotang">
                <option value="">------</option>
                @foreach (['1','2','3','4','5','6', '7+'] as $v)
                    <option value="{!! $v !!}" {!! ($spFilterCriteria['nha_sotang'] == $v) ? 'selected="selected"' : '' !!}>
                        {!! $v !!} tầng
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Giá trị</label>
            <select class="form-control select2" name="giatri">
                <option value="">------</option>

                @for ($v = 250; $v <= 6000; $v = $v + 100)
                    <option value="{!! $v !!}" {!! ($spFilterCriteria['giatri'] == $v) ? 'selected="selected"' : '' !!}>

                        @php
                            $ty = floor($v / 1000);
                            $trieu = $v % 1000;
                        @endphp

                        > @if ($ty > 0) {!! $ty !!} tỷ @endif
                        {!! $trieu !!} triệu

                    </option>
                @endfor

                <option value="6000" {!! ($spFilterCriteria['giatri'] == 6000) ? 'selected="selected"' : '' !!}>
                    6 tỷ
                </option>

            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Chỗ đậu ô tô</label>
            <select class="form-control select2" name="nha_chodexehoi">
                <option value="">------</option>
                <option value="0" {!! ($spFilterCriteria['nha_chodexehoi'] === '0') ? 'selected="selected"' : '' !!}>Không</option>
                <option value="1" {!! ($spFilterCriteria['nha_chodexehoi'] === '1') ? 'selected="selected"' : '' !!}>Có</option>
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Số toilet</label>
            <select class="form-control select2" name="nha_phongwc">
                <option value="">------</option>
                @foreach (['1','2','3','4','5'] as $v)
                    <option value="{!! $v !!}" {!! ($spFilterCriteria['nha_phongwc'] == $v) ? 'selected="selected"' : '' !!}>
                        {!! $v !!}+
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Lộ giới</label>
            <select class="form-control select2" name="vt_logioihienhuu">
                <option value="">------</option>

                @for ($v = 5; $v <= 40; $v++)
                    <option value="{!! $v !!}" {!! ($spFilterCriteria['vt_logioihienhuu'] == $v) ? 'selected="selected"' : '' !!}>
                        > {!! $v !!}m
                    </option>
                @endfor

            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>&nbsp;</label>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-filter"></i> Tìm hồ sơ
                </button>
            </div>
        </div>

        {!! csrf_field() !!}

    </form>
</div>