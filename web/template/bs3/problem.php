<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Joungkyun/font-d2coding@1.2.1/d2coding.css">

    <title><?php echo $OJ_NAME?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
	
<?php
if ($pr_flag){
echo "<title>$MSG_PROBLEM ".$row['problem_id']." --". $row['title']."</title>";
echo "<center><h2>$id: ".$row['title']."</h2>";
}else{
$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$id=$row['problem_id'];
echo "<title>$MSG_PROBLEM ".$PID[$pid].": ".$row['title']." </title>";
echo "<center><h2>$MSG_PROBLEM ".$PID[$pid].": ".$row['title']."</h2>";
}
echo "<span class=green>$MSG_Time_Limit: </span>".$row['time_limit']." Sec&nbsp;&nbsp;";
echo "<span class=green>$MSG_Memory_Limit: </span>".$row['memory_limit']." MB";
if ($row['spj']) echo "&nbsp;&nbsp;<span class=red>Special Judge</span>";
echo "<br><span class=green>$MSG_SUBMIT: </span>".$row['submit']."&nbsp;&nbsp;";
echo "<span class=green>$MSG_SOVLED: </span>".$row['accepted']."<br>";
if ($pr_flag){
echo "[<a href='submitpage.php?id=$id'>$MSG_SUBMIT</a>]";
}else{
echo "[<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>]";
}
echo "[<a href='problemstatus.php?id=".$row['problem_id']."'>$MSG_STATUS</a>]";
//echo "[<a href='bbs.php?pid=".$row['problem_id']."$ucid'>$MSG_BBS</a>]";
if(isset($_SESSION['administrator'])){
require_once("include/set_get_key.php");
?>
[<a href="admin/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION['getkey']?>" >Edit</a>]
[<a href='javascript:phpfm(<?php echo $row['problem_id'];?>)'>TestData</a>]
<?php
}
echo "</center>";
echo "<h2>$MSG_Description</h2><div class=content style=\"font-family:d2coding, Consolas, monospace;\">".$row['description']."</div>";
echo "<h2>$MSG_Input</h2><div class=content style=\"font-family:d2coding, Consolas, monospace;\">".$row['input']."</div>";
echo "<h2>$MSG_Output</h2><div class=content style=\"font-family:d2coding, Consolas, monospace;\">".$row['output']."</div>";
$sinput=str_replace("<","&lt;",$row['sample_input']);
$sinput=str_replace(">","&gt;",$sinput);
$soutput=str_replace("<","&lt;",$row['sample_output']);
$soutput=str_replace(">","&gt;",$soutput);
if(strlen($sinput) && 1==0) {
echo "<h2>$MSG_Sample_Input</h2>
<pre class=content><span class=sampledata style=\"font-family:d2coding, Consolas, monospace;\">".($sinput)."</span></pre>";
}
if(strlen($soutput) && 1==0){
echo "<h2>$MSG_Sample_Output</h2>
<pre class=content><span class=sampledata style=\"font-family:d2coding, Consolas, monospace;\">".($soutput)."</span></pre>";
}
if ($pr_flag||true)
echo "<h2>$MSG_HINT</h2>
<div class=content style=\"font-family:d2coding, Consolas, monospace;\">".nl2br($row['hint'])."</div>";
if ($pr_flag){
	echo "<h2>$MSG_Source</h2><div class=content style=\"font-family:d2coding, Consolas, monospace;\">";
	$cats=explode(" ",$row['source']);
	foreach($cats as $cat){
		echo "<a href='problemset.php?search=".htmlentities($cat,ENT_QUOTES,'utf-8')."'>".htmlentities($cat,ENT_QUOTES,'utf-8')."</a>&nbsp;";
	}
	echo "</div>";
}
echo "<center>";
if ($pr_flag){
echo "[<a href='submitpage.php?id=$id'>$MSG_SUBMIT</a>]";
}else{
echo "[<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>]";
}
echo "[<a href='problemstatus.php?id=".$row['problem_id']."'>$MSG_STATUS</a>]";
//echo "[<a href='bbs.php?pid=".$row['problem_id']."$ucid'>$MSG_BBS</a>]";
if(isset($_SESSION['administrator'])){
require_once("include/set_get_key.php");
?>
[<a href="admin/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION['getkey']?>" >Edit</a>]
[<a href='javascript:phpfm(<?php echo $row['problem_id'];?>)'>TestData</a>]
<?php
}
echo "</center>";
?>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	
<script>
function phpfm(pid){
        //alert(pid);
        $.post("admin/phpfm.php",{'frame':3,'pid':pid,'pass':''},function(data,status){
                if(status=="success"){
                        document.location.href="admin/phpfm.php?frame=3&pid="+pid;
                }
        });
}
</script>	  
  </body>
</html>
