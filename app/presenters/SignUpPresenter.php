<?php

namespace App\Presenters;

use App\Forms\SignUpFormFactory;

class SignUpPresenter extends BasePresenter
{
    /**
     * @var SignUpFormFactory
     */
    private $signUpFormFactory;

    function __construct(
        SignUpFormFactory $signUpFormFactory
    ) {
        $this->signUpFormFactory = $signUpFormFactory;
    }

    public function actionDefault()
    {
    }

    public function createComponentSignUpForm()
    {
        $form = $this->signUpFormFactory->create(function () {;
            $this->flashMessage('User has been created. Now you can sign in.', 'success');
            $this->redirect('SignIn:default');
        });
        return $form;
    }
}
