<?php
/**
 * Controller para o cadastro de mantimentos
 * 
 * @package		sgce
 * @subpackage	sgce.controller
 */
/**
 * @package		sgce
 * @subpackage	sgce.controller
 */
class MantimentosController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Mantimentos';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Mantimento');

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
// Transforma os campos especificados para caixa ALTA (mb_strtoupper)
/*		if (isset($this->data))
		{
			$this->data['Mantimento']['nome'] = mb_strtoupper($this->data['Mantimento']['nome']);
		}
*/
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
		$listaCampos 					= array('Mantimento.nome','Mantimento.tipo','Mantimento.data_entrada','Mantimento.validade');
		$edicaoCampos					= array('Mantimento.nome','#','Mantimento.tipo','#','Mantimento.data_entrada','#','Mantimento.validade');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		$camposPesquisa['Mantimento.nome'] 	= 'Nome';
		$escreverTitBt 					= false; //Desativa escrito por extenso nos botões

		$campos['Mantimento']['nome']['input']['label']['text'] 	= 'Nome';
		$campos['Mantimento']['nome']['input']['size']				= '50';
		$campos['Mantimento']['nome']['th']['width']				= '300px';

		$campos['Mantimento']['tipo']['input']['label']['text'] 	= 'Tipo';
		$campos['Mantimento']['tipo']['input']['size']				= '20';
		$campos['Mantimento']['tipo']['th']['width']				= '130px';

		$campos['Mantimento']['data_entrada']['input']['label']['text']	= 'Data de entrada';
		$campos['Mantimento']['data_entrada']['input']['label']['style']= 'color: green;';
		$campos['Mantimento']['data_entrada']['mascara'] 				= '99/99';
		$campos['Mantimento']['data_entrada']['input']['style']			= 'width: 46px; text-align: center; ';

		$campos['Mantimento']['validade']['input']['label']['text']	= 'Validade';
		$campos['Mantimento']['validade']['input']['label']['style']= 'color: red;';
		$campos['Mantimento']['validade']['mascara'] 				= '99/99';
		$campos['Mantimento']['validade']['input']['style']			= 'width: 46px; text-align: center; ';


		if ($this->action=='imprimir') //Esse "imprimir" é um método do controlador(classe)
		{
			$edicaoCampos = array('Mantimento.nome','#','Mantimento.tipo','#','Mantimento.data_entrada','#','Mantimento.validade');
		}

		if ($this->action=='listar')
		{
			foreach($this->data as $_linha => $_arrModel)
			{
				// Irá colorir todas as datas que estiverem vencendo em X dias
				//if ($_arrModel['Mantimento']['data_entrada']>XXXXX) array_unshift($onReadView,'$("#tr'.$id.'").css("background-color","#F2BCBC")');
			}
		}

		if ($this->action=='editar' || $this->action=='novo')
		{
			array_unshift($onReadView,'$("#UsuarioNome").focus();'); // Define o campo que vai ganhar foco
		}

		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','escreverTitBt','onReadView','listaFerramentas','botoesEdicao'));
	}
}
?>
