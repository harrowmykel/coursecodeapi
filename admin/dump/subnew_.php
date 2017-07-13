<?php 
    include 'beginn.php';
    $link=isset($_GET['link']) ? urldecode($_GET['link']) : '';
    $act=isset($_GET['todo']) ? urldecode($_GET['todo']) : '';
    $message="";

    $ass_code=translate('input_ass_code');
    $erot=false;
    $error=translate('input_ass_code_first');
    $apiquery=new apiQuery();
    $usert=getUser();

    if(isset($_GET['wishlist'])){
        $message="<div class='alert alert-block'>
                      <button type='button' class='close' data-dismiss='alert'>×</button>
                      <h4>Warning!</h4>
                      Best check yo self, you're not...
                    </div>";                    
    }

    if (isset($_GET['ass_code'])){
      $ass_code=getGetString('ass_code');
      if (!empty($ass_code)){
          $res=$apiquery->getfile(getUser(), getPass(), $ass_code);
          $body=$res->body;
          if (isset($body[0]->ass_code)){
            $words=$body[0];
            $erot=true;
            $usert=(isset($words->username))?$words->username:getUser();
            if (isset($words->deactivated_)){
              if($words->deactivated_==1){
                $message= "<div class='alert fade-in m-warning'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <strong>".translate('ass_has_bn_deactd')."</strong>
                          </div>";                    
              }            
            }
          }else if (isset($body[0]->error_more)) {
            $error=$body[0]->error_more;
            $message= "<div class='alert fade-in m-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>".translate('sorry error')." $error</strong>
                      </div>";
          }
      }
    }

    if (isset($_POST['ddmy'])){
        $time__=time();
        $file_dump="b/".$time__."/";
        mkdire($file_dump);
        $bb=mkdire($file_dump.gnrtNewString(2, 6)."/");
      if (!isset($_POST['crtefile'])){
        $rname=$_FILES['assign']['name'];
        $f_location=$bb.$rname;

        while(is_file($f_location) && file_exists($f_location)){
          $bb=mkdire($file_dump.gnrtNewString(2, 6)."/");
          $f_location=$bb.$rname;
        }

        move_uploaded_file($_FILES['assign']['tmp_name'], $f_location);
      }else{
        $rname=isset($_POST["assign_name"])?$_POST["assign_name"]:"no name.txt";
        $f_content=isset($_POST["fillew"])?$_POST["fillew"]:"";

        $bb=mkdire($file_dump.gnrtNewString(2, 6)."/");
        $f_location=$bb.$rname;

        while(is_file($f_location) && file_exists($f_location)){
          $bb=mkdire($file_dump.gnrtNewString(2, 6)."/");
          $f_location=$bb.$rname;
        }

        fwrite(fopen($f_location, "a+"), $f_content);
      }
      $res=$apiquery->submitFile(getUser(), getPass(), $ass_code, $f_location);
      if(isset($res[0]->error)){
         $errrr=$res[0]->error_more;
         $message= "<div class='alert fade-in m-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Sorry,  An Error Occured! $errrr</strong>
          </div>";        
      }else if (isset($res[0][0]->error)){
        $errrr=$res[0][0]->error_more;
        $message= "<div class='alert fade-in m-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>".translate('sorry error')." $errrr</strong>
          </div>";
        unlink($f_location);
      } else if (isset($res[0][0]->success)){
        $f_nm=$res[1][0]->file_name;
        $f_sz=$res[1][0]->file_size;
         $message= "<div class='alert fade-in m-warning'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>".translate_var('f_uploaded_', array($f_nm, $f_sz))."</strong>
          </div>";
        unlink($f_location);
      }
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.php';?>
  </head>

  <body>
    <?php include 'header.php';?>  
    <div class='container-fluid'>
      <div class='row'>
        <?php include 'sidebar.php';?>      
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
          <h1 class='page-header'><?php echo $link ?></h1> 
            <div class="row">
                <div class="col-lg-8">
                    <?php echo $message;?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo translate('input_ass_code');?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">                            
                          <form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <input type='text' name='ass_code' value="<?php echo $ass_code;?>" class='form-control' placeholder='<?php echo translate('input_ass_code');?>'/>  <br>
                            <input type='hidden' name="dummy" value="go"/>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer"> 
                            <input type='submit' class='btn btn-success btn-sm btn-lng' value="<?php echo translate('go');?>"/>    
                          </form>   
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel -->
                    <?php
                        $arrayu=array("panel-green", "panel-yellow", "panel-info", "panel-default");
                        $color=$arrayu[rand(0,2)];

                        $color_=array("btn-info", "btn-primary", "btn-success")[rand(0,2)];
                        
                    ?>
                    <div class="panel <?php echo $color;?>">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-fw fa-5x"></i>
                                </div>                                
                                <div class="col-xs-9">
                                    <div class="huge text-right"><?php echo $ass_code; ?></div>
                                    <div class="text-right"><a class='btn <?php echo $color_;?> btn-sm btn-lng' href="#myModal"><i class="fa fa-eye "></i> <?php echo translate('add_watchlist');?></a> <a class='btn btn-default btn-sm btn-lng' href="messages_read.php?user=<?php echo $usert;?>"><i class="fa fa-inbox"></i>  <?php echo translate('message');?> <b><?php echo $usert; ?></b></a></div>
                                  </div>
                              </div>
                          </div>

                        <!-- /.panel-heading --> 
                            <div class="panel-footer">
                                <b class="pull-left"> 
                                    <?php echo translate('titlw');?>                               
                                </b>
                                <div class="clearfix"></div>
                            </div>
                        <!-- /.panel-footer -->                        
                        <div class="panel-body">    
                            <?php
                                if($erot){                                    
                                    $method=$words->title_;
                                    echo $method;
                                }
                            ?> 
                        </div>
                        <!-- /.panel-body -->  
                        <div class="panel-footer">
                            <b class="pull-left"> 
                                <?php echo translate('desc');?>                              
                            </b>    
                            <div class="clearfix"></div>
                        </div>
                    <!-- /.panel-footer -->                        
                        <div class="panel-body">
                            <?php
                                if($erot){                                    
                                    $method=$words->method_;
                                    echo Markdown($method);
                                }
                            ?> 
                        </div>
                        <!-- /.panel-body --> 
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <?php echo translate('sub_ass');?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab"><?php echo translate('upload_a_');?></a>
                                </li>
                                <li><a href="#profile" data-toggle="tab"><?php echo translate('create_a_');?></a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home"> <br>
                                  <form method='POST' enctype='multipart/form-data' action="<?php echo $_SERVER['PHP_SELF'].'?ass_code='.$ass_code;?>">
                                    <input type='file' name='assign'><br>
                                      <input type='hidden' name='ass_code' value="<?php echo $ass_code;?>"/> 
                                    <input type='hidden' value='remember-me' name='ddmy'> 
                                    <input type='hidden' value='remember-me' name='dummy'>   
                                    <input type='hidden' value='remember-me' name='upldfile'> 
                                    <input type='submit' class='btn btn-sm btn-lng btn-success' value='<?php echo translate('submit');?>'/> 
                                  </form>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                  <br>
                                  <form method='POST' action="<?php echo $_SERVER['PHP_SELF'].'?ass_code='.$ass_code;?>">
                                    <input type='text' class='form-control' name='assign_name' placeholder='File name'><br>
                                    <textarea class='form-control' name='fillew' placeholder="<?php echo translate('type_ass_here');?>"></textarea>

                                    <div class='checkbox'>
                                      <label>
                                        <input type='checkbox' value='remember-me' name='use_below'> <?php echo translate('use_this_ass');?>
                                      </label>
                                      <input type='hidden' name='ass_code' value="<?php echo $ass_code;?>"/>    
                                    </div>
                                    <input type='hidden' value='remember-me' name='ddmy'> 
                                    <input type='hidden' value='remember-me' name='dummy'>   
                                    <input type='hidden' value='remember-me' name='crtefile'>   
                                    <input type='submit' class='btn btn-smbtn-lng btn-success' value='<?php echo translate('submit');?>'/> 
                                  </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->     
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <?php
                        $arrayu=array("panel-green", "panel-yellow", "panel-info", "panel-red", "panel-default");
                        $color=$arrayu[rand(0,3)];
                    ?>
                    <div class="panel <?php echo $color;?>">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bell fa-fw fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">                      
                                        <?php
                                            if($erot){
                                                echo $body[1]->total;
                                            }else{
                                                echo "0";
                                            }?>
                                    </div>
                                    <div><?php echo translate('total_subms');?></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body reduce_margin">                           
                            <div class="list-group">
                                    <?php
                                        if($erot){
                                            $gen_url=$words->ass_code;
                                            $deactivated=$words->deactivated_;
                                            $method=$words->method_;
                                            $view=$body[1]->total;
                                            $time=formatThisForHr($words->time);
                                            $deactivatedtime=formatThisForHr($words->deactivated_time);
                                            $deactivationtime=formatThisForHr($words->deactivation_time);
                                            if($deactivated!=0){
                                                $deact=translate('react');
                                            }else{
                                                $deact=translate('deact');
                                            }
                                            $array_1=array(translate('ass_code'),
                                                            translate('total_subms'),
                                                            translate('time'), 
                                                            translate('sub_time'),
                                                            translate('deactd'),
                                                            translate('deact_time'));
                                            $array_2=array("$gen_url", "$view",
                                                            "$time", 
                                                            "$deactivationtime",
                                                            "$deactivated",
                                                            "$deactivatedtime");
                                            for($ioi=0; $ioi<count($array_2); $ioi++){
                                                echo "<div class='list-group-item'>
                                                            <i class='fa fa-comment fa-fw'></i>".$array_1[$ioi]."
                                                            <span class='pull-right text-muted small'><em>".$array_2[$ioi]."</em>
                                                            </span>
                                                      </div>";
                                            }
                                        }else{
                                            echo "<div href='#' class='list-group-item'>
                                                        <i class='fa fa-comment fa-fw'></i>1
                                                        <span class='pull-right text-muted small'><em>$error</em>
                                                        </span>
                                                    </div>";
                                        }
                                     ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->                   
                    
                    <?php include 'single_quotes.php';?>
                    <!-- /.panel --> 
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
          
        </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='../assets/js/jquery.js'></script>
    <script src='../assets/js/bootstrap.min.js'></script>
    <script type="text/javascript" src="../assets/js/k.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src='../assets/js/docs.min.js'></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src='../../assets/js/ie10-viewport-bug-workaround.js'></script>
    </div>
  </div>
  </div>
  </body>
</html>
