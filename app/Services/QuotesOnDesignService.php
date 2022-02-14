<?php

namespace App\Services;

use App\Abstracts\QuoteService;

class QuotesOnDesignService extends QuoteService
{
    public function __construct()
    {
        $this->service_url = config('services.quotes_on_design.url');
    }

    protected function formatQuotes($quotes)
    {
        return collect($quotes)->map(function ($quote) {
            return [
                "author" => $quote['title']['rendered'],
                "quote" => $quote['content']['rendered']
            ];
        })->toArray();
    }

    public function getRandomQuote()
    {
        $quotes = $this->getQuotes();
        return $quotes[array_rand($quotes->toArray())];
    }
}
