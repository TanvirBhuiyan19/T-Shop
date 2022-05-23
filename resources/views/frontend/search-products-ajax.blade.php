<style>
    .search-item-design{
        padding: 10px 0px;
    }
   .design-li{
        list-style: none;
        padding: 0 20px;
    }
    .design-li:hover{
        background: #F3F3F3;
        cursor: pointer;
    }
    .design-li a:hover{
       color: #333333;
    }
</style>

<ul class="search-item-design">
    @forelse ($products as $product)
    @if(session()->get('language') == 'bangla') 
    <a href="{{ url('products/'.$product->product_slug_bn) }}">
    @else    
    <a href="{{ url('products/'.$product->product_slug_en) }}">
    @endif    
        <li class="design-li">
            <img src="{{ asset('uploads/product/thumbnail/'.$product->product_thumbnail) }}" alt="" height="40px;" width="40px;">
            <strong >@if(session()->get('language') == 'bangla') {{ $product->product_name_bn }} @else {{ $product->product_name_en }} @endif</strong>             
            <hr style="margin: 5px 0px;">
        </li>
    </a>
    @empty
        <li style="color: red; padding:0 20px; text-align: center;"><b>@if(session()->get('language') == 'bangla') পণ্য পাওয়া যায়নি @else Product Not Found @endif</b></li>
    @endforelse
</ul>