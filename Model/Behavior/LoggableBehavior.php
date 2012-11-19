<?php
class LoggableBehavior extends ModelBehavior {

	public $settings = array('nameField' => 'name', 'descriptionField' => 'description', 'actionDescription' => 'Activity by', 'userField' => 'user_id', 'parentForeignKey' => 'foreign_key');
	
/**
 * Setup 
 * 
 * @param Model $Model
 * @param array $settings
 */
	public function setup(Model $Model, $settings = array()) {
		$this->settings = array_merge($this->settings, $settings);
	}
	
/**
 * After Save Callback
 * 
 * By default, adding the Loggable behavior will log when a record is created only.
 * 
 * @param Model $Model
 * @param bool $created
 */
	public function afterSave(Model $Model, $created) {
		if ($created) {
			$this->triggerLog($Model);
		}
	}
    
/**
 * Trigger Log method
 * 
 * Create an activity easily by attaching this behavior, and using $this->Model->triggerLog($this, array());
 * 
 * @param Model $Model
 * @param array $settings
 */
	public function triggerLog(Model $Model, $settings = array()) {
		$settings = !empty($settings) ? array_merge($this->settings, $settings) : $this->settings;
        
		$data['Activity']['name'] = !empty($Model->data[$Model->alias][$settings['nameField']]) ? $Model->data[$Model->alias][$settings['nameField']] : 'null';
        $data['Activity']['description'] = !empty($Model->data[$Model->alias][$settings['descriptionField']]) ? $Model->data[$Model->alias][$settings['descriptionField']] : null;
        $data['Activity']['model'] = $Model->alias;
        $data['Activity']['foreign_key'] = $Model->id;
        $data['Activity']['parent_foreign_key'] = !empty($Model->data[$Model->alias][$settings['parentForeignKey']]) ? $Model->data[$Model->alias][$settings['parentForeignKey']] : null;
        $data['Activity']['action_description'] = !empty($settings['actionDescription']) ? $settings['actionDescription'] : null;
        $data['Activity']['user_id'] = !empty($Model->data[$Model->alias][$settings['userField']]) ? $Model->data[$Model->alias][$settings['userField']] : null;
        $Activity = ClassRegistry::init('Activity');
        $Activity->create();
        $Activity->save($data);		
	}

}