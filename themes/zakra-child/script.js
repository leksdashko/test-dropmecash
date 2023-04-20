jQuery(document).ready((function ($) {

    let addBodyClass = document.querySelector('body');
    let cityCookie = getCookie('color');

    document.querySelector('.colorswitcher').addEventListener('click', e => {
        if ($("body").hasClass("dark_theme")){
            addBodyClass.className = '';
            var content = 'white_theme';
        } else {
            addBodyClass.className = '';
            var content = 'dark_theme';
        }
        console.log(content);
        addBodyClass.classList.add(content);
        setCookie('color', content);

    });

    function setCookie(name, value, options = {}) {

        options = {
            path: '/',
            // при необходимости добавьте другие значения по умолчанию
            ...options
        };

        if (options.expires instanceof Date) {
            options.expires = options.expires.toUTCString();
        }

        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

        for (let optionKey in options) {
            updatedCookie += "; " + optionKey;
            let optionValue = options[optionKey];
            if (optionValue !== true) {
                updatedCookie += "=" + optionValue;
            }
        }

        document.cookie = updatedCookie;
    }

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    if (cityCookie == undefined) {
    } else {
        addBodyClass.className = '';
        addBodyClass.classList.add(cityCookie);
    }


    $(".tg-mobile-toggle").click(function() {
        $(".tg-site-header-bottom").toggleClass("overlay");
    });
    $(".mob-wid li a").click(function() {
        $(".tg-site-header-bottom").removeClass("overlay");
    });
	$(".overlay").click(function() {
        $(".tg-header-action__item button").click();
    });
    var swiper = new Swiper(".filter_swiper", {
        navigation: {
            nextEl: '.tab-next',
            prevEl: '.tab-prev',
        },
        spaceBetween: 6,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2.5,
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 3.5,
            },
            // when window width is >= 640px
            1200: {
                slidesPerView: 7,
            }
        }
    });
    if (window.matchMedia("(max-width: 991px)").matches) {
        $( ".item_in_tab" ).each(function( index ) {
            $(this).children(".for_tel").wrapAll( "<div class='spec_cover' />");
        });
    }
}));