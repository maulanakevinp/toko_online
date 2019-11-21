@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')
<main class="page payment-page">
    <section class="clean-block payment-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Payment</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                    mattis vitae leo.</p>
            </div>
            <form>
                <div class="products">
                    <h3 class="title">Checkout</h3>
                    <div class="item"><span class="price">$200</span>
                        <p class="item-name">Product 1</p>
                        <p class="item-description">Lorem ipsum dolor sit amet</p>
                    </div>
                    <div class="item"><span class="price">$120</span>
                        <p class="item-name">Product 2</p>
                        <p class="item-description">Lorem ipsum dolor sit amet</p>
                    </div>
                    <div class="total"><span>Total</span><span class="price">$320</span></div>
                </div>
                <div class="card-details">
                    <h3 class="title">Credit Card Details</h3>
                    <div class="form-row">
                        <div class="col-sm-7">
                            <div class="form-group"><label for="card-holder">Card Holder</label><input
                                    class="form-control" type="text" placeholder="Card Holder"></div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group"><label>Expiration date</label>
                                <div class="input-group expiration-date"><input class="form-control" type="text"
                                        placeholder="MM"><input class="form-control" type="text" placeholder="YY"></div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group"><label for="card-number">Card Number</label><input
                                    class="form-control" type="text" id="card-number" placeholder="Card Number"></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="cvc">CVC</label><input class="form-control" type="text"
                                    id="cvc" placeholder="CVC"></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group"><button class="btn btn-primary btn-block"
                                    type="submit">Proceed</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection