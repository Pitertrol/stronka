 <?php include ("./inc/header.inc.php" ); ?>
 <?php
 $connect = mysqli_connect("localhost","root","") or die("Couldn't connect to SQL server");
mysqli_select_db($connect,"youngauthors") or die("Couldn't select DB");

$reg =@$_POST['reg'];
$fn = "";
$ln = "";
$un = "";
$em = "";
$em2 = "";
$pswd = "";
$pswd2 = "";
$d = "";
$u_check = "";
//register form
$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$em2 = strip_tags(@$_POST['email2']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d");

  if($reg) {
  if($em == $em2) {
   //	
   $u_check = mysql_query("SELECT username FROM users WHERE username='$un'");
   //
  $check = mysql_num_rows($u_check);
  if ($check == 0) {
  //
   if($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) {
  // 	
    if ($pswd==$pswd2) {
  //  	
     if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
      echo "The maximum limit for username/first name/lastname in 25 characters!";
     }
     else
     {
      if (strlen($pswd)>30||strlen($pswd)<5) {
       echo "Your password must be betwenn 5 and 30 characters long";
      }
      else 
      {
       $pswd = md5($pswd);
       $pswd2 = md5($pswd2);
       $query = mysql_query("INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$pswd', '$d', '0')");
       die ("<h2>Welcome in TheYoungAuthors.net</h2> Login your account to start ... ");
      }
      }
      }
    else {
     echo " passwords didn't match";
    } 
   }
   else 
   {
    echo "Please fill in all fields";
   }
  }
  else
   {
   echo "Username is already taken...";
  }
 }
else {
 echo " e-mails don´t match";
}
}

//login code

 if (isset($_POST["user_login"]) && isset($_POST["user_login"])) {
 	$user_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["user_login"]);
    $password_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password_login"]);
    $password_login_md5 =md5($password_login);
 $sql = mysql_query("SELECT id FROM users WHERE username='$user_login' AND password='$password_login_md5'  LIMIT 1");
    $userCount = mysql_num_rows($sql);
    if ($userCount == 1) {   
    	while($row = mysql_fetch_array($sql)){
    		$id = $row["id"];
    }
       $_SESSION["user_login"] = $user_login;	
       header("location: home.php");
       exit();
       } else { 
       echo 'Sorry, but that information is incorrect.';
       exit();	
    }
}

?>﻿

    
     <table>
     	<tr>
     		<td width="60%" valign="top">
     		    <h2>If you are member, LogIn!</h2>  
     		    <form action="index.php" method="POST">
                 <input type="text" name="user_login" size="25" placeholder="Username"/><br /><br />
                 <input type="password" name="password_login" size="25" placeholder="Password"/><br /><br />
                 <input type="submit" name="login" value="Login!">
     		    </form>                      
     		</td>
     		<td width="40%" valign="top">
     			<h2>Sign Up!</h2>
     			<form action="index.php" method="POST">
                     <input type="text" name="fname" size="25" placeholder="First Name"/><br /><br />
                     <input type="text" name="lname" size="25" placeholder="Last Name"/><br /><br />
                     <input type="text" name="username" size="25" placeholder="Username"/><br /><br />
                     <input type="text" name="email" size="25" placeholder="E-Mail"/><br /><br />
                     <input type="text" name="email2" size="25" placeholder="Repeat E-Mail"/><br /><br />
                     <input type="password" name="password" size="25" placeholder="Password"/><br /><br />
                     <input type="password" name="password2" size="25" placeholder="Repeat Password"/><br /><br />
                     <input type="submit" name="reg" value="Register now !">
     			</form>
     		</td>
     	</tr>
     </table>

     <?php include ( "./inc/footer.inc.php" ); ?>