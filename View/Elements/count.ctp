<?php
/**
 * display the number of occurences of $type for $model $foreignKey
 */
$ActivityHelper = $this->Helpers->load('Activities.Activity', $___dataForView);
$count = $ActivityHelper->find('count', array(
	'conditions' => array(
		'activity_type' => $type,
		'model' => $model,
		'foreign_key' => $foreignKey
	)
));
echo $count;
