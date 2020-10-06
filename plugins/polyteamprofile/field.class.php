<?php

require_once("polyteamprofile.class.php");

class profile_field_polyteamprofile extends profile_field_base {
	public function display_data() {
		$data = json_decode($this->data);
		$fields = $this->get_fields();

		$html = "";

		foreach($fields as $field) {
			if ($field->hidden) continue;
			$stringify = $field->stringify;
			$value = isset($data->{$field->name}) ? $stringify($data->{$field->name}) : "";
			$name = get_string($field->name, 'profilefield_polyteamprofile');
			$help = $this->get_help_section($field->name);
			$html .= $help . "<h6>" . $name . " : " . $value . "</h6><br/>";
		}

		return $html;
	 }

	public function edit_field_add($mform) {
		$fields = $this->get_fields();

		foreach($fields as $field) {
			if (!$field->editable) continue;

			$mform->addElement(
				'text',
				'profile_field_'.$field->name,
				ucfirst($field->name)
			);

			$mform->setType('profile_field_'.$field->name, $field->type);
		}
	}

	public function edit_save_data($usernew) { 
		$fields = $this->get_fields();
		$input = isset($usernew->{$this->inputname}) ? json_decode($usernew->{$this->inputname}) : new stdclass;

		foreach($fields as $field) {
			$attr = 'profile_field_'.$field->name;

			if (isset($usernew->{$attr})) {
				$input->{$field->name} = $usernew->{$attr};
				unset($usernew->{$attr});
			}
		}

		$usernew->{$this->inputname} = json_encode($input);

		parent::edit_save_data($usernew);
	}
   
	private function get_fields() {
		$profile = new PolyteamProfile();
		return $profile->fields;
	}

	private function get_help_section($name) {
		$content = get_string($name . ":help:content", 'profilefield_polyteamprofile');
		$label = get_string($name . ":help:label", 'profilefield_polyteamprofile');

		return "
		<span class='float-sm-right text-nowrap'>
		<a class='btn btn-link p-0' role='button' data-container='body' data-toggle='popover' data-placement='right' data-content='<div class=&quot;no-overflow&quot;><p>". $content ."</p></div> ' data-html='true' tabindex='0' data-trigger='focus'>
			<i class='icon fa fa-question-circle text-info fa-fw' title='". $label ."' aria-label='". $label ."'></i>
		</a>
		</span>";
	}
}