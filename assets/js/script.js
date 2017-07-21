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
                arrows              : false,
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
                autoplaySpeed       : 4500 ,
                easing              : "easeOutQuad",
                speed               : 700
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

        $(".about-company-slider").livequery(function(){

            var len = $(this).find(">.slid-item").length,
                barWidth = 100;

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
                autoplay            : true,
                easing              : "easeOutQuad"
                //prevArrow : '<span class="slide-nav-bt slide-prev custom-btn custom-btn-secondary"><i class="fa fa-angle-left"></i></span>',
                //nextArrow : '<span class="slide-nav-bt slide-next custom-btn custom-btn-secondary"><i class="fa fa-angle-right"></i></span>',
            });

            var $bar = $(".mafiran-slick-nav > .mafiran-slick-bar");

            $bar.width( barWidth / len );

            var lenS = len < 10 ? "0" + len : len;

            $(".mafiran-slider-nav-number").text( "01/" + lenS );

            $(this).on('beforeChange', function(event, slick, currentSlide, nextSlide){

                //var $currentSlide = currentSlide + 1;

                var barL = barWidth / len;

                barL = barL * nextSlide;

                $bar.animate({
                    //opacity: 0.25,
                    left: barL,
                    //height: "toggle"
                }, 500, function() {

                    var curS = nextSlide + 1;

                    curS = curS < 10 ? "0" + curS : curS;

                    $(".mafiran-slider-nav-number").text( curS + "/" + lenS );

                });

            });

        });

        $(".mafiran-slider-nav .slide-next").on("click" , function(){

            $(".about-company-slider").slick("slickNext");

        });

        $(".mafiran-slider-nav .slide-prev").on("click" , function(){

            $(".about-company-slider").slick("slickPrev");

        });


    });


})(jQuery);
