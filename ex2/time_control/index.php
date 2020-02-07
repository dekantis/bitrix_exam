<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оценка производительности");
?><table border="1" cellpadding="1" cellspacing="1" style="width: 500px;">
<tbody>
<tr>
	<td>
 <b>Название самой ресурсоемкой страницы</b>
	</td>
	<td>
 <b>&nbsp;Доля в общей статистике нагрузки %</b>
	</td>
</tr>
<tr>
	<td>
		 &nbsp; &nbsp;<a href="http://localhost/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fex2%2Fsimplecomp%2Findex.php">/ex2/simplecomp/index.php</a>&nbsp;
	</td>
	<td>
		 &nbsp;94.07
	</td>
</tr>
</tbody>
</table>
<h3><b>Размер кэша компонента simplecomp.exam до и после кэшерования только данных из некэшируемой области</b></h3>
<table border="1" cellpadding="1" cellspacing="1">
<tbody>
<tr>
	<td>
 <b>&nbsp;По умолчанию</b>
	</td>
	<td>
		 &nbsp;<b>Только данные из некешируемой области</b>
	</td>
	<td>
 <b>&nbsp;Разница</b>
	</td>
</tr>
<tr>
	<td>
		 &nbsp;27139
	</td>
	<td>
		&nbsp; &nbsp; &nbsp; 1211
	</td>
	<td>
		 <?= 27139-1211;?>
	</td>
</tr>
</tbody>
</table>
 <b><br>
 </b><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>