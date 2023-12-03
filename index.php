<!DOCTYPE html>

<html>

<head>
<title>Home Page</title>
<style>
   
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body
{
margin: 0;
padding: 0;
background: linear-gradient( to right , #e2ecfe , #e6dbfa);     
}

.logo img{
position: absolute;
margin-top: 5px;
margin-left: 30px;
width: 150px;
height: 100px;
}  

h2{
text-align: center;
padding-top: 120px;
font-size: 70px;
color: #4f0099;
font-weight: 400;
padding-right: -140px;
} 

.container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  height: 50vh;
}

.buttons {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  gap: 20px;
}

.buttons .bto{
   height: 70px;
   width: 230px;
   outline: none;
   color: #fff;
   font-size: 25px;
   font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
   background: linear-gradient(135deg, #5586e3 , #a33ee7 );
   border: none;
   border-radius: 5px;
   color: #eff0f8;
}

.buttons .bto:hover{
    background: linear-gradient(-135deg, #5586e3 , #a33ee7 );
}

.buttons .bto a{
    text-decoration: none;
    color: #eff0f8;
}

.login-links {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  gap: 50px;
  margin-top: 20px;
  font-size: 20px;
}

.login-link a {
  text-decoration: none;
}
.text-center {
  text-align: center;
   background:  linear-gradient(-135deg, #5586e3 , #a33ee7 );
}

/* .container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 50vh;
}

.buttons {
  display: flex;
  gap: 20px;
}

.buttons .bto{
   height: 70px;
   width: 230px;
   outline: none;
   color: #fff;
   font-size: 25px;
   font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
   background: linear-gradient(135deg, #5586e3 , #a33ee7 );
   border: none;
   border-radius: 5px;
   color: #eff0f8;
}

.buttons .bto:hover{
    background: linear-gradient(-135deg, #5586e3 , #a33ee7 );
}

.buttons .bto a{
    text-decoration: none;
    color: #eff0f8;
}

.login-links {
  display: flex;
  gap: 50px;
  margin-top: 20px;
  font-size: 20px;
} */

/* .login-link a {
  text-decoration: none;
} */



</style>
</head>

<body>

<!--    <div class="logo"> 
        <a href="#"><img src="images\logo.png" alt=""> </a>   
   </div>-->

            <a href="https://www.bing.com/search?q=git.exe&gs_lcrp=EgZjaHJvbWUqBwgAEEUYwgMyBwgAEEUYwgMyBwgBEOwHGEDSAQ0zMzcwNTk4NDRqMGo0qAIBsAIB&FORM=ANAB01&PC=HCTS">
               <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
            </a>
   
   <h2>ClASS CHEAK</h2>

   <div class="container">

    <div class="buttons">
      <button class="bto"> <a href="InstructorLogin.php">Instructor Log-in</a></button>
      <button class="bto"> <a href="StudentLogin.php">Student Log-in</a></button>
    </div>

    <div class="login-links">

    <div class="login-link">
        <p>New Intructor? <a href="InstructorSignup.php"> Sign-up</a></p>
    </div>

    <div class="login-link">
        <p>New Student?<a href="StudentSignup.php"> Sign-up</a> </p>
    </div>
    
    </div>

  </div>


<footer class="text-center">
       <p>@Copyright KSU - IT department</p>
  </footer>

</body>

</html>
