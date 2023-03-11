<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Hướng</label>
            <select name="vt_huong" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_huong']) !!}">
                <option value="{!! old('vt_huong', $sp_hoso->vt_huong) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Số mặt tiền</label>
            <input type="text" name="vt_somattien" class="form-control" value="{!! old('vt_somattien', $sp_hoso->vt_somattien) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Lộ giới hiện hữu (m)</label>
            <input type="text" name="vt_logioihienhuu" class="form-control inputmask-float" value="{!! old('vt_logioihienhuu', $sp_hoso->vt_logioihienhuu) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Lộ giới quy hoạch (m)</label>
            <input type="text" name="vt_logioiquyhoach" class="form-control inputmask-float" value="{!! old('vt_logioiquyhoach', $sp_hoso->vt_logioiquyhoach) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Mặt đường</label>
            <select name="vt_dm_hc_duong" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_hc_duong']) !!}">
                <option value="{!! old('vt_dm_hc_duong', $sp_hoso->vt_dm_hc_duong) !!}"></option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Latitude</label>
            <input type="text" id="vt_latitude" name="vt_latitude" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Longitude</label>
            <input type="text" id="vt_longtitude" name="vt_longtitude" class="form-control">
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Mô tả vị trí</label>
            <textarea type="text" name="vt_mota" class="form-control editor">{!! old('vt_mota', $sp_hoso->vt_mota) !!}</textarea>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <label>Tìm địa chỉ</label>
            <input type="text" id="vt_address" class="form-control">
        </div>
    </div>
    <div class="col-xs-12">
        <div id="vt_map" style="width: 100%; height: 400px;"></div>
        <?php
            $long = old('vt_longtitude', $sp_hoso->vt_longtitude);
            $lat = old('vt_latitude', $sp_hoso->vt_latitude);

            if (empty($long) && empty($lat)) {
                $lat = 10.0369368;
                $long = 105.7904502;
            }
        ?>
        <script>
            /* Contain Google Maps instance */
            var vt_map;

            /* Init map function */
            function initMap()
            {
                $('#vt_map').locationpicker({
                    radius: 0,
                    enableAutocomplete: true,
                    zoom: 12,
                    location: {
                        latitude: "{!! $lat !!}",
                        longitude: "{!! $long !!}"
                    },
                    inputBinding: {
                        latitudeInput: $('#vt_latitude'),
                        longitudeInput: $('#vt_longtitude'),
                        locationNameInput: $('#vt_address')
                    },
                    oninitialized: function(component) {
                        vt_map = $(component).locationpicker('map');
                    },
                });
            }

            /* Bidnd events when page loaded */
            window.addEventListener("load", function() {
                var tab_vitri = $('.nav-tabs a[href="#tab_vitri"]');

                /* Init map when tab_vitri active */
                tab_vitri.on('shown.bs.tab', function (e) {
                    initMap();
                });

                /* Init map if tab_vitri already activated */
                if (tab_vitri.attr('aria-expanded') == 'true') {
                    initMap();
                }
            });
        </script>
    </div>
</div>