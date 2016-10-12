<style type="text/css">
.bronze{display:show;}
.silver{display:none;}
.gold{display:none;}
.platinum{display:none;}


</style>






<script type="text/javascript">
  top.visible_div_id = 'bronze';
  function toggle_visibility(id) {
     var old_e = document.getElementById(top.visible_div_id);
     var new_e = document.getElementById(id);
     if(old_e) {
        console.log('old', old_e, 'none');
        old_e.style.display = 'none';
     }
    console.log('new', new_e, 'block');
     new_e.style.display = 'block';   
     top.visible_div_id = id;          
  }
  </script>




<?
echo "<script type=\"text/javascript\">document.getElementById(\"h4\").innerHTML = \"Upgrade your account to VIP user\"</script>
        <input type='hidden' id='module_contet' value='Upgrade your account to VIP user'>";
    
$load_vip_settings = simplexml_load_file('engine/config_mods/get_vip.xml');
$bronze = explode(",",trim($load_vip_settings->bronze));
$silver = explode(",",trim($load_vip_settings->silver));
$gold = explode(",",trim($load_vip_settings->gold));
$platinum = explode(",",trim($load_vip_settings->platinum));


$link_identifier = mssql_connect($core['db_host'], $core['db_user'], $core['db_password']);
mssql_select_db($core['db_name'], $link_identifier);


$exist = $core_db->Execute("Select AccountID from T_VIPList where AccountID=?",array($user_auth_id));
if($exist->EOF)
{
mssql_query("INSERT INTO T_VIPList(AccountID,Date,Type) VALUES ('$user_auth_id',NULL,NULL)");
}    


