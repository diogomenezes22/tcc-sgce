<?php
/**
 * Model para os equipamentos sociais
 *
 * @package		sgce
 * @subpackage	sgce.model
 */
/**
 * @package		sgce
 * @subpackage	sgce.model
 */
class EquipamentoSocial extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'EquipamentoSocial';

	/**
	 * Campo padrão do model
	 * 
	 * @var		string
	 * @access	public
	 */
//	public $displayField 	= 'XXX';

	/**
	 * Campo de ordenação padrão
	 * 
	 * @var		string
	 * @access	public
	 */
//	public $order		 	= 'EquipamentoSocial.XXX';



	/**
	 * Relacionamento 1 para 1
	 * 
	 * @var		array
	 * @access	public
	 */
	public $belongsTo = array(
		'Questionario' => array(
			'className' => 'Questionario',
			'foreignKey' => 'questionario_id',
			'conditions' => '',
			'fields' => 'Questionario.id'
		)
	);

}
?>
