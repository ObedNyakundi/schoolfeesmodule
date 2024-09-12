<?php

namespace App\Http\Controllers;

use App\Models\FeePayment;
use Illuminate\Http\Request;
/*
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
*/
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    public function invoice($payment){
    
    //finding the payment
    $payment = FeePayment::findorfail($payment);

    $client = new Party([
        'name'          => 'Roosevelt Lloyd',
        'phone'         => '(520) 318-9486',
        'custom_fields' => [
            'note'        => 'IDDQD',
            'business id' => '365#GG',
        ],
    ]);

        $customer = new Party([
            'name'          => 'Ashley Medina',
            'address'       => 'The Green Street 12',
            'code'          => '#22663214',
            'custom_fields' => [
                'order number' => '> 654321 <',
            ],
        ]);

        $items = [
            InvoiceItem::make('Service 1')
                ->description('Your product or service description')
                ->pricePerUnit(47.79)
                ->quantity(2)
                ->discount(10),
            InvoiceItem::make('Service 2')->pricePerUnit(71.96)->quantity(2),
            InvoiceItem::make('Service 3')->pricePerUnit(4.56),
            InvoiceItem::make('Service 4')->pricePerUnit(87.51)->quantity(7)->discount(4)->units('kg'),
            InvoiceItem::make('Service 5')->pricePerUnit(71.09)->quantity(7)->discountByPercent(9),
            InvoiceItem::make('Service 6')->pricePerUnit(76.32)->quantity(9),
            InvoiceItem::make('Service 7')->pricePerUnit(58.18)->quantity(3)->discount(3),
            InvoiceItem::make('Service 8')->pricePerUnit(42.99)->quantity(4)->discountByPercent(3),
            InvoiceItem::make('Service 9')->pricePerUnit(33.24)->quantity(6)->units('m2'),
            InvoiceItem::make('Service 11')->pricePerUnit(97.45)->quantity(2),
            InvoiceItem::make('Service 12')->pricePerUnit(92.82),
            InvoiceItem::make('Service 13')->pricePerUnit(12.98),
            InvoiceItem::make('Service 14')->pricePerUnit(160)->units('hours'),
            InvoiceItem::make('Service 15')->pricePerUnit(62.21)->discountByPercent(5),
            InvoiceItem::make('Service 16')->pricePerUnit(2.80),
            InvoiceItem::make('Service 17')->pricePerUnit(56.21),
            InvoiceItem::make('Service 18')->pricePerUnit(66.81)->discountByPercent(8),
            InvoiceItem::make('Service 19')->pricePerUnit(76.37),
            InvoiceItem::make('Service 20')->pricePerUnit(55.80),
        ];

        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('receipt')
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('KES ')
            ->currencyCode('KES')
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
