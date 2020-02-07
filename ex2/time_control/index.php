<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оценка производительности");
?><table border="1" cellpadding="1" cellspacing="1">
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
 <b>&nbsp;Ресурсоемкий компонент</b>
	</td>
	<td>
 <b>Время работы компонента</b>
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
		 &nbsp;bitrix:menu
	</td>
	<td>
		 &nbsp; &nbsp; &nbsp;1.4289
	</td>
</tr>
</tbody>
</table>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>