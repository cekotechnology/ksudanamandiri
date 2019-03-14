
<script type="text/javascript" src="./javascript/prototype.js"></script> 
<script type="text/javascript" src="./javascript/effects.js"></script> 
<script type="text/javascript" src="./javascript/newsbox.js"></script>


<h4>Network Tree</h4>

   
    <?php
	
		$lv=21;
		for($i=0;$i<$lv;$i++) {
			$j = $i + 1;
			
			$ja = $db->jmlmember($mid, "a.status=1 and b.upline$i='$user_session'"); //jml mbr aktif per level
			$jf = $db->jmlmember($mid, "a.status=0 and blokir=0 and b.upline$i='$user_session'"); //jml mbr free per level
			$jb = $db->jmlmember($mid, "a.blokir=1 and b.upline$i='$user_session'"); //jml mbr blokir per level
			
			if($ja > 0 or $jf > 0) {
?>

<div style="width: 100%; padding: 2px; margin: 0;">
            <div id="newsBox">
              <!-- NEWS ITEMS GO HERE - Repeat Sections as many times as you want -->
              <!--NEWS ITEM-->
              <div class="newsItem" style="padding:4px;"> <a class="newsTitle">Level <?= $j; ?>: <span style="color:#006600"><?= $ja; ?></span> <span style="color:#0000CC"><?= $jf; ?></span> <span style="color:#FF0000"><?= $jb; ?></span></a>
                  <div style="display:none;">
                    <div class="newsContent">
        <?php
	
		//$db->select("a.username, a.nama, a.status, a.blokir, a.hp, a.phone, a.email, a.tglaktif, a.upline, b.sponsor, b.posisi", "member as a inner join upline as b on a.username=b.username", "b.upline$i='$user_session'");
		
		$dt_dwn = $this->db->query(" SELECT a.username, a.nama, a.status, a.blokir, a.hp, a.phone, a.email, a.tglaktif, a.upline, b.sponsor, b.posisi FROM member AS a inner join upline AS b ON a.username=b.username WHERE b.upline$i='$user_session'");
		?>
      <table class="table table-bordered table-striped table-booking-history">
      <tr>
        <td>>#</strong></td>
        <td><strong>Username</strong></td>
        <td><strong>Nama</strong></td>
        <td><strong>Sponsor</strong></td>
        <td><strong>Upline</strong></td>
        <td><strong>Posisi</strong></td>
        <td><strong>HP</strong></td>
        
        <td><strong>Status</strong></td>
      </tr>
   <?php
   		$n=1;
		foreach($dt_dwn->result_array() as $row){
			
			if($row['status'] > 0) {
				$status = "AKTIF<br>".date("d.m.y", strtotime($row['tglaktif']));
				$cl_status = "status_active";
				
			} else if($row['blokir'] > 0) {
				$status = "BLOKIR";
				$cl_status = "status_blokir";	
			} else {
				//$status = "BLM AKTIF";
				$status = "AKTIF<br>".date("d.m.y", strtotime($row['tglaktif']));
				$cl_status = "status_free";
			}
					
			
   ?>  		
	  <tr height="20">
        <td><?= $n; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= strtoupper($row['nama']); ?></td>
        <td><?= $row['sponsor']; ?></td>
        <td align="center"><?= $row['upline']; ?></td>
        <td><?= $row['posisi']; ?></td>
        <td><?= $row['hp']; ?></td>
       
        <td class="<?= $cl_status; ?>" align="center"><?= $status; ?></td>
      </tr>
	 <?
	 	$n++;
		 }
	 ?> 
    </table>  </div>
                  </div>
              </div>
              <!-- end news items -->
            </div>
</div>
	
	  <?
		}
		}
	?>
	  <!-- this script is required for your newsbox to work; also, modify the variables defined below to customize the look of the newbox contents. -->
	  <!-- bg = background color; fg = text color for your article; link = the color for your links -->
	  <!-- altbg = background color of alternating row ; altfg = text color for your article on an alternating row; altlink = the color for your links on an alernating row -->
<script type="text/javascript">newsBox = new newsBox({'bg':'#f7f7f7','fg':'#000000','link':'#0000cc','altbg':'#ffffff','altfg':'#000000','altlink':'#0000cc'});</script>
	