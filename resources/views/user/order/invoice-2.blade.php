<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('invoice/template.css') }}">
  </head>
  <body>
    <div id="container">
      <section id="memo">
        <div class="logo">
          <img src="{{ url("frontend/assets/images/T-Shop-Logo.png") }}" />
        </div>
        
        <div class="company-info">
          <div>{{config('app.name')}}</div>

          <br />
          
          <span>227 Cobblestone Road</span>
          <span>30000 Bedrock, Cobblestone County</span>

          <br />
          
          <span>+555 7 789-1234</span>
          <span>{{config('app.url')}} | hello@tshop.com</span>
        </div>

      </section>

      <section id="invoice-title-number">
      
        <span id="title">INVOICE</span>
        <span id="number">#{{$order->invoice_no}}</span>
        
      </section>
      
      <div class="clearfix"></div>
      
      <section id="client-info">
        <span>SHIPPING TO:</span>
        <div>
          <span class="bold">{{ $order->name }}</span>
        </div>
        
        <div>
          <span>{{ $order->phone }}</span>
        </div>
        
        <div>
          <span>{{ $order->email }}</span>
        </div>
        
        <div>
          <span>{{ $order->state->state_name_en }}, {{ $order->district->district_name_en }}</span>
        </div>
        
        <div>
          <span>{{ $order->division->division_name_en }} - {{ $order->post_code }}</span>
        </div>
        
      </section>
      
      <div class="clearfix"></div>
      
      <section id="items">
        
        <table cellpadding="0" cellspacing="0">
        
          <tr>
            <th>THUMBNAIL</th> <!-- Dummy cell for the row number and row commands -->
            <th>NAME</th>
            <th>CODE</th>
            <th>COLOR</th>
            <th>SIZE</th>
            <th>PRICE</th>
            <th>QUANTITY</th>
            <th>LINE TOTAL</th>
          </tr>
          @php
          $subtotal = 0;
          @endphp
          @foreach($orderItems as $item)
          <tr data-iterate="item">
            <td><img src="{{ asset('uploads/product/thumbnail/') }}/{{$item->product->product_thumbnail}}" height="50px;" width="50px;" alt="imga"></td> <!-- Don't remove this column as it's needed for the row commands -->
            <td>{{$item->product->product_name_en}}</td>
            <td>{{$item->product->product_code}}</td>
            <td>{{$item->color}}</td>
            <td>{{$item->size}}</td>
            <td>{{$item->price}}</td>
            <td>{{ $item->qty }}</td>
            <td>৳{{ $item->price * $item->qty }}</td>
          </tr>
          @php
          $subtotal = $subtotal+($item->price * $item->qty);
          @endphp
          @endforeach
        </table>
        
      </section>
      
      <section id="sums">
      
        <table cellpadding="0" cellspacing="0">
          <tr>
            <th>Subtotal:</th>
            <td>৳{{ $subtotal }}</td>
          </tr>
          
          <tr data-iterate="tax">
            <th>Discount:</th>
            @if($order->coupon_discount)
            <td>{{$order->coupon_discount}}%</td>
            @else
            <td>0%</td>
            @endif
          </tr>
          
          <tr data-iterate="tax">
            <th>Discount Amount:</th>
            @if($order->discount_amount)
            <td>৳{{$order->discount_amount}}</td>
            @else
            <td>৳0.00</td>
            @endif
          </tr>
          
          <tr class="amount-total">
            <th>TOTAL:</th>
            @if($order->coupon_code)
            <td>৳{{$order->amount}}</td>
            @else
            <td>৳{{ $subtotal }}</td>
            @endif
          </tr>
          
          <!-- You can use attribute data-hide-on-quote="true" to hide specific information on quotes.
               For example Invoicebus doesn't need amount paid and amount due on quotes  -->
          <tr data-hide-on-quote="true">
            <th>Paid:</th>
            @if($order->payment_method == "Cash on Delivery")
            <td>$0.00</td>
            @else
                @if($order->coupon_code)
                <td>৳{{$order->amount}}</td>
                @else
                <td>৳{{ $subtotal }}</td>
                @endif
            @endif
          </tr>
          
          <tr data-hide-on-quote="true">
            <th>AMOUNT DUE:</th>
            @if($order->payment_method == "Cash on Delivery")
                @if($order->coupon_code)
                <td>৳{{$order->amount}}</td>
                @else
                <td>৳{{ $subtotal }}</td>
                @endif
            @else
            <td>৳0.00</td>
            @endif
          </tr>
          
        </table>

        <div class="clearfix"></div>
        
      </section>
      
      <div class="clearfix"></div>

      <section id="invoice-info">
        <div>
          <span class="bold">Issue Date: </span> <br/>
          <span>{{ $order->order_date }}</span>
        </div>

        <br/>
        <br/>

        <div>
            <span class="bold">BILL TO: </span> <br/>
          <div>{{Auth::user()->name}}</div>
          <div>{{Auth::user()->phone}}</div>
          <div>{{Auth::user()->email}}</div>
            
        </div>
      </section>
      
      <section id="terms">
           <div class="payment-info">
               <div class="bold">NOTES:</div>
           </div>   
        <div class="notes"> @if($order->notes){{ $order->notes }}@else N/A @endif</div>

        <br />

        <div class="payment-info">
          <div class="bold">Payment details:</div>
          <div>PAYMENT TYPE: {{ $order->payment_type }}</div>
          <div>PAYMENT METHOD: {{ $order->payment_method }}</div>
          <div>CURRENCY: {{ $order->currency }}</div>
          <div>TRANSACTION ID: {{ $order->transaction_id }}</div>
        </div>
        
      </section>

      <div class="clearfix"></div>
      @if($order->status == 'Pending' || $order->status == 'Processing')
      <div class="thank-you" style="background-color: #F4846F">STATUS: {{$order->status}}</div>
      @elseif($order->status == 'Cancel')
      <div class="thank-you" style="background-color: red">STATUS: {{$order->status}}</div>
      @else
      <div class="thank-you" style="background-color: #59B210;">STATUS: {{$order->status}}</div>
      @endif
      <div class="clearfix"></div>
    </div>

  </body>
</html>
