<?php

namespace App\Services;

class QuoteService
{
    public function getRandomQuoteOfEachService()
    {
        $quoteGardenService = new QuoteGardenService();
        $quotesOnDesignService = new QuotesOnDesignService();
        $stoicQuouteService = new StoicQuouteService();
        $zenQuoutesService = new ZenQuoutesService();

        return [
            $quoteGardenService->getRandomQuote(),
            $quotesOnDesignService->getRandomQuote(),
            $stoicQuouteService->getRandomQuote(),
            $zenQuoutesService->getRandomQuote()
        ];
    }
}
