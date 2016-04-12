<?php
namespace PFBC;

class Fieldset extends Base {
	protected $_attributes = array();
	protected $_form;

    public function _setForm(Form $form) {
        $this->_form = $form;
    }
}
