window.SmoothScrollOptions = { 
    keyboardSupport: false 
} 
SmoothScroll({ stepSize: 75 })


var items = [],
    caption = "";

function GetListLinks(json, root){
    for(var k in json) {
        if (json[k].level!=undefined){

            caption = json[k]["caption"];
            
            for (var i = 0; i<json[k]["list"].length-1; i+=2){
                href = json[k]["list"][i];
                val = json[k]["list"][i+1];

                items.push('<li><a href="' + href + '">' + val + '</a></li>');
            }

            var sectionElem = $("<section class='widget-category'></section>");
            var pElem = $("<p>", {html: caption});
            var articleElem = $("<article class='widget-links'>");  
            var olElem = $('<ol/>', {html: items.join('')});

            $(sectionElem).append(pElem).append(articleElem);
            $(articleElem).append(olElem);

            $(root).append(sectionElem); 

            items = [];
            caption = "";

            GetListLinks(json[k],articleElem);
        }
    }
}

window.onload = function() {
    $.getJSON("js/list.json", function(json) {
        GetListLinks(json, ".wrapper");
    });
};

$(".wrapper").on('click','p', function(){

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

     // console.log(json); // this will show the info it in firebug console

        // for(var k in json) {
        //     console.log(json[k]);
        //     console.log(json[k][0]);
        // }

