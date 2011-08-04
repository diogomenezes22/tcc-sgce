<?php
/**
 * Model para os usuários
 *
 * @package		sgce
 * @subpackage	sgce.model
 */
/**
 * @package		sgce
 * @subpackage	sgce.model
 */
class Usuario extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'Usuario';

	/**
	 * Campo padrão do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $displayField 	= 'nome';

	/**
	 * Campo de ordenação padrão
	 * 
	 * @var		string
	 * @access	public
	 */
	public $order		 	= 'Usuario.nome';

	/**
	 * Regras de validação para cada campo do model
	 * 
	 * @var		array
	 * @access	public
	 */
	public $validate = array
	(
		'status' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar se o usuário está ou não ativo!',
			)
		),
		'perfil' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar um perfil para o usuário!',
			)
		),
		'voluntario' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar se é um voluntário!',
			)
		),
		'prestacao_servico' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o tipo de prestação de serviço!',
			)
		),
		'nome' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o nome do usuário!',
			)
		),
		'email' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o email do usuário!',
			)
		),
		'senha' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar a senha do usuário!',
			)
		),
		'cpf' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o CPF do usuário!',
			)
		)
	);
}

?>
