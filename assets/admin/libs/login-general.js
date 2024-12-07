"use strict";
var KTLoginGeneral = function () {
    var t = $("#kt_login"), i = function (t, i, e) {
        var n = $('<div class="kt-alert kt-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
        t.find(".alert").remove(), n.prependTo(t), KTUtil.animateClass(n[0], "fadeIn animated"), n.find("span").html(e)
    }, e = function () {
        t.removeClass("kt-login--forgot"), t.removeClass("kt-login--signup"), t.addClass("kt-login--signin"), KTUtil.animateClass(t.find(".kt-login__signin")[0], "flipInX animated")
    }, n = function () {
        $("#kt_login_forgot").click(function (i) {
            i.preventDefault(), t.removeClass("kt-login--signin"), t.removeClass("kt-login--signup"), t.addClass("kt-login--forgot"), KTUtil.animateClass(t.find(".kt-login__forgot")[0], "flipInX animated")
        }), $("#kt_login_forgot_cancel").click(function (t) {
            t.preventDefault(), e()
        }), $("#kt_login_signup").click(function (i) {
            i.preventDefault(), t.removeClass("kt-login--forgot"), t.removeClass("kt-login--signin"), t.addClass("kt-login--signup"), KTUtil.animateClass(t.find(".kt-login__signup")[0], "flipInX animated")
        }), $("#kt_login_signup_cancel").click(function (t) {
            t.preventDefault(), e()
        })
    };
    return {
        init: function () {
            n(), $("#kt_login_signin_submit").click(function (t) {
                t.preventDefault();
                var e = $(this), n = $(this).closest("form");
                n.validate({
                    rules: {
                        username: {required: !0},
                        password: {required: !0, minlength: 6, maxlength: 16}
                    }
                }), n.valid() && (e.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), n.ajaxSubmit({
                    url: n.attr('action'),
                    success: function (t, s, r, a) {
                        let rs = $.parseJSON(t);
                        if (rs.status) {
                            window.location = rs.redirect;
                        } else {
                            e.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i(n, "danger", rs.message);
                        }
                    }
                }))
            }), $("#kt_login_forgot_submit").click(function (n) {
                n.preventDefault();
                var s = $(this), r = $(this).closest("form");
                r.validate({
                    rules: {
                        email: {required: !0, email: !0}
                    }
                }), r.valid() && (s.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), r.ajaxSubmit({
                    url: r.attr('action'),
                    success: function (n, a, l, o) {
                        let rp = $.parseJSON(n);
                        {
                            setTimeout(function () {
                                s.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm();
                                var n = t.find(".kt-login__signin form");
                                e();
                                i(n, rp.class, rp.message);
                                //n.clearForm(), n.validate().resetForm(
                            }, 2e3)
                        }
                    }
                }))
            })
        }
    }
}();
jQuery(document).ready(function () {
    KTLoginGeneral.init()
});