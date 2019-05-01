<?php

namespace App\Model\Math\Control\CalcControl;

use App\Model\Math\Control\InputForm\IInputFormFactory;
use App\Model\Math\Calc;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Database\Connection;

class CalcControl extends Control
{
    /**
     * @var IInputFormFactory
     */
    private $inputFormFactory;

    /**
     * CalcControl constructor.
     *
     * @param IInputFormFactory $inputFormFactory
     */
    function __construct(
        IInputFormFactory $inputFormFactory
    ) {
        $this->inputFormFactory = $inputFormFactory;
    }

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/template/input.latte');
        $template->render();
    }

    public function renderOutput()
    {
        $inputValue = $this->getInputValue();

        $template = $this->template;
        $output   = null;
        if ($inputValue) {
            try {
                $output = Calc::calc($inputValue);
            } catch (\Exception $e) {
                $output = "There is an error in your input";
            }
        }
        $template->output = $output;
        $template->setFile(__DIR__ . '/template/output.latte');
        $template->render();
    }

    public function renderTest() {
        $this->template->render(__DIR__ . '/template/test.latte');
    }

    public function createComponentInputForm()
    {
        $form = $this->inputFormFactory->create();

        $form->setDefaults([
            'input' => $this->getInputValue(),
        ]);

        $form->onSubmit[] = [$this, 'onSubmit'];

        return $form;
    }

    public function onSubmit(Form $form)
    {
        $values = $form->getValues();
        if ($values->input) {
            $this->getPresenter()->redirect('this', ['value' => $values->input]);
        } else {
            $form->addError('Value is empty');
        }
    }

    private function getInputValue()
    {
        return $this->getPresenter()->getParameter('value');
    }
}
