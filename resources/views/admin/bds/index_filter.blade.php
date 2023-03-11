<div class="row">
    <form method="post">

        <div class="form-group col-md-3 col-sm-4 col-xs-12">
            <label>Tên Sản phẩm</label>
            <input class="form-control" name="ten" placeholder="Tên sản phẩm" value="{!! $spFilterCriteria['ten'] !!}" />
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Giá tiền <sup>VNĐ</sup></label>
            {{--<input class="form-control inputmask-integer" name="ten" placeholder="Giá tiền" />--}}
            <select name="giatri" class="form-control select2">

                <option value="-1">------</option>

                @php( $giatri = $spFilterCriteria['giatri'] )

                @foreach($priceRanges as $key => $range)

                    @if ($key == $giatri && $giatri !== null)
                        @php( $selected = 'selected="selected"' )
                    @else
                        @php( $selected = '' )
                    @endif

                    <option value="{!! $key !!}" {!! $selected !!}>
                        từ {!! number_format($range['min']) !!} {!! $range['unitMin'] !!}

                        @if ($range['max'])
                            đến {!! number_format($range['max']) !!} {!! $range['unitMax'] !!}
                        @endif

                    </option>

                @endforeach
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>Loại BĐS</label>
            <select name="dm_loai_bds" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_loai_bds']) !!}">
                <option value="{!! $spFilterCriteria['dm_loai_bds'] !!}"></option>
            </select>
        </div>

        {{--<div class="form-group col-md-3 col-sm-4 col-xs-6">
            <label>Đơn vị hành chính</label>
            <select name="dm_hc_xa" class="form-control select2"
                    data-source="{!! route('admin.category', ['type' => 'dm_hc_xa']) !!}">
                <option value="{!! $spFilterCriteria['dm_hc_xa'] !!}"></option>
            </select>
        </div>--}}

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

        <div class="form-group col-md-2 col-sm-4 col-xs-6">
            <label>&nbsp;</label>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-filter"></i> Tìm sản phẩm
                </button>
            </div>
        </div>

        {!! csrf_field() !!}

    </form>
</div>