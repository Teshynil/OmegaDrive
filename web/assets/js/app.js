/*****
 * CONFIGURATION
 */
// Active ajax page loader
$.ajaxLoad = true;
//required when $.ajaxLoad = true
$.defaultPage = 'Main';
$.subPagesDirectory = '';
$.mainContent = $('#ui-view');
$.loader = $('#ui-loader');
//ajax POST&PUT
$.uploadContext = '';
//Main navigation
$.navigation = $('nav > ul.nav');

$.panelIconOpened = 'icon-arrow-up';
$.panelIconClosed = 'icon-arrow-down';

//Default colours
$.brandPrimary = '#20a8d8';
$.brandSuccess = '#4dbd74';
$.brandInfo = '#63c2de';
$.brandWarning = '#f8cb00';
$.brandDanger = '#f86c6b';

$.grayDark = '#2a2c36';
$.gray = '#55595c';
$.grayLight = '#818a91';
$.grayLighter = '#d1d4d7';
$.grayLightest = '#f8f9fa';

'use strict';

/*****
 * ASYNC LOAD
 * Load JS files and CSS files asynchronously in ajax mode
 */
function loadJS(jsFiles, pageScript) {

    var i;
    for (i = 0; i < jsFiles.length; i++) {

        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = false;
        script.src = jsFiles[i];
        body.appendChild(script);
    }

    if (pageScript) {
        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = false;
        script.src = pageScript;
        body.appendChild(script);
    }

    init();
}

function loadCSS(cssFile, end, callback) {

    var cssArray = {};

    if (!cssArray[cssFile]) {
        cssArray[cssFile] = true;

        if (end == 1) {

            var head = document.getElementsByTagName('head')[0];
            var s = document.createElement('link');
            s.setAttribute('rel', 'stylesheet');
            s.setAttribute('type', 'text/css');
            s.setAttribute('href', cssFile);

            s.onload = callback;
            head.appendChild(s);

        } else {

            var head = document.getElementsByTagName('head')[0];
            var style = document.getElementById('main-style');

            var s = document.createElement('link');
            s.setAttribute('rel', 'stylesheet');
            s.setAttribute('type', 'text/css');
            s.setAttribute('href', cssFile);

            s.onload = callback;
            head.insertBefore(s, style);

        }

    } else if (callback) {
        callback();
    }

}

/****
 * AJAX LOAD
 * Load pages asynchronously in ajax mode
 */
