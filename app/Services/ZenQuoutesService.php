<?php

namespace App\Services;

use App\Abstracts\QuoteService;

class ZenQuoutesService extends QuoteService
{
    public function __construct()
    {
        $this->service_url = config('services.zen_qoutes.url');
        $this->service_random_single_url = config('services.zen_qoutes.random_single_url');
    }

    protected function formatQuotes($quotes)
    {
        return collect($quotes)->map(function ($quote) {
            return [
                "author" => $quote['a'],
                "quote" => $quote['q']
            ];
        });
    }
}
