<html>
<head>
      <title>AdminIN</title>
	  
	  
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style> 
.div1 {
    background-image: url(white-wood-texture-background-design_1022-75.jpg);
    text-align: center;
    width: 1330px;
    height: 100px;
    border: 1px solid blue;
    box-sizing: border-box;
	front-colar:white-space;
}

.div2 {
    background-image: url(white-wood-texture-background-design_1022-75.jpg);
    text-align: center;
    width: 1330px;
    height: 70px;    
    padding: 1px;
    border: 1px solid red;
    box-sizing: border-box;
	}
	.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}

.button1 {
    
}

.button2:hover {
   
}

.flex-container {
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: row-reverse;
    flex-direction: row-reverse;
    width: 1330px;
    height: 450px;
    background-color: lightgrey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 450px;
    margin: 2px;
}

h1 {
   color: black;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

</style>

</head>


<body>
<form>

<div class="div1"><h1>DICCI NICCI TUTOR</h1></div>
<div class="div2">


<a href="http://localhost/Project/dnt.html" class="button">Home</button></a>
<a href="http://localhost/Project/ParentLogin.php" class="button">Search tutor</button></a>
<a href="http://localhost/Project/TutorLogIn.php" class="button">Search tution</button></a>
<a href="http://localhost/Project/Contact.html" class="button">Contact </button></a>
<a href="http://localhost/Project/adminLogin.php" class="button">Admin</button></a>

</div>
<div class="flex-container">

 <div class="flex-item">
 </div>
  <div class="flex-item">
  <h2>Search a Tutor or Parent by using his/her Id </h2>
  <h3>Search a Parent </h3>
  <h3><input type="text" name="PID"></h3>
  <h3><input type="submit" value ="delete"></h3>

  <h3></h3>

</div>
<div class="flex-item">
</form>

<form >
<h3><input type="submit" value ="logout"></h3>
</form>
</div>

</body>
</html>
