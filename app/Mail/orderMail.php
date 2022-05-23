<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class orderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        
        $order = Order::with('division', 'district', 'state')->where('id', $data['order_id'] )->where('user_id', Auth::user()->id )->first();
        $orderItems = OrderItem::with('product')->where('order_id', $data['order_id'] )->get();        
        $pdf = \PDF::loadView('user.order.invoice', compact('order','orderItems'));
        
        return $this->from(config('mail.from.address'), $data['appName'].' -New Order')
                ->view('mail.orderMail', compact('data'))
                ->subject('Invoice #'.$order['invoice_no'] )
                ->attachData($pdf->output(), $data['invoice_no'], [
                    'mime' => 'application/pdf',
                ]);
                
    }
}
