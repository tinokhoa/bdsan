<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Diện tích xây dựng (m<sup>2</sup>)</label>
            <input type="text" name="nha_dtxd" class="form-control inputmask-float" value="{!! old('nha_dtxd', $sp_hoso->nha_dtxd) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Diện tích sử dụng (m<sup>2</sup>)</label>
            <input type="text" name="nha_dtsd" class="form-control inputmask-float" value="{!! old('nha_dtsd', $sp_hoso->nha_dtsd) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Chất lượng còn lại (%)</label>
            <input type="text" name="nha_chatluongconlai" class="form-control inputmask-float" value="{!! old('nha_chatluongconlai', $sp_hoso->nha_chatluongconlai) !!}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Giá xây dựng ước tính (đồng / m<sup>2</sup>)</label>
            <input type="text" name="nha_giaxaydung" class="form-control inputmask-float" value="{!! old('nha_giaxaydung', $sp_hoso->nha_giaxaydung) !!}">
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label>Kết cấu xây dựng</label>
            <input type="text" name="nha_ketcau" class="form-control" maxlength="200" value="{!! old('nha_ketcau', $sp_hoso->nha_ketcau) !!}">
        </div>
    </div>
</div>

<div class="panel panel-info">
    <div class="panel-heading">THÔNG TIN NHÀ Ở</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Số tầng</label>
                    <input type="text" name="nha_sotang" class="form-control inputmask-integer" value="{!! old('nha_sotang', $sp_hoso->nha_sotang) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Số phòng khách</label>
                    <input type="text" name="nha_phongkhach" class="form-control inputmask-integer" value="{!! old('nha_phongkhach', $sp_hoso->nha_phongkhach) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Số phòng ngủ</label>
                    <input type="text" name="nha_phongngu" class="form-control inputmask-integer" value="{!! old('nha_phongngu', $sp_hoso->nha_phongngu) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Số nhà vệ sinh</label>
                    <input type="text" name="nha_phongwc" class="form-control inputmask-integer" value="{!! old('nha_phongwc', $sp_hoso->nha_phongwc) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Năm xây dựng</label>
                    <input type="text" name="nha_namxaydung" class="form-control inputmask-integer" value="{!! old('nha_namxaydung', $sp_hoso->nha_namxaydung) !!}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Vật liệu xây dựng</label>
                    <select name="nha_dm_vlxd" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_vlxd']) !!}">
                        <option value="{!! old('nha_dm_vlxd', $sp_hoso->nha_dm_vlxd) !!}"></option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Có thang máy?</label>
                    <select name="nha_thangmay" class="form-control select2">
                        <option value="0" {!! (old('nha_thangmay', $sp_hoso->nha_thangmay) == 0) ? 'selected="selected"': '' !!}>Không</option>
                        <option value="1" {!! (old('nha_thangmay', $sp_hoso->nha_thangmay) == 1) ? 'selected="selected"': '' !!}>Có</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Có sân thượng?</label>
                    <select name="nha_santhuong" class="form-control select2">
                        <option value="0" {!! (old('nha_santhuong', $sp_hoso->nha_santhuong) == 0) ? 'selected="selected"': '' !!}>Không</option>
                        <option value="1" {!! (old('nha_santhuong', $sp_hoso->nha_santhuong) == 1) ? 'selected="selected"': '' !!}>Có</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Có chỗ để xe hơi?</label>
                    <select name="nha_chodexehoi" class="form-control select2">
                        <option value="0" {!! (old('nha_chodexehoi', $sp_hoso->nha_chodexehoi) == 0) ? 'selected="selected"': '' !!}>Không</option>
                        <option value="1" {!! (old('nha_chodexehoi', $sp_hoso->nha_chodexehoi) == 1) ? 'selected="selected"': '' !!}>Có</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                    <label>An ninh?</label>
                    <select name="nha_anninh" class="form-control select2">
                        <option value="0" {!! (old('nha_anninh', $sp_hoso->nha_anninh) == 0) ? 'selected="selected"': '' !!}>Không</option>
                        <option value="1" {!! (old('nha_anninh', $sp_hoso->nha_anninh) == 1) ? 'selected="selected"': '' !!}>Có</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel panel-info">
    <div class="panel-heading">
        THÔNG TIN KIẾN TRÚC
        @if (\Permission::has('R_EDIT') || \Permission::has('R_ADD'))
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-xs" id="nha_kt_add">
                    <i class="fa fa-plus"></i> Thêm
                </button>
            </div>
        @endif
    </div>
    <div class="panel-body" id="nha_kt_container">

    </div>
</div>

<script>
    /* Default template for new row */
    var nha_kt_template = '<div class="row">\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-4">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Tên kết cấu</label>\n' +
        '                    <select name="nha_kt_dm_ketcau[]" class="form-control select2" data-source="{!! route('admin.category', ['type' => 'dm_ket_cau']) !!}"><option value="{nha_kt_dm_ketcau}"></option></select>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Loại</label>\n' +
        '                    <input type="text" name="nha_kt_loai[]" class="form-control" value="{nha_kt_loai}">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Hiện trạng</label>\n' +
        '                    <input type="text" name="nha_kt_hientrang[]" class="form-control" value="{nha_kt_hientrang}">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="col-xs-12 col-sm-6 col-md-2">\n' +
        '                <div class="form-group">\n' +
        '                    <label>Chất lượng</label>\n' +
        '                    <input type="text" name="nha_kt_chatluong[]" class="form-control" value="{nha_kt_chatluong}">\n' +
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

    /* Init add function */
    window.addEventListener("load", function() {
        var selBtn = '#nha_kt_add';
        var selContainer = '#nha_kt_container';

        /* Create new row */
        function addNha(data)
        {
            var newItem = nha_kt_template;

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

        /* Handle add button */
        $(selBtn).click(function() {
            addNha({
                nha_kt_dm_ketcau: '',
                nha_kt_loai: '',
                nha_kt_hientrang: '',
                nha_kt_chatluong: ''
            });
        });

        <?php
            $nha_kientruc = $sp_hoso->SpHoSoNhaKienTruc()->get();

            foreach ($nha_kientruc as $item) {
                ?>
                addNha({
                    nha_kt_dm_ketcau: '{!! $item->dm_ketcau !!}',
                    nha_kt_loai: '{!! $item->loai !!}',
                    nha_kt_hientrang: '{!! $item->hientrang !!}',
                    nha_kt_chatluong: '{!! $item->chatluong !!}'
                });
                <?php
            }
        ?>
    });
</script>