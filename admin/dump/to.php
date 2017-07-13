<?php
   // move_uploaded_file($_FILES['file']['tmp_name'], "b/".$_FILES['file']['name']);
   // fwrite(fopen("a.txt", "a+"), $_POST['name']);
	include 'php/beginn.php';
    $rtyt=1; 
    echo time()+time();
    var_dump(getdate(time()+(365*24*3600)));

   /* $error="";
    $rtyt=1;

    $erto=$ert=new apiQuery();
    $Response=$erto->getMessagesLists(getUser(), getPass(), $rtyt);
    $body=$Response->body;
    // echo getUser();
    // echo getPass();
    // save_to_db("amd", "amd");
    // saveCookie__("amd", "amd");
    echo var_dump(getData('user'));
    echo var_dump(getData('pass'));
    // $result=$ert->fetchprof(getUser(), getPass());
    // $body=$result->body;
    // if (isset($body[0]->username)){      
    //    // header("Location: nxt/index.php");
    // }

var_dump($body);
    $tr="this is a way to {{0}} and {{1}}";
    echo translate_var($tr, array("dance","play"));*/

    // var_dump($_SERVER);
    var_dump(url_rewrite_query("watchlist=true"));
    // var_dump(strpos("&", url_rewrite_query("watchlist=true")))
    // echo $_GET['watchlist'];
    $erto=$ert=new apiQuery();
    $link="farouk";

    var_dump($ert->getAllUserSubmittedfile(getUser(), getPass(), $link)->body);
    // getWatchlists(getUser(), getPass(), $rtyt)->body);
    // addwatchlist(getUser(), getPass(), $link)->body);
        // getWatchlists(getUser(), getPass(), $rtyt)->body);


?>