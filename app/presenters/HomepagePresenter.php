<?php

namespace App\Presenters;


class HomepagePresenter extends BasePresenter
{
    public function actionDefault()
    {
        $this->redirect('TestIssue:');
    }
}
