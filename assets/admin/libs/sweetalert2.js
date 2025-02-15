"use strict";
var KTSweetAlert2Demo = {
    init: function () {
        $("#kt_sweetalert_demo_1").click(function (e) {
            swal.fire("Good job!")
        }), $("#kt_sweetalert_demo_2").click(function (e) {
            swal.fire("Here's the title!", "...and here's the text!")
        }), $("#kt_sweetalert_demo_3_1").click(function (e) {
            swal.fire("Good job!", "You clicked the button!", "warning")
        }), $("#kt_sweetalert_demo_3_2").click(function (e) {
            swal.fire("Good job!", "You clicked the button!", "error")
        }), $("#kt_sweetalert_demo_3_3").click(function (e) {
            swal.fire("Good job!", "You clicked the button!", "success")
        }), $("#kt_sweetalert_demo_3_4").click(function (e) {
            swal.fire("Good job!", "You clicked the button!", "info")
        }), $("#kt_sweetalert_demo_3_5").click(function (e) {
            swal.fire("Good job!", "You clicked the button!", "question")
        }), $("#kt_sweetalert_demo_4").click(function (e) {
            swal.fire({
                title: "Good job!",
                text: "You clicked the button!",
                type: "success",
                buttonsStyling: !1,
                confirmButtonText: "Confirm me!",
                confirmButtonClass: "btn btn-brand"
            })
        }), $("#kt_sweetalert_demo_5").click(function (e) {
            swal.fire({
                title: "Good job!",
                text: "You clicked the button!",
                type: "success",
                buttonsStyling: !1,
                confirmButtonText: "<i class='la la-headphones'></i> I am game!",
                confirmButtonClass: "btn btn-danger",
                showCancelButton: !0,
                cancelButtonText: "<i class='la la-thumbs-down'></i> No, thanks",
                cancelButtonClass: "btn btn-default"
            })
        }), $("#kt_sweetalert_demo_6").click(function (e) {
            swal.fire({
                position: "top-right",
                type: "success",
                title: "Your work has been saved",
                showConfirmButton: !1,
                timer: 1500
            })
        }), $("#kt_sweetalert_demo_7").click(function (e) {
            swal.fire({
                title: "jQuery HTML example",
                html: $("<div>").addClass("some-class").text("jQuery is everywhere."),
                animation: !1,
                customClass: "animated tada"
            })
        }), $("#kt_sweetalert_demo_8").click(function (e) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!"
            }).then(function (e) {
                e.value && swal.fire("Deleted!", "Your file has been deleted.", "success")
            })
        }), $("#kt_sweetalert_demo_9").click(function (e) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
                e.value ? swal.fire("Deleted!", "Your file has been deleted.", "success") : "cancel" === e.dismiss && swal.fire("Cancelled", "Your imaginary file is safe :)", "error")
            })
        }), $("#kt_sweetalert_demo_10").click(function (e) {
            swal.fire({
                title: "Sweet!",
                text: "Modal with a custom image.",
                imageUrl: "https://unsplash.it/400/200",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image",
                animation: !1
            })
        }), $("#kt_sweetalert_demo_11").click(function (e) {
            swal.fire({
                title: "Auto close alert!", text: "I will close in 5 seconds.", timer: 5e3, onOpen: function () {
                    swal.showLoading()
                }
            }).then(function (e) {
                "timer" === e.dismiss && console.log("I was closed by the timer")
            })
        })
    }
};
jQuery(document).ready(function () {
    KTSweetAlert2Demo.init()
});