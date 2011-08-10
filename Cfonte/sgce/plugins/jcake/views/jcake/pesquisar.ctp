<?php
/**
 * View para exibir a resposta da pesquisa rápida
 * 
 * @package		jcake
 * @subpackage	jcake.view
 */
?>
<?php // exibe a resposta da pesquisa ?>
<ul>
<?php foreach($pesquisa as $id => $valor) echo "\t".'<li onclick="document.location.href=\''.$link.'/'.$id.'\'">'.$valor.'</li>'."\n"; ?>
</ul>
