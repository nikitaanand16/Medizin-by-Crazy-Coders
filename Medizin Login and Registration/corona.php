<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medizin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
    <!-- <img class="logo" src="../../public/imgs/favicon.png" alt="logo"> -->

    <img class="logo" src="medizin.png" alt="logo" style="width: 120px;">
    <nav>
        <ul class="nav__links" >
            <!-- <li><a href="/home" class="font-weight-bold"><strong>MEDIZINE</strong></a></li> -->
            <!--li class="dropdown"><a href="{% url 'index' %}">Home</a></li>
            <li><a href="#here">Treatment</a></li>
            <li><a href="{% url 'medical' %}">Medical Help</a></li>
            <li><a href="{% url 'blog' %}">Blog</a></li>
            <li><a href="{% url 'add' %}">Admin</a></li-->
            <li></li><li></li>
            <li><a href="{% url 'medical' %}"><b>USER</b></a></li>
            <li><a href="{% url 'patientq' %}"><b>DOCTOR</b></a></li>
            <li><a href="{% url 'add' %}"><b>ADMIN</b></a></li>
            <li><a href="{% url 'expert' %}"><b>AI EXPERT</b></a></li>
            <li style="font-size: 20px; visibility: hidden;"><a href="{% url 'blog' %}">BLOG</a></li>
        </ul>
    </nav>

    <a href="https://www.mohfw.gov.in/" class="cta"><button style="background-color: black"><b>Helpline</b></button></a>
    </header>
    <div class="container">

    <div class="card shadow-sm" style="padding: 20px; margin-bottom: 30px;font-size: 20px;margin-top: 3%">

    <h1 style="margin-bottom: 20px; margin-left: 2%;"><b>DIAGNOSIS OF COVID-19 FROM X-RAY SCANS</b></h1>
    <form method="POST" action="#" style="font-weight: bold;">
        <div class="form-group">
          <label for="InputName">Full Name</label>
          <input type="text" class="form-control form-rounded" id="InputName" aria-describedby="Help" required placeholder="John Clinton" name="name">
          <small id="Help" class="form-text text-muted">We'll never share your details with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="InputAge">Age</label>
          <input type="number" required class="form-control form-rounded" id="InputAge" placeholder="30" name="age">
        </div>
               
        <div class="form-group">
            <label for="InputCountry">Country</label>
            <input type="text" class="form-control form-rounded" id="InputCountry" required placeholder="Delhi, India" name="country">
        </div>
        <div class="form-group">
            <label for="Phone">Phone</label>
            <input type="number" class="form-control form-rounded" id="Phone" required placeholder="9478383847" name="phone">
        </div>  
        <div class="form-group">
                <label for="upload">Upload X-ray Scan of Lungs</label><br>
                <input type="file" name="certificate">
            </div>
        <div class="form-group">
            <button type="submit" id="submitForm" style="margin-left: 42%;width: 150px; height: 50px;">DIAGNOSE</button>
        </div> 
      </form>
    
        <div class="card" style="width: 50rem; margin-left: 13%;">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 25px; margin-left: 37.5%;"><b>PREVIEW IMAGE</b></h5>
                  <div class="alignRow" style="width: 100%">
                      <div class="imageColumn">
                      <img src="m1.png" style="margin-left: 35%">
                      </div>
                      <div class="imageColumn" style="margin-left: 25%">
                      <img src="m2.png" >
                </div>
            </div>
        </div>
      </div>
        
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card" style="color: wheat; background-color: rgba(0,136,169,0.20); margin-bottom: 30px;">
                <div class="card-body">
                  <h1 class="card-title text-danger" style="color: #edf0f1; font-weight: bold;"><a href="#" style="color: rgb(0, 136, 169);" class="h1">#</a> Result : Diagnosed with COVID-19 </h1>
                  </div>
              </div>
        </div>
   
        <div class="col-12">
            <div class="card" style="color: wheat; background-color: rgba(0,136,169,0.20); margin-bottom: 30px;">
                <div class="card-body">
                  <h1 class="card-title text-success" style="color: #edf0f1; font-weight: bold;"><a href="#" style="color: rgb(0, 136, 169);" class="h1">#</a> Accuracy : 82.63 %</h1>
                  </div>
              </div>
        </div>
    </div>
    <button type="submit" id="submitForm" style="margin-left: 40%;width: 250px; height: 50px;">GO TO MAIN PAGE</button>
    </form>
    </div>
    </div>


    <div class="footer-copyright text-center py-3" style="background-color: crimson; color: white;">© 2020 Copyright:
        <a href="https://mdbootstrap.com/"> HealthCare</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:500');
body{
    background-color: rgba(0,136,169,0.05);
    color: #24252A;
}

*{
    font-family: "Montserrat", sans-serif;
}
html {
  scroll-behavior: smooth;
}


li, a, button{
    font-family: "Montserrat", sans-serif;
    font-weight: 500;
    font-size: 16px;
    color: #edf0f1;
    text-decoration: none;
}

header{
    display: flex;
    box-sizing: border-box;
    justify-content: space-between;
    align-items: center;
    padding: 30px 10%;
    background-color: crimson;
    color: black;
}

.logo{
    cursor: pointer;
}

.nav__links{
    list-style: none;
}

.nav__links li{
    display: inline-block;
    padding: 0 20px;
}

.nav__links li a{
    transition: all 0.3s ease 0s;
}

.imageColumn {
   float: left;
   width: 25%;
   padding: 10px;
}

h1{
   text-align: center;
}

.nav__links li a:hover{
  background-color: white;
  color: black;
  text-decoration: none;
}

#x,button{
    padding: 9px 25px;
    background-color: rgba(0,136,169,1);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease 0s;
}

#x:hover,button:hover{
    color: white;
    text-decoration: none;
    background-color: rgba(0,136,169,0.8);
}

.form-rounded{
    border-radius: 1rem;
}

form > button{
    margin: auto;
    display: block;
}

p{
    font-size: 20px;
}

.heading{
    background: linear-gradient(rgba(36,37,42, .5), rgba(50, 0, 200, .5)), url('landing.jpg');  background-repeat: no-repeat; background-position: 100% -22px;
    height: 80vh;
    background-size: cover;
    background-attachment: fixed;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}
button{
    font-weight: bold;
    background-color: blue;
    color: white;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>

</<?php include 'home.php'; ?>>