<?php

namespace App\Presenters;


use App\Forms\SignInFormFactory;

class SignInPresenter extends BasePresenter
{
    /**
     * @var SignInFormFactory
     */
    private $signInFormFactory;

    function __construct(
        SignInFormFactory $signInFormFactory
    ) {
        $this->signInFormFactory = $signInFormFactory;
    }

    public function actionDefault()
    {
    }

    public function createComponentSignInForm() {
        $form = $this->signInFormFactory->create(function () {
            $this->redirect('Homepage:');
        }, function () {
            $this->redirect('SignUp:');
        });
        return $form;
    }
}
