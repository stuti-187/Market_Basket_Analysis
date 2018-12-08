 
<?php
require_once('nlp.php');
require_once('db.php');
$itemid = $_POST['itemid'];
$Comments = $_POST['txtReview'];
$userid ='rk@gmail.com';// $_POST['userid'];
$commentValue = getNLPvalue($Comments);
 
if(isset($itemid ) && isset($Comments) && isset($userid))
{
$insert = mysql_query("INSERT INTO comments_nlp (item_id, comments, commentValue, user_id) VALUES('$itemid','$Comments','$commentValue','$userid')");
header("location: product-details.php?prodid=".$itemid);
exit();
}
else
{
    
 header("location: product-details.php?prodid=".$itemid);
 
}

?>
  