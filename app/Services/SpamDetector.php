<?php

namespace App\Services;

use App\Models\Filter;
use App\Events\SpamDetected;
use App\Factories\FilterFactory;
use App\Exceptions\FilterDoesNotExist;
use Illuminate\Contracts\Events\Dispatcher;

class SpamDetector
{
    private Filter $filterDb;
    private FilterFactory $filterFactory;
    private Dispatcher $dispatcher;

    public function __construct(
        Filter $filterDb, 
        FilterFactory $filterFactory,
        Dispatcher $dispatcher
    )
    {
        $this->filterDb = $filterDb;
        $this->filterFactory = $filterFactory;
        $this->dispatcher = $dispatcher;
    }

    public function detect(string $string)
    {
        $filterNames = $this->getEnabledFilterNames();

        foreach($filterNames as $filterName) {
            $filter = $this->filterFactory->make($filterName);

            if($filter->passes($string) === false) {
                $this->dispatcher->dispatch(
                    new SpamDetected($string, $_SERVER['REMOTE_ADDR'])
                );

                return true;
            }
        }

        return false;
    }

    protected function getEnabledFilterNames()
    {
        return $this->filterDb->active()->get();
    }
}