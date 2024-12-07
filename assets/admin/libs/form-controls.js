var KTFormControls = {
    init: function () {
        $("#kt_form_1").validate({
            rules: {
                title: {required: !0},
                friendly_url: {required: !0},
                meta_title: {required: !0},
                first_name: {required: !0},
                phone: {required: !0},
                email: {required: !0, email: !0, minlength: 10},
                country: {required: !0},
                gender: {required: !0},
                user_type_id: {required: !0},
                username: {required: !0},
                password: {required: !0},
                //image: {required: !0},
                /*url: {required: !0},
                digits: {required: !0, digits: !0},
                creditcard: {required: !0, creditcard: !0},
                option: {required: !0},
                options: {required: !0, minlength: 2, maxlength: 4},
                memo: {required: !0, minlength: 10, maxlength: 100},
                checkbox: {required: !0},
                checkboxes: {required: !0, minlength: 1, maxlength: 2},
                radio: {required: !0}*/
            }, invalidHandler: function (e, r) {
                $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
            }, submitHandler: function (e) {
                e.submit();
            }
        });
            /*$("#kt_form_2").validate({
            rules: {
                title: {required: !0},
                friendly_url: {required: !0},
                billing_card_name: {required: !0},
                billing_card_number: {required: !0, creditcard: !0},
                billing_card_exp_month: {required: !0},
                billing_card_exp_year: {required: !0},
                billing_card_cvv: {required: !0, minlength: 2, maxlength: 3},
                billing_address_1: {required: !0},
                billing_address_2: {},
                billing_city: {required: !0},
                billing_state: {required: !0},
                billing_zip: {required: !0, number: !0},
                billing_delivery: {required: !0}
            }, invalidHandler: function (e, r) {
                swal.fire({
                    title: "",
                    text: "There are some errors in your submission. Please correct them.",
                    type: "error",
                    confirmButtonClass: "btn btn-secondary",
                    onClose: function (e) {
                        console.log("on close event fired!")
                    }
                }), e.preventDefault()
            }, submitHandler: function (e) {
                return swal.fire({
                    title: "",
                    text: "Form validation passed. All good!",
                    type: "success",
                    confirmButtonClass: "btn btn-secondary"
                }), !1
            }
        })*/
    }
};
jQuery(document).ready(function () {
    KTFormControls.init()
});
