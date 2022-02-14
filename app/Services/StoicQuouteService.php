<?php

namespace App\Services;

use App\Abstracts\QuoteService;

class StoicQuouteService extends QuoteService
{
    public function __construct()
    {
        $this->service_url = config('services.stoic_quoute.url');
        $this->service_random_single_url = config('services.stoic_quoute.random_single_url');
    }

    protected function formatQuotes($quotes)
    {
        return collect([$quotes['data']]);
    }
}
