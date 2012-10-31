<?php
class LoggableBehavior extends ModelBehavior {

	public $model = '';
	public $foreignKey = '';
	public $userData = array();
	public $settings = array('nameField' => 'name', 'descriptionField' => 'description', 'actionDescription' => 'Activity by', 'userField' => 'user_id', 'parentForeignKey' => 'foreign_key');
	

	public function setup(&$model, $settings = array()) {
		$this->settings = array_merge($this->settings, $settings);
	}
	
/**
 * Callback used to save a log of activities for the respective object.
 */
	public function afterSave(&$model, $created) {
		if ($created) {
			$data['Activity']['name'] = !empty($model->data[$model->alias][$this->settings['nameField']]) ? $model->data[$model->alias][$this->settings['nameField']] : null;
			$data['Activity']['description'] = !empty($model->data[$model->alias][$this->settings['descriptionField']]) ? $model->data[$model->alias][$this->settings['descriptionField']] : null;
			$data['Activity']['model'] = $model->alias;
			$data['Activity']['foreign_key'] = $model->id;
			$data['Activity']['parent_foreign_key'] = !empty($model->data[$model->alias][$this->settings['parentForeignKey']]) ? $model->data[$model->alias][$this->settings['parentForeignKey']] : null;
			$data['Activity']['action_description'] = !empty($this->settings['actionDescription']) ? $this->settings['actionDescription'] : null;
			$data['Activity']['user_id'] = !empty($model->data[$model->alias][$this->settings['userField']]) ? $model->data[$model->alias][$this->settings['userField']] : null;
			$Activity = ClassRegistry::init('Activity');
			$Activity->create();
			$Activity->save($data);
		}
	}

}