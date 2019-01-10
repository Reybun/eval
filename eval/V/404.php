<html>

            <link href="./V/css/for404.css" rel="stylesheet"/>
 <body style="background-color: black">
<p style='color:white'>en gros si t'arrives la cest que t'as merde. Mais tas le droit de voir des yeux faient main</p>
     <div id="box">
         <div id="minion">
             <div id="eye"><img src="./V/img/rond.png"></div>
            </div>
        </div> 
        
        <div id="box1">
            <div id="m">
                <div id="eye1"><img src="./V/img/rond.png"></div>
            </div>
        </div>       
        
        <br>

        <p style="text-align:center;margin-top:21%"><img src="./V/img/404.png" width="360px" height="320px"></p>
        
        
        
        
        <script src="./V/js/jquery-1.10.2.min.js"></script>
        
        <script type="text/javascript">
        
            var object=$("#eye");
            var object2=$("#eye1");

            if(object.length > 0){
                var offset = object.offset(); 
                
                function move(e){
                    var center_X = (offset.left + 5) + (object.width() / 2);
                    var center_Y = (offset.top) + (object.height() / 2);
                    var mouse_X = e.pageX;
                    var mouse_Y = e.pageY;
                    
                    var radius = Math.atan2(mouse_X - center_X, mouse_Y - center_Y);
                    var degree = (radius * (180 / Math.PI) * -1)+180;
                    
                    object.css('transform','rotate('+degree+'deg)');  
                    object2.css('transform','rotate('+degree+'deg)');      
                }
                
                $("#box").mousemove(move);
            }
        
        </script>
        <!--on s'amuse comme on peut -->
        <iframe src="./V/img/pkm.mp3" allow="autoplay" allow="loop" style="display:none" id="iframeAudio">
        </iframe> 
    </body>


</html>