<br /><br />
<center>
<?php echo $this->Form->create(null,array('url'=>Router::url('/',true).'ferramentas')); ?>
	
<?php echo $this->Form->input('tipo',array('id'=>'tipo','type'=>'hidden')); ?>

<p>
	Clique aqui para Executar a instalação da aplicação exemplo.<br />
	Os arquivos devem estar no diretório "APP/docs".<br />
</p>
<?php echo $this->Form->button('Instalar Aplicação exemplo',array('onclick'=>'$(\'#tipo\').val(\'instalarApp\'); ','style'=>'width: 400px;')); ?>

<p>Clique aqui para resetar todo o cache.</p>
<?php echo $this->Form->button('Limpar Cache',array('onclick'=>'$(\'#tipo\').val(\'limparCache\'); ','style'=>'width: 400px;')); ?>

<?php echo $this->Form->end(); ?>
<br />
<br />
<br />
<div id='msg' style='color: green; font-weight: bold;;'>
<?php if (isset($msg)) echo $msg; $this->Visao->setOnReadView('setTimeout(function(){ $("#msg").fadeOut(4000); },3000);'); ?>
</div>

</center>
