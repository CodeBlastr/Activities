<?php
class LoggableBehavior extends ModelBehavior {

	var $model = '';
	var $foreignKey = '';
	var $userData = array();
	var $settings = array('nameField' => 'name', 'descriptionField' => 'description', 'actionDescription' => 'Activity by', 'userField' => 'user_id', 'parentForeignKey' => 'foreign_key');
	

	function setup(&$model, $settings = array()) {
		$this->settings = array_merge($this->settings, $settings);
	}
	
	/**
	 * Callback used to save a log of activities for the respective object.
	 */
	function afterSave(&$model, $created) {
		if ($created) :
			$data['Activity']['name'] = $model->data[$model->alias][$this->settings['nameField']];
			$data['Activity']['description'] = $model->data[$model->alias][$this->settings['descriptionField']];
			$data['Activity']['model'] = $model->alias;
			$data['Activity']['foreign_key'] = $model->id;
			$data['Activity']['parent_foreign_key'] = $model->data[$model->alias][$this->settings['parentForeignKey']];
			$data['Activity']['action_description'] = $this->settings['actionDescription'];
			$data['Activity']['user_id'] = $model->data[$model->alias][$this->settings['userField']];
			$Activity = ClassRegistry::init('Activity');
			$Activity->save($data);
		endif;
	}
	
	
	
}
?>