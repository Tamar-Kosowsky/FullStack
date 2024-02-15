

$(function() {    
   
    
    var audio = new Audio("sound/mixkit-arcade-game-jump-coin-216.wav");    

    // restart game params on the first time
    if(localStorage.getItem('user_points_counter')==null || localStorage.getItem('user_level')==null){
        localStorage.setItem('user_level',1);
        localStorage.setItem('user_points_counter',0);        
        localStorage.setItem('user_level_one_points',0); 
        localStorage.setItem('user_level_two_points',0); 
        localStorage.setItem('user_level_three_points',0); 
    }else{
        $(".user_points_counter").text(localStorage.getItem('user_points_counter'));
    }    



    $(document).on('click','.level_link',function(){        
         var level_link = $(this).data('link');            
         audio.play();

         setTimeout(function(){ 
             Speak('When you are ready , please press the blue button');
            window.location = window.location.origin+'/GoogleVision/'+level_link;
          }, 500);
         
    });    
    
        $(document).on('click','.remove_obj',function(){
            $(this).parents('.object_wrapper').remove();
        });    

        $(document).on('change','.img_input',function(){
            $(this).parent().css("background-color","#fff2a8");
        });    

        var random_lable = '';
        var voice = '';
        var random_wrong_answers = '';
        //var all_currect_answers = [];

        function randomWrongAnswer(){
            var wrong_answers = ['Please Try Again ' ,'Not Currect ',' Answer Is Wrong '];    
            random_wrong_answers = Math.floor(Math.random() * wrong_answers.length);
            random_wrong_answers =  wrong_answers[random_wrong_answers];
            return random_wrong_answers;
        }

        function startQuestionText(){
            var text_options = ['Please Press On The ' ,'Where Is The ',' Can you find The '];         
            var random_option =  Math.floor(Math.random() * text_options.length);
            var random_option =  text_options[random_option];   
            return random_option;
        }    
        
        function randomGoodAnswer(){
            var text_options = ['Good Answer ! ' ,'Grate !!','You are currect']; 
            var random_option =  Math.floor(Math.random() * text_options.length);
            var random_option =  text_options[random_option];   
            return random_option;
        }          

        function getRandomLable(currect_lable=''){                    
            random_option = startQuestionText();                 
            var random = Math.floor(Math.random() * $('.lable_name').length);      
                random_lable = $.trim($('.lable_name').eq(random).text());      
                voice = random_option + random_lable;   
                $(".lable_text").text(random_lable);
                $(".ask_question").hide("slow");
                return voice;
        };


        function setLevelsPoints($answer_type){

            var game_level_id = $(".game_level_id").data('lvl');
            if(game_level_id==1){

                var user_level_one_points = parseInt(localStorage.getItem('user_level_one_points'));

                if($answer_type=='plus'){
                    user_level_one_points = user_level_one_points+1;
                }else{
                    if(user_level_one_points>0){
                        user_level_one_points = user_level_one_points-1;
                    }
                }
                localStorage.setItem('user_level_one_points',user_level_one_points); 

            }else if(game_level_id==2){

                var user_level_two_points = parseInt(localStorage.getItem('user_level_two_points'));
         
                if($answer_type=='plus'){
                    user_level_two_points = user_level_two_points+1;
                }else{
                    if(user_level_two_points>0){
                        user_level_two_points = user_level_two_points-1;
                    }
                }                

                localStorage.setItem('user_level_two_points',user_level_two_points); 

            }else if(game_level_id==3){

                var user_level_three_points = parseInt(localStorage.getItem('user_level_three_points'));

                if($answer_type=='plus'){
                    user_level_three_points = user_level_three_points+1;
                }else{
                    if(user_level_three_points>0){
                        user_level_three_points = user_level_three_points-1;
                    }
                }    
                
                localStorage.setItem('user_level_three_points',user_level_three_points); 
            }    
        }

        //First time on page load
       // getRandomLable();
     
       var voices = '';
        window.speechSynthesis.onvoiceschanged = function() {
          var voices = window.speechSynthesis.getVoices();     
        };

        function Speak(text = ''){            
            
            if(text.length>0){
                var text_to_speak = text;
            }else{
                var text_to_speak = getRandomLable();
            }

            if(voices.length==0){
                 voices = speechSynthesis.getVoices();
            }

            var message = new SpeechSynthesisUtterance(text_to_speak);
            //voices = speechSynthesis.getVoices();
            
            message.voice = voices[1];
            message.volume = '0.7';
            message[1];     
            
            speechSynthesis.speak(message);
    
            // Hack around voices bug
            var interval = setInterval(function () {
                voices = speechSynthesis.getVoices();
                if (voices.length) clearInterval(interval); else return;
    
                for (var i = 0; i < voices.length; i++) {
                    $("select").append("<option value=\"" + i + "\">" + voices[i].name + "</option>");
                }
            }, 5);
        }
  

        $(".ask_question").on("click", function () {
            Speak();
        });


        $(".start_game").on("click", function () {
            localStorage.setItem('user_level',1);
            localStorage.setItem('user_points_counter',0);        
            localStorage.setItem('user_level_one_points',0); 
            localStorage.setItem('user_level_two_points',0); 
            localStorage.setItem('user_level_three_points',0); 
            window.location = window.location;
        });
        


        // when user press on image  
        
        $(".image_lable").on("click", function () {
            //$(".ask_question").show();
            var answer_check = false;
           // next question
            var user_image_lable = $(this).parent().find('span.lable_name');

            for (i = 0; i < user_image_lable.length; ++i) {
                if(user_image_lable[i].innerText==random_lable){                    
                    answer_check=true;
                }
            }

            if(answer_check){           

                Speak(randomGoodAnswer());    
                
                $(document).find("span.lable_name:contains("+random_lable+")").remove();
                if($('.lable_name').length>0){
                    setUserLevel('plus'); 
                    var current_lable = getRandomLable(user_image_lable);   
                    Speak(current_lable);    
                    setLevelsPoints('plus');                                                 
                    runEffect($(this));                    
                }else{
                   // no more questions
                   setUserLevel('plus');
                   setLevelsPoints('plus');
                   setUserLevel('ask_for_new_level');
                }                                                                
            }else{       
                setUserLevel('minus');         
                Speak(randomWrongAnswer());
                setLevelsPoints('minus');
            }
                        
        });    
        
        function setUserLevel($flag){
     
            if($flag=='ask_for_new_level'){                
                // get cuurent game level                
               var game_level_id = $(".game_level_id").data('lvl'); 
    

                if(game_level_id<3){
                    $(".user_level").text((parseInt(game_level_id)+1));
                    $('#confirm-next').modal('show');
                    Speak('Prees on the green button for next level');
                }else{
                                       
                    $('#confirm-end').modal('show');
                    $(".finel_points").text(user_points_counter);
                }               
                
            }else{
       
                var user_level=1; 
                //if user enter the first time
                if(localStorage.getItem('user_level')==undefined || localStorage.getItem('user_level')=='' || localStorage.getItem('user_level')==null ){
                    //SET user level on browser local storage                 
                     localStorage.setItem('user_level',1);          
                              
                    $('.level_1').text(0);
                    $('.level_2').text(0);
                    $('.level_3').text(0);
                    Speak('To begin pleas press on the blue button');
                }else
                {//if user enter allready play
                    //GET user level on browser local storage
                    var user_points_counter = localStorage.getItem('user_points_counter');
    
                    if($flag=='plus'){
                        user_points_counter = parseInt(user_points_counter)+ 1;
                    }else{
                        if(user_points_counter>0){
                            user_points_counter = parseInt(user_points_counter)-1;
                        }
                    }                
                    localStorage.setItem('user_points_counter',user_points_counter);          
                }                
                
                $(".user_points_counter").text(user_points_counter);
            }
            
     
        }
});

    
if(localStorage.getItem('user_level_one_points')!=undefined 
&& localStorage.getItem('user_level_one_points')!='' 
&& localStorage.getItem('user_level_one_points')!=null ){
    
    $('.level_1').text(localStorage.getItem('user_level_one_points'));
    $('.level_2').text(localStorage.getItem('user_level_two_points'));
    $('.level_3').text(localStorage.getItem('user_level_three_points'));
    
}


