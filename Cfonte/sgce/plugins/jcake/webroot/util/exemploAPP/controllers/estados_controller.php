<?php
/**
 * Controller para o cadastro de estados
 * 
 * @package		exemploApp
 * @subpackage	exemploApp.controller
 */
/**
 * @package		exemploApp
 * @subpackage	exemploApp.controller
 */
class EstadosController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Estados';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Estado');

	/**
	 * Componentes
	 * 
	 * @var		array
	 * @access	public
	 */
	public $components	= array('Jcake.Controlador');

	/**
	 * Ajudantes
	 * 
	 * @var		array
	 * @access	public
	 */
	public $helpers		= array('Jcake.Visao');

	/**
	 * 
	 */
	public function beforeFilter()
	{
		if (isset($this->data))
		{
			$this->data['Estado']['nome'] = mb_strtoupper($this->data['Estado']['nome']);
		}
	}

	/**
	 * Executa código antes da renderização da view
	 * 
	 * @return	void
	 */
	public function beforeRender()
	{
		$campos							= array();
		$onReadView 					= array();
		$listaCampos 					= array('Estado.nome','Estado.uf','Estado.modified','Estado.created');
		$edicaoCampos					= array('Estado.nome','#','Estado.uf','@','Estado.modified','Estado.created');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		if ($this->action=='imprimir')
		{
			$edicaoCampos				= array('Estado.nome','#','Estado.uf','@','Estado.modified','Estado.created');
		}

		$listaFerramentas['excluir']	= '';
		$botoesEdicao['novo']	 		= '';
		//$botoesEdicao['salvar']	 		= '';
		$botoesEdicao['excluir'] 		= '';

		$camposPesquisa['Estado.nome'] 	= 'Nome';

		$campos['Estado']['nome']['input']['label']['text'] 	= 'Nome';
		$campos['Estado']['nome']['input']['size']				= '60';
		$campos['Estado']['nome']['th']['width']				= '400px';

		$campos['Estado']['uf']['input']['label']['text'] 		= 'Uf';
		$campos['Estado']['uf']['input']['style']				= 'width: 30px; text-align: center;';
		$campos['Estado']['uf']['th']['width']					= '99px';
		$campos['Estado']['uf']['td']['align']					= 'center';

		if ($this->action=='editar' || $this->action=='novo')
		{
			array_unshift($onReadView,'$("#EstadoNome").focus();');
		}
//$lista = Cache::read('all_Estado');
//pr($lista.' *');
		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','escreverTitBt','onReadView','listaFerramentas','botoesEdicao'));
	}
}
?>