if (isset($_POST['get_vip1']))
{
    $viptime    =    htmlspecialchars($_POST['viptime1'],ENT_QUOTES);
  $result2    =    mssql_query("select credits from MEMB_CREDITS where memb___id='$user_auth_id'");
    $myrow2        =    mssql_fetch_array($result2);
    if ($viptime    ==    NULL )
    {
        echo    msg('0',"VIP period was not found.");
    }
  
  switch($viptime)
    {
      case '10' : $kredit = $bronze[0];
        break;
      case '30' : $kredit = $bronze[1];
        break;
      case '60' : $kredit = $bronze[2];
        break;
      default   : echo    msg('0',"VIP period was not found.");
        break;
    }
  
  if ($myrow2['credits']    <    $kredit)
    {
        
    echo    msg('0',"Not enough credits.");
    }
    else
    {
    $select = mssql_query("select Type,Date,AccountID from T_VIPList where AccountID='$user_auth_id'");    
        $select_req = mssql_fetch_array($select);
    $actualDate = time();
    $vipEndDate = strtotime($select_req['Date']);
    $checkStatus =  ($vipEndDate) - ($actualDate);
        $result        =    mssql_query("select Type from T_VIPList where AccountID='$user_auth_id'");
        if (mssql_num_rows($result)    >    0)
        {
            $myrow    =    mssql_fetch_array($result);
            if ($checkStatus    >    0)
            {
                echo    msg('0',"You have already active VIP status.");
            }
            else
            {
              $cas = time()+$viptime*86400;
        $small = date("Y-m-d H:i:s",$cas);    
        mssql_query("update T_VIPList set Date='$small',Type ='1' WHERE AccountID='$user_auth_id'");
        mssql_query("update MEMB_CREDITS set credits= credits-".$kredit." where memb___id='$user_auth_id'");
        echo    msg('1',"VIP status was successfully bought.");
            }
        }
    }
}
if (isset($_POST['get_vip2']))
{
    $viptime    =    htmlspecialchars($_POST['viptime2'],ENT_QUOTES);
  $result2    =    mssql_query("select credits from MEMB_CREDITS where memb___id='$user_auth_id'");
    $myrow2        =    mssql_fetch_array($result2);
    if ($viptime    ==    NULL )
    {
        echo    msg('0',"VIP period was not found.");
    }
  


    switch($viptime)
    {
      case '10' : $kredit = $silver[0];
        break;
      case '30' : $kredit = $silver[1];
        break;
      case '60' : $kredit = $silver[2];
        break;
      default   : echo    msg('0',"VIP period was not found.");
        break;
    }
  
  if ($myrow2['credits']    <    $kredit)
    {
        
    echo    msg('0',"Not enough credits.");
    }
    else
    {
        $result        =    mssql_query("select Type from T_VIPList where AccountID='$user_auth_id'");
        
    $select = mssql_query("select Type,Date,AccountID from T_VIPList where AccountID='$user_auth_id'");    
        $select_req = mssql_fetch_array($select);
    $actualDate = time();
    $vipEndDate = strtotime($select_req['Date']);
    $checkStatus =  ($vipEndDate) - ($actualDate);
      
    if (mssql_num_rows($result)    >    0)
        {
            $myrow    =    mssql_fetch_array($result);
            if ($checkStatus    >    0)
            {
                echo    msg('0',"You have already active VIP status.");
            }
            else
            {
              $cas = time()+$viptime*86400;    
        $small = date("Y-m-d H:i:s",$cas);    
        mssql_query("update T_VIPList set Date='$small',Type ='2' WHERE AccountID='$user_auth_id'");
        mssql_query("update MEMB_CREDITS set credits= credits-".$kredit." where memb___id='$user_auth_id'");
        echo    msg('1',"VIP status was successfully bought.");
            }
        }
    }
}
if (isset($_POST['get_vip3']))
{
    $viptime    =    htmlspecialchars($_POST['viptime3'],ENT_QUOTES);
  $result2    =    mssql_query("select credits from MEMB_CREDITS where memb___id='$user_auth_id'");
    $myrow2        =    mssql_fetch_array($result2);
    if ($viptime    ==    NULL )
    {
        echo    msg('0',"VIP period was not found.");
    }
  
    switch($viptime)
    {
      case '10' : $kredit = $gold[0];
        break;
      case '30' : $kredit = $gold[1];
        break;
      case '60' : $kredit = $gold[2];
        break;
      default   : echo    msg('0',"VIP period was not found.");
        break;
    }
  
  if ($myrow2['credits']    <    $kredit)
    {
        
    echo    msg('0',"Not enough credits.");
    }
    else
    {
        $result        =    mssql_query("select Type from T_VIPList where AccountID='$user_auth_id'");
    $select_req = mssql_fetch_array($select);
    $actualDate = time();
    $vipEndDate = strtotime($select_req['Date']);
    $checkStatus =  ($vipEndDate) - ($actualDate);
        if (mssql_num_rows($result)    >    0)
        {
            $myrow    =    mssql_fetch_array($result);
            if ($checkStatus    >    0)
            {
                echo    msg('0',"You have already active VIP status.");
            }
            else
            {
              $cas = time()+$viptime*86400;    
        $small = date("Y-m-d H:i:s",$cas);    
        mssql_query("update T_VIPList set Date='$small',Type ='3' WHERE AccountID='$user_auth_id'");
        mssql_query("update MEMB_CREDITS set credits= credits-".$kredit." where memb___id='$user_auth_id'");
        echo    msg('1',"VIP status was successfully bought.");
            }
        }
    }
}
if (isset($_POST['get_vip4']))
{
    $viptime    =    htmlspecialchars($_POST['viptime4'],ENT_QUOTES);
  $result2    =    mssql_query("select credits from MEMB_CREDITS where memb___id='$user_auth_id'");
    $myrow2        =    mssql_fetch_array($result2);
    if ($viptime    ==    NULL )
    {
        echo    msg('0',"VIP period was not found.");
    }
  
    
    switch($viptime)
    {
      case '10' : $kredit = $platinum[0];
        break;
      case '30' : $kredit = $platinum[1];
        break;
      case '60' : $kredit = $platinum[2];
        break;
      default   : echo    msg('0',"VIP period was not found.");
        break;
    }
  
  if ($myrow2['credits']    <    $kredit)
    {
        
    echo    msg('0',"Not enough credits.");
    }
    else
    {
        $result        =    mssql_query("select Type from T_VIPList where AccountID='$user_auth_id'");
    $select_req = mssql_fetch_array($select);
    $actualDate = time();
    $vipEndDate = strtotime($select_req['Date']);
    $checkStatus =  ($vipEndDate) - ($actualDate);
        if (mssql_num_rows($result)    >    0)
        {
            $myrow    =    mssql_fetch_array($result);
            if ($checkStatus    >    0)
            {
                echo    msg('0',"You have already active VIP status.");
            }
            else
            {
              $cas = time()+$viptime*86400;    
        $small = date("Y-m-d H:i:s",$cas);    
        mssql_query("update T_VIPList set Date='$small',Type ='4' WHERE AccountID='$user_auth_id'");
        mssql_query("update MEMB_CREDITS set credits= credits-".$kredit." where memb___id='$user_auth_id'");
        echo    msg('1',"VIP status was successfully bought.");
            }
        }
    }
}
?>


