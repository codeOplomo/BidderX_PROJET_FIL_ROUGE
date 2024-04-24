<?php

namespace App\Console\Commands;

use App\Models\Auction;
use Illuminate\Console\Command;

class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired auctions...');

        // Fetch auctions that have ended and don't have a winner assigned
        $endedAuctions = Auction::where('end_time', '<=', now())
            ->whereNull('winner_id')
            ->whereNotNull('current_bid_price')
            ->get();

        foreach ($endedAuctions as $auction) {
            // Find the highest bid for each auction
            $highestBid = $auction->bids()->orderByDesc('amount')->first();

            if ($highestBid) {
                // Set the highest bidder as the winner
                $auction->winner_id = $highestBid->user_id;
                $auction->save();

                $this->info('Auction ' . $auction->id . ' has ended. Winner: ' . $highestBid->user_id);
            } else {
                $this->info('Auction ' . $auction->id . ' has ended with no bids.');
            }
        }

        $this->info('Expired auctions processed successfully.');
    }

}
