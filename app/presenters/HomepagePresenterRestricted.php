<?php

namespace App\Presenters;


class HomepagePresenter extends RestrictedBasePresenter
{
    public function actionDefault()
    {
        $this->redirect('TestIssue:');
    }
}
