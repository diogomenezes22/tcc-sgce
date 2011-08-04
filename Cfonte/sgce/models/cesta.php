<?php
/**
 * Model para as cestas
 *
 * @package		sgce
 * @subpackage	sgce.model
 */
/**
 * @package		sgce
 * @subpackage	sgce.model
 */
class Cesta extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'Cesta';

	/**
	 * Campo padrão do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $displayField 	= 'quantidade';

	/**
	 * Campo de ordenação padrão
	 * 
	 * @var		string
	 * @access	public
	 */
	public $order		 	= 'Cesta.quantidade';

	/**
	 * Regras de validação para cada campo do model
	 * 
	 * @var		array
	 * @access	public
	 */
	public $validate = array
	(
		'quantidade' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty',
				'required' 	=> true,
				'message' 	=> 'É necessário informar a quantidade de cestas!',
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
		),
	);

	/**
	 * Relacionamento 1 para n
	 */
	public $hasAndBelongsToMany	= array
	(
		'Mantimento' => array
		(
			'className'		=> 'Mantimento',
			'joinTable'		=> 'mantimentos_cestas',
			'associationForeignKey' => 'mantimento_id',
			'foreignKey'	=> 'cesta_id',
			'unique'		=> true,
			'fields' 		=> 'Mantimento.id, Mantimento.nome'
		),


		'Familia' => array
		(
			'className'		=> 'Familia',
			'joinTable'		=> 'cestas_familias',
			'associationForeignKey' => 'familia_id',
			'foreignKey'	=> 'cesta_id',
			'unique'		=> true,
			'fields' 		=> 'Familia.id, Familia.nome'
		),
	);

}
?>
