<?php
/**
 * Controller para Relatórios
 * 
 * @package		jcake
 * @subpakage	jcake.controller
 */
/**
 * @package		jcake
 * @subpakage	jcake.controller
 */
class RelatoriosController extends AppController {
	/**
	 * 
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 	= 'Relatorios';

	/**
	 * Model usado pelo controlador
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses	= array();

	/**
	 * Ajudantes
	 * 
	 * @var		array
	 * @access	public
	 */
	public $helpers		= array('Jcake.Visao');

	/**
	 * Antes de tudo
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		$this->layout 	= 'jcake';
		$this->plugin 	= 'jcake';
	}

	/**
	 * Método start
	 * 
	 * @return void
	 */
	public function index()
	{
		if ($this->data)
		{
			$msg = '';
			switch($this->data['tipo'])
			{
				case 'limparCache':
					$this->setLimpaCache();
					$msg = 'Cache limpo com sucesso';
					break;
			}
			$this->set('msg',$msg);
		}
	}
}
?>
