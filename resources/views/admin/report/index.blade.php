@extends('layouts.adminMaster')

@section('reports')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Search Reports | {{$settings->site_name}} @else Search Reports | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Search Reports</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">

        <div class="col-md-4">
            <div class="card">
                <h6 class="card-header text-center">Search By Date</h6>
                <div class="card-body">
                    
                    <form action="{{ route('search-by-date') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Select Date: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="date" name="date" max="{{$formatLastDate}}" min="{{$formatFirstDate}}">
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="form-layout-footer">
                            <button type="submit" class="logged-name btn btn-outline-success btn-block">Search</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <h6 class="card-header text-center">Search By Month</h6>
                <div class="card-body">
                    <form action="{{ route('search-by-month') }}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Select Month: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" name="month_name" data-placeholder="Choose one" data-validation="required" style="max-width: 300px !important">
                                <option label="Choose one"></option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                            @error('month_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            @php
                            $order_last_id = App\Models\Order::latest()->first();
                            $order_first_id = App\Models\Order::oldest('id')->first();
                            $year_last = $order_last_id->order_year;
                            $year_first = $order_first_id->order_year;
                            @endphp
                            <label class="form-control-label">Select Year: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" name="year_name" data-placeholder="Choose one" data-validation="required" style="max-width: 300px !important">
                                <option label="Choose one"></option>
                                @for ($i = $year_last; $i >= $year_first; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('year_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-outline-success btn-block logged-name">Search</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <h6 class="card-header text-center">Search By Year</h6>
                <div class="card-body">
                    <form action="{{ route('search-by-year') }}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Select Year: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" name="year_name2" data-placeholder="Choose one" data-validation="required" style="max-width: 300px !important">
                                <option label="Choose one"></option>
                                @for ($i = $year_last; $i >= $year_first; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('year_name2')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-outline-success btn-block logged-name">Search</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection