<SCRIPT LANGUAGE="JavaScript"> 

$(document).ready(function() {


});


</SCRIPT>
<?php 

if (!isset($initok)) {echo "do not run this script directly";exit;}

/* Spiros Ioannou 2009-2010 , sivann _at_ gmail.com */


if (isset($_POST['dateformat'])) { //if we came from a post (save), update the rack 
  $sql="UPDATE settings set companytitle='".$_POST['companytitle']."', dateformat='".$_POST['dateformat']."', currency='".$_POST['currency']."', lang='".$_POST['lang']."'";
  db_exec($dbh,$sql);

}//save pressed

/////////////////////////////
//// display data 

$sql="SELECT * FROM settings";
$sth=$dbh->query($sql);
$settings=$sth->fetchAll(PDO::FETCH_ASSOC);
$settings=$settings[0];

echo "\n<form id='mainform' method=post  action='$scriptname?action=$action' enctype='multipart/form-data'  name='settingsfrm'>\n";

echo "\n<h1>".t("Settings")."</h1>\n";
?>

    <table class="tbl2" >
    <tr><td colspan=2><h3><?php te("Settings"); ?></h3></td></tr>
    <tr><td class="tdt"><?php te("Company Title");?>:</td> 
        <td><input  class='input2 ' size=20 type=text name='companytitle' value="<?php echo $settings['companytitle']?>"></td></tr>
    <tr><td class="tdt"><?php te("Date Format")?></td><td>
    <select  name='dateformat'>
      <? if ($settings['dateformat']=="dmy") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> value='dmy'>Day/Month/Year</option>
      <? if ($settings['dateformat']=="mdy") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> value='mdy'>Month/Day/Year</option>
    </select>
    </td>
    </tr>

    <tr><td class="tdt"><?php te("Currency")?></td><td>

    <select  name='currency'>
      <? if ($settings['currency']=="&amp;euro;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Euro' value='<?php echo htmlentities("&euro;");?>'>&euro;</option>

      <? if ($settings['currency']=="$") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Dollar' value='<?php echo htmlentities("$");?>'>$</option>

      <? if ($settings['currency']=="&amp;pound;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Pound' value='<?php echo htmlentities("&pound;");?>'>&pound;</option>

      <? if ($settings['currency']=="&amp;yen;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Yen' value='<?php echo htmlentities("&yen;");?>'>&yen;</option>

      <? if ($settings['currency']=="&amp;#8361;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Won' value='<?php echo htmlentities("&#8361;");?>'>&#8361;</option>

      <? if ($settings['currency']=="&amp;#8360;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Rupee' value='<?php echo htmlentities("&#8360;");?>'>&#8360;</option>

      <? if ($settings['currency']=="&amp;#8377;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Indian Rupee' value='<?php echo htmlentities("&#8377;");?>'>&#8377;</option>

      <? if ($settings['currency']=="&amp;#20803;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Yuan' value='<?php echo htmlentities("&#20803;");?>'>&#20803;</option>

      <? if ($settings['currency']=="&amp;#65020;") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> title='Rial' value='<?php echo htmlentities("&#65020;");?>'>&#65020;</option>
    </select>
    <tr><td class="tdt"><?php te("Interface Language")?></td><td>
    <select  name='lang'>
      <? if ($settings['lang']=="en") $s="SELECTED"; else $s="" ?>
      <option <?php echo $s?> value='en'>en</option>
      <?
      $tfiles=scandir("translations/");
      foreach ($tfiles as $f) {
        if (strstr($f,"txt") && (!strstr($f,"new")) && (!strstr($f,"missing"))) {
	  $bf=basename($f,".txt");
	  if ($settings['lang']=="$bf") $s="SELECTED"; else $s="" ;
	  echo "<option $s value='$bf'>$bf</option>\n";
	}
      }
      ?>
    </select>
    </td>


<tr>
<td colspan=2>
<br>
<button type="submit"><img src="images/save.png" alt="Save"> <?php te("Save");?></button>
</td>
</tr>
</table>
<input type=hidden name='action' value='<?php echo $action ?>'>
</form>

</body>
</html>