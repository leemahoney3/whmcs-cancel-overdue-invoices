# WHMCS Cancel Overdue Invoices Hook

A simple hook that automatically cancels invoices that are overdue by a defined amount of days.

To change the amount of days from the due date before the invoice should be cancelled, simply modify

```
$duration = 90;
```

(e.g. 90 days is the default as shown above)

The hook is set to run once a day on the daily cron, if you prefer it runs on the more regular cron (however long you've set it up to run, then change the bottom part of the code from

```
add_hook('DailyCronJob', 1, 'cancel_overdue_invoices');
```

To the following

```
add_hook('AfterCronJob', 1, 'cancel_overdue_invoices');
```

## Have a feature request?

Any ideas for it please let me know! I'm happy to implement anything that may benefit the module further. Email all feature requests to lee@leemahoney.dev

## Contributions

Feel free to fork the repo, make changes, then create a pull request!