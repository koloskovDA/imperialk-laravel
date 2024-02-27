$(function() {
    $('.imperial-buttons').hide();
    $('.fancybox').click(function(e){
       e.preventDefault();
       $('.imperial-buttons').show();
       var styleOverlay = "opacity: 1;visibility: visible;position: fixed;overflow: auto;z-index: 100001;width: 100%;height: 100%;top: 0px;left: 0px;text-align: center;display: block;";
       $('<div class="basicoverlay" style="' + styleOverlay +'"></div>').appendTo('.row-content');

       var style = "z-index: 100005;left:50%;top:50%;position: absolute;";
       var href = $(this).attr('href');
       $('<div class="lightimage" style="' + style +'"></div>').appendTo('.basicoverlay');
       $('<img class="bgimg" width="500"  src="'+ href +'" />').appendTo('.lightimage');
       var width = parseInt($('.bgimg').css('width'));
       var marginLeft = parseInt(width/2);
       $(".lightimage").css("margin-left",-marginLeft);

       $(".lightimage").css("margin-top",-250);
       $('.bgimg').load(function(){
                 var height = parseInt($('.bgimg').height());
                 var marginTop = parseInt(height/2);
                 $(".lightimage").css("margin-top",-marginTop);
       });



    });
    
    $('#auction-links').on('click',function(){
       $('.links-auct').toggle();
       if ($(this).text() == '...больше...'){
            $(this).html('...меньше...');
       }else {
           $(this).html('...больше...');
       }
    });

    $('.fa-search-plus').click(function(){
       var currentWidth = parseInt($('.lightimage').css('width')) + 100;
       $('.lightimage img').css({width:currentWidth});
       var marginLeft = parseInt(currentWidth/2);
       $(".lightimage").css("margin-left",-marginLeft);
    });

    $('.fa-search-minus').click(function(){
       var currentWidth = parseInt($('.lightimage').css('width')) - 100;
       $('.lightimage img').css({width:currentWidth});
       var marginLeft = parseInt(currentWidth/2);
       $(".lightimage").css("margin-left",-marginLeft);
    });


    $('.content').on('mousewheel','.bgimg', function(e){
         if(e.deltaY > 0) {
                  var currentWidth = parseInt($('.lightimage').css('width')) + 100;
                  $('.lightimage img').css({width:currentWidth});
                  var marginLeft = parseInt(currentWidth/2);
                  $(".lightimage").css("margin-left",-marginLeft);
         }
         else{
                   var currentWidth = parseInt($('.lightimage').css('width')) - 100;
                   $('.lightimage img').css({width:currentWidth});
                   var marginLeft = parseInt(currentWidth/2);
                   $(".lightimage").css("margin-left",-marginLeft);
         }
         return false;
    });

    $('.row-content').on('click','.basicoverlay',function(){
           $('.lightimage').remove();
           $('.basicoverlay').remove();
           $('.imperial-buttons').hide();
    });


    $('.fa-close').click(function(){

       $('.lightimage').remove();
       $('.basicoverlay').remove();
       $('.imperial-buttons').hide();
    });

    $(".auctions-lots input[type='checkbox']").click(function(e){
        var userId = parseInt($(this).attr('data_id'));
        var lotId = parseInt($(this).val());
        if ($(this).is(':checked')){
           $.ajax({
                url: '/auctions/lots/addlotfromcheckbox',
                data: {lotId:lotId,userId:userId},
                dataType: "json",
                success:function(data){
                   console.log(data.success);
                },
                error:function(errors){
                   console.log(errors);
                }
           });

        } else {
                   $.ajax({
                        url: '/auctions/lots/removelotfromcheckbox',
                        data: {lotId:lotId,userId:userId},
                        dataType: "json",
                        success:function(data){
                           console.log(data.success);
                        },
                        error:function(errors){
                           console.log(errors);
                        }
                   });
        }
    });

    $("#minRateSum").click(function(){
         var sum = parseInt($(this).text());
         $('#historylots-sum').val(sum);
         $('#profilelots-sum').val(sum);

    });

           $("#link_show_all").on('click',function(e){
               e.preventDefault();
               $(this).parents('.toggle').hide();
               $("#bid_all_sum").show();
               $("#profilelots-sum").val($("#historylots-sum").val());

           });

           $("#link_show_bid").on('click',function(e){
               e.preventDefault();
               $(this).parents('.toggle').hide();
               $("#default_bid").show();
               $("#historylots-sum").val($("#profilelots-sum").val());

           });

});