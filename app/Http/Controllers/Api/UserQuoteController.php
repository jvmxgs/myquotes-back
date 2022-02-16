<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserQuoteDeleteRequest;
use App\Http\Requests\UserQuoteStoreRequest;
use App\Http\Resources\QuoteCollection;
use App\Models\Quote;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserQuoteController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        try {
            $user->load('quotes');
            return $this->dataResponse('User quotes', new QuoteCollection($user->quotes));
        } catch(Exception $e) {
            return $this->errorResponse('Error trying to get user quotes', $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, UserQuoteStoreRequest $request)
    {
        try {
            $user->quotes()->sync($request->quote_id);

            return $this->successResponse('Quote saved');
        } catch(Exception $e) {
            return $this->errorResponse('Error trying to save quote', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UserQuoteDeleteRequest $request)
    {
        try {
            $user->quotes()->updateExistingPivot($request->quote_id, ['deleted_at' => now()]);

            return $this->successResponse('Quote deleted');
        } catch(Exception $e) {
            return $this->errorResponse('Error trying to delete quote', $e);
        }
    }

    public function export()
    {
        $fileName = 'quotes.txt';
        $pines = Quote::all();

        $headers = array(
            "Content-type"        => "text/plain",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('pin', 'tiempo');

        $callback = function() use($pines, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pines as $pin) {
                $row['pin']  = $pin->pin;
                $row['comment']    = $pin->comment;

                fputcsv($file, array($row['pin'], $row['comment']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

/*
* Schedules a cronjob to get one random quote of every provider daily.
* Users should be able to see a list of the latest quotes in the main page.
* Users should be able to store any of the displayed quotes in their account
* Users should be able to view all the quotes they have stored in the UI
* Users should be able to export all their quotes to a `.txt` file and send it to their email.
* Quotes should be stored in the cache to prevent calling the DB every time the main page is loaded.
* BONUS:
* The use of Vue/React for the UI.
* The use of TailwindCSS for the UI.
* DB Queries an optimization
*/
