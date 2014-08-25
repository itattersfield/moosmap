<?php
	$today = getdate();
	
//Connect to mySQL info =============================================================
$hostname = "moosmap.db.10804641.hostedresource.com";
$username = "moosmap";
$dbname = "moosmap";
$password = "M00Sm@p1812";
$usertable = "macdspf";
$yourfield = "name";

$spfIn = $_GET['spfIn'];
//echo $spfIn;
//echo "--";

//Connect to database
mysql_connect($hostname, $username, $password) OR DIE ("Unable to 
connect to database! Please try again later.");
mysql_select_db($dbname);

//Fetching from your database table.
$query = "SELECT * FROM $usertable";

$result = mysql_query($query);

//echo "++";
if ($result) {
//	echo "Connected to Database"."<BR>";
	while($row = mysql_fetch_array($result)) {
		   $spfTable[$i] = $row["spf"];
			if ($spfIn == $spfTable[$i]) {
		//		echo "true";
				$spf = $row["spf"];
				$full = $row["full"];
				$coords = $row["coords"];
				$desc = $row["desc"];
				$moosurl = $row["moosurl"];
				$alturltitle = $row["alturltitle"];
				$alturl = $row["alturl"];
				$budget = $row["budget"];
				$date = $row["date"];
				$logophoto = $row["logophoto"];
				$photo = $row["photo"];
						
				$i++;
				$j++;	// counts array length for loop
			}
			else {
			//	echo "false";
				$i++;
				$j++;
			}
	}
}


if (!$result) {
  die('Invalid query: ' . mysql_error());
}


// Top of KML File ========================================================================================================================================================
$kml = array('<?xml version="1.0" encoding="UTF-8"?>');
$kml[] = '<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">';
$kml[] = ' <Document id="arts" xsi:schemaLocation="http://www.opengis.net/kml/2.2 http://schemas.opengis.net/kml/2.2.0/ogckml22.xsd http://www.google.com/kml/ext/2.2 http://code.google.com/apis/kml/schema/kml22gx.xsd">';
$kml[] = ' <name>SPF_LOC-' . $spfIn . '_' . $today['mon'] . '-' .$today['mday'] . '-' . $today['year'] . '_' . $today['hours'] . ':' . $today['minutes'] . '.kml</name>';
//  ************************** location ******************************
$kml[] = ' 	<Style id="' . $spf . '">';
$kml[] = ' 		<IconStyle>';
$kml[] = ' 			<scale>1</scale>';
$kml[] = ' 			<Icon>';
$kml[] = ' 			   <href>http://www.moosmap.com/media/icons/SPF3.png</href>';
$kml[] = ' 			</Icon>';
$kml[] = ' 		</IconStyle>';
$kml[] = '  </Style>';
$kml[] = ' 	<Placemark id="' . $spf .'">';
$kml[] = ' 		<name>' . $full . '</name>';
$kml[] = ' 		<Snippet maxLines="0"></Snippet>';
// description balloon info here
$kml[] = '<description><![CDATA[<html xmlns:fo="http://www.w3.org/1999/XSL/Format" xmlns:msxsl="urn:schemas-microsoft-com:xslt"> ';
$kml[] = ' 	<body> ';
$kml[] = '    <font size="2">  ';
$kml[] = '    <img src="' .$photo .'" /> ';
$kml[] = '    <table width="300" border="2" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC"> ';
$kml[] = '      <tr> ';
$kml[] = '        <th scope="row">Project Name:</th> ';
$kml[] = '        <td>' .$full .'</td> ';
$kml[] = '      </tr> ';
$kml[] = '      <tr> ';
$kml[] = '	      <th scope="row">Links</th> ';
$kml[] = '        <td><a href="' . $moosurl . '">Project Page</a><br><a href="' . $alturl . '">'. $alturltitle . '</a></td> ';
$kml[] = '      </tr> ';
$kml[] = '      <tr> ';
$kml[] = '        <th scope="row">Budget:</th> ';
$kml[] = '        <td>' .$budget .'</td> ';
$kml[] = '      </tr> ';
$kml[] = '      <tr> ';
$kml[] = '        <th scope="row">Date:</th> ';
$kml[] = '        <td>' .$date .'</td> ';
$kml[] = '      </tr> ';
$kml[] = '     </table> ';
$kml[] = '     </table> ';
$kml[] = '     <table width="300" border="2" cellspacing="1" cellpadding="1"> ';
$kml[] = '     <tr> ';
$kml[] = '     <td style="text-align:justify;"><font size="2" >' . $desc . ' </font></td> ';
$kml[] = '     </tr> ';
$kml[] = '     </table> ';
$kml[] = '    <img src="'. $logophoto .'" /> ';
$kml[] = ' 	</body> ';
$kml[] = ' 	</html>]]> ';
$kml[] = '</description>';
$kml[] = ' ';
$kml[] = ' ';
$kml[] = ' ';
$kml[] = ' ';
$kml[] = '<styleUrl>#' . $spf .'</styleUrl>';
$kml[] = ' <Point>';
$kml[] = '  <coordinates>'. $coords .'</coordinates>';
$kml[] = ' </Point>';
$kml[] = '</Placemark>';
$kml[] = ' ';
$kml[] = ' </Document>';
$kml[] = ' </kml>';
// close .kml document
$kmlOutput = join("\n", $kml);
header('Content-Disposition: attachment; filename="MACSPF_' . $today['mon'] . '-' .$today['mday'] . '-' . $today['year'] . '_' . $today['hours'] . ':' . $today['minutes'] . '.kml"');
echo $kmlOutput;

?>