(function ($) {
    $(document).ready(function () {
            /*===============================*/

            /*======= INPUT MASK =======*/
            $(":input").inputmask();

            //email mask
            $('[name=email]').inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                greedy: false,
                onBeforePaste: function (pastedValue, opts) {
                    pastedValue = pastedValue.toLowerCase();
                    return pastedValue.replace("mailto:", "");
                },
                definitions: {
                    '*': {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            });

            /*======= TINY MCE EDITOR FULL =======*/
            function tinymcy_init(
                selector = '.editor',
                height = 450,
                menubar = true,
                toolbar1 = true,
                toolbar2 = true,
                toolbar3 = true,
            ) {
                //console.log(selector, toolbar2);
                tinymce.init({
                    selector: selector,
                    menubar: menubar,
                    height: height,
                    image_advtab: true,
                    verify_html: false,
                    //forced_root_block: "",
                    content_css: [
                        asset_url + "css/style.css",
                        asset_url + "css/custom.css",
                        asset_url + "css/vendor.min.css",
                        asset_url + "css/font-awesome.min.css",
                        //asset_url + "css/bootstrap.min.css",
                    ],
                    plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
                    toolbar1: (!toolbar1 ? '' : 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist | removeformat | image | fontselect | fontsizeselect | fullscreen | code'),
                    toolbar2: (!toolbar2 ? '' : 'numlist bullist | bold italic | link | formatselect| fontsizeselect | code'),
                    toolbar3: (!toolbar3 ? '' : 'numlist bullist | bold italic | link | code'),
                    plugins: [
                        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons template textcolor paste "
                    ],
                    //images_upload_handler: upload_file,
                    external_filemanager_path: asset_aurl + "vendors/tinymce/plugins/filemanager/",
                    filemanager_title: "Filemanager",
                    //filemanager_access_key:"1cac38f9f36af9bb8bb885aa5858c058s",
                    external_plugins: {"filemanager": asset_aurl + "vendors/tinymce/plugins/filemanager/plugin.min.js"}
                });
            }

            //tinymcy_init();
            tinymcy_init('.editor', 400, false, true, false, false);
            tinymcy_init('.editor2', 400, true, true, false);
            tinymcy_init('.home_editor', 500, false, true, false, false);
            tinymcy_init('.short_editor', 250, false, true, false, false);
            tinymcy_init('.short_editor2', 350, false, false, false,);
            tinymcy_init('.product_editor', 500, false, true, false);


            /*======== dashboard module search =========*/
            $(document).on("keyup", ".search-input", function () {
                var value = $(this).val().toLowerCase();
                var find_attr = $(this).attr('find-in');
                var find_container = $(this).attr('find-block');

                $(find_attr, find_container).filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


            /*======== TOUCHSPIN =========*/
            $(".kt_touchspin").TouchSpin({
                buttondown_class: "btn btn-secondary",
                buttonup_class: "btn btn-secondary",
                verticalbuttons: !0,
                verticalup: '<i class="la la-angle-up"></i>',
                verticaldown: '<i class="la la-angle-down"></i>'
            });


            /*======= selec2 multiple =======*/
            $(".kt_select2_3").select2({placeholder: "Select options"});


            /*======== SELECT2 =========*/
            if ($(".kt_select2_1").length > 0) {
                $(".kt_select2_1").select2({placeholder: "Select Option"})
                ({
                    placeholder: "Select Option",
                    allowClear: !0
                });
            }

            /*======= form repeater =======*/
            $('.array-repeater').repeater({
                initEmpty: false,
                show: function () {
                    $(this).slideDown();
                    if ($(this).find('.m-select2').length > 0) {
                        $(this).find('select.m-select2').attr('id', 'select2-id_' + Math.random());
                        $(this).find('select.m-select2').select2();
                    }
                    $('input,select,textarea', '.array-repeater').each(function (i, e) {
                        $(e).attr('name', $(e).data('name'));
                    });
                    let _this = $(this);
                    let _data = _this.data();
                    let callback = _data.callback;
                    if (callback) {
                        var fn = window[callback];
                        if (typeof fn === 'function') {
                            fn(_this);
                        }
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                    $(this).slideUp(deleteElement);
                },
                ready: function (setIndexes) {
                    $('input,select,textarea', '.array-repeater').each(function (i, e) {
                        $(e).attr('name', $(e).data('name'));
                    })
                },
                isFirstItemUndeletable: true
            });


            /*=== add more and remove============*/
            $(document).on('click', '.add_more,.add-more', function (e) {
                e.preventDefault();
                let _this = $(this);
                //console.log(_this);
                let callback = _this.attr('callback');

                let clone_container = false;
                let _closest = _this.attr('clone-closest');
                console.log(_closest);
                if (_closest === "true") {
                    clone_container = _this.closest(_this.attr('clone-container'));
                    console.log(clone_container);
                } else if (_closest !== 'true' && typeof _closest === 'string' && _closest.length > 0) {
                    clone_container = _this.closest(_closest).find(_this.attr('clone-container'));
                    console.log(clone_container);
                } else {
                    clone_container = $(_this.attr('clone-container'));
                    console.log(clone_container);
                }

                if (!clone_container) {
                    clone_container = _this.parents('.clone_container');
                }

                let clone;
                if (_this.is('[clone]')) {
                    clone = $(_this.attr('clone') + ':last').clone(true);
                } else {
                    clone = clone_container.find('.clone:last').clone(true);
                }
                console.log(clone);

                clone.find('.close-btn').show();
                clone.find('input,textarea').not(':checked,:radio,button,submit,reset,.no-change').val('');
                clone.find(':checked,:radio').attr('checked', false).parent().removeClass('checked');
                clone.find('select > option').attr('selected', false);
                clone.find('select > option:eq(0)').attr('selected', true);
                clone_container.append(clone);

                var clone_len = clone_container.find('.clone').length;
                var clone_last = clone_container.find('.clone:last');
                clone_last.find('select,input,textarea').each(function () {
                    var id = $(this).attr('id');
                    $(this).attr('id', id + '_' + clone_len);

                    if ($(this).hasClass('styled') && $(this).is("select")) {
                        $(this).parent('div[id^=uniform]').find('span').remove();
                        $(this).parent('div[id^=uniform]').find('select').unwrap().uniform();

                    } else if ($(this).hasClass('select') && $(this).is("select")) {
                        console.log(clone_last);
                        clone_last.find('.select2-container').remove();
                        clone_last.find('select').removeClass('select2-offscreen');
                        clone_last.find('select').select2();
                    }
                });
                if (callback) {
                    var fn = window[callback];

                    if (typeof fn === 'function') {
                        fn(clone, clone_container);
                    }
                }

            });

            $(document).on('click', '[remove-el]', function (e) {
                e.preventDefault();
                let _this = $(this);
                //remove-el=".parent_cls-.clone" | remove-el="parent-.clone" | remove-el=".clone"
                let callback = _this.attr('callback');

                let remove_limit = _this.attr('remove-limit');
                let remove_el = _this.attr('remove-el');
                let remove_el_ar = remove_el.split('-');
                console.log(remove_el_ar, remove_el_ar[0]);

                if (remove_el_ar[0] === 'parent') {
                    if ($(remove_el_ar[1]).length > remove_limit) {
                        _this.closest(remove_el_ar[1]).remove();
                    }
                } else if (remove_el_ar[0] !== '') {
                    if (_this.closest(remove_el_ar[0]).find(remove_el_ar[1]).length > remove_limit) {
                        _this.closest(remove_el_ar[1]).remove();
                    }
                } else if (remove_el_ar[0] === '') {
                    if ($(remove_el_ar[1]).length > remove_limit) {
                        _this.closest(remove_el_ar[1]).remove();
                    }
                } else {
                    if ($(remove_el_ar[0]).length > remove_limit) {
                        $(remove_el_ar[0]).remove();
                    }
                }

                if (callback) {
                    let fn = window[callback];
                    if (typeof fn === 'function') {
                        fn(remove_el, remove_el_ar);
                    }
                }

            });


            /*======== ORDERING =========*/
            $(document).on('blur', 'input.ordering, input.title, input.sku_code, input.description, input.module_title, input.color, input.size, input.tags, input.comments, input.price', function (e) {
                e.preventDefault();
                var url = $(this).data('url');
                if (url.indexOf('?') != -1) {
                    url += '&' + $(this).serialize()
                } else {
                    url += '?' + $(this).serialize()
                }
                //console.log(url);
                $.get(url)
                    .done(function () {
                        var notify = $.notify('Record has been updated!', {
                            type: 'success',
                            newest_on_top: true,
                            allow_dismiss: true,
                        });
                    })
                    .fail(function () {
                        var notify = $.notify('Some error occurred!', {
                            type: 'danger',
                            newest_on_top: true,
                            allow_dismiss: true,
                        });
                    });
            });

            /*======== AUTOSIZE =========*/
            autosize($(".kt_autosize_1"));

            /*======== DATEPICKER =========*/
            var t;
            t = KTUtil.isRTL() ? {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            } : {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};

            $(".kt_datepicker_3_modal").datepicker({
                rtl: KTUtil.isRTL(),
                todayBtn: "linked",
                clearBtn: !0,
                format: 'yyyy-mm-dd',
                todayHighlight: !0,
                templates: t
            });

            /*======== SINGLE DELETE ALERT =========*/
            $('.confirm').click(function (e) {
                e.preventDefault();
                var href = $(this).attr('href');

                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, Delete It!"
                }).then(function (e) {
                    if (e.value) {
                        window.location = href;
                    }
                });
            });


            /*======== DELETE ALL ALERT =========*/
            $('.confirm_all').click(function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                var form = $('.deleteAll');
                form.attr('action', href);

                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert these!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, Delete All!"
                }).then(function (e) {
                    if (e.value) {
                        form.submit();
                    }
                });
            });

            //*======== CHECK ALL CHECKBOX =========*/
            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $('.export_table tbody').checkboxes('range', true);

            /*======== DELETE BACKGROUND IMAGE =========*/
            $('.del_bg_img').click(function () {
                let _parent = $(this).closest('.fImg');
                _parent.find('.delete_img').css('background-image', '').unwrap();
                $('.input_img', _parent).val(1);
            });


            /*======== DELETE NORMAL IMAGE =========*/
            $('.del_img').click(function () {
                let _parent = $(this).closest('.fImg');
                $('.delete_img', _parent).val(1);
                $('.thumb-img', _parent).remove();
                $('.del_img', _parent).remove();
            });

            /*======= SORTABLE ROWS =======*/
            $('#sortable-rows').sortable({
                placeholder: 'ui-state-highlight',
                update: function (event, ui) {
                    updateDisplayOrder();
                }
            });

            // function to save display sort order
            function updateDisplayOrder() {
                var selectedLanguage = new Array();
                $('#sortable-rows tr').each(function () {
                    selectedLanguage.push($(this).attr("id"));
                });

                /* for product
                 ===================================*/
                var dataString = 'page_sort=' + selectedLanguage;
                $.ajax({
                    type: "GET",
                    url: "js/update_ordering.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                    }
                });
            }

            /*===============================*/
        }
    );
})(jQuery);

