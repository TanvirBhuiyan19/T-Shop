<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
<title> 
@if($settings->site_name) Invoice | {{$settings->site_name}} @else Invoice | {{config('app.name')}}  @endif
</title>



<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          {{-- <img src="" alt="" width="150"/> --}}<br>
          <a href="{{config('app.url')}}" style="text-decoration: none;"><h2 style="color: green; font-size: 26px;"><strong>
            @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
          </strong></h2></a>
        </td>
        
        <td align="right">
          <pre class="font">
            @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif Head Office
            @if($settings->email) {{$settings->email}} @else hello@tshop.com  @endif 
            @if($settings->mobile) {{$settings->mobile}} @else +8801757461006  @endif 
            @if($settings->address) {{$settings->address}} @else 
             Dhaka 1207,Dhanmondi:#4
             Dhaka ,Bangladesh
             @endif 
             {{config('app.url')}}
          </pre>
        </td>
    </tr>
  </table>
  <table width="100%" style="background:white; padding:2px;""></table>
  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px; line-height: 1.5">
           <strong>SHIPPING TO :</strong><br>
            {{ $order->name }} <br>
            {{ $order->phone }} <br>
            {{ $order->email }} <br>
            @php
                $div = $order->division->division_name_en;
                $dis = $order->district->district_name_en;
                $state = $order->state->state_name_en;
            @endphp
           {{ $state }},{{ $dis }}<br>
           {{ $div }} - {{ $order->post_code }}
         </p>
        </td>
        <td>
          <p class="font" style="margin-left: 20px; line-height: 1.5">
            <strong>BILLING DETAILS: </strong><br>
            Payment Type: {{ $order->payment_type }}<br>
            Payment Method: {{ $order->payment_method }}<br>
            Currency: {{ $order->currency }}<br>
            Transaction ID: {{ $order->transaction_id }}<br>
            Order Date: {{ $order->order_date }}
         </p>
        </td>
    </tr>
  </table>
  <h3 style="color: green; text-align: center;">Invoice: {{ $order->invoice_no }} </h3>
<h3>Products</h3>
  <table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Code</th>
        <th>Size</th>
        <th>Color</th>
        <th>Unit Price </th>
        <th>Quantity</th>
        <th>Line Total</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($orderItems as $item)
     <tr class="font">
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">
            <img src="{{ public_path('uploads/product/thumbnail/') }}/{{$item->product->product_thumbnail}}" height="60px;" width="60px;" alt="">
        </td>
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">{{ $item->product->product_name_en }}</td>
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">{{ $item->product->product_code }}</td>
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">
            @if ($item->size == NULL)
                ---
            @else
            {{ $item->size }}
            @endif
        </td>
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">{{ $item->color }}</td>
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">{{ $item->price }}Tk</td>
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">{{ $item->qty }}</td>
        <td align="center" style="border-bottom: 1px solid;padding-bottom: 5px;">{{ $item->price * $item->qty }}Tk</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="left">
            @if($order->notes) <h3>Note :</h3> {{ $order->notes }}<br> @endif
            
            @if($order->status == 'Pending')
            <h2 style="color: #F4846F">Status: {{$order->status}}</h2>
            @elseif($order->status == 'Cancel')
            <h2 style="color: red">Status: {{$order->status}}</h2>
            @else
            <h2 style="color: #59B210;">Status: {{$order->status}}</h2>
            @endif
        </td>
        
        <td align="right" >
            @if($order->coupon_discount)
            <h2><span style="color: green;">Subtotal : </span> {{ $order->amount + $order->discount_amount }}tk</h2>
            <h2><span style="color: green;">Discount : </span> {{$order->coupon_discount}}%</h2>
            <h2><span style="color: green;">Discount Amount : </span> {{$order->discount_amount}}tk</h2>
            @else
            <h2><span style="color: green;">Subtotal:</span> {{ $order->amount }}tk</h2>
            <h2><span style="color: green;">Discount : </span> 00%</h2>
            @endif
            
            <h2 class="row"><span style="color: green;">Grand Total:</span> {{ $order->amount }}tk</h2>
            
            @if($order->payment_method == "Cash on Delivery")
            <h2><span style="color: green;">Paid Amount : </span> 0.00tk</h2>
                @if($order->coupon_discount)
                <h2 style="padding: 5px; border: 1px solid; background: #F7F7F7;"><span style="color: green;">Due Amount : </span> {{ $order->amount }}tk</h2>
                @else
                <h2 style="padding: 5px; border: 1px solid; background: #F7F7F7;"><span style="color: green;">Due Amount : </span> {{ $order->amount + $order->discount_amount }}tk</h2>
                @endif
            @else
                @if($order->coupon_discount)
                <h2><span style="color: green;">Paid Amount : </span> {{ $order->amount }}tk</h2>
                @else
                <h2><span style="color: green;">Paid Amount : </span> {{ $order->amount + $order->discount_amount }}tk</h2>
                @endif
           {{-- <h2><span style="color: green;">DUE Amount : </span> 0.00tk</h2> --}}
                <h2><span style="color: green; padding: 5px; border: 1px solid; width: 60%; background: #F7F7F7;">Full Payment PAID</h2>
            @endif
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
      <br>
    <p>Thanks For Buying Products..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
  <br><br></br><br>
  <a href="{{config('app.url')}}" style="text-decoration: none;"><h2 style="text-align: center; color: #E9E8E2;">{{config('app.url')}}</h2></a>
</body>
</html>