<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
include_ONCE("UserAnswerSQL.php");
$db = new SQLite3('/xampp/Data/StudentModule.db');
$stmt = $db->prepare('SELECT Role FROM User WHERE UserName = :username ');
$stmt->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
$result = $stmt->execute();
$rows_array = [];
while ($row=$result->fetchArray())
{
    $rows_array[]=$row;
}
if($rows_array[0][0] == "Admin")
{
    include('/xampp/htdocs/groupfour-main/admin/AdminNavBar.php');
}
else if($rows_array[0][0] == "Manager"){
    include('/xampp/htdocs/groupfour-main/manager/ManagerNavBar.php');
}
else{
    include('/xampp/htdocs/groupfour-main/user/UserNavBar.php');
}

if (isset($_POST['submit'])) {
  $answerReview = AnswerReviewFunc();
  header('Location: userAnswerConfirmation.php?createUser='.$answerReview); 
  exit();
}


?>


<?php
$userID = $_SESSION['userID'];
$dbQ = new SQLite3('/xampp/Data/StudentModule.db');
$stmtQ = $db->prepare("SELECT Question_1, Question_2, Question_3, Question_4, Question_5, Question_6, 
Question_7, Question_8, Question_9, Question_10, Question_11, Question_12, AppraiserID, ReviewID FROM ReviewsQ WHERE AppraiseeID = $userID ");
$resultQ = $stmtQ->execute();
$rows_arrayQ = [];
while ($rowQ=$resultQ->fetchArray())
{
    $rows_arrayQ[]=$rowQ;
}
$_SESSION['appraiserID']= $rows_arrayQ[0][12] ;
$_SESSION['reviewID']= $rows_arrayQ[0][13] ;
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/groupfour-main/site.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <form method="post">
  <div class="reviewCanvas col-md-6" style = "margin-bottom: 100px;">
    <main class="form-signin">
      <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
          <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
          <div style="text-align: center">
            <h1 style="color: #004C89">Answer Reviews Page</h1>
          </div>
          <div style="text-align: center">
          <table style="width: 100%;text-align: center ;border: solid 2px black;">
          <tr style="">
          <th>Questions</th>
          <th>Answers</th>
          </tr>
            <?php for ($x = 1; $x < 12; $x+=1) {?>
              
                <tr style="border: solid 2px black">
                  <?php if($rows_arrayQ[0][$x] != null){ ?>
                    <td> <label for="floatingInput"class="questionsFont reviewLabel"><?php echo $rows_arrayQ[0][$x]." "?></label> </td>
                    <td style="width:70% "> <textarea rows="4" cols="50"  placeholder="Answer ..."class="inputFields reviewInput" id="answer" name=<?php echo "answer".$x?>></textarea> </td>
                  <?php } ?>
                  </tr>
            <?php } ?>
            </table>
            <button class="w-50 btn btn-lg btn-primary" style="align: center;margin-top:20px" type="submit" name="submit" value="User Login">Publish the Review</button>
          </div>
        </form>
    </main>
  </div>

<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>