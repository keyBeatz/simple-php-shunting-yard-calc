<?php

namespace App\Presenters;

use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    public function startup()
    {
        parent::startup();
        $user = $this->getUser();
        if ($user && $user->isLoggedIn()) {
            $this->redirect('Homepage:');
        }
    }
}
