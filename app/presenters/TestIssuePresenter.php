<?php

namespace App\Presenters;

use App\Model\Math\Control\CalcControl\ICalcControlFactory;


class TestIssuePresenter extends RestrictedBasePresenter
{
    /**
     * @var ICalcControlFactory
     */
    private $mathControlFactory;

    /**
     * TestIssuePresenter constructor.
     *
     * @param ICalcControlFactory $mathControlFactory
     */
    function __construct(
        ICalcControlFactory $mathControlFactory
    ) {
        $this->mathControlFactory = $mathControlFactory;
    }

    public function createComponentCalc()
    {
        return $this->mathControlFactory->create();
    }
}
