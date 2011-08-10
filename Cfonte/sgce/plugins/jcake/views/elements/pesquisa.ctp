<?php
/**
 * View para exibir o formulário da pesquisa rápida
 * 
 * @package		jcake
 * @subpackage	jcake.view.elements
 */
?>
<!-- inicio pesquisa -->
<div id="pesquisa">
	<span id="spPesquisa">Pesquisar</span>

	<?php
		$parametrosPesquisa				= array();
		$parametrosPesquisa['label'] 	= false;
		$parametrosPesquisa['div']		= false;
		$parametrosPesquisa['class']	= 'slPesquisa';
		$parametrosPesquisa['id']		= 'slPesquisa';
		$parametrosPesquisa['options']	= $camposPesquisa;
		$parametrosPesquisa['default'] 	= ($this->Session->check('campoPesquisa'.$this->name)) ? $this->Session->read('campoPesquisa'.$this->name) : false;
		echo $this->Form->input('slPesquisa',$parametrosPesquisa);
	?>

	<input type="text" name="inPesquisa" id="inPesquisa" class="inPesquisa" />
	<div id="rePesquisa"></div>
</div>
<!-- fim pesquisa -->
