<?php
/**
 * View para exibir o formulário de impressão do plugin jCake
 * 
 * @package		jcake
 * @subpackage	jcake.view
 */
?>
<div id='imprimir'>
<?php
	echo $this->Html->css('/jcake/css/jcake_editar.css', null, array('inline' => false));
	if (isset($edicaoCampos)) $texto = $this->Visao->getCampos($edicaoCampos, $campos, $modelClass, $id, true);
	echo $texto;
?>
<br /><br />
<center><a href='javascript:history.back();' style='font-weight: bold;'>Voltar</a></center>
<br /><br />
</div>
<?php //pr($this->data); ?>
