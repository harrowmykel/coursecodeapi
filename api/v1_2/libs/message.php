<?php	

  function sendMsg(){
    $user=getThisUser();
    $useri=getOtherUser();
    $time=time();
    $persy=getPostString('body');
    if(!empty($persy) && ucfirst($user)!=ucfirst($useri)){ 
      if(!(queryNum("SELECT * FROM misc__ WHERE user='$useri' AND email_notification=0")>0)){
        //send message as a email.
        //if log in time >2 daysor notification is enabled
        notifyNewMessage($user, $useri);
      }     
      $q="INSERT INTO pmesages (user_id, reciv, aut, time, text, del_recip, del_auth, confirm, pic) VALUES(NULL, '$useri', '$user', $time, '$persy',0,0, 'w', 1)";
      queryMysql($q); 
    }
    return success(324);
  }

  function getNewMessages(){
    $user=getThisUser();
    $numb=checknum("SELECT aut FROM pmesages WHERE reciv='$user' AND confirm='w'");
    return returnOneString($numb);
  }

  function delMsg(){
    $user=getThisUser();
    $useri=getOtherUser();
    //this is particularly dangerous i wont create a different space for a 
    //single delete. i will use a function for both delete singularly and multiples
    $msg_id=getPostString("msg_id");
    $msg_id=(empty($msg_id) || !is_numeric($msg_id))?0:$msg_id;
    $Addictive="";

    $quer="SELECT * FROM pmesages WHERE (reciv='$user' OR aut='$useri') AND user_id=$msg_id";
    if(queryNum($quer)>0){
      $arr=fetch_assoc($quer);
      foreach ($arr as $key => $value) {
        $ty=($value['msg_auth']=="$username")?"del_auth":"del_recip";
        $query="UPDATE pmesages SET $ty=1 WHERE user_id=$msg_id";
        queryMysql($query);
      }
        return success(324);
    }
    return emptyArray();
  }

  function getMessageLists(){
    $user=getThisUser();
    $array=array();
    $arra=array();
    $qq="SELECT DISTINCT pmesages.aut,pmesages.reciv FROM pmesages WHERE reciv='$user' OR aut='$user'";
    $result=queryMysql($qq);
    $num= $result->num_rows;
    $result=queryMysql($qq.calcpages($num, NO_OF_MSGS));
    $num= $result->num_rows;
    $arr=[];
    for($i=0; $i<$num; $i++){
      $rowd = $result->fetch_array(MYSQLI_ASSOC);
      $useri=($user==$rowd['aut'])?$rowd['reciv']:$rowd['aut'];
      if(in_array(ucfirst($useri), $arr) || $user==$useri)
        continue;
      $arr[]=ucfirst($useri);
      $qq="SELECT * FROM pmesages WHERE (reciv='$user' AND aut='$useri') OR (reciv='$useri' AND aut='$user') ORDER BY pmesages.time DESC LIMIT 1";
      $resultf=queryMysql($qq);
      $row = $resultf->fetch_array(MYSQLI_ASSOC);
      $subtitle=$row['text'];
      $useri=($user==$row['aut'])?$row['reciv']:$row['aut'];
      $fullname=getFullname($useri);
      if(!empty($subtitle)){
        array_push($array, array("username"=>$useri,
                    "userid"=>$useri,
                    "fullname"=>getFullname($useri),
                    "subtitle"=>$subtitle,
                    "timestamp"=>$row['time'],
                    "read"=>($user!=$row['aut'])?$row['confirm']:"r"));
      }
    }
    $arra= array($array, array("pages"=>teil($num/NO_OF_MSGS), "pagination"=>getCurrentPage()));
    return $arra;
  }

  function getMessages(){
    $array=array();
    $user=getThisUser();
    $useri=getOtherUser();
    $qq="SELECT * FROM pmesages WHERE (reciv='$user' AND aut='$useri') OR (reciv='$useri' AND aut='$user') ORDER BY pmesages.time DESC";
    $num= checknum($qq);
    $resultf=queryMysql($qq.calcpages($num, NO_OF_MSGS));

    $top=checknum($qq.calcpages($num, NO_OF_MSGS));
    $i=0;
    while($top>0){
      $row = $resultf->fetch_array(MYSQLI_ASSOC);
      $subtitle=$row['text'];
      $useri=($user==$row['aut'])?$row['reciv']:$row['aut'];
      $image=getUserDP($useri);
      $fullname=getFullname($useri);

      array_push($array, array("auth_username"=>$row['aut'],
                  "reciv"=>$row['reciv'],
                  "message"=>$row['text'],
                  "auth"=>getFullname($row['aut']),
                  "time"=>$row['time'],
                  "timestamp"=>$row['time'],
                  "image"=>$image,
                  "read"=>($user!=$row['aut'])?$row['confirm']:"r"));
      $i++;
      $top--;
    }
    $arra= array($array, array("pages"=>teil($num/NO_OF_MSGS), "pagination"=>getCurrentPage()));
    $qqo="UPDATE pmesages SET confirm='r' WHERE (reciv='$user' AND aut='$useri') OR (reciv='$user' AND aut='$user')";
    queryMysql($qqo);
    return $arra;
  }


?>