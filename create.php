<script>
function validate()
{
	//alert("we are validating your data");
	//return false;
	var firstname= document.forms["reg"]["firstname"];
	var lastname= document.forms["reg"]["lastname"];
	var email= document.forms["reg"]["email"];
	var age= document.forms["reg"]["age"];
	var location= document.forms["reg"]["location"];	
    if(firstname.value=="")
	{
		alert("enter a valid firstname");
		document.forms["reg"]["firstname"].focus();
		return false;
	}
	else if(lastname.value=="")
	{
		alert("enter a valid lastname");
		document.forms["reg"]["lastname"].focus();
		return false;
	}
	else if(email.value=="")
	{
		alert("enter a valid mail id");
		document.forms["reg"]["email"].focus();
		return false;
	}
	else if(age.value=="")
	{
		alert("enter a valid age");
		document.forms["reg"]["age"].focus();
		return false;
	}
	else if(location.value=="")
	{
		alert("enter your location");
		document.forms["reg"]["location"].focus();
		return false;
	}
	else
		alert("Dear "+firstname.value);
	
}
</script>
<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";
    $fname ="";
		$lname ="";
		$email ="";
		$age ="";
		$loc ="";
	
		$fname_e ="";
		$lname_e ="";
		$email_e ="";
		$age_e ="";
		$loc_e ="";
	
	
		if (empty($_POST["firstname"])) 
		{
			$fname_e="First name is required";		
		}
		else 
		{
			$fname = $_POST["firstname"];
		}
		if (empty($_POST["lastname"])) 
		{
			?> <script> alert("Last Name is required"); </script> <?php
		}
		else 
		{
			$lname = $_POST["lastname"];
		}
		if (empty($_POST["email"])) 
		{
			?> <script> alert("email is required"); </script> <?php
		}
		else 
		{
			$email = $_POST["email"];
			if (!preg_match("/([w-]+@[w-]+.[w-]+)/",$email)) 
			{
				$email_e = "Invalid email format";
			}
		}
		if (empty($_POST["age"])) 
		{
			?> <script> alert("age is required"); </script> <?php
			
		}
		else 
		{
			$age =$_POST["age"];
		}
		if (empty($_POST["location"])) 
		{
			?> <script> alert("location is required"); </script> <?php
		}
		else 
		{
			$loc = $_POST["location"];
		}
	
	?> <blockquote> ERROR in Server Side . </blockquote> <?php


if(($fname!="") and ($lname!="") and ($email!="") and ($age!="") and ($loc!="") )
	{
    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "age"       => $_POST['age'],
            "location"  => $_POST['location']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "abhi",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
}
?>


<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>

<h2>Add a user</h2>

<form method="post" onsubmit="return validate()" name="reg">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
