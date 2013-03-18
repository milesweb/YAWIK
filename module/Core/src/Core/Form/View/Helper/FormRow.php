<?php

namespace Core\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow as BaseFormRow;

class FormRow extends BaseFormRow
{
    
    public function render(ElementInterface $element)
    {
        if (!$element->hasAttribute('title') && $element->getLabel()) {
            $element->setAttribute('title', $this->view->translate($element->getLabel()));
        }
        $markup = parent::render($element);
        
        while (preg_match('~<fieldset><legend>(.*?)</legend>(.*?)</fieldset>~s', $markup, $match)) {
            $markup = str_replace(
                $match[0], 
                '<div class="label">' . $match[1] . '</div>' . $match[2],
                $markup
            );
        }
        
        return $markup;
                
    }
}
