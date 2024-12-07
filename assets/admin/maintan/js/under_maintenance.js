"use strict";
/*=============================
Start Mobile Detect
=============================*/
(function () {
    var md = new MobileDetect(window.navigator.userAgent);
    if (!md.mobile()) {
        window.isMobile = false;
    } else {
        window.isMobile = true;
    }
})();
/*=============================
End Mobile Detect
=============================*/
/*=============================
Start Preloader Out
=============================*/
function preloaderFadeout() {
    $('.el-preloader').fadeOut(preloaderFadeOut, function () {
        $(window).trigger('preloaderOut');
    });
};
/*=============================
End Preloader Out
=============================*/
/*=============================
Start Countdown
=============================*/
function countdown_timer() {
    if (!$('.counter')) {
        return false;
    }
    ;
    $(document).on("ready", function () {
        $('.counter').countdown({
            until: new Date(Date.parse(setting.counter.lastDate)),
            layout: $('.counter').html(),
            timezone: setting.counter.timeZone
        });
    });
    var setting = {
        counter: {
            lastDate: targetDate, // target date settings,
            timeZone: null
        }
    };
};
countdown_timer();
/*=============================
End Countdown
=============================*/
/*=============================
Start Preloader
=============================*/
function preloader_out_start() {
    if (!$('.el-preloader')) {
        return false;
    }
    ;
    if (isMobile) {
        preloaderFadeout();
    }
    if (!isMobile) {
        if (youtubeBg) {
            $('.youtube-player').on("YTPStart", function (e) {
                preloaderFadeout();
            });
            return false;
        } else {
            preloaderFadeout();
        }
    }
};
/*=============================
Start Canvas Settings
=============================*/
$(window).load(function () {
    preloader_out_start();
});