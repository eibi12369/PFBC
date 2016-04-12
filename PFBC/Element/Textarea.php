<?php
namespace PFBC\Element;

class Textarea extends \PFBC\Element {
	protected $_attributes = array("rows" => "5");

	public function render() {
		$this->appendAttribute("class", "form-control");
		
        echo "<textarea", $this->getAttributes("value"), ">";
        if(!empty($this->_attributes["value"]))
            echo $this->filter($this->_attributes["value"]);
        echo "</textarea>";
    }
}
