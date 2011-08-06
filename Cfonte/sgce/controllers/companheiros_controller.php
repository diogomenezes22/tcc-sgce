<?php
/**
 * Controller para o cadastro de companheiros
 * 
 * @package		sgce
 * @subpackage	sgce.controller
 */
/**
 * @package		sgce
 * @subpackage	sgce.controller
 */
class CompanheirosController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Companheiros';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Companheiro');

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
	 * Antes de tudo
	 */
	public function beforeFilter()
	{

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
		$listaCampos 					= array('Companheiro.nome','Companheiro.escolaridade','Companheiro.profissao','Companheiro.trabalha');
		$edicaoCampos					= array('Companheiro.nome','#','Companheiro.escolaridade','#','Companheiro.profissao','#','Companheiro.ocupacao','@','Companheiro.trabalha','#','Companheiro.local_trabalho');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		$camposPesquisa['Companheiro.nome'] 	= 'Nome';
		$escreverTitBt 					= false; //Desativa escrito por extenso nos botões


		$campos['Companheiro']['nome']['input']['label']['text'] 	= 'Nome';
		$campos['Companheiro']['nome']['input']['size']				= '50';
		$campos['Companheiro']['nome']['th']['width']				= '300px';

		$campos['Companheiro']['escolaridade']['input']['label']['text'] 	= 'Escolaridade';
		$campos['Companheiro']['escolaridade']['input']['size']				= '30';
		$campos['Companheiro']['escolaridade']['th']['width']				= '200px';

		$campos['Companheiro']['profissao']['input']['label']['text'] 	= 'Profissão';
		$campos['Companheiro']['profissao']['input']['size']			= '30';
		$campos['Companheiro']['profissao']['th']['width']				= '200px';

		$campos['Companheiro']['ocupacao']['input']['label']['text'] 	= 'Ocupação';
		$campos['Companheiro']['ocupacao']['input']['size']				= '40';
		$campos['Companheiro']['ocupacao']['th']['width']				= '250px';

		$campos['Companheiro']['trabalha']['input']['label']['text'] 	= 'Trabalha?';
		$campos['Companheiro']['trabalha']['input']['options']		= array('1'=>'Sim', '0'=>'Não');
		$campos['Companheiro']['trabalha']['th']['width']				= '80px';

		$campos['Companheiro']['local_trabalho']['input']['label']['text'] 	= 'Local de Trabalho';
		$campos['Companheiro']['local_trabalho']['input']['size']			= '40';
		$campos['Companheiro']['local_trabalho']['th']['width']				= '250px';


		if ($this->action=='imprimir') //Esse "imprimir" é um método do controlador(classe)
		{
			$edicaoCampos = array('Companheiro.nome','#','Companheiro.escolaridade','#','Companheiro.profissao','#','Companheiro.ocupacao','@','Companheiro.trabalha','#','Companheiro.local_trabalho');
		}

		if ($this->action=='listar')
		{
			foreach($this->data as $_linha => $_arrModel)
			{
				// Irá colorir todos os usuários inativos
				//if ($_arrModel['Companheiro']['xxx']==0) array_unshift($onReadView,'$("#tr'.$id.'").css("background-color","#F2BCBC")');
			}
		}

		if ($this->action=='editar' || $this->action=='novo')
		{
			array_unshift($onReadView,'$("#CompanheiroNome").focus();');
		}

		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','escreverTitBt','onReadView','listaFerramentas','botoesEdicao'));
	}
}
?>
