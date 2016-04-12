<?php
namespace PFBC\View;

class SideBySide extends \PFBC\View {
	protected $class = "form-horizontal";

	public function render() {
		$this->_form->appendAttribute("class", $this->class);

		echo '<form', $this->_form->getAttributes(), '><fieldset', $this->_fieldset->getAttributes(), '>';
		$this->_form->getErrorView()->render();

		$elements = $this->_form->getElements();
		$elementSize = sizeof($elements);
		$elementCount = 0;
		for($e = 0; $e < $elementSize; ++$e) {
			$element = $elements[$e];

			if($element instanceof \PFBC\Element\Hidden || $element instanceof \PFBC\Element\HTML)
				$element->render();
            elseif($element instanceof \PFBC\Element\Button) {
                if($e == 0 || !$elements[($e - 1)] instanceof \PFBC\Element\Button)
					echo '<div class="form-actions col-sm-offset-3 col-sm-9">';
				else
					echo ' ';
				
				$element->render();

                if(($e + 1) == $elementSize || !$elements[($e + 1)] instanceof \PFBC\Element\Button)
                    echo $this->_form->renderSubmitMessage(), '</div>';
            }
            else {
				echo '<div class="form-group">', $this->renderLabel($element), '<div class="col-sm-9">', $element->render(), $this->renderDescriptions($element), '</div></div>';
				++$elementCount;
			}
		}

		echo '</fieldset> </form>';
    }

	protected function renderLabel(\PFBC\Element $element) {
        $label = $element->getLabel();

        if(!empty($label) || true) {
			echo '<label class="control-label col-sm-3" for="', $element->getAttribute("id"), '">';
			if($element->isRequired())
				echo '<span class="required">* </span>';
			echo $label, '</label>'; 
        }
    }
}
