<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medizin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php include 'home.php'; ?>
<body>
    <header>
    <!-- <img class="logo" src="../../public/imgs/favicon.png" alt="logo"> -->

    <img class="logo" src="medizin.png" alt="logo" style="width: 120px;">
    <nav>
        <ul class="nav__links" >
            <li></li><li></li>
            <li style="font-size: 17px"><a href="ulogin.php">USER</a></li>
            <li style="font-size: 17px"><a href="dlogin.php">DOCTOR</a></li>
            <li style="font-size: 17px"><a href="alogin.php">ADMIN</a></li>
        </ul>
    </nav>

    <a href="https://www.mohfw.gov.in/" class="cta"><button style="background-color: black;">Helpline</button></a>
    </header>

    <div class="card shadow-sm" style="width: 600px;padding: 20px; margin-left: 27%; border-color: black; margin-bottom: 7%; margin-top:3%;">
        <h3 style="text-align: center;">User Registration</h3>
        <?php 
        if(isset($_GET['info']))
        { 
            echo $_GET['info'];
        } 
        ?><br>
        <form action="home.php" method="POST">   
             <div class="form-group">
                <label for="Name">Full Name</label>
                <input type="text" class="form-control form-rounded" id="Name" placeholder="Enter your Name" name="name" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control form-rounded" id="age" placeholder="Enter your Age" name="age" required>
            </div>

             <div class="form-group" required>
                <label for="Gender">Gender&emsp;&emsp;</label>
                <label class="checkbox-inline"><input type="radio" name="gender" value="male">&emsp;Male&emsp;</label>
                <label class="checkbox-inline"><input type="radio" name="gender" value="female">&emsp;Female&emsp;</label>
            </div>

             <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control form-rounded" id="email" placeholder="Enter your E-mail" name="email" required>
            </div>

             <div class="form-group">
                <label for="phone">Phone</label>
                <input type="phone" class="form-control form-rounded" id="phone" placeholder="Enter your Phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="Date">Date of Birth</label>
                <input type="date" class="form-control form-rounded" id="date" placeholder="Enter your Date of Birth" name="dob" required>
            </div>
            
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" class="form-control form-rounded" id="password" placeholder="Password" name="password" required>
            </div>

            <div class="form-group">
                <label for="Password">Confirm Password</label>
                <input type="password" class="form-control form-rounded" id="password" placeholder="Password" name="confirmpassword" required>
            </div>


            <div><button style="margin-left: 8%" name="uregister">Register</button>
            <a id="x" href="ulogin.php" style="margin-left: 30%; background-color: blue;">Goto User Login</a>
            </div>
        </form>
    </div>

    <div class="footer-copyright text-center py-3" style="background-color: crimson; color: white;">© 2020 Copyright:
        <a href="https://mdbootstrap.com/">HealthCare</a>
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
    justify-content: space-between;
    align-items: center;
    padding: 30px 10%;
    background-color: crimson;
    color: black;
    box-sizing: border-box;
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
button{
    font-weight: bold;
    background-color: blue;
    color: white;
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
    background: linear-gradient(rgba(36,37,42, .5), rgba(50, 0, 200, .5)),;  background-repeat: no-repeat; background-position: 100% -22px;
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

.dropdown:hover .dropdown-content {
  display: block;
}
</style>

</html>