if ($.ajaxLoad) {

    var paceOptions = {
        elements: false,
        restartOnRequestAfter: false
    };

    var url = location.hash.replace(/^#/, '');

    if (url != '') {
        setUpUrl(url);
    } else {
        setUpUrl($.defaultPage);
    }

    $(document).on('click', ':not(#ui-view *)a[href!="#"]:not([hardlink]),.nav :not(#ui-view *)a[href!="#"]:not([hardlink])', function (e) {
        if ($(this).parent().parent().hasClass('nav-tabs') || $(this).parent().parent().hasClass('nav-pills')) {
            e.preventDefault();
        } else if ($(this).attr('target') == '_top') {
            e.preventDefault();
            var target = $(e.currentTarget);
            window.location = (target.attr('href'));
        } else if ($(this).attr('target') == '_blank') {
            e.preventDefault();
            var target = $(e.currentTarget);
            window.open(target.attr('href'));
        } else {
            e.preventDefault();
            var target = $(e.currentTarget);
            var softlink = (target.attr('softlink') === undefined ? false : true);
            setUpUrl(target.attr('href'), softlink);
        }
    });

    $(document).on('click', 'a[href="#"]', function (e) {
        e.preventDefault();
    });
}

function setUpUrl(url, softlink = false, method = 'GET') {

    $('nav .nav li .nav-link').removeClass('active');
    $('nav .nav li.nav-dropdown').removeClass('open');
    $('nav .nav li:has(a[href="' + url.split('?')[0] + '"])').addClass('open');
    $('nav .nav a[href="' + url.split('?')[0] + '"]').addClass('active');

    loadPage(url, softlink, method);
}

function loadPage(url, softlink = false, method = 'GET') {
    actualPage=url;
    url=url.replace($.subPagesDirectory,"");
    if (method === 'GET') {
        $.ajax({
            type: 'GET',
            url: $.subPagesDirectory + url,
            dataType: 'html',
            async: true,
            beforeSend: function () {
                $.mainContent.animate({opacity: 0}, 500,'swing',function(){
                    $.mainContent.css({display:'none'});
                });
                $.loader.css({display: 'block'});
                destroypage();
            },
            success: function (data) {
                Pace.restart();
                $('html, body').animate({scrollTop: 0}, 0);
                $.mainContent.html(data).delay(250).animate({opacity: 1}, 500,'swing',function(){
                    $.mainContent.css({display:'block'});
                    $.loader.css({display: 'none'});
                    initPage();
                });
                if (!softlink) {
                    window.location.hash = url;
                }
            }
        });
    } else if (method === 'POST') {
        $.ajax({
            type: 'POST',
            url: $.subPagesDirectory + url,
            data: $.postData,
            async: true,
            beforeSend: function () {
                $.mainContent.animate({opacity: 0}, 500,'swing',function(){
                    $.mainContent.css({display:'none'});
                });
                $.loader.css({display: 'block'});
                destroypage();
            },
            success: function (data) {
                Pace.restart();
                $('html, body').animate({scrollTop: 0}, 0);
                $.mainContent.html(data).delay(250).animate({opacity: 1}, 500,'swing',function(){
                    $.mainContent.css({display:'block'});
                    $.loader.css({display: 'none'});
                    initPage();
                });
                if (!softlink) {
                    window.location.hash = url;
                }
            }
        });
}

}

/****
 * MAIN NAVIGATION
 */

$(document).ready(function ($) {

    // Add class .active to current link - AJAX Mode off
    $.navigation.find('a').each(function () {

        var cUrl = String(window.location).split('?')[0];

        if (cUrl.substr(cUrl.length - 1) == '#') {
            cUrl = cUrl.slice(0, -1);
        }

        if ($($(this))[0].href == cUrl) {
            $(this).addClass('active');

            $(this).parents('ul').add(this).each(function () {
                $(this).parent().addClass('open');
            });
        }
    });

    // Dropdown Menu
    $.navigation.on('click', 'a', function (e) {

        if ($.ajaxLoad) {
            e.preventDefault();
        }

        if ($(this).hasClass('nav-dropdown-toggle')) {
            $(this).parent().toggleClass('open');
            resizeBroadcast();
        }
    });

    function resizeBroadcast() {

        var timesRun = 0;
        var interval = setInterval(function () {
            timesRun += 1;
            if (timesRun === 5) {
                clearInterval(interval);
            }
            window.dispatchEvent(new Event('resize'));
        }, 62.5);
    }

    /* ---------- Main Menu Open/Close, Min/Full ---------- */
    $('.navbar-toggler').click(function () {

        if ($(this).hasClass('sidebar-toggler')) {
            $('body').toggleClass('sidebar-hidden');
            resizeBroadcast();
        }

        if ($(this).hasClass('sidebar-minimizer')) {
            $('body').toggleClass('sidebar-minimized');
            resizeBroadcast();
        }

        if ($(this).hasClass('aside-menu-toggler')) {
            $('body').toggleClass('aside-menu-hidden');
            resizeBroadcast();
        }

        if ($(this).hasClass('mobile-sidebar-toggler')) {
            $('body').toggleClass('sidebar-mobile-show');
            resizeBroadcast();
        }

    });

    $('.sidebar-close').click(function () {
        $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
    });

    /* ---------- Disable moving to top ---------- */
    $('a[href="#"][data-top!=true]').click(function (e) {
        e.preventDefault();
    });

    
});

/****
 * CARDS ACTIONS
 */

$(document).on('click', '.card-actions a', function (e) {
    e.preventDefault();

    if ($(this).hasClass('btn-close')) {
        $(this).parent().parent().parent().fadeOut();
    } else if ($(this).hasClass('btn-minimize')) {
        var $target = $(this).parent().parent().next('.card-block');
        if (!$(this).hasClass('collapsed')) {
            $('i', $(this)).removeClass($.panelIconOpened).addClass($.panelIconClosed);
        } else {
            $('i', $(this)).removeClass($.panelIconClosed).addClass($.panelIconOpened);
        }

    } else if ($(this).hasClass('btn-setting')) {
        $('#myModal').modal('show');
    }

});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function init(url) {

    /* ---------- Tooltip ---------- */
    $('[data-toggle="tooltip"],[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement": "bottom", delay: {show: 400, hide: 200}});

    /* ---------- Popover ---------- */
    $('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();

    /* ---------- Select2 ---------- */
    $('select[select2]').select2({
        language: "es"
    });
}

function destroypage() {
    /* ---------- Tooltip ---------- */
    $.mainContent.find('[data-toggle="tooltip"],[rel="tooltip"],[data-rel="tooltip"]').tooltip('hide');
    $.mainContent.find('[data-toggle="tooltip"],[rel="tooltip"],[data-rel="tooltip"]').tooltip('disable');

    /* ---------- Popover ---------- */
    $.mainContent.find('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover('hide');
    $.mainContent.find('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover('disable');
    
    $.mainContent.off('click', 'a[href!="#"]:not([hardlink])');
    $.mainContent.off('submit', 'form');
    if(mainDropzone!=undefined){
        mainDropzone.destroy();
    }
}
function initPage() {

    /* ---------- Tooltip ---------- */
    $.mainContent.find('[data-toggle="tooltip"],[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement": "bottom", delay: {show: 200, hide: 0}});

    /* ---------- Popover ---------- */
    $.mainContent.find('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();

    /* ---------- Select2 ---------- */
    $.mainContent.find('select[select2]').select2({
        language: "es"
    });

    $.mainContent.on('click', 'a[href!="#"]:not([hardlink])', function (e) {
        if ($(this).parent().parent().hasClass('nav-tabs') || $(this).parent().parent().hasClass('nav-pills')) {
            e.preventDefault();
        } else if ($(this).attr('target') == '_top') {
            e.preventDefault();
            var target = $(e.currentTarget);
            window.location = (target.attr('href'));
        } else if ($(this).attr('target') == '_blank') {
            e.preventDefault();
            var target = $(e.currentTarget);
            window.open(target.attr('href'));
        } else {
            e.preventDefault();
            var target = $(e.currentTarget);
            var softlink = (target.attr('softlink') === undefined ? false : true);
            setUpUrl(target.attr('href'), softlink);
        }
    });
    $.mainContent.on('submit', 'form', function (e) {
        e.preventDefault();
        var form = $(e.currentTarget);
        $.postData = form.serialize();
        setUpUrl(form.attr('action'), true, 'POST');
    });

    $('.is-invalid[data-toggle="tooltip"]').tooltip({
        template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner text-danger"></div></div>'
    });
    $('.is-invalid').keypress(function () {
        $(this).removeClass('is-invalid').tooltip('hide');
        $(this).tooltip('disable');
    });
    $('select[select2]').select2({
        language: "es"
    });
    
}
