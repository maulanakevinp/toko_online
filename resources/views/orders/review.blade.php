@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')
<main class="page payment-page">
    <section class="clean-block mt-5">
        <div class="container">
            <h1 class="text-center text-info">Berikan Ulasan Anda</h1>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow h-100">
                        <div class="card-header">
                            <a href="{{ route('details-product', ['id' => $orderProduct->product->id, 'name' => strtolower(str_replace(' ','-',$orderProduct->product->name))] )}}">
                                <h5 class="m-0 pt-1 font-weight-bold text-black-50" data-toogle="tooltip" title="{{ $orderProduct->product->name }}">{{ $orderProduct->product->name }}</h5>
                            </a>
                        </div>
                        <form action="{{ route('orders.update_review',$orderProduct) }}" method="post">
                        @csrf @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" {{ $orderProduct->rating == 5 ? 'checked='.'"'.'checked'.'"' : ''  }}/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" {{ $orderProduct->rating == 4 ? 'checked='.'"'.'checked'.'"' : ''  }}/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3" {{ $orderProduct->rating == 3 ? 'checked='.'"'.'checked'.'"' : ''  }}/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" {{ $orderProduct->rating == 2 ? 'checked='.'"'.'checked'.'"' : ''  }}/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1" {{ $orderProduct->rating == 1 ? 'checked='.'"'.'checked'.'"' : ''  }}/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                    </div>
                                    @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="ulasan" id="ulasan" rows="2" class="form-control" placeholder="Tulis ulasan anda">{{ old('ulasan', $orderProduct->review) }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block btn-success" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('style')
    <style>
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        fieldset, label { margin: 0; padding: 0; }
        h1 { font-size: 1.5em; margin: 10px; }

        /****** Style Star Rating Widget *****/

        .rating { 
        border: none;
        float: left;
        }

        .rating > input { display: none; } 
        .rating > label:before { 
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
        }

        .rating > .half:before { 
        content: "\f089";
        position: absolute;
        }

        .rating > label { 
        color: #ddd; 
        float: right; 
        }

        /***** CSS Magic to Highlight Stars on Hover *****/

        .rating > input:checked ~ label, /* show gold star when clicked */
        .rating:not(:checked) > label:hover, /* hover current star */
        .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

        .rating > input:checked + label:hover, /* hover current star when changing rating */
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
        .rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
    </style>
@endsection