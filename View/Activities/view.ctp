<div class="well well-large pull-right last span3">
	<span class="label label-info"><?php echo !empty($activity['Activity']['created']) ? $activity['Activity']['created'] : 'Undated'; ?> </span>
</div>

<div class="activities view">
	<?php
	echo $activity['Activity']['description'];  ?>

</div>


        
<?php
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Activities',
		'items' => array(
			$this->Html->link(__('Related %s', $activity['Activity']['model']), array('plugin' => Inflector::tableize(ZuhaInflector::pluginize($activity['Activity']['model'])), 'controller' => Inflector::tableize($activity['Activity']['model']), 'action' => 'view', $activity['Activity']['foreign_key'])),
			$this->Html->link(__('Edit'), array('plugin' => 'activities', 'controller' => 'activities', 'action' => 'edit', $activity['Activity']['id'])),
			),
		),
	))); ?>
