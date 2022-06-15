<html>
	<head>
		<title>User</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	
	<style>
		table, th, td {
			border:1px solid black;
			text-align: left;
		}
		form {
			margin-top:20px;
		}
	</style>
	
	<body>
		<a href="index.php">Click here to go back</a><br/><br/>
		<div width="80%" Style="margin-top:30px">
			<table style="width:100%">
				<tr style="background-color: lightgrey;">
					<th>Zival</th>
					<th>Opis</th>
					<th>Id</th>
				</tr>
		<?php
			$conn = new mysqli('localhost', 'root', 'test1234', 'mydb');
			$conn->set_charset("UTF8");
			
			if(isset($_POST["add"])){
				$zival=$_POST["ime"];
				$opis=$_POST["opis"];
				$x=$_POST["x"];
				$y=$_POST["y"];
				$conn->query("INSERT INTO mydb.zivali (zival, opis, datum, x, y) VALUES ('$zival', '$opis', NOW(), $x, $y);");
				$_POST = array();
			}
		
		
			function f2(){
				global $conn;
				$x = $conn->query("SELECT * FROM Zivali");
				$tab = array();
				while($oglas = $x->fetch_object()){
					array_push($tab, $oglas);
				}
				return $tab;
			}
			foreach(f2() as $x){
				?>
					<tr>
						<th><?php echo $x->zival;?></th>
						<th><?php echo $x->opis;?></th>
						<th><?php echo $x->id;?></th>
					</tr>
				<?php
			}			
			
			
		?>	
				</table>
			</div>
			
			<div width="80%" Style="margin-top:30px">
				<table style="width:100%">
						<tr><form method="POST">
						<th><p>Add</p></th>
						<th><label>Ime: </label><input type="text" name="ime" />
						<label>Opis: </label><input type="text" name="opis" />
						<label>x: </label><input type="text" name="x" id="x"/>
						<label>y: </label><input type="text" name="y" id="y"/>
						<input type="submit" name="add"/> </th>
					</form></tr>
					</form></tr>
				</table>
			</div>
			
			<div id="divid" style="position: relative; border:2px solid black; margin-top:30px"><img class="img1" src="images/maribor.png" width="86%" style="position: relative;"></div>
			<div id="coords">Coords</div>

	<script type="text/javascript">
	/*
	 Here add the ID of the HTML elements for which to show the mouse coords
	 Within quotes, separated by comma.
	 E.g.:   ['imgid', 'divid'];
	*/
	var elmids = ['divid'];

	var x, y = 0;       // variables that will contain the coordinates

	// Get X and Y position of the elm (from: vishalsays.wordpress.com)
	function getXYpos(elm) {
	  x = elm.offsetLeft;        // set x to elm’s offsetLeft
	  y = elm.offsetTop;         // set y to elm’s offsetTop

	  elm = elm.offsetParent;    // set elm to its offsetParent

	  //use while loop to check if elm is null
	  // if not then add current elm’s offsetLeft to x
	  //offsetTop to y and set elm to its offsetParent
	  while(elm != null) {
		x = parseInt(x) + parseInt(elm.offsetLeft);
		y = parseInt(y) + parseInt(elm.offsetTop);
		elm = elm.offsetParent;
	  }

	  // returns an object with "xp" (Left), "=yp" (Top) position
	  return {'xp':x, 'yp':y};
	}

	// Get X, Y coords, and displays Mouse coordinates
	function getCoords(e) {
	 // coursesweb.net/
	  var xy_pos = getXYpos(this);

	  // if IE
	  if(navigator.appVersion.indexOf("MSIE") != -1) {
		// in IE scrolling page affects mouse coordinates into an element
		// This gets the page element that will be used to add scrolling value to correct mouse coords
		var standardBody = (document.compatMode == 'CSS1Compat') ? document.documentElement : document.body;

		x = event.clientX + standardBody.scrollLeft;
		y = event.clientY + standardBody.scrollTop;
	  }
	  else {
		x = e.pageX;
		y = e.pageY;
	  }

	  x = x - xy_pos['xp'];
	  y = y - xy_pos['yp'];

	  // displays x and y coords in the #coords element
	  document.getElementById('coords').innerHTML = 'X= '+ x+ ' ,Y= ' +y;
	}

	// register onmousemove, and onclick the each element with ID stored in elmids
	for(var i=0; i<elmids.length; i++) {
	  if(document.getElementById(elmids[i])) {
		// calls the getCoords() function when mousemove
		document.getElementById(elmids[i]).onmousemove = getCoords;

		// execute a function when click
		document.getElementById(elmids[i]).onclick = function() {
		  document.getElementById('x').value = x;
		  document.getElementById('y').value = y;
		};
	  }
	}
	</script>

</html>