<!-- 
Delete users from the Database
Follow the link I gave you  for help
https://www.w3schools.com/php/php_mysql_update.asp
You need the $_SESSION['userID] Variable to get the ID of the user you want to update.
You need $_POST['firstName'], $_POST['lastName'] and $_POST['Role'] for the details you will update them with
Look at all the other php files with SQL on them if you need a reference to what it should look like and where you should put the variables.

-->
function updateUser()
{
<!--
//q = Query
//cq Compound Query
-->
	$q = "UPDATE `User` SET `firstName`=:fName, `lastName`=:lName, `Role`=:role where `ID` = :ID";
	$cq = REPLACEMEWITHYOURDBCONNECTION->prepare($q);
	$cq->bindValue(':fName',$_SESSION['firstName']);
	$cq->bindValue(':lName',$_SESSION['lastName']);
	$cq->bindValue(':role',$_SESSION['Role']);
	$cq->bindValue(':ID',$_SESSION['userID']);
	$res = $cq->execute();
}
?>
