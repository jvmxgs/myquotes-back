<?php

namespace App\Console\Commands;

use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Console\Command;

class GetQuotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quoteService = new QuoteService();

        $quotes = $quoteService->getRandomQuoteOfEachService();

        $quotes = $this->addTimeStamps($quotes);

        Quote::insert($quotes);
    }

    private function addTimeStamps($quotes)
    {
        return collect($quotes)->map(function ($quote) {
            $quote['created_at'] = now();
            $quote['updated_at'] = now();

            return $quote;
        })->toArray();
    }
}
