<?php

namespace App\Http\Controllers;

use App\Models\FeePayment;
use Illuminate\Http\Request;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    public function invoice($payment){
    
    //finding the payment
    $payment = FeePayment::findorfail($payment);

    $client = new Party([
        'name'          => config('app.name'),
        'phone'         => '(254) 706-748162',
        'custom_fields' => [
            'You were served by'  => $payment->users->name.'.',
        ],
    ]);

        $customer = new Party([
            'name'          => $payment->student->name,
            'custom_fields' => [
                'Student Class' => $payment->student->stream->name,
            ],
        ]);

        $items = [
            InvoiceItem::make('Fee Payment')
                ->description('Paid as '.$payment->feestypes->name)
                ->pricePerUnit($payment->amount)
                ->quantity(1),
           
        ];

        $notes = [
            'This is a system-generated receipt.',
            'It is produced without any alterations.',
            'Any inquiries should be directed to our office.',
            'This System was developed and is maintained by the:'.config('app.name').' Team',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('receipt')
            ->series('SMS')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence($payment->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date($payment->created_at)
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('KSh. ')
            ->currencyCode('Kenyan Shillings')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('images/logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
