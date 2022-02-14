<?php

namespace App\Services;

use App\Abstracts\QuoteService;

class QuoteGardenService extends QuoteService
{
    public function __construct()
    {
        $this->service_url = config('services.quote_garden.url');
        $this->service_random_single_url = config('services.quote_garden.random_single_url');
    }

    protected function formatQuotes($quotes)
    {
        return collect($quotes['data'])->map(function ($quote) {
            return [
                "author" => $quote['quoteAuthor'],
                "quote" => $quote['quoteText']
            ];
        });
    }
}
