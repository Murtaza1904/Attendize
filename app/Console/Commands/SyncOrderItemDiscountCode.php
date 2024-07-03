<?php

namespace App\Console\Commands;

use App\EventDiscountCode;
use App\Models\OrderItem;
use Illuminate\Console\Command;

class SyncOrderItemDiscountCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:order-item-discount-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to sync the order item discount code';

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
     * @return void
     */
    public function handle(): void
    {
        $discountCodes = EventDiscountCode::where('usage', '>', 0)->orderBy('event_id')->get(['event_id', 'code', 'usage']);
        $lastUsedDiscountCode = null;
    
        foreach (OrderItem::where('discount', '>', 0)->with('order')->get() as $orderItem) {
            $eventId = $orderItem->order->event_id;
            $discountCodeAssigned = false;
    
            foreach ($discountCodes as $index => $currentDiscountCode) {
                if ($eventId == $currentDiscountCode->event_id && $currentDiscountCode->usage > 0) {
                    // Assign the current discount code to the order item
                    $orderItem->update(['discount_code' => $currentDiscountCode->code]);    
                    // Decrement the usage of the current discount code
                    $currentDiscountCode->usage--;
    
                    // Mark this discount code as the last used one
                    $lastUsedDiscountCode = $currentDiscountCode;
    
                    // Indicate that a discount code was assigned
                    $discountCodeAssigned = true;
                    break;
                }
            }
    
            // If no matching discount code was found, use the last used discount code
            if (!$discountCodeAssigned && $lastUsedDiscountCode) {
                $orderItem->update(['discount_code' => $lastUsedDiscountCode->code]);
            }
        }
    
        $this->info('Sync successfully!');
    }       
}
