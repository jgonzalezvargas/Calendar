<?php
defined('MOODLE_INTERNAL') || die();
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir . "/formslib.php");


class calendario2_crear_form extends moodleform {
	public function definition() {
		global $DB, $CFG;

		$mform = $this->_form;

	//	$user = $this->id.USER;
		
		
		$mform->addElement("text", "evento", "evento");
		$mform->setType( "evento", PARAM_TEXT);
		$mform->addElement("text", "descripcion", "descripcion");
		$mform->setType( "descripcion", PARAM_TEXT);
		$mform->addElement("date_selector", "fecha", "fecha");
		$mform->setType( "fecha", PARAM_INT);
		
		$mform->addElement("hidden", "action", "add");
		
		$this->add_action_buttons(true, 'Agregar Evento');
	}
	
	public function validation($data, $files){
		$errors = array();
		
		$evento = $data["evento"];
		$descripcion = $data["descripcion"];
		$fecha = $data["fecha"];
		
		if(empty($evento)){
			$errors["evento"] = "Debe ponerle nombre a su evento";
		}
		
		if(empty($descripcion)){
			$errors["descripcion"] = "De que se trata su evento?";
		}
		
		$today = time();
		if ($today > $fecha){
			$errors["fecha"] = "Debe seleccionar una fecha";
			
		}
		
		return $errors;
		
	}
}