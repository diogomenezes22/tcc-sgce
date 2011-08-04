<?php
/**
 * Model para as famílias
 *
 * @package		sgce
 * @subpackage	sgce.model
 */
/**
 * @package		sgce
 * @subpackage	sgce.model
 */
class Familia extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'Familia';

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
	public $order		 	= 'Familia.nome';

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
				'message' 	=> 'É necessário informar se a família está ou não ativa!',
			)
		),
		'nome' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o nome do responsável pela família!',
			)
		),
		'dt_nasc' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar a data de nascimento do responsável!',
			)
		),
		'endereco' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o endereço da moradia!',
			)
		),
		'numero' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o número da residência!',
			)
		),
		'bairro' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar o bairro!',
			)
		),
		'cidade' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty', //Não pode ficar em branco
				'required' 	=> true,
				'message' 	=> 'É necessário informar a cidade!',
			)
		)
	);
}

?>
