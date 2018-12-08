<?php
  include('db.php');
Class Recommend
{
   function getTotalCommentValue($id)
        {
         $q = "Select sum(commentValue) AS postive  from comments_nlp where item_id=$id";
            $result = mysql_query($q);
            if($row = mysql_fetch_array($result)){
                $postive = $row['postive'];
            }
            return $postive;   
        }  
        
         function getTotalSell($id)
        {
         $q = "Select sum(commentValue) AS postive  from comments_nlp where item_id=$id";
            $result = mysql_query($q);
            if($row = mysql_fetch_array($result)){
                $postive = $row['postive'];
            }
            return $postive;   
        } 
}
 ?>
