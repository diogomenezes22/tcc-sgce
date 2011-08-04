<?php
/**
 * Model para as doenças
 *
 * @package		sgce
 * @subpackage	sgce.model
 */
/**
 * @package		sgce
 * @subpackage	sgce.model
 */
class Doenca extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'Doenca';

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
//	public $order		 	= 'Doenca.XXX';



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
