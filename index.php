<html>
	<head>
		<title>Top</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="wrapper">
		    <div class="table" style="border-bottom: 1px solid #ddd; border-left: 1px solid #ddd;">
				<table cellpadding="0" cellspacing="0"  style="text-align: center">
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
$path = '/path/to/your/csstats.dat'; //путь до файла csstats.dat
$pnumber = 30; //количество игроков на странице

include "csstats.php";

function pagination($url, $page, $total_pages) {
	$neighbors = 2; 
	$out = '<div class="pagination">'; 
	
	if ($page > 1 || $page < $total_pages) {
		$out .= '<div class="plinks">'; 
		if ($page > 1)
			$out .= '<a href="'.$url.'p='.($page - 1).'"><button>← Предыдущая</button></a>'; 
/*		if ($page > 1 && $page < $total_pages)
	$out .= ' | '; */
		if ($page < $total_pages)
			$out .= ' <a href="'.$url.'p='.($page + 1).'"><button>Следующая →</button></a>'; 
		$out .= '</div>'; 
	}
	
	// Ссылка на первую страницу
	if ($page > 1)
		$out .= ' <a class="page" href="'.$url.'p=1"><button>&nbsp;1&nbsp;</button></a>'; 
	
	// Страницы слева активной
	if ($page - 1 > $neighbors + 1)
		$out .= ' ... '; 
	$min_page = max(2, $page - $neighbors); 
	for ($i = $min_page; $i < $page; $i++)
		$out .= ' <a class="page" href="'.$url.'p='.$i.'"><button>&nbsp;'.$i.'&nbsp;</button></a> '; 
	
	// Текущая страничка
	$out .= ' <span class="curr_page"><button disabled>&nbsp;'.$page.'&nbsp;</button></span> '; 
	
	// Страницы справа активной
	$max_page = min($total_pages - 1, $page + $neighbors); 
	for ($i = $page + 1; $i <= $max_page; $i++)
		$out .= ' <a class="page" href="'.$url.'p='.$i.'"><button>&nbsp;'.$i.'&nbsp;</button></a> '; 
	if ($page < $total_pages - $neighbors - 1)
		$out .= ' ... '; 
	
	// Ссылка на последнюю страницу
	if ($page < $total_pages)
		$out .= ' <a class="page" href="'.$url.'p='.$total_pages.'"><button>&nbsp;'.$total_pages.'&nbsp;</button></a> '; 
	$out .= '</div>'; 
	
	return $out; 
}

$data = new CSstats($path); 
$all = $data->countPlayers();

$page = (int)$_GET['p'];
$pages = ceil($all / $pnumber);
$start = ($start = $page * $pnumber - $pnumber) <= 0 ? 1 : $start;
$end = ($end = $start + $pnumber) > $all ? $all : $end;
for($i=$start;$i<=$end;$i++){
	echo "					<tr class=\"row".($i%2)."\"> 
						<td>$i</td>
						<td>".$data[$i]['nick']."</td>
						<td>".$data[$i]['kills']."</td>
						<td>".$data[$i]['deaths']."</td>
						<td>".number_format(($data[$i]['kills']/$data[$i]['deaths']), 2, '.', '')."</td>
						<td>".$data[$i]['headshots']."</td>
						<td>".$data[$i]['acc']."%</td>
					</tr>\n";	
}
echo "		<tr>
						<td>#</td>
						<td>Ник</td>
						<td>Убийств</td>
						<td>Смертей</td>
						<td>Коэфф.</td>
						<td>В голову</td>
						<td>Точность</td>
					</tr>
			</table>\n </div>\n <div style=\"text-align: right; margin-top: 10px;\">Игроков в топе: <b>$all</b></div>\n<div class=\"center\" style=\"margin-top: 20px;\">".pagination("/mytop/?", $page, $pages)."</div>\n";
?>
	</body>
</html>
