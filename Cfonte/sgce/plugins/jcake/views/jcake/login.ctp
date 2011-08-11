<?php echo $this->Html->css('principal'); ?>
<?php echo $this->Visao->setOnReadView('$("#'.$this->Form->domId('loginLogin').'").focus();'); ?>
<div id='login'>
	<?php echo $this->Form->create('login',array('url'=>'login')); ?>
	<div id='campos'>
		<?php echo $this->Form->input('login',array('type'=>'text')); ?>
		<?php echo $this->Form->input('senha',array('type'=>'password')); ?>
	</div>
	<div id='botao'><?php echo $this->Form->end('Enviar'); ?></div>
</div>
<div id='msg'><?php if (isset($msg)) echo $msg; ?></div>
