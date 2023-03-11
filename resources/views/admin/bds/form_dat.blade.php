<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Ngang (m)</label>
            <input type="text" name="dat_ngang" class="form-control inputmask-float" value="{!! old('dat_ngang', $sp_hoso->dat_ngang) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Dài (m)</label>
            <input type="text" name="dat_dai" class="form-control inputmask-float" value="{!! old('dat_dai', $sp_hoso->dat_dai) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Nở hậu (m)</label>
            <input type="text" name="dat_nohau" class="form-control inputmask-float" value="{!! old('dat_nohau', $sp_hoso->dat_nohau) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Tổng diện tích (m<sup>2</sup>)</label>
            <input type="text" name="dat_tongdientich" class="form-control inputmask-float" value="{!! old('dat_tongdientich', $sp_hoso->dat_tongdientich) !!}">
        </div>
    </div>
</div>

<div class="panel panel-info">
    <div class="panel-heading">
        CHI TIẾT ĐẤT
        @if (\Permission::has('R_EDIT') || \Permission::has('R_ADD'))
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-xs" id="dat_ct_add">
                    <i class="fa fa-plus"></i> Thêm
                </button>
            </div>
        @endif
    </div>
    <div class="panel-body" id="dat_ct_container">

    </div>
</div>

<script>
    var dat_ct_template = '<div class="row">\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Loại đất</label>\n' +
        '                    <input type="text" name="dat_ct_loaidat[]" class="form-control" value="{dat_ct_loaidat}">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Diện tích (m<sup>2</sup>)</label>\n' +
        '                    <input type="text" name="dat_ct_dientich[]" class="form-control inputmask-float" value="{dat_ct_dientich}">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Giá thẩm định (đồng / m<sup>2</sup>)</label>\n' +
        '                    <input type="text" name="dat_ct_giathamdinh[]" class="form-control inputmask-float" value="{dat_ct_giathamdinh}">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Ghi chú</label>\n' +
        '                    <input type="text" name="dat_ct_ghichu[]" class="form-control" value="{dat_ct_ghichu}">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Tính giá (%)</label>\n' +
        '                    <input type="text" name="dat_ct_tinhgia[]" class="form-control inputmask-float" value="{dat_ct_tinhgia}">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>&nbsp;</label>\n' +
        '                    <div>\n' +
        '                        <button class="btn btn-danger btn-sm btn-delete">\n' +
        '                            <i class="fa fa-trash"></i>\n' +
        '                        </button>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>';

    window.addEventListener("load", function() {
        var selBtn = '#dat_ct_add';
        var selContainer = '#dat_ct_container';

        function addDat(data) {
            var newItem = dat_ct_template;

            for (var k in data) {
                newItem = newItem.replace('{' + k + '}', data[k]);
            }

            newItem = $(newItem);
            $(selContainer).append(newItem);

            newItem.find('[data-source]').each(function(idx) {
                initDataSource(this);
            });

            newItem.find('.btn-delete').each(function(idx) {
                $(this).click(function() {
                    if (confirm('Bạn có chắc chắn muốn xoá không?')) {
                        $(this).parents('.row').remove();
                    }
                });
            });
        }

        $(selBtn).click(function() {
            addDat({
                dat_ct_loaidat: '',
                dat_ct_dientich: '',
                dat_ct_giathamdinh: '',
                dat_ct_ghichu: '',
                dat_ct_tinhgia: '',
            });
        });

        <?php
            $nha_kientruc = $sp_hoso->SpHoSoDat()->get();

            foreach ($nha_kientruc as $item) {
                ?>
                addDat({
                    dat_ct_loaidat: '{!! $item->loaidat !!}',
                    dat_ct_dientich: '{!! $item->dientich !!}',
                    dat_ct_giathamdinh: '{!! $item->giathamdinh !!}',
                    dat_ct_ghichu: '{!! $item->ghichu !!}',
                    dat_ct_tinhgia: '{!! $item->tinhgia !!}',
                });
                <?php
            }
        ?>
    });
</script>