<?php
/**
 * View para exibir sqlDump do plugin jCake
 * 
 * @package		jcake
 * @subpackage	jcake.view.elements
 */

if (!class_exists('ConnectionManager') || Configure::read('debug') < 2) {
	return false;
}
$noLogs = !isset($logs);
if ($noLogs):
	$sources = ConnectionManager::sourceList();

	$logs = array();
	foreach ($sources as $source):
		$db =& ConnectionManager::getDataSource($source);
		if (!$db->isInterfaceSupported('getLog')):
			continue;
		endif;
		$logs[$source] = $db->getLog();
	endforeach;
endif;

if ($noLogs || isset($_forced_from_dbo_)):
	foreach ($logs as $source => $logInfo):
		$text = $logInfo['count'] > 1 ? 'queries' : 'query';
		printf(
			'<table border = "0" align="center">',
			preg_replace('/[^A-Za-z0-9_]/', '_', uniqid(time(), true))
		);
		printf('<caption>(%s) %s %s took %s ms</caption>', $source, $logInfo['count'], $text, $logInfo['time']);
	?>
	<thead>
		<tr><th>Nr</th><th>Consulta</th><th>Erro</th><th>Lin.Afet.</th><th>Nr.Linhas</th><th>Tempo (ms)</th></tr>
	</thead>
	<tbody>
	<?php
		foreach ($logInfo['log'] as $k => $i) :
			$class = ($k % 2) ? 'tdSqlDump' : 'tdSqlDump1';
			echo "<tr><td class='$class' align='center'>" . ($k + 1) . "</td><td class='$class'>" . str_replace('`','',h($i['query'])) . "</td><td class='$class'>{$i['error']}</td><td class='$class' style = \"text-align: center\">{$i['affected']}</td><td class='$class' style = \"text-align: center\">{$i['numRows']}</td><td class='$class' style = \"text-align: center\">{$i['took']}</td></tr>\n";
		endforeach;
	?>
	</tbody></table>
	<?php 
	endforeach;
else:
	echo '<p>Encountered unexpected $logs cannot generate SQL log</p>';
endif;
?>