/*======== DROPZONE =========*/
Dropzone.options.kDropzoneThree = {
    paramName: "file",
    maxFiles: 10,
    maxFilesize: 10,
    addRemoveLinks: !0,
    acceptedFiles: "image/*,application/pdf,.psd",
    accept: function (event, val) {
        console.log(event);
        "justinbieber.jpg" == event.name ? val("Naha, you don't.") : val();

        $('.dropzone').prepend('<input type="hidden" name="files[]" value="' + event.name + '">')
    }
};

<!-- begin::Global Config(global config for global JS sciprts) -->
var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5D78FF",
            "dark": "#282A3C",
            "light": "#FFFFFF",
            "primary": "#5867DD",
            "success": "#34BFA3",
            "info": "#36A3F7",
            "warning": "#FFB822",
            "danger": "#FD3995"
        },
        "base": {
            "label": ["#C5CBE3", "#A1A8C3", "#3D4465", "#3E4466"],
            "shape": ["#F0F3FF", "#D9DFFA", "#AFB4D4", "#646C9A"]
        }
    }
};


/*
shipping loading script
http://localhost/cakportal/admin/orders
*/
function startProcess() {
    // Show the loading spinner
    var loadingSpinner = document.getElementById("loadingSpinner");
    loadingSpinner.style.display = "block";

    // Simulate a time-consuming process
    setTimeout(function () {
        // Complete the process

        // Hide the loading spinner
        loadingSpinner.style.display = "none";
    }, 5000); // Adjust the timeout duration as needed for your process
}

