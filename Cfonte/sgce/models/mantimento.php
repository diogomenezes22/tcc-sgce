<?php
/**
 * Model para os mantimentos
 *
 * @package		sgce
 * @subpackage	sgce.model
 */
/**
 * @package		sgce
 * @subpackage	sgce.model
 */
class Mantimento extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'Mantimento';

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
	public $order		 	= 'Mantimento.nome';

	/**
	 * Regras de validação para cada campo do model
	 * 
	 * @var		array
	 * @access	public
	 */
	public $validate = array
	(
		'nome' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty',
				'required' 	=> true,
				'message' 	=> 'É necessário informar o nome do mantimento!',
			)
		),
		'tipo' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty',
				'required' 	=> true,
				'message' 	=> 'É necessário informar o tipo de mantimento!',
			)
		),
		'validade' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty',
				'required' 	=> true,
				'message' 	=> 'É necessário informar a validade do mantimento!',
			)
		)
	);

	/**
	 * Relacionamento 1 para 1
	 * 
	 * @var		array
	 * @access	public
	 */
	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => 'Usuario.id, Usuario.nome'
		)
	);

	/**
	 * Relacionamento 1 para n
	 */
	public $hasAndBelongsToMany	= array
	(
		'Cesta' => array
		(
			'className'		=> 'Cesta',
			'joinTable'		=> 'mantimentos_cestas',
			'associationForeignKey' => 'cesta_id',
			'foreignKey'	=> 'mantimento_id',
			'unique'		=> true,
			'fields' 		=> 'Cesta.id, Cesta.quantidade'
		),
	);

}
?>
