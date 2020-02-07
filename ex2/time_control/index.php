<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?><?$APPLICATION->SetTitle("Оценка производительности");
?>
<table border="1" cellpadding="1" cellspacing="1">
<tbody>
<tr>
	<td>
 <b>
		&nbsp;Самая ресурсоемкая страница </b>
	</td>
	<td>
 <b>
		&nbsp;Доля&nbsp; в общей статистике %&nbsp;&nbsp;</b>
	</td>
	<td>
 <b>&nbsp;Компонент с наибольшим кол-вом запросов</b>
	</td>
	<td>
 <b>Кол-во запросов</b>
	</td>
</tr>
<tr>
	<td>
		 &nbsp;<a href="http://localhost/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fproducts%2Findex.php">/products/index.php</a>
	</td>
	<td>
		 &nbsp; &nbsp; 22.41
	</td>
	<td>
		 bitrix:news.list<br>
	</td>
	<td>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;34&nbsp;&nbsp;
	</td>
</tr>
</tbody>
</table><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>