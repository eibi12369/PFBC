<?php
namespace PFBC\View;

class Vertical extends \PFBC\View {
	public function render() {
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
                    echo '<div class="form-actions">';
				else
					echo ' ';
                $element->render();
                if(($e + 1) == $elementSize || !$elements[($e + 1)] instanceof \PFBC\Element\Button)
                    echo $this->_form->renderSubmitMessage(), '</div>';
            }
            else {
                echo '<div class="form-group">', $this->renderLabel($element), $element->render(), $this->renderDescriptions($element), '</div>';
                ++$elementCount;
            }
        }

		echo '</fieldset> </form>';
    }

	protected function renderLabel(\PFBC\Element $element) {
        $label = $element->getLabel();

        if(!empty($label)) {
            echo '<label for="', $element->getAttribute("id"), '">';
			if($element->isRequired())
				echo '<span class="required">* </span>';
			echo $label;	
        }
		echo '</label>'; 
    }
}	
