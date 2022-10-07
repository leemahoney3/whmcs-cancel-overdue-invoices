<?php

use WHMCS\Billing\Invoice;

/**
 * Cancel Overdue Invoices Hook
 *
 * A helper that automatically cancels invoices that are overdue by a defined amount of days.
 * 
 * You can define the duration (in days) before invoices are cancelled below.
 *
 * @package    WHMCS
 * @author     Lee Mahoney <lee@leemahoney.dev>
 * @copyright  Copyright (c) Lee Mahoney 2022
 * @license    MIT License
 * @version    1.0.2
 * @link       https://leemahoney.dev
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function cancel_overdue_invoices($vars) {

    # How many days after an invoice's due date it should be cancelled.
    $duration = 90;

    # Get all invoices that are unpaid and meet the criteria
    $invoices = Invoice::where('status', 'Unpaid')->where('duedate', '<=', date('Y-m-d', strtotime("-{$duration} days")))->get();

    # Loop through the invoices
    foreach ($invoices as $invoice) {

        # Update their statuses
        Invoice::where('id', $invoice->id)->update([
            'status' => 'Cancelled'
        ]);

    }

}

add_hook('DailyCronJob', 1, 'cancel_overdue_invoices');

//add_hook('AfterCronJob', 1, 'cancel_overdue_invoices');