<br><br>
<center>
Choose VIP type &nbsp;  
<select class="iRg_input" style="width: 120px" name="type" onchange="toggle_visibility(this.value);"> 
          <option value="bronze" selected>Bronze VIP</option> 
          <option value="silver" >Silver VIP</option>
          <option value="gold" >Gold VIP</option>
          <option value="platinum" >Platinum VIP</option> 
</select>
</center>


<div id="bronze" class="bronze" align="center" ><br><br>
<form action="" method="post" onsubmit="request("form_vip","sh_","POST","getpage.php?cat=Get-VIP"); return false;" id="form_vip">
<select name="viptime1" class="iRg_input" style="margin-bottom:10px; width:250px;">
<option value="10">VIP for 10 days | <? echo $bronze[0];?> credits</option>
<option value="30">VIP for 30 days | <? echo $bronze[1];?> credits</option>
<option value="60">VIP for 60 days | <? echo $bronze[2];?> credits</option>
</select>
<input type="submit" name="get_vip1" value="Buy Bronze VIP"><br><br>
</form>
</div>


<div id="silver" class="silver" align="center"><br><br>
<form action="" method="post" onsubmit="request("form_vip","sh_","POST","getpage.php?cat=Get-VIP"); return false;" id="form_vip">
<select name="viptime2" class="iRg_input" style="margin-bottom:10px; width:250px;">
<option value="10">VIP for 10 days | <? echo $silver[0];?> credits</option>
<option value="30">VIP for 30 days | <? echo $silver[1];?> credits</option>
<option value="60">VIP for 60 days | <? echo $silver[2];?> credits</option>
</select>
<input type="submit" name="get_vip2" value="Buy Silver VIP"><br><br>
</form>
</div>


<div id="gold" class="gold" align="center"><br><br>
<form action="" method="post" onsubmit="request("form_vip","sh_","POST","getpage.php?cat=Get-VIP"); return false;" id="form_vip">
<select name="viptime3" class="iRg_input" style="margin-bottom:10px; width:250px;">
<option value="10">VIP for 10 days | <? echo $gold[0];?> credits</option>
<option value="30">VIP for 30 days | <? echo $gold[1];?> credits</option>
<option value="60">VIP for 60 days | <? echo $gold[2];?> credits</option>
</select>
<input type="submit" name="get_vip3" value="Buy Gold VIP"><br><br>
</form>
</div>


<div id="platinum" class="platinum" align="center"><br><br>
<form action="" method="post" onsubmit="request("form_vip","sh_","POST","getpage.php?cat=Get-VIP"); return false;" id="form_vip">
<select name="viptime4" class="iRg_input" style="margin-bottom:10px; width:250px;">
<option value="10">VIP for 10 days | <? echo $platinum[0];?> credits</option>
<option value="30">VIP for 30 days | <? echo $platinum[1];?> credits</option>
<option value="60">VIP for 60 days | <? echo $platinum[2];?> credits</option>
</select>
<input type="submit" name="get_vip4" value="Buy Platinum VIP"><br><br>
</form>
</div>
<br>


<ul>
  <li><b>Advantages of VIP status [edit in getvip.php on the bottom]:</b></li>
  <li>- <font color="#CD7F32"><strong>Bronze</strong></font>: +5% exp, +5% drop</li>
  <li>- <font color="#C0C0C0"><strong>Silver</strong></font>: +10% exp, +10% drop</li>
  <li>- <font color="#FFD700"><strong>Gold</strong></font>: +15% exp, +15% drop</li>
  <li>- <font color="#9900FF"><strong>Platinum</strong></font>: +25% exp, +20% drop, MU Helper</li>
</ul>
