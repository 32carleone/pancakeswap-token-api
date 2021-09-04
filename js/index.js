$(function () {

    /* Grid Layout */
    $('.grid').responsivegrid({
        column : 6,
        gutter : '10px',
        itemHeight : '100%',
        itemSelector : '.grid-item'
    });


    /* Api Post */
    $(".loading").hide();
    var post_check = false;
    function pancakeswap_api(){
        if(!post_check){
            post_check = true;
            $(".loading").show();

            $.post("api.php",{},function (response) {
                post_check = false;
                $(".loading").hide();
                response = JSON.parse(response);

                Object.keys(response).forEach(function (token) {
                    var selector = ".grid-item[data-id='"+token+"']";
                    $(selector+" .coin-name").text(response[token]["symbol"]);
                    $(selector+" .coin-price").text("$"+response[token]["price"]);
                    $(selector+" .coin-count").text("Count : "+response[token]["count"]);
                    $(selector+" .coin-total-price").text("Total : $"+response[token]["total_price"]);
                    
                     if(response[token]["symbol"] == "LEAD")
                         document.title = 'LEAD : '+response[token]["price"];
                });
                
            });
        }else{
            console.log("Post Not Finished")
        }

    }

    setInterval(pancakeswap_api,60000)

});
