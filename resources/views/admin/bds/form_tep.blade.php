@if ($sp_hoso->id)

    <div class="row">
        <div class="col-md-6 col-xs-12">
            @if (\Permission::has('R_EDIT') || \Permission::has('R_ADD'))
                <a class="btn btn-primary btn-sm" onclick="selectFiles('formMainImages')">
                    <i class="fa fa-plus"></i> Thêm ảnh
                </a>
            @endif
            <div class="row" id="img-container"></div>
        </div>

        {{--<select name="anh_dm_loai_anh[]" class="form-control select2"
                data-source="{!! route('admin.category', ['type' => 'dm_loai_anh']) !!}">
            <option value="{anh_dm_loai_anh}"></option>
        </select>--}}

        <div class="col-md-6 col-xs-12">
            @if (\Permission::has('R_EDIT') || \Permission::has('R_ADD'))
                <a class="btn btn-primary btn-sm" onclick="selectFiles('formMainFiles')">
                    <i class="fa fa-plus"></i> Thêm tài liệu
                </a>
            @endif
            <table class="table table-striped" id="file-container-table">
                <tbody id="file-container"></tbody>
            </table>
        </div>
    </div>

    <script>
        var templateImage =
            '<div class="col-sm-4 col-xs-12" data-path="{path}">\n' +
            '        <div class="img" style="background-image: url({!! config('filesystems.disks.bds.url') !!}/{!! $sp_hoso->id !!}/{path});">' +
            '           <a class="btn btn-xs btn-danger" onclick="delImg({!! $sp_hoso->id !!}, \'{path}\')">' +
            '               <i class="fa fa-close"></i>' +
            '           </a>' +
            '        </div>\n' +
            /*'        <input type="hidden" name="anh_id[]" value="{id}" />\n' +*/
            '        <input type="hidden" name="anh_path[]" value="{path}" />\n' +
            '    </div>';

        var templateFile =
            '<tr data-path="{path}"><td>' +
            '   <a href="{!! config('filesystems.disks.bds.url') !!}/{!! $sp_hoso->id !!}/{path}">' +
            '       {path}' +
            '   </a>' +
            '   <a class="btn btn-xs btn-danger pull-right" onclick="delFile({!! $sp_hoso->id !!}, \'{path}\')">' +
            '       <i class="fa fa-close"></i>' +
            '   </a>' +
            '</td></tr>';

        window.addEventListener("load", function()
        {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{!! csrf_token() !!}' } });

            /* Bind upload images */
            bindAutoUpload('formMainImages', 'img-selector', addImg, 'img');

            @php $images = $sp_hoso->SpHoSoAnh()->get() @endphp

            @foreach ($images as $img)
                addImg("{!! $img->path !!}");
            @endforeach

            /* Bind upload files */
            bindAutoUpload('formMainFiles', 'file-selector', addFile, 'file');

            @php $files = $sp_hoso->SpHoSoTep()->get() @endphp

            @foreach ($files as $file)
                addFile("{!! $file->path !!}");
            @endforeach
        });


        /**
         * Trigger files select
         *
         * @param formId
         */
        function selectFiles(formId)
        {
            var form = $('#' + formId);
            form.find('input[type="file"]').first().click();
        }


        /**
         * Handle image process (Create UI element, Delete)
         */
        function addImg(path)
        {
            var newItem = templateImage;
            newItem = newItem.replace(/{path}/gi, path);
            $('#img-container').append(newItem);
        }

        function delImg(id_sp_hoso, path)
        {
            if (confirm('Bạn có chắc chắn muốn xoá ảnh này không?')) {
                $.ajax({
                    url: '{!! route('admin.re.delete.file') !!}',
                    type: 'post',
                    data: {
                        id_sp_hoso: id_sp_hoso,
                        path: path,
                        type: 'img'
                    },
                    success: function (data) {
                        $('#img-container [data-path="' + path + '"]').remove();
                    }
                });
            }
        }


        /**
         * Handle file process (Create UI element, Delete)
         */

        function addFile(path)
        {
            var newItem = templateFile;
            newItem = newItem.replace(/{path}/gi, path);
            $('#file-container').append(newItem);
        }

        function delFile(id_sp_hoso, path)
        {
            if (confirm('Bạn có chắc chắn muốn xoá tệp này không?')) {
                $.ajax({
                    url: '{!! route('admin.re.delete.file') !!}',
                    type: 'post',
                    data: {
                        id_sp_hoso: id_sp_hoso,
                        path: path,
                        type: 'file'
                    },
                    success: function (data) {
                        $('#file-container [data-path="' + path + '"]').remove();
                    }
                });
            }
        }


        /**
         * Set auto upload files after selected files
         *
         * @param formId
         * @param inputId
         * @param callback
         * @param type
         */
        function bindAutoUpload(formId, inputId, callback, type)
        {
            document.getElementById(inputId).onchange = function () {
                var form = $('#' + formId);
                var formData = new FormData(form[0]);

                formData.type = type;
                document.getElementById(inputId).value = '';

                console.log(formData);

                $.ajax({
                    url: form.attr('action'),
                    type: 'post',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        /*callback(data);*/
                        if (typeof data.data !== 'undefined') {
                            for (var i = 0; i < data.data.length; i++) {
                                callback(data.data[i]);
                            }
                        }
                    },
                });
            }
        }
    </script>

@else

    <em>Vui lòng lưu hồ sơ trước khi tải tệp lên!</em>

@endif