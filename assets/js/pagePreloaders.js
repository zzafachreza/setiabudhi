(function ($) {
    $.fn.pagePreloaders = function (options) {
        var settings = $.extend({}, options);

        return this.each(function () {
            $('body').append(
                '<div id="animationPreloader-1">' +
                '<div class="object1" id="first_object"></div>' +
                '<div class="object1" id="second_object"></div>' +
                '<div class="object1" id="third_object"></div>' +
                '<div class="object1" id="forth_object"></div>' +
                '</div>' +
                '<div id="animationPreloader-2">' +
                '<div class="object2" id="object_one2"></div>' +
                '<div class="object2" id="object_two2"></div>' +
                '<div class="object2" id="object_three2"></div>' +
                '<div class="object2" id="object_four2"></div>' +
                '</div>' +
                '<div id="animationPreloader-3">' +
                '<div class="object3" id="object_one3"></div>' +
                '<div class="object3" id="object_two3"></div>' +
                '<div class="object3" id="object_three3"></div>' +
                '</div>' +
                '<div id="animationPreloader-4">' +
                '<div class="object4" id="first_object4"></div>' +
                '<div class="object4" id="second_object4" style="float:right;"></div>' +
                '</div>' +
                '<div id="animationPreloader-5">' +
                '<div class="object5" id="object_one5"></div>' +
                '<div class="object5" id="object_two5"></div>' +
                '<div class="object5" id="object_three5"></div>' +
                '<div class="object5" id="object_four5"></div>' +
                '</div>' +
                '<div id="animationPreloader-6">' +
                '<div class="object6" id="object_one6"></div>' +
                '<div class="object6" id="object_two6"></div>' +
                '<div class="object6" id="object_three6"></div>' +
                '<div class="object6" id="object_four6"></div>' +
                '</div>' +
                '<div id="animationPreloader-7">' +
                '<div class="object7" id="object_one7"></div>' +
                '<div class="object7" id="object_two7" style="left:20px;"></div>' +
                '<div class="object7" id="object_three7" style="left:40px;"></div>' +
                '<div class="object7" id="object_four7" style="left:60px;"></div>' +
                '<div class="object7" id="object_five7" style="left:80px;"></div>' +
                '</div>' +
                '<div id="animationPreloader-8">' +
                '<div class="object8" id="object_one8"></div>' +
                '<div class="object8" id="object_two8"></div>' +
                '<div class="object8" id="object_three8"></div>' +
                '<div class="object8" id="object_four8"></div>' +
                '<div class="object8" id="object_five8"></div>' +
                '<div class="object8" id="object_six8"></div>' +
                '<div class="object8" id="object_seven8"></div>' +
                '<div class="object8" id="object_eight8"></div>' +
                '</div>' +
                '<div id="animationPreloader-9">' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '<div class="object9"></div>' +
                '</div>' +
                '<div id="animationPreloader-10">' +
                '<div class="object10" id="object_four10"></div>' +
                '<div class="object10" id="object_three10"></div>' +
                '<div class="object10" id="object_two10"></div>' +
                '<div class="object10" id="object_one10"></div>' +
                '</div>' +
                '<div id="animationPreloader-11">' +
                '<div class="object11" id="object_four11"></div>' +
                '<div class="object11" id="object_three11"></div>' +
                '<div class="object11" id="object_two11"></div>' +
                '<div class="object11" id="object_one11"></div>' +
                '</div>' +
                '<div id="loading"></div>' +
                '<div id="imagePreloader" style="background-image: url(' + settings.imageURL + ')"</div>'
            );

            var imagePreloader = $('#imagePreloader');
            settings.preloaderStyle == 'logo' ? $(imagePreloader).show() +
                $('#animationPreloader-' + settings.animationPreloader).hide() : $(imagePreloader).hide() +
                $('#animationPreloader-' + settings.animationPreloader).show();

            $('#loading').css({ 'background-color': settings.backgroundColor, 'opacity': settings.backgroundOpacity });
            $(imagePreloader).css({
                'background-color': settings.logoBackgroundColor,
                'opacity': settings.logoOpacity,
                'height': settings.logoSize,
                'width': settings.logoSize,
                'border': 'solid' + settings.logoBorderColor + ' ' + settings.logoBorderWidth,
                'border-radius': settings.logoBorderRadius
            });

            $('#animationPreloader-' + settings.animationPreloader).css('opacity', settings.animationPreloaderOpacity);

            $(imagePreloader).css("top", (($(window).height() - $(imagePreloader).outerHeight()) / 2) + $(window).scrollTop() + "px");
            $(imagePreloader).css("left", (($(window).width() - $(imagePreloader).outerWidth()) / 2) + $(window).scrollLeft() + "px");

            function GetIEVersion() {
                var sAgent = window.navigator.userAgent;
                var Idx = sAgent.indexOf("MSIE");

                if (Idx > 0) return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));
                else if (!!navigator.userAgent.match(/Trident\/7\./)) return 11;
                else return 0;
            }

            if (GetIEVersion() > 0){
                $(imagePreloader).css({
                    'border': 'solid',
                    'border-width': settings.logoBorderWidth, 
                    'border-color': settings.logoBorderColor
                });
            }

            if (settings.animationPreloader == '1') {
                $('#animationPreloader-1').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('border', 'solid 4px' + settings.animationPreloaderColor);
    
                if (GetIEVersion() > 0){
                    $('.object' + settings.animationPreloader).css({
                        'border-style': 'solid', 
                        'border-color': settings.animationPreloaderColor, 
                        'border-width': '4px'
                    });
                }
            }
            else if (settings.animationPreloader == '2') {
                $('#animationPreloader-2').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '3') {
                $('#animationPreloader-3').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '4') {
                $('#animationPreloader-4').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '5') {
                $('#animationPreloader-5').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '6') {
                $('#animationPreloader-6').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '7') {
                $('#animationPreloader-7').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '8') {
                $('#animationPreloader-8').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '9') {
                $('#animationPreloader-9').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css('background-color', settings.animationPreloaderColor);
            }
            else if (settings.animationPreloader == '10') {
                $('#animationPreloader-10').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css({
                    'border-left': 'solid 5px' + settings.animationPreloaderColor,
                    'border-right': 'solid 5px' + settings.animationPreloaderColor,
                });
    
                if (GetIEVersion() > 0){
                    $('.object' + settings.animationPreloader).css({
                        'border-left-style': 'solid',
                        'border-left-width': '5px', 
                        'border-left-color': settings.animationPreloaderColor, 
                        'border-right-style': 'solid',
                        'border-right-width': '5px', 
                        'border-right-color': settings.animationPreloaderColor, 
                    });
                }
            }
            else if (settings.animationPreloader == '11') {
                $('#animationPreloader-11').css({ 'visibility': 'visible' });
                $('.object' + settings.animationPreloader).css({
                    'border-top': 'solid 5px' + settings.animationPreloaderColor,
                    'border-left': 'solid 5px' + settings.animationPreloaderColor
                });

                if (GetIEVersion() > 0){
                    $('.object' + settings.animationPreloader).css({
                        'border-left-style': 'solid',
                        'border-left-width': '5px', 
                        'border-left-color': settings.animationPreloaderColor, 
                        'border-top-style': 'solid',
                        'border-top-width': '5px', 
                        'border-top-color': settings.animationPreloaderColor, 
                    });
                }
            }
            else { $(this).css({ 'visibility': 'hidden' }); }

            var beforeload = (new Date()).getTime();
            $(function () {
                var afterload = (new Date()).getTime();
                seconds = (afterload-beforeload) / 1000;
                var animTime = settings.animationTime;

                animTime > seconds ?
                    + $('#loading, #imagePreloader, #animationPreloader-' + settings.animationPreloader).delay(settings.animationTime * 1000).fadeOut(800) :
                    + $('#loading, #imagePreloader, #animationPreloader-' + settings.animationPreloader).delay(seconds).fadeOut(800);
            });
        });
    }
}(jQuery));