<?php
//K.G.D.R Perera IT15112538

session_start();//Start session


if(empty($_SESSION['key']))
{
    $_SESSION['key']=bin2hex(random_bytes(32));//Create CSRF Token key
    
}


$token = hash_hmac('sha256',"This is token:index.php",$_SESSION['key']);//Genarate CSRF Token


$_SESSION['CSRF'] = $token; //Store CSRF token in a session variable

ob_start(); 

echo $token;

if(isset($_POST['loginsubmit'])) //validating login
		{		
    		if($_POST['user_name'] =="admin" && $_POST['user_pswd'] =="123") 
    		{
                echo$_SESSION['CSRF'];
                header( "Location:login.php" );
            }
    		else
    		{
				header( "Location:pages/errorlogin.html" );
            }
        }


if(isset($_POST['submit'])) //check comment was submited
{
    ob_end_clean(); 
    sessionvalidate($_POST['CSR'],$_COOKIE['session_id']); //validates the csrf and session 

}


function sessionvalidate($user_CSRF,$user_sessionID)
{
    if($user_CSRF==$_SESSION['CSRF'] && $user_sessionID==session_id())
    {
        unset($_SESSION['key']);//deleting session
        header( "Location:pages/success.html" );
    }
    else
    {
	    header( "Location:pages/error.html" ); 
    }
}

?>
