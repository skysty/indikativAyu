<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php
		session_start();
		$_SESSION['tutor'];
		include('../incs/connect.php');
		
		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php');
		}
	?>
	<title>Еңбектерді тексеру</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
	<link rel="icon" type="image/png" href="../img/favicon.png" />

		<!-- Edit Below -->
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../css/animate.min.css"></script>
    	<link href='../css/animate.min.css' rel='stylesheet' type='text/css'>
		<link rel="icon" type="image/png" href="../img/favicon.png" />
		<style type="text/css">
	      .tabs input[type=radio] {
	          top: -9999px;
	          left: -9999px;
	      }
	      .tabs {
	        width: 870px;
	        float: none;
	        list-style: none;
	        position: relative;
	        padding: 0;
	        margin: 0 auto;
	      }
	      .tabs li{
	        float: left;
	      }
	      .tabs label {
	          display: block;
	          padding: 10px 20px;
	          border-radius: 2px 2px 0 0;
	          color: #08C;
	          background: rgba(255,255,255,0.2);
	          cursor: pointer;
	          position: relative;
	          top: 3px;
	          -webkit-transition: all 0.2s ease-in-out;
	          -moz-transition: all 0.2s ease-in-out;
	          -o-transition: all 0.2s ease-in-out;
	          transition: all 0.2s ease-in-out;
	      }
	      .tabs label:hover {
	        background: rgba(255,255,255,0.5);
	        top: 0;
	      }
	      
	      [id^=tab]:checked + label {
	        background: #003366;
	        color: white;
	        top: 0;
	      }
	      
	      [id^=tab]:checked ~ [id^=tab-content] {
	          display: block;
	      }
	      .tab-content{
	        z-index: 2;
	        display: none;
	        text-align: left;
	        width: 100%;
	        font-size: 20px;
	        line-height: 140%;
	        padding-top: 10px;
	        padding: 15px;
	        position: absolute;
	        top: 53px;
	        left: 0;
	        box-sizing: border-box;
	        -webkit-animation-duration: 0.5s;
	        -o-animation-duration: 0.5s;
	        -moz-animation-duration: 0.5s;
	        animation-duration: 0.5s;
	      }
		  
		.select_box{
			width: 600px;
			padding: 20px;
			margin: 0 auto;
			margin-bottom: 30px;
			border: 1px black solid;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			background: #eee;
		}
		.btn {
			  background: #3498db;
			  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
			  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
			  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
			  background-image: -o-linear-gradient(top, #3498db, #2980b9);
			  background-image: linear-gradient(to bottom, #3498db, #2980b9);
			  font-family: Arial;
			  color: #ffffff;
			  font-size: 20px;
			  padding: 10px 20px 10px 20px;
			  text-decoration: none;
			}

			.btn:hover {
			  background: #3cb0fd;
			  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
			  text-decoration: none;
			}
			.btn:focus {
				background: #3cb0fd;
			}
			select{
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

			input[type=submit] {
				width: 150px;
				background-color: #003366;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: 1px black solid;
				cursor: pointer;
			}

			input[type=submit]:hover {
				background-color: #000;
			}
			
			.login_form{
				margin: 0 auto;
				margin-top: 100px;
				width: 300px;
				padding: 20px;
				border: 1px black solid;
			}
			
			.footer{
				margin-top: 100px;
			}
			.tables{
				margin-top: 400px;				
			}
	</style>
<style>
		.shagymTable{
			margin: 0 auto;
			width: 1000px;
		}
		table {
			border-collapse: collapse;
			border:1px black solid;
			width: 100%;
			font-size: 12px;
		}

		th, td {
			text-align: left;
			padding: 6px;
			border:1px black solid;
		}

		tr:nth-child(even){background-color: #f2f2f2}

		th {
			background-color: #003366;
			color: white;
		}
	</style>
</head>
<body>
	<div class = "upper_header">
        <?php include '../extensions/header.php'?>
    </div>	
	<div class = "header">
		<div id = "menu_nav">
			<?php include '../extensions/nav.php'?>
		</div>
	</div>	


<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">
		
			<?php
			
				$_SESSION['tutor'];
				
			?>
			<div class = "shagymTable">
				<h2 align = "center">Көрсеткіштер</h2>
<p><span style="font-size: 10pt;">2.1.1.7.1 Монографиялар  (Ғылыми-техникалық кеңес ұсынысы негізінде, 5.0 б.т. кем емес): Отандық басылымдарда жарияланатын</span></p>
<p><span style="font-size: 10pt;"> </span></p>
<table>
<tbody>
<tr>
<td>
<p><span style="font-size: 10pt;">1</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2194_1527499534.pdf">http://ip.ayu.edu.kz/files/2194_1527499534.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">2</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2050_1527146768.pdf">http://ip.ayu.edu.kz/files/2050_1527146768.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">3</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2050_1527146857.pdf">http://ip.ayu.edu.kz/files/2050_1527146857.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">4</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2194_1527601328.pdf">http://ip.ayu.edu.kz/files/2194_1527601328.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">5</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2564_1527603083.pdf">http://ip.ayu.edu.kz/files/2564_1527603083.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">6</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/200_1527486862.PDF">http://ip.ayu.edu.kz/files/200_1527486862.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">7</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2050_1527148545.pdf">http://ip.ayu.edu.kz/files/2050_1527148545.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">8</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1290_1527487575.PDF">http://ip.ayu.edu.kz/files/1290_1527487575.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">9</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/385_1526891092.PDF">http://ip.ayu.edu.kz/files/385_1526891092.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">10</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3092_1527236199.pdf">http://ip.ayu.edu.kz/files/3092_1527236199.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">11</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2128_1527506927.pdf">http://ip.ayu.edu.kz/files/2128_1527506927.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">12</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1327_1527222539.PDF">http://ip.ayu.edu.kz/files/1327_1527222539.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">13</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/547_1527316334.pdf">http://ip.ayu.edu.kz/files/547_1527316334.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">14</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/547_1527316728.pdf">http://ip.ayu.edu.kz/files/547_1527316728.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">15</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3065_1527317314.pdf">http://ip.ayu.edu.kz/files/3065_1527317314.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">16</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2326_1527508396.pdf">http://ip.ayu.edu.kz/files/2326_1527508396.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">17</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3065_1527317403.pdf">http://ip.ayu.edu.kz/files/3065_1527317403.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">18</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/91_1527508643.pdf">http://ip.ayu.edu.kz/files/91_1527508643.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">19</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2326_1527508924.JPG">http://ip.ayu.edu.kz/files/2326_1527508924.JPG</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">20</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2326_1527509615.jpg">http://ip.ayu.edu.kz/files/2326_1527509615.jpg</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">21</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2118_1527591862.pdf">http://ip.ayu.edu.kz/files/2118_1527591862.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">22</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2564_1527515689.pdf">http://ip.ayu.edu.kz/files/2564_1527515689.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">23</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1321_1527582641.pdf">http://ip.ayu.edu.kz/files/1321_1527582641.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">24</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/302_1524559576.pdf">http://ip.ayu.edu.kz/files/302_1524559576.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">25</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2631_1524716417.PDF">http://ip.ayu.edu.kz/files/2631_1524716417.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">26</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1646_1525494015.pdf">http://ip.ayu.edu.kz/files/1646_1525494015.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">27</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2331_1526555749.pdf">http://ip.ayu.edu.kz/files/2331_1526555749.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">28</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1197_1526901236.pdf">http://ip.ayu.edu.kz/files/1197_1526901236.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">29</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1038_1521290037.pdf">http://ip.ayu.edu.kz/files/1038_1521290037.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">30</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2706_1526975639.pdf">http://ip.ayu.edu.kz/files/2706_1526975639.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">31</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1171_1527050563.pdf">http://ip.ayu.edu.kz/files/1171_1527050563.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">32</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3082_1526903699.pdf">http://ip.ayu.edu.kz/files/3082_1526903699.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">33</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1171_1527051044.pdf">http://ip.ayu.edu.kz/files/1171_1527051044.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">34</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3082_1526904406.pdf">http://ip.ayu.edu.kz/files/3082_1526904406.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">35</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1286_1527063924.pdf">http://ip.ayu.edu.kz/files/1286_1527063924.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">36</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3075_1527051442.pdf">http://ip.ayu.edu.kz/files/3075_1527051442.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">37</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3075_1527051562.pdf">http://ip.ayu.edu.kz/files/3075_1527051562.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">38</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2281_1526018022.pdf">http://ip.ayu.edu.kz/files/2281_1526018022.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">39</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2082_1527064743.pdf">http://ip.ayu.edu.kz/files/2082_1527064743.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">40</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3076_1527052004.pdf">http://ip.ayu.edu.kz/files/3076_1527052004.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">41</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3076_1527052061.pdf">http://ip.ayu.edu.kz/files/3076_1527052061.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">42</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/308_1526462893.pdf">http://ip.ayu.edu.kz/files/308_1526462893.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">43</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/553_1527067072.pdf">http://ip.ayu.edu.kz/files/553_1527067072.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">44</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2309_1527200795.pdf">http://ip.ayu.edu.kz/files/2309_1527200795.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">45</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1207_1526917028.pdf">http://ip.ayu.edu.kz/files/1207_1526917028.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">46</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/261_1526021739.PDF">http://ip.ayu.edu.kz/files/261_1526021739.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">47</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1446_1523946910.pdf">http://ip.ayu.edu.kz/files/1446_1523946910.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">48</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1628_1524117707.pdf">http://ip.ayu.edu.kz/files/1628_1524117707.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">49</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2247_1527234414.pdf">http://ip.ayu.edu.kz/files/2247_1527234414.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">50</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2576_1522824233.PDF">http://ip.ayu.edu.kz/files/2576_1522824233.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">51</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1442_1523951650.pdf">http://ip.ayu.edu.kz/files/1442_1523951650.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">52</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/553_1525929365.pdf">http://ip.ayu.edu.kz/files/553_1525929365.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">53</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/553_1525929782.pdf">http://ip.ayu.edu.kz/files/553_1525929782.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">54</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1361_1524978644.PDF">http://ip.ayu.edu.kz/files/1361_1524978644.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">55</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/10_1524544686.pdf">http://ip.ayu.edu.kz/files/10_1524544686.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">56</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2563_1524545654.pdf">http://ip.ayu.edu.kz/files/2563_1524545654.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">57</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/280_1524028357.pdf">http://ip.ayu.edu.kz/files/280_1524028357.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">58</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2310_1527076545.pdf">http://ip.ayu.edu.kz/files/2310_1527076545.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">59</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2326_1526965818.JPG">http://ip.ayu.edu.kz/files/2326_1526965818.JPG</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">60</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2189_1526636447.pdf">http://ip.ayu.edu.kz/files/2189_1526636447.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">61</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2320_1527142383.pdf">http://ip.ayu.edu.kz/files/2320_1527142383.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">62</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2128_1526968068.pdf">http://ip.ayu.edu.kz/files/2128_1526968068.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">63</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2128_1524650264.pdf">http://ip.ayu.edu.kz/files/2128_1524650264.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">64</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1441_1524032927.pdf">http://ip.ayu.edu.kz/files/1441_1524032927.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">65</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2204_1526265784.PDF">http://ip.ayu.edu.kz/files/2204_1526265784.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">66</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3051_1526413109.pdf">http://ip.ayu.edu.kz/files/3051_1526413109.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">67</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2204_1526265834.PDF">http://ip.ayu.edu.kz/files/2204_1526265834.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">68</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3052_1526414404.pdf">http://ip.ayu.edu.kz/files/3052_1526414404.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">69</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2204_1526265875.pdf">http://ip.ayu.edu.kz/files/2204_1526265875.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">70</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2326_1527227066.JPG">http://ip.ayu.edu.kz/files/2326_1527227066.JPG</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">71</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1304_1525253635.pdf">http://ip.ayu.edu.kz/files/1304_1525253635.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">72</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/547_1526439943.pdf">http://ip.ayu.edu.kz/files/547_1526439943.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">73</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/400_1524035453.pdf">http://ip.ayu.edu.kz/files/400_1524035453.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">74</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1405_1524557404.PDF">http://ip.ayu.edu.kz/files/1405_1524557404.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">75</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3091_1527060606.pdf">http://ip.ayu.edu.kz/files/3091_1527060606.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">76</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2718_1527443554.pdf">http://ip.ayu.edu.kz/files/2718_1527443554.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">77</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1286_1527064010.pdf">http://ip.ayu.edu.kz/files/1286_1527064010.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">78</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2326_1527066622.JPG">http://ip.ayu.edu.kz/files/2326_1527066622.JPG</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">79</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/553_1525929596.pdf">http://ip.ayu.edu.kz/files/553_1525929596.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">80</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2268_1526964926.PDF">http://ip.ayu.edu.kz/files/2268_1526964926.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">81</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2326_1527141411.JPG">http://ip.ayu.edu.kz/files/2326_1527141411.JPG</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">82</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2268_1526964975.PDF">http://ip.ayu.edu.kz/files/2268_1526964975.PDF</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">83</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/841_1527059898.jpg">http://ip.ayu.edu.kz/files/841_1527059898.jpg</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;"> </span></p>
</td>
<td>
<p><span style="font-size: 10pt;"> </span></p>
</td>
</tr>
</tbody>
</table>
<p><span style="font-size: 10pt;"> </span></p>
<p><span style="font-size: 10pt;">2.1.1.7.2 Монографиялар  (Ғылыми-техникалық кеңес ұсынысы негізінде, 5.0 б.т. кем емес): Жақын шетелдік басылымдарда жарияланатын</span></p>
<p><span style="font-size: 10pt;"> </span></p>
<table>
<tbody>
<tr>
<td>
<p><span style="font-size: 10pt;">84</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2316_1527478452.png">http://ip.ayu.edu.kz/files/2316_1527478452.png</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">85</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2267_1527486839.pdf">http://ip.ayu.edu.kz/files/2267_1527486839.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">86</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/939_1527487193.pdf">http://ip.ayu.edu.kz/files/939_1527487193.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">87</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/1290_1527487646.pdf">http://ip.ayu.edu.kz/files/1290_1527487646.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">88</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/3092_1527236433.pdf">http://ip.ayu.edu.kz/files/3092_1527236433.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">89</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2247_1527233449.pdf">http://ip.ayu.edu.kz/files/2247_1527233449.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">90</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2309_1527200888.pdf">http://ip.ayu.edu.kz/files/2309_1527200888.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">91</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/547_1523588342.pdf">http://ip.ayu.edu.kz/files/547_1523588342.pdf</a></p>
</td>
</tr>
</tbody>
</table>
<p><span style="font-size: 10pt;"> </span></p>
<p><span style="font-size: 10pt;">2.1.1.7.3 Монографиялар  (Ғылыми-техникалық кеңес ұсынысы негізінде, 5.0 б.т. кем емес): Алыс шетелдік басылымдарда жарияланатын</span></p>
<p><span style="font-size: 10pt;"> </span></p>
<table>
<tbody>
<tr>
<td>
<p><span style="font-size: 10pt;">92</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/273_1527651777.pdf">http://ip.ayu.edu.kz/files/273_1527651777.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">93</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2128_1527651859.pdf">http://ip.ayu.edu.kz/files/2128_1527651859.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">94</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/91_1527485049.pdf">http://ip.ayu.edu.kz/files/91_1527485049.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">95</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2128_1527507488.pdf">http://ip.ayu.edu.kz/files/2128_1527507488.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">96</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2189_1526565941.pdf">http://ip.ayu.edu.kz/files/2189_1526565941.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">97</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2247_1527233624.pdf">http://ip.ayu.edu.kz/files/2247_1527233624.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">98</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/230_1527488477.pdf">http://ip.ayu.edu.kz/files/230_1527488477.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">99</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2866_1526879793.pdf">http://ip.ayu.edu.kz/files/2866_1526879793.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">100</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2866_1526879914.pdf">http://ip.ayu.edu.kz/files/2866_1526879914.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">101</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2128_1524650127.pdf">http://ip.ayu.edu.kz/files/2128_1524650127.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">102</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2170_1526009484.pdf">http://ip.ayu.edu.kz/files/2170_1526009484.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">103</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/831_1526041451.pdf">http://ip.ayu.edu.kz/files/831_1526041451.pdf</a></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: 10pt;">104</span></p>
</td>
<td>
<p><a href="http://ip.ayu.edu.kz/files/2257_1526380470.PDF">http://ip.ayu.edu.kz/files/2257_1526380470.PDF</a></p>
</td>
</tr>
</tbody>
</table>
<p><span style="font-size: 10pt;"> </span></p>
<p><span style="font-size: 10pt;"> </span></p>
<p><span style="font-size: 10pt;"> </span></p>
















			</div>


		</div>
	</div>
	</br>













	<div class = "footer">
	</div>
</body>
</html>