// <?php
 include 'beginn.php';
 /*$rel="../api/v1/libs/";
  require_once($rel."constant.php");
  require_once($rel."db.php");
  require_once($rel."profile.php");
  require_once($rel."assignment.php");
  require_once($rel."file.php");
  require_once($rel."verifier.php");
  require_once($rel."report.php");
  require_once($rel."email.php");
  require_once($rel."ip_.php");
  require_once($rel."message.php");
  require_once("../api/"."db_vr.php");*/

  echo dirname(__FILE__) . DIRECTORY_SEPARATOR . 'library';
  var_dump(__FILE__);
  $rtyt=1;

  $erto=new apiQuery();
  // $Response=$erto->getTotalMsg(getUser(), getPass());
  // sendMsg(getUser(), getPass(), getGetString('user'), $rtyt);
  // $body=$Response->body;

        $ert=new apiQuery();
        $body=$ert->getCompressed(getUser(), getPass(), "farouk")->body;
var_dump($body);
// var_dump("<br>");
// var_dump(sendMsg());
// var_dump("<br>");
// var_dump(getMessageLists());
// var_dump("<br>");
// var_dump(json_encode(getMessages()));
// var_dump(json_encode(delMsg()));
// include '../api/v1/api.php';
/*$erto=new apiQuery();
$Response=$erto->fetchprof(getUser(), getPass());
$body=$Response->body;*/
?>

<?php 
function getThisUser(){
  return "amd";
}

function getOtherUser(){
  return "amdo";
}

?>