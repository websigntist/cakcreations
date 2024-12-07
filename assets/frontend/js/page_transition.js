// OPTIONS
const options = {
    animationSelector: '[class*="o-page-transition-"]',
    // linkSelector: 'a[href^="' +  window.location.origin + '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup])',
    containers: [".js-main"],
};
const swup = new Swup(options);

// clean
swup.on('willReplaceContent', unmount);

// this event runs for every page view after initial load
swup.on('contentReplaced', mount);

function mount() {
    ga_events();
    button_events();
}

function unmount() {
    button_remove_events();
}

// GOOGLE ANALYTICS
function ga_events() {
    if (typeof window.ga === 'function') {
        let title = document.title;
        let url = window.location.pathname + window.location.search;

        window.ga('set', 'title', title);
        window.ga('set', 'page', url);
        window.ga('send', 'pageview');

        console.log('GA pageview (url ' + url + ').');
    } else {
        console.log('GA is not loaded.');
    }
}

// START FUNCS ON DOCUMENT READY - FIRST TIME ONLY
mount();
header_menu_events();


// ------------------------------------------------- ADD EVENTS

// EVENTS - HEADER ITEM ACTIVE
function header_menu_events() {
    if (document.querySelector('.js-header-item')) {
        document.querySelectorAll('.js-header-item').forEach(item => {
            item.addEventListener('click', header_menu_active);
        });
    }
}

// HEADER MENU ACTIVE
function header_menu_active(e) {
    document.querySelector('.js-header-item.is-active').classList.remove('is-active');
    e.target.classList.add('is-active');
}


// EVENTS - BUTTON
function button_events() {
    if (document.querySelector('.js-button')) {
        let button = document.querySelector('.js-button');
        button.addEventListener('click', button_click);
    }
}

// BUTTON CLICK
function button_click(e) {
    e.target.classList.toggle('is-alt');
}


// ------------------------------------------------- REMOVE EVENTS

// REMOVE EVENTS - BUTTON
function button_remove_events() {
    if (document.querySelector('.js-button')) {
        let button = document.querySelector('.js-button');
        button.removeEventListener('click', button_click);
    }
}
