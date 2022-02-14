<?php

namespace App\Abstracts;

abstract class QuoteService {

    abstract protected function formatQuotes($quotes);
    protected $service_url;
    protected $service_random_single_url;

    public function getQuotes()
    {
        $quotes = $this->getQuotesFromUrl($this->service_url);

        return $this->clearQuotes($quotes);
    }

    public function getRandomQuote()
    {
        $quotes = $this->getQuotesFromUrl($this->service_random_single_url);

        return $this->clearQuotes($quotes)->first();
    }

    private function getQuotesFromUrl($url)
    {
        $httpClient = new \GuzzleHttp\Client();
        $request = $httpClient
            ->get($url);

        return json_decode($request->getBody()->getContents(), true);
    }

    private function clearQuotes($quotes) {
        return collect($this->formatQuotes($quotes))->map(function ($quote) {
            return [
                'author' => $quote['author'],
                'quote' => html_entity_decode(strip_tags($quote['quote']), ENT_QUOTES, "UTF-8")
            ];
        });
    }
}
