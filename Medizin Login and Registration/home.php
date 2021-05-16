<?php
    if ($_POST) {
        if (isset($_POST['dlogin'])) {
            dlogin();
        }
        elseif (isset($_POST['dregister'])) {
            dregister();
        }
        elseif (isset($_POST['uregister'])) {
            uregister();
        }
        elseif (isset($_POST['ulogin'])) {
            ulogin();
        }
        elseif (isset($_POST['alogin'])) {
            alogin();
        }
    }

    function create_database(){
		$servername = "localhost";
		$username = "root";
		$password = "";

		// Create connection
		$conn = new mysqli($servername, $username, $password);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// Create database
		$sql = "CREATE DATABASE Medizin";
		if ($conn->query($sql) === TRUE) {
		  echo "Database created successfully";
		} else {
		  echo "Error creating Database: " . $conn->error;
		}
		$conn->close();
	}

	function createDoctortable(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// sql to create table
		$sql = "CREATE TABLE Doctor(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		full VARCHAR(30) NOT NULL,
		age int(2) NOT NULL,
		gender VARCHAR(10) NOT NULL,
		email NVARCHAR(50) NOT NULL,
		phone VARCHAR(15) NOT NULL,
		dob VARCHAR(25) NOT NULL,
		specialization VARCHAR(35) NOT NULL,
		hospital_name VARCHAR(35) NOT NULL,
		address VARCHAR(35) NOT NULL,
		password NVARCHAR(50) NOT NULL		
		)";

		if ($conn->query($sql) === TRUE) {
		  echo "Table Doctor created successfully";
		} 
		else {
		  echo "Error creating table Doctor: " . $conn->error;
		}

		$conn->close();
	}

	function createUsertable(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// sql to create table
		$sql = "CREATE TABLE User(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		full VARCHAR(30) NOT NULL,
		age int(2) NOT NULL,
		gender VARCHAR(10) NOT NULL,
		email NVARCHAR(50) NOT NULL,
		phone VARCHAR(15) NOT NULL,
		dob VARCHAR(25) NOT NULL,
		password NVARCHAR(50) NOT NULL		
		)";

		if ($conn->query($sql) === TRUE) {
		  echo "Table User created successfully";
		} 
		else {
		  echo "Error creating table User: " . $conn->error;
		}

		$conn->close();
	}

	function createAdmintable(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// sql to create table
		$sql = "CREATE TABLE Admin(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		full VARCHAR(30) NOT NULL,
		age int(2) NOT NULL,
		gender VARCHAR(10) NOT NULL,
		email NVARCHAR(50) NOT NULL,
		phone VARCHAR(15) NOT NULL,
		dob VARCHAR(25) NOT NULL,
		password NVARCHAR(50) NOT NULL		
		)";

		if ($conn->query($sql) === TRUE) {
		  echo "Table Admin created successfully";
		} 
		else {
		  echo "Error creating table Admin: " . $conn->error;
		}

		$conn->close();
	}

	function createDoctorRequest(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// sql to create table
		$sql = "CREATE TABLE DoctorRequest(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		full VARCHAR(30) NOT NULL,
		age int(2) NOT NULL,
		gender VARCHAR(10) NOT NULL,
		email NVARCHAR(50) NOT NULL,
		phone VARCHAR(15) NOT NULL,
		dob VARCHAR(25) NOT NULL,
		specialization VARCHAR(35) NOT NULL,
		hospital_name VARCHAR(35) NOT NULL,
		address VARCHAR(35) NOT NULL		
		)";

		if ($conn->query($sql) === TRUE) {
		  echo "Table DoctorRequest created successfully";
		} 
		else {
		  echo "Error creating table Doctor: " . $conn->error;
		}

		$conn->close();
	}



	function add_admin(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$confirmpassword=md5('Harry');
		$sql = "INSERT INTO Admin (full,age,gender,email,phone,dob,password)
		VALUES ('Hariharan.R.S',20,'male','haran8861@gmail.com','9487984214','2000-11-15','$confirmpassword')";

		if ($conn->query($sql) === TRUE) {
		  echo "New admin created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}

	function add_doctor(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$confirmpassword=md5('srinath');	
		$sql = "INSERT INTO Doctor (full,age,gender,email,phone,dob,specialization,hospital_name,address,password)
		VALUES ('Srinath',25,'male','srinath@gmail.com','9839284214','2003-11-15','Cardiologist','Sri Hospital','India','$confirmpassword')";

		if ($conn->query($sql) === TRUE) {
		  echo "New admin created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}

	function uregister(){
		$name=$_POST["name"];
		$age=$_POST["age"];
		$gender=$_POST["gender"];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$dob=$_POST["dob"];
		$password=md5($_POST["password"]);
		$confirmpassword=md5($_POST["confirmpassword"]);
		$info="";
		if($password!=$confirmpassword){
			$info="Password and Confirm Password not matching.";
		}
		else{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO User (full,age,gender,email,phone,dob,password)
		VALUES ('$name',$age,'$gender','$email','$phone','$dob','$confirmpassword')";

		if ($conn->query($sql) === TRUE) {
		  $info="New User created successfully";
		} else {
		  $info="Error: " .$conn->error;
		}
		$conn->close();
		}
		header("Location: uregister.php?info=".$info);
	};

	function ulogin(){
		$user=$_POST["Name"];
		$pass=md5($_POST["password"]);

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		$info="";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM User WHERE email='$user'";
		$result = $conn->query($sql);

		if ($result->num_rows >0) {
		  // output data of row
			$row = $result->fetch_assoc();  
		  	if($row["password"]==$pass){
		  		$info="User Login successfully";
		  	}
		  	else{
		  		$info="Wrong password. Try again !";
		  	}
		} else {
		  $info="No user with that username";
		}
		$conn->close();
		header("Location: ulogin.php?info=".$info);
	};

	function dlogin(){
		$user=$_POST["Name"];
		$pass=md5($_POST["password"]);

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		$info="";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM Doctor WHERE email='$user'";
		$result = $conn->query($sql);

		if ($result->num_rows >0) {
		  // output data of row
			$row = $result->fetch_assoc();  
		  	if($row["password"]==$pass){
		  		$info="Doctor Login successfully";
		  	}
		  	else{
		  		$info="Wrong password. Try again !";
		  	}
		} else {
		  $info="No Doctor with that username";
		}
		$conn->close();
		header("Location: dlogin.php?info=".$info);
	};

	function alogin(){
		$user=$_POST["Name"];
		$pass=md5($_POST["password"]);

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$info="";

		$sql = "SELECT * FROM Admin WHERE email='$user'";
		$result = $conn->query($sql);

		if ($result->num_rows >0) {
		  // output data of row
			$row = $result->fetch_assoc();  
		  	if($row["password"]==$pass){
		  		$info="Admin Login successfully";
		  	}
		  	else{
		  		$info="Wrong password. Try again !";
		  	}
		} else {
		  $info="No Admin with that username";
		}
		$conn->close();
		header("Location: alogin.php?info=".$info);
	};

	function dregister()
	{	
		$name=$_POST["Name"];
		$age=$_POST["age"];
		$gender=$_POST["gender"];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$date=$_POST["date"];
		$specialization=$_POST["specialization"];
		$hospital=$_POST["hospital"];
		$address=$_POST["address"];
		$info="";

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Medizin";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO DoctorRequest (full,age,gender,email,phone,dob,specialization,hospital_name,address)
		VALUES ('$name',$age,'$gender','$email','$phone','$dob','$specialization','$hospital','$address')";

		if ($conn->query($sql) === TRUE) {
		  $info="Doctor Request submitted successfully. Our team will get in touch with you soon.";
		} else {
		  $info="Error: " .$conn->error;
		}
		$conn->close();
		header("Location: dregister.php?info=".$info);
	};

	#create_database();
	#createAdmintable();
	#createUsertable();
	#createDoctortable();
	#add_admin();
	#add_doctor();
	#createDoctorRequest();


?>