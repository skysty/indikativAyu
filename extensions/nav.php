<?php
		include('../incs/connect.php');
		
		$_SESSION['tutor'];		
		$_SESSION['lang'];
        include_once('../locale/MyLocale.php');
        $oL = new MyLocale();
        $query = mysqli_query($connection,"SELECT * FROM tutors WHERE mail = '$_SESSION[tutor]'") or die(mysqli_error($connection));
		$tut = mysqli_fetch_array($query);
        $roleID=$tut['roleID'];

        $sHome = '/';
        if($_SESSION['roleID'] == 1){
            $sHome = '../tutor';
        } else if($_SESSION['roleID'] == 2){
            $sHome = '../admin';
        } else if($_SESSION['roleID'] == 3){
            $sHome = '../moderator';
        } else if($_SESSION['roleID'] == 4){
            $sHome = '../cafedraManager';
        } else if($_SESSION['roleID'] == 5){
            $sHome = '../facultyDean';
        } else if($_SESSION['roleID'] == 6){
            $sHome = '../first_moderator';
        }else if($_SESSION['roleID'] == 7){
            $sHome = '../bakylaushy';
        }

			$ere = '';
			if($_SESSION['lang']=='kaz')
		$ere = '../files/erezhe2023.pdf';
		else $ere = '../files/erezhe2023.pdf';

?>    
    
    <nav id="primary_nav_wrap">
        <ul>
            <li><a href="#"><?= $oL::get('Негізгі')?></a>
		        <ul>
				    <li><a href="<?=$sHome?>/index.php"><?= $oL::get('Негізгі бет')?></a></li>
					<?php 
						if($roleID=="3"){
							echo '<li><a href="'.$sHome.'/tekseruler.php">'. $oL::get('Еңбектерді тексеру').'</a></li>';
							echo '<li><a href="'.$sHome.'/enbek_filter.php">'. $oL::get('Фильтр').'</a></li>';
							echo '<li><a href="'.$sHome.'/manu.php">'. $oL::get('Қосылған балл').'</a></li>';
						}
						if(in_array($roleID ,["1","2","4","5"])){
							echo '<li><a href="'.$sHome.'/manu.php">'. $oL::get('Қосылған балл').'</a></li>';
						}
						if($roleID=="6"){
							echo '<li><a href="'.$sHome.'/tekseruler.php">'. $oL::get('Еңбектерді тексеру').'</a></li>';
							echo '<li><a href="'.$sHome.'/manu.php">'. $oL::get('Қосылған балл').'</a></li>';
						}
					?>		  
				    <li><a href="<?=$sHome?>/korsetkishter.php"><?= $oL::get('Көрсеткіштер')?></a></li>
				    <li><a href="#"><?= $oL::get('Құжаттар')?></a>
				    <ul>                             
					    <li><a target = "_blank" href = "<?php echo $ere;?>"><?= $oL::get('Ереже 2023-2024')?></a></li>
                        <li><a target = "_blank" href = "../files/gylym24.pdf"><?= $oL::get('Растаушылар - Ғылыми бағыт')?></a></li>
                        <li><a target = "_blank" href = "../files/akadem24.pdf"><?= $oL::get('Растаушылар - Академиялық бағыт')?></a></li>
                        <li><a target = "_blank" href = "../files/tarbie24.pdf"><?= $oL::get('Әлеуметтік-мәдени бағыт - Растаушылар')?></a></li>
                        <li><a target = "_blank" href = "../files/okim24.pdf"><?= $oL::get('Растаушылар - Халықаралық байланыс')?></a></li>
						<li><a target = "_blank" href = "../files/hattama_2024.pdf"><?= $oL::get('Хаттама №1 2024')?></a></li>
					</ul>
			</li>  
                   <li>
								<a href="#"><?= $oL::get('Архив')?></a>
                            <ul>
								<!--<li><a target = "_blank" href = "../files/senat22.pdf"><?= $oL::get('Хаттама Сенатқа -  Рейтинг комиссия 2022')?></a></li>-->
								<li><a href="https://indikativ2023.ayu.edu.kz">2022-2023 <?= $oL::get('оқу жылы')?></a></li>
								<li><a href="http://ip2022.ayu.edu.kz">2021-2022 <?= $oL::get('оқу жылы')?></a></li>
								<li><a href="http://ip3.ayu.edu.kz">2020-2021 <?= $oL::get('оқу жылы')?></a></li>
                                <li><a href="http://ip4.ayu.edu.kz">2019-2020 <?= $oL::get('оқу жылы')?></a></li>
                            </ul>
			           </li>
                       <li><a href="<?=$sHome?>/change_password.php"><?= $oL::get('Құпия сөзді ауыстыру')?></a></li>
				</ul>
			  </li>
			  <li><a href="#"><?= $oL::get('Орындау')?></a>
				<ul>
				  <?php
				  if(in_array($roleID,["1", "4","5"])){
					echo '<li><a href='.$sHome.'/engbek_jukteu.php>'.$oL::get('ОПҚ/ҒҚ').'</a></li>';
					echo '<li><a href='.$sHome.'/engbek_apel.php>'.$oL::get('ОПҚ/ҒҚ апелляция').'</a></li>';
				  }
				  if(in_array($roleID,["4", "2", "6"])){
					echo '<li><a href='.$sHome.'/engbek_jukteu_cafedra.php>'.$oL::get('Каф./ҒЗИ орт. ендіру').'</a></li>';
				  }
				  if(in_array($roleID, ["5", "2", "6"])){
					echo '<li><a href='.$sHome.'/engbek_jukteu_faculty.php>'.$oL::get('Фак./ҒЗО орт. ендіру').'</a></li>';
				  }
				  if(in_array($roleID, ["6","7"])){
					echo '<li><a href='.$sHome.'/enbek_jukteuopk.php>'.$oL::get('ОПҚ орт. ендіру').'</a></a></li>';
				  }
				  if (in_array($_SESSION['roleID'], [2])) {
					echo '<li><a href='.$sHome.'/kyzmetkerler.php>'.$oL::get('Фак./ҒЗО орт. ендіру').'</a></li>';
				  }
				  ?>
				</ul>
			  </li>
			  <li><a href="#"><?= $oL::get('Басқа')?></a>
				<ul>
				  <li><a href="<?=$sHome?>/baska_okitushyny_koru.php"><?= $oL::get('ОПҚ/ҒҚ')?></a></li>
				  <?php
					if($roleID=="7"){
						echo '<li><a href="'.$sHome.'/sandar.php">'.$oL::get('Жалпы есептеме').'</a></li>';
					}	  
			  	?>
				</ul>
			  </li>
			  <?php
			  if($roleID=="6"|| $roleID=="3"){
			     echo '<li><a href="'.$sHome.'/dostup_opk.php">'.$oL::get('Оқытушыға рұқсат беру').'</a></li>';
			  }	  
			  ?>
			  <li><a href="#"><?= $oL::get('Сенім жәшігі')?></a>
				<ul>
				  <li><a href="<?=$sHome?>/shagym_tusiru.php"><?= $oL::get('Шағым түсіру')?></a></li>
				  <li><a href="<?=$sHome?>/shagymdar.php"><?= $oL::get('Шағымдарды көру')?></a></li>
				</ul>
			  </li>
            <?php 
				if (in_array($_SESSION['roleID'], [2,3])) {
					echo '<li><a href=\'../locale/index.php\'>' . $oL::get('Сөздік') . '</a></li>';
				 } 	
		 	?>			  
		 		<li><a href="../logout.php"><?= $oL::get('Шығу')?></a></li>
			</ul>
	</nav>