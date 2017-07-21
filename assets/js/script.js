/**
 * Theme Front end main js
 *
 */

(function($) {

    $(document).ready(function() {

        var $rtl = ( $("body").hasClass("rtl-body") ) ? true : false;

        $(".sed-mafiran-slider").livequery(function(){

            var $sliderNav = $(this).data('sliderNav');

            $(this).slick({
                //mobileFirst         : true ,
                arrows              : true,
                slidesToShow        : 1,
                slidesToScroll      : 1,
                dots                : false,
                //centerMode          : false,
                rtl                 : $rtl,
                //swipe               : true ,
                touchMove           : true ,
                infinite            : true, 
                asNavFor            : $sliderNav,
                autoplay            : true,
                easing              : "easeOutQuad"
                //prevArrow : '<span class="slide-nav-bt slide-prev custom-btn custom-btn-secondary"><i class="fa fa-angle-left"></i></span>',
                //nextArrow : '<span class="slide-nav-bt slide-next custom-btn custom-btn-secondary"><i class="fa fa-angle-right"></i></span>',
            });

        });

        $(".mafiran-next-prev-controler .next").on("click" , function(){

            $(".slide-first.sed-mafiran-slider").slick("slickNext");

        });

        $(".mafiran-next-prev-controler .previous").on("click" , function(){

            $(".slide-first.sed-mafiran-slider").slick("slickPrev");

        });

    });


})(jQuery);
