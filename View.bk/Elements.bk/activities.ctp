<?php
/**
 * Activities Element 
 *
 * Used to display a list of activities for a given object.
 *
 * PHP versions 5
 *
 * Zuha(tm) : Business Management Applications (http://zuha.com)
 * Copyright 2009-2010, Zuha Foundation Inc. (http://zuha.org)
 *
 * Licensed under GPL v3 License
 * Must retain the above copyright notice and release modifications publicly.
 *
 * @copyright     Copyright 2009-2010, Zuha Foundation Inc. (http://zuha.com)
 * @link          http://zuha.com Zuha™ Project
 * @package       zuha
 * @subpackage    zuha.app.plugins.forms.views.elements
 * @since         Zuha(tm) v 0.0.1
 * @license       GPL v3 License (http://www.gnu.org/licenses/gpl.html) and Future Versions
 */
	# this should be at the top of every element created with format __ELEMENT_PLUGIN_ELEMENTNAME_instanceNumber.
 	# it allows a database driven way of configuring elements, and having multiple instances of that configuration.
	if(!empty($instance) && defined('__ELEMENT_ACTIVITIES_ACTIVITIES_'.$instance)) {
		extract(unserialize(constant('__ELEMENT_ACTIVITIES_ACTIVITIES_'.$instance)));
	} else if (defined('__ELEMENT_ACTIVITIES_ACTIVITIES')) {
		extract(unserialize(__ELEMENT_ACTIVITIES_ACTIVITIES));
	}
	
	# set up defaults
	#$var = !empty($var) ? $var : 'var';
	$parentForeignKey = !empty($parentForeignKey) ? $parentForeignKey : null;
	$activities = $this->requestAction('activities/activities/index/' . $parentForeignKey);
	
	?>
    <ul class="activities">
    <?php
	foreach ($activities as $activity) :
		?>
        <li class="activity activity<?php echo $activity['Activity']['model']?>">
        	<span class="activityModel"><?php echo $activity['Activity']['model']?></span>
        	<span class="activityName"><?php echo $activity['Activity']['name']?></span>
        	<span class="activityDescription"><?php echo $this->Text->truncate(strip_tags($activity['Activity']['description']), 20, array('ending' => '...', 'exact' => false))?></span>
        	<span class="activityLabel"><?php echo $activity['Activity']['action_description']?></span>
        	<span class="activityUser"><?php echo $activity['User']['full_name']?></span>
        	<span class="activityUser"><?php echo $this->Time->niceShort($activity['User']['created'])?></span>
        </li>
    <?php
	endforeach;
	?>
    </ul>