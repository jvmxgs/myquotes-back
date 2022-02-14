<?php

namespace App\Jobs;

use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveDailyQuouteOfEachQuoteService implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $quoteService = new QuoteService();

        $quotes = $quoteService->getRandomQuoteOfEachService();

        $quotes = $this->addTimeStamps($quotes);

        Quote::insert($quotes);
    }

    /**
     * Add timestamps to quotes array
     *
     * @param array $quotes
     * @return array
     */
    private function addTimeStamps($quotes)
    {
        return collect($quotes)->map(function ($quote) {
            $quote['created_at'] = now();
            $quote['updated_at'] = now();

            return $quote;
        })->toArray();
    }
}
