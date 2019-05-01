<?php

namespace App\Presenters;

use App\Forms\FormFactory;
use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class RestrictedBasePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @var FormFactory
     */
    private $formFactory;

    public function startup()
    {
        parent::startup();
        $user = $this->getUser();
        if (!$user || !$user->isLoggedIn()) {
            $this->redirect('SignIn:');
        }
    }

    public function injectFormFactory(FormFactory $formFactory) {
        $this->formFactory = $formFactory;
    }

    protected function createComponentLogout() {
        $form = $this->formFactory->create();
        $form->addSubmit('logout', 'Logout');
        $form->onSubmit[] = function () {
            $user = $this->getUser();
            if ($user) {
                $user->logout(true);
                $this->redirect('SignIn:');
            }
        };
        return $form;
    }
}
