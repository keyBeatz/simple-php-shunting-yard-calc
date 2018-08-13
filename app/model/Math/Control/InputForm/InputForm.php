<?php

namespace App\Model\Math\Control\InputForm;

use Nette;
use Nette\Application\UI\Form;


class InputForm extends Form
{
    function __construct(Nette\ComponentModel\IContainer $parent = null, $name = null)
    {
        parent::__construct($parent, $name);
        $this->addTextArea('input', 'Value');
        $this->addSubmit('submit', 'Submit Value');
    }
}