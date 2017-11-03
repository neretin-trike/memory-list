window.SmoothScrollOptions = { 
    keyboardSupport: false 
} 
SmoothScroll({ stepSize: 75 })

$("p").click(function() {

    var widgetLinks = $(this).parent().children(".widget-links");
    var beginHeight = widgetLinks.css("height");

    if ($(this).hasClass("opened")){
        $(this).removeClass("opened");

        widgetLinks.animate({
                height: 0,
                opacity: "0" 
            }, 250, "easeOutCubic",             
                (function(){
                    widgetLinks.css( "display", "none");
                    widgetLinks.css( "height", "auto");
                })
        );

    }
    else{
        $(this).addClass("opened");

        widgetLinks.css( "height", "0");
        widgetLinks.css( "display", "block");
    
        widgetLinks.animate({
                height: beginHeight,
                opacity: "1" 
            }, 250, "easeOutCubic",             
                (function(){
                    widgetLinks.css( "height", "auto");
                }) 
        );
    }
    


  });