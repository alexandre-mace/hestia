    $(function(){

        var counter = 0;
        var c = 0;
        var endPoint = $(".count").data("content");
        var t = setInterval(function() {


            $(".count").html(c + "%");
            $(".progress").css("width", c + "%");

            counter++;
            c++;
            if(counter === parseFloat(endPoint) + parseFloat(1)) {
                clearInterval(t);

                // Actions
                setTimeout(function(){
                    $(".count, .loader").fadeOut();
                }, 500);

                setTimeout(function(){
                    $(".result-ctn").fadeIn();
                }, 1250);
                $(".a-close").click( function () {
                    $("main").fadeOut();
                })

            };
        }, 50);

    });

