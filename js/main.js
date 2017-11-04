window.SmoothScrollOptions = { 
    keyboardSupport: false 
} 
SmoothScroll({ stepSize: 75 })

window.onload = function() {
    $.getJSON("js/list.json", function(json) {
        var items = [],
            caption = "";
   
        for(var k in json) {

            caption = json[k]["caption"];
            
            for (var i = 0; i<json[k]["list"].length-1; i+=2){
                href = json[k]["list"][i];
                val = json[k]["list"][i+1];
    
                items.push('<li><a href="' + href + '">' + val + '</a></li>');
            }
    
            var sec = $("<section class='widget-category'></section>");
            var ps = $("<p>", {html: caption});
            var art = $("<article class='widget-links'>");  
            var ols = $('<ol/>', {html: items.join('')});
    
            $(sec).append(ps).append(art);
            $(art).append(ols);
    
            $('.wrapper').append(sec); 

            items = [];
            caption = "";
            
            for(var j in json[k]) {
                
                if (json[k][j].level==2){

                    caption = json[k][j]["caption"];
                    
                    for (var i = 0; i<json[k][j]["list"].length-1; i+=2){
                        href = json[k][j]["list"][i];
                        val =  json[k][j]["list"][i+1];
            
                        items.push('<li><a href="' + href + '">' + val + '</a></li>');
                    }
            
                    var sec1 = $("<section class='widget-category'></section>");
                    var ps1 = $("<p>", {html: caption});
                    var art1 = $("<article class='widget-links'>");  
                    var ols1 = $('<ol/>', {html: items.join('')});
            
                    $(sec1).append(ps1).append(art1);
                    $(art1).append(ols1);
            
                    $(art).append(sec1); 
        
                    items = [];
                    caption = "";
                }
            }
        }
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

        // "sheetList":{
        //     "level":1,
        //     "caption":"Шпаргалки",
        //     "list":[
        //         "https://github.com/nicothin/web-design", "О чём должен помнить веб-дизайнер",
        //         "http://lynn.ru/examples/svg/", "Трюки с SVG и тегом image",
        //         "https://ru.stackoverflow.com/questions/584813/Контроль-версий-на-локальном-компьютере-windows", "Контроль версий на локальном компьютере windows",
        //         "https://ru.stackoverflow.com/questions/431520/Как-вернуться-откатиться-к-более-раннему-коммиту", "Как вернуться откатиться к более раннему коммиту",
        //         "https://github.com/kamranahmedse/developer-roadmap", "Web developer roadmap",
        //         "https://github.com/acilsd/wrk-fet", "I can has frontend skillz: fat FAQ",
        //         "https://github.com/tsergeytovarov/htmlacademy-basic-additional-material", "Дополнительные материалы для интенсивов",
        //         "http://css-live.ru/wp-content/uploads/2012/07/html5-flowchart-ru.png", "Выбор элемента HTML5",
        //         "https://superuser.com/questions/454380/git-bash-here-in-conemu", "Git Bash Here in ConEmu",
        //         "https://rsdn.org/article/tools/Git.xml#E5D", "Git в картинках",
        //         "http://eax.me/git-commands/", "Моя шпаргалка по работе с Git",
        //         "http://mediasapiens.tv/files/2012/04/font.png", "Итак, тебе нужен шрифт",
        //         "http://odeskconf.github.io/guide/", "Гайд по работе на Апворке",
        //         "http://html5please.com/", "html5please",
        //         "http://easings.net/ru", "easings"
        //     ]
        // },