$('#confirm-next').on('click', '.btn-ok', function(e) {
    
    var game_level_id = $(".game_level_id").data('lvl');
    game_level_id =  (parseInt(game_level_id)+1);
    if(game_level_id<4){    
        window.location = window.location.pathname+"?game_level_id="+ game_level_id;
    }else{
        alert('end game');
    }    
});

$('#confirm-next').on('show.bs.modal', function(e) {    
    $('.reload_game').show();
});






/* floating point to star */


function runEffect(obj){
		
    var picture =  obj;    	
    user_image = picture.attr("src");						        
    
    var movmentTypme = 0;    
    
setTimeout(
          function() 
          {
        
    var cart = $('.user_points_counter');
  //  var imgtodrag = picture;
    if (picture) {
        var imgclone = picture.clone()
            .offset({
            top: picture.offset().top,
            left: picture.offset().left
        })
            .css({
                'opacity': '0.9',
                'position': 'absolute',
                'height': '200px',
                'width': '277px',
                'z-index': '999999'
        })
            .appendTo($('body'))
            .animate({
            'top': cart.offset().top + 10,
                'left': cart.offset().left + 10,
                'width': 200,
                'height': 20
        }, 1000, 'easeInOutExpo');
        

        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {
            $(this).detach();           
        });	            	            
    }			

   
    
    }, movmentTypme);


    setTimeout(
        function() 
        {
            var retro_game_point = new Audio("sound/mixkit-retro-game-notification-212.wav");
            retro_game_point.play();   
        }, 1200);
}

