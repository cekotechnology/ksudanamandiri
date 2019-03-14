 <h4>Network Status</h4>
<?php
    require_once('classes/TreeMenu.php');

    $icon         = 'folder.gif';
    $expandedIcon = 'folder-expanded.gif';

    $menu  = new HTML_TreeMenu();
	$nama 	= "( ".$db->dataku("nama", $user_session)." )";
    $node1   = new HTML_TreeNode(array('text' => "$user_session", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => true), array('onclick' => "alert('$user_session $nama'); return false"));
   $db->select("username", "upline", "sponsor='$user_session'");
   $nm=1;
   while($row=$db->fetch_row()) {
    	$node1_1 = &$node1->addItem(new HTML_TreeNode(array('text' => "$row[0]", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
		//---lev 2--
		$sql_01 = mysql_query("select username from upline where sponsor='$row[0]'");
		while($row01=mysql_fetch_row($sql_01)) {
			$node1_1_1 = &$node1_1->addItem(new HTML_TreeNode(array('text' => "$row01[0]", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
			//----lev 3---
			$sql_02 = mysql_query("select username from upline where sponsor='$row01[0]'");
			while($row02=mysql_fetch_row($sql_02)) {
				$node1_1_1_1 = &$node1_1_1->addItem(new HTML_TreeNode(array('text' => "$row02[0]", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
			//----lev 4---
				$sql_03 = mysql_query("select username from upline where sponsor='$row02[0]'");
				while($row03=mysql_fetch_row($sql_03)) {
					$node1_1_1_1_1 = &$node1_1_1_1->addItem(new HTML_TreeNode(array('text' => "$row03[0]", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
					//----lev 5---
					$sql_04 = mysql_query("select username from upline where sponsor='$row03[0]'");
				while($row04=mysql_fetch_row($sql_04)) {
					$node1_1_1_1_1_1 = &$node1_1_1_1_1->addItem(new HTML_TreeNode(array('text' => "$row04[0]", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
			//----lev 3---
			
					}	
				}	
			}	
		}	
	}	
    
   // $node1_1_1_1 = &$node1_1_1->addItem(new HTML_TreeNode(array('text' => "Fourth level", 'link' => "test.php", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
   // $node1_1_1_1->addItem(new HTML_TreeNode(array('text' => "Fifth level", 'link' => "test.php", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'cssClass' => 'treeMenuBold')));

   // $node1->addItem(new HTML_TreeNode(array('text' => "Second level, item 2", 'link' => "test.php", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
   // $node1->addItem(new HTML_TreeNode(array('text' => "Second level, item 3", 'link' => "test.php", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));

    $menu->addItem($node1);
    //$menu->addItem($node1);
    
    // Create the presentation class
    $treeMenu = &new HTML_TreeMenu_DHTML($menu, array('images' => '../classes/images', 'defaultClass' => 'treeMenuDefault'));
   // $listBox  = &new HTML_TreeMenu_Listbox($menu, array('linkTarget' => '_self'));
    //$treeMenuStatic = &new HTML_TreeMenu_staticHTML($menu, array('images' => '../images', 'defaultClass' => 'treeMenuDefault', 'noTopLevelImages' => true));
?>

<html>
<head>
    
    <script src="<?php echo base_url(); ?>assets/classes/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
</head>

<body>
<div class="top-heading"> Network Tree </div>
<div class="content-text-box" style="padding-top:20px;">
<script language="JavaScript" type="text/javascript">
<!--
    a = new Date();
    a = a.getTime();
//-->
</script>

<?$treeMenu->printMenu()?><br /><br />


<script language="JavaScript" type="text/javascript">
<!--
 //   b = new Date();
 //   b = b.getTime();
    
 //   document.write("Time to render tree: " + ((b - a) / 1000) + "s");
//-->
</script>