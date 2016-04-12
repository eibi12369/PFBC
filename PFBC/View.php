<?php
namespace PFBC;

abstract class View extends Base {
	protected $_form;
	protected $_fieldset;

	public function __construct(array $properties = null) {
		$this->configure($properties);
	}

	public function _setForm(Form $form) {
		$this->_form = $form;
	}

    public function _setFieldset(Fieldset $fieldset) {
        $this->_fieldset = $fieldset;
    }

	/*jQuery is used to apply css entries to the last element.*/
	public function jQueryDocumentReady() {}	

	public function render() {}

	public function renderCSS() {
		//echo 'label span.required { color: #B94A48; }';
		echo 'span.help-inline, span.help-block { color: #888; font-size: .9em; font-style: italic; }';
	}	

	protected function renderDescriptions($element) {
		$shortDesc = $element->getShortDesc();
		if(!empty($shortDesc))
			echo '<span class="help-inline">', $shortDesc, '</span>';;

        $withError = $element->hasAttribute('required');
        $class = '';
        if($withError) {
            $class = 'with-error';
        }

		$longDesc = $element->getLongDesc();
		if(!empty($longDesc) || $withError)
			echo '<div class="help-block ', $class, '">', $longDesc, '</div>';;
	}

	public function renderJS() {}

	protected function renderLabel(Element $element) {}
}
