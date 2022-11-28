{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <title>Laravel 8 PayPal Payment Gateway Integration - MEANINGARTICLES.COM</title>--}}

{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />--}}
{{--</head>--}}

{{--<body>--}}
{{--<div class="container mt-5 text-center">--}}
{{--    <h2>Laravel 8 PayPal Integration Example - MEANINGARTICLES.COM</h2>--}}

{{--    <a href="{{ route('make.payment') }}" class="btn btn-primary mt-3">Pay $224 via Paypal</a>--}}
{{--</div>--}}
{{--</body>--}}

{{--</html>--}}


{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <title>How to integrate paypal payment in Laravel - Techsolutionstuff</title>--}}
{{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-8 col-md-offset-2">--}}
{{--            <h3 class="text-center" style="margin-top: 90px;">How to integrate paypal payment in Laravel - Techsolutionstuff</h3>--}}
{{--            <div class="panel panel-default" style="margin-top: 60px;">--}}

{{--                @if ($message = Session::get('success'))--}}
{{--                    <div class="custom-alerts alert alert-success fade in">--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>--}}
{{--                        {!! $message !!}--}}
{{--                    </div>--}}
{{--                    <?php Session::forget('success');?>--}}
{{--                @endif--}}

{{--                @if ($message = Session::get('error'))--}}
{{--                    <div class="custom-alerts alert alert-danger fade in">--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>--}}
{{--                        {!! $message !!}--}}
{{--                    </div>--}}
{{--                    <?php Session::forget('error');?>--}}
{{--                @endif--}}
{{--                <div class="panel-heading"><b>Paywith Paypal</b></div>--}}
{{--                <div class="panel-body">--}}
{{--                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >--}}
{{--                        {{ csrf_field() }}--}}

{{--                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">--}}
{{--                            <label for="amount" class="col-md-4 control-label">Enter Amount</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>--}}

{{--                                @if ($errors->has('amount'))--}}
{{--                                    <span class="help-block">--}}
{{--                                        <strong>{{ $errors->first('amount') }}</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <div class="col-md-6 col-md-offset-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    Paywith Paypal--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}

    <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How To Integrate Paypal Payment Gateway with Laravel - devnote.in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="text-center">
    <div class="content">
        <h1>How To Integrate Paypal Payment Gateway with Laravel - devnote.in</h1>
        <a href="{{ route('payment') }}" class="btn btn-success">Pay $160 from Paypal</a>
    </div>
</div>
</body>
</html>
