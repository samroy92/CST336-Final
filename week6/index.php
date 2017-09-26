<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>index</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
   <!--*************jQuery MAKE SURE YOU HAVE IT************-->
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <style>
       img { width: 100px;
              cursor: pointer;
            }
  </style>
</head>

<body>
  <div>
 <!--*************STEP 1 ************-->
 <h2>More than a Vocabulary Quiz</h2>
 
  <div id="q1">
      <h3>1. Click on "El Pollo"</h3>  
      <img id="cat" src="cat.png" >
      <img id="dog" src="dog.png" >
      <img id="chicken" src="chicken.png" >
      <img id="mouse" src="mouse.png" >
  </div>
  
 <!--*************STEP 3 ************-->
  <h3>2. What is cat in Spanish</h3>
  <input type="text" id="q2" />
  
  <!--*************STEP 4 ************-->
  <h3>3. What is dog in Spanish</h3>
  <input type="radio" name="q3" value="cat"> Gato <br /> 
  <input type="radio" name="q3" value="dog"> Perro <br />
  <input type="radio" name="q3" value="chicken"> Pollo <br />
  <input type="radio" name="q3" value="mouse"> Raton <br />
  
  <!--******STEP 4.2******-->
  <h3>4. What was our first president? </h3>
  <input id="q4" type="radio" name="q4" value="trump"> Trump <br /> 
  <input id="q4" type="radio" name="q4" value="washington"> Washington <br />
  <input type="radio" name="q4" value="franklin"> Franklin <br />
  <input type="radio" name="q4" value="roosevelt"> Roosevelt <br />
  
  <h3>5. Will Sam pass this class? </h3>
  <input id="q5" type="radio" name="q5" value="yes"> Yes <br /> 
  <input id="q5" type="radio" name="q5" value="no"> No <br />
  
  <br /><br />
 <!--*************STEP 5 ************-->
  <input type="button" value="Submit Quiz!" id="submitQuiz" />
  
  
  <h2 id="grade"></h2>
   
  
  </div>
  
  <script>
      <!--*************STEP 2 ************-->
      var answer1;
      $("#q1 img").mouseenter( function(){    $(this).css("width","125px")     }  );
      
      $("#q1 img").mouseleave( function(){    $(this).css("width","100px")     }  );
      
      $("#q1 img").click( function(){
          
          $("#q1 img").css("border","");    
          $(this).css("border","5px solid green")
          //alert( $(this).attr("id") );
          answer1 = $(this).attr("id");
               
       });
      
      <!--*************STEP 6 ************-->
      $("#submitQuiz").click( function(){
          var grade = 0;
          
          if (answer1 == "chicken") {
              grade = 20;
          }
          
          var answer2 = $("#q2").val().toUpperCase();
          if (answer2 == "GATO") {
              grade += 20;
          }
          
          var answer3 = $("input:radio:checked").val();
          if (answer3 == "dog") {
               grade += 20;
          }
          
          var answer4 = $('input[name=q4]:checked').val()
          if (answer4 == "washington") {
          	grade += 20;
          }
          
          var answer5 = $('input[name=q5]:checked').val()
          if (answer5 == "yes") {
          	grade +=20;
          }
          
          if(grade == 100)
          {
            $("#grade").html("Congrats, you got a perfect " + grade + "!!!")
          }
          else {
          $("#grade").html("Grade: "  + grade + "/100");
          }
                  
      }  );
      
  
      
  </script>
  
</body>
</html>