@extends('layouts.frontendMaster')
@section('title')  | {{config('app.name')}} @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') ইউজার ড্যাশবোর্ড @else User Dashboard @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li class='active'>ড্যাশবোর্ড</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Dashboard</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<style>
    .txt-center {
        text-align: center;
    }
    .hide {
        display: none;
    }

    .clear {
        float: none;
        clear: both;
    }

    .rating {
        width: 250px;
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
        position: relative;
    }

    .rating > label {
        font-size: 36px;
        float: right;
        display: inline;
        padding: 0;
        margin: 0;
        position: relative;
        width: 1.1em;
        cursor: pointer;
        color: #000;
    }

    .rating > label:hover,
    .rating > label:hover ~ label,
    .rating > input.radio-btn:checked ~ label {
        color: transparent;
    }

    .rating > label:hover:before,
    .rating > label:hover ~ label:before,
    .rating > input.radio-btn:checked ~ label:before,
    .rating > input.radio-btn:checked ~ label:before {
        content: "\2605";
        position: absolute;
        left: 0;
        color: #FFD700;
    }
</style>

<div class="body-content">
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="sign-in-page">

                    <!----------------------------------------- Change Information Section ------------------------------->                      

                    <h4 class="text-center">Write a review</h4>
                    <hr><br>

                    <div class="row">
                        <div class="col-md-8 col-sm-12 col-md-offset-2">
                            <div class="product-add-review">

                                <form action="{{ route('store.review') }}" method="POST">
                                    @csrf
                                    
                                    <input type="hidden" name="product_id" value="{{$product_id}}">
                                    
                                    <div class=" row">
                                        <h5 class="col-md-3" style="padding-top: 12px;"><b>Rating <span style="color: red">*</span></b></h5>

                                        <div class="rating col-md-9 col-sm-">
                                            <input id="star5" name="rating" type="radio" value="5" class="radio-btn hide" />
                                            <label for="star5">☆</label>
                                            <input id="star4" name="rating" type="radio" value="4" class="radio-btn hide" />
                                            <label for="star4">☆</label>
                                            <input id="star3" name="rating" type="radio" value="3" class="radio-btn hide" />
                                            <label for="star3">☆</label>
                                            <input id="star2" name="rating" type="radio" value="2" class="radio-btn hide" />
                                            <label for="star2">☆</label>
                                            <input id="star1" name="rating" type="radio" value="1" class="radio-btn hide" />
                                            <label for="star1">☆</label>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    @error('rating')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    <div class="form-group">
                                        <label for="exampleInputReview">Comment <span class="astk">*</span></label>
                                        <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                        @error('comment')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div><!-- /.form-group -->

                                    <div class="action text-right">
                                        <button type="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                    </div><!-- /.action -->
                                </form>
                            </div>
                    <br><br><br>

                        </div><!-- /.product-add-review -->
                    </div>
                </div>
                <!-------------------------------------------- End: Change Information Section -------------------------------> 
                
            </div>

        </div>

    </div>

    <script>

    </script>  

    @endsection
