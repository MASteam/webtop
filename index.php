<html>
	<head>
	</head>
	<body>
	<table>
		<tr>
			<td>#</td>
			<td>Ник</td>
			<td>Убийств</td>
			<td>Смертей</td>
			<td>Коэфф.</td>
			<td>В голову</td>
			<td>Точность</td>
		</tr>
<?php
define('GUARD', true);
$path = '/root/hlds/public/cstrike/addons/amxmodx/data/csstats.dat';

include "csstats.php";

$data = new CSstats($path); 
//print_r($result);

$start = 1; $end = 15;
for($i=$start;$i<=$end;$i++){
	echo "		<tr> 
			<td>$i</td>
			<td>".$data[$i]['nick']."</td>
			<td>".$data[$i]['kills']."</td>
			<td>".$data[$i]['deaths']."</td>
			<td>".number_format(($data[$i]['kills']/$data[$i]['deaths']), 2, '.', '')."</td>
			<td>".$data[$i]['headshots']."</td>
			<td>".$data[$i]['acc']."%</td>
		</tr>\n";	
}
?>
		</table>
	</body>
</html>
