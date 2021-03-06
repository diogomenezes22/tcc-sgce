<?php
/**
 * Controller para o cadastro de usuários
 * 
 * @package		sgce
 * @subpackage	sgce.controller
 */
/**
 * @package		sgce
 * @subpackage	sgce.controller
 */
class UsuariosController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Usuarios';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Usuario');

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
	 * Executa código antes da renderização da view
	 * 
	 * @return	void
	 */
	public function beforeRender()
	{
		$campos							= array();
		$onReadView 					= array();
		$listaCampos 					= array('Usuario.status','Usuario.voluntario','Usuario.perfil','Usuario.nome','Usuario.email','Usuario.telefone','Usuario.celular');
		$edicaoCampos					= array('Usuario.status','#','Usuario.voluntario','#','Usuario.perfil','#','Usuario.prestacao_servico','@','Usuario.nome','#','Usuario.email','#','Usuario.senha','@','Usuario.cpf','Usuario.rg','#','Usuario.endereco','Usuario.numero','Usuario.complemento','#','Usuario.bairro','#','Usuario.cidade','Usuario.uf','#','Usuario.cep','#','Usuario.telefone','#','Usuario.celular');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		$camposPesquisa['Usuario.nome'] 	= 'Nome';
		$escreverTitBt 					= false; //Desativa escrito por extenso nos botões

		$campos['Usuario']['status']['input']['label']['text'] 				= 'Situação';
		$campos['Usuario']['status']['input']['options']					= array('1'=>'Ativo', '0'=>'Inativo');
		$campos['Usuario']['status']['th']['width']							= '80px';

		$campos['Usuario']['voluntario']['input']['label']['text']			= 'Voluntário?';
		$campos['Usuario']['voluntario']['input']['options']				= array('1'=>'Sim', '0'=>'Não');
		$campos['Usuario']['voluntario']['th']['width']						= '100px';

		$campos['Usuario']['perfil']['input']['label']['text'] 				= 'Perfil';
		$campos['Usuario']['perfil']['input']['options']					= array('Administrador'=>'Administrador','Coordenador'=>'Coordenador','Gestor'=>'Gestor','Consultor'=>'Consultor');
		$campos['Usuario']['perfil']['input']['type']						= 'select';
		$campos['Usuario']['perfil']['th']['width']							= '200px';

		$campos['Usuario']['prestacao_servico']['input']['label']['text'] 	= 'Tipo de Serviço';
		$campos['Usuario']['prestacao_servico']['input']['style']			= 'width: 400px; text-align: left';
		$campos['Usuario']['prestacao_servico']['th']['width']				= '400px';

		$campos['Usuario']['nome']['input']['label']['text'] 				= 'Nome';
		$campos['Usuario']['nome']['input']['style']						= 'width: 250px; text-align: left';
		$campos['Usuario']['nome']['th']['width']							= '200px';

		$campos['Usuario']['email']['input']['label']['text'] 				= 'E-mail';
		$campos['Usuario']['email']['input']['style']						= 'width: 250px; text-align: left';
		$campos['Usuario']['email']['th']['width']							= '150px';

		$campos['Usuario']['senha']['input']['label']['text'] 				= 'Senha';
		$campos['Usuario']['senha']['input']['style']						= 'width: 250px; text-align: left';
		$campos['Usuario']['senha']['input']['type']						= 'password';

		$campos['Usuario']['cpf']['input']['label']['text'] 				= 'CPF';
		$campos['Usuario']['cpf']['input']['style']							= 'width: 120px; text-align: center;';
		$campos['Usuario']['cpf']['mascara']								= '999.999.999-99';

		$campos['Usuario']['rg']['input']['label']['text'] 					= 'RG';
		$campos['Usuario']['rg']['input']['size']							= '10';
		$campos['Usuario']['rg']['th']['width']								= '100px';

		$campos['Usuario']['endereco']['input']['label']['text'] 			= 'Endereço';
		$campos['Usuario']['endereco']['input']['style']					= 'width: 340px; text-align: left';
		$campos['Usuario']['endereco']['th']['width']						= '350px';

		$campos['Usuario']['numero']['input']['label']['text'] 				= 'Número';
		$campos['Usuario']['numero']['input']['style']						= 'width: 40px; text-align: left';
		$campos['Usuario']['numero']['th']['width']							= '50px';

		$campos['Usuario']['complemento']['input']['label']['text']			= 'Complemento';
		$campos['Usuario']['complemento']['input']['style']					= 'width: 40px; text-align: left';
		$campos['Usuario']['complemento']['th']['width']					= '50px';

		$campos['Usuario']['bairro']['input']['label']['text'] 				= 'Bairro';
		$campos['Usuario']['bairro']['input']['style']						= 'width: 200px; text-align: left';
		$campos['Usuario']['bairro']['th']['width']							= '150px';

		$campos['Usuario']['cidade']['input']['label']['text'] 				= 'Cidade';
		$campos['Usuario']['cidade']['input']['style']						= 'width: 200px; text-align: left';
		$campos['Usuario']['cidade']['th']['width']							= '150px';

		$campos['Usuario']['uf']['input']['label']['text'] 					= 'UF';
		$campos['Usuario']['uf']['input']['style']							= 'width: 25px; text-align: center';
		$campos['Usuario']['uf']['th']['width']								= '50px';

		$campos['Usuario']['cep']['input']['label']['text']					= 'CEP';
		$campos['Usuario']['cep']['input']['style']							= 'width: 95px; text-align: center;';
		$campos['Usuario']['cep']['mascara']								= '99.999-999';

		$campos['Usuario']['telefone']['input']['label']['text'] 			= 'Telefone';
		$campos['Usuario']['telefone']['input']['style']					= 'width: 120px; text-align: center;';
		$campos['Usuario']['telefone']['mascara']							= '99 9999-9999';
		$campos['Usuario']['telefone']['input']['maxlength']				= '13';

		$campos['Usuario']['celular']['input']['label']['text'] 			= 'Celular';
		$campos['Usuario']['celular']['input']['style']						= 'width: 120px; text-align: center;';
		$campos['Usuario']['celular']['input']['maxlength']					= '13';
		$campos['Usuario']['celular']['mascara']							= '99 9999-9999';


		//Desativa ordenação de campo com clique no título da lista ou do DBgrid
		//$campos['Usuario']['nome']['thOff']						= true;

		//Inativa o campo email - como obrigatório - e desativa o campo senha, caso voluntário seja ativo.

		if ($this->action=='imprimir') //Esse "imprimir" é um método do controlador(classe)
		{
			$edicaoCampos = array('Usuario.voluntario','#','Usuario.perfil','#','Usuario.prestacao_servico','@','Usuario.nome','#','Usuario.email','@','Usuario.cpf','Usuario.rg','#','Usuario.endereco','Usuario.numero','Usuario.complemento','#','Usuario.bairro','#','Usuario.cidade','Usuario.uf','#','Usuario.cep','#','Usuario.telefone','#','Usuario.celular');
		}

		if ($this->action=='listar')
		{
			foreach($this->data as $_linha => $_arrModel)
			{
				// Irá colorir todos os usuários inativos
				if ($_arrModel['Usuario']['status']==0) array_unshift($onReadView,'$("#tr'.$id.'").css("background-color","#F2BCBC")');
			}
		}

		if ($this->action=='editar' || $this->action=='novo')
		{
			array_unshift($onReadView,'$("#UsuarioPrestacaoServico").focus();');
		}

		if ($this->data && in_array($this->action,array('editar')))
		{
			$this->data['Usuario']['senha'] = '';
		}

		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','escreverTitBt','onReadView','listaFerramentas','botoesEdicao'));
	}
}
?>
