<?php
/**
 * Controller para o cadastro de grupos
 * 
 * @package		exemploApp
 * @subpackage	exemploApp.controller
 */
/**
 * @package		exemploApp
 * @subpackage	exemploApp.controller
 */
class GruposController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Grupos';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Grupo');

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
			$this->data['Grupo']['nome'] = mb_strtoupper($this->data['Grupo']['nome']);
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
		$listaCampos 					= array('Grupo.nome','Grupo.modified','Grupo.created');
		$edicaoCampos					= array('Grupo.nome','#','Cliente','@','Grupo.modified','#','Grupo.created');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		if ($this->action=='imprimir')
		{
			$edicaoCampos = array('Grupo.nome','#','Cliente.nome','@','Grupo.modified','Grupo.created');
		}

		$camposPesquisa['Grupo.nome'] 	= 'Nome';

		$campos['Grupo']['nome']['input']['label']['text'] 	= 'Nome';
		$campos['Grupo']['nome']['input']['size']			= '60';
		$campos['Grupo']['nome']['th']['width']				= '400px';

		$campos['Cliente']['cliente']['input']['label']['text']		= 'Cliente(s)';
		$campos['Cliente']['cliente']['input']['label']['style'] 	= 'min-height: 200px;';
		$campos['Cliente']['cliente']['input']['style']				= 'min-height: 100px;';

		if ($this->action=='editar' || $this->action=='novo')
		{
			$clientes = $this->Grupo->Cliente->find('list');
			array_unshift($onReadView,'$("#GrupoNome").focus();');
		}

		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','onReadView','listaFerramentas','botoesEdicao','clientes'));
	}
}
?>
