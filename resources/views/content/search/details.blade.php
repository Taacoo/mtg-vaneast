@extends('layouts.app', ['pageid' => 'search'])
@section('pagetitle', 'Search')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Details</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ action('SearchController@search') }}" class="search_form" method="post" autocomplete="off">
                                        <div class="form-field">
                                            {{ csrf_field() }}
                                            <input type="text" name="card_search" class="form-control" placeholder="Search..." required/>
                                            </br>
                                            <button type="submit" class="search_button btn btn-block">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="result">
                                        @if(isset($prices) && isset($card))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="text-center">{{ $card->name }}</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6  col-xs-8">
                                                    <img class="center-block card-img" src="https://magiccardmarket.eu{!! ltrim($card->img_path, '.') !!}" alt="{{ $card->name }}" />
                                                </div>
                                                <div class="col-md-6 col-xs-4">
                                                    <div class="row"><span>Sell: &euro; {{ number_format($prices['sell'], 2,',', '.') }}</span></div>
                                                    <div class="row"><span>Low: &euro; {{ number_format($prices['low'], 2,',', '.') }}</span></div>
                                                    <div class="row"><span>Low EX: &euro; {{ number_format($prices['lowex'], 2,',', '.') }}</span></div>
                                                    <div class="row"><span>Low Foil: &euro; {{ number_format($prices['lowfoil'], 2,',', '.') }}</span></div>
                                                    <div class="row"><span>Average: &euro; {{ number_format($prices['avg'], 2,',', '.') }}</span></div>
                                                    <div class="row"><span>Trend: &euro; {{ number_format($prices['trend'], 2,',', '.') }}</span></div>
                                                </div>
                                            </div>
                                        @else
                                            <p>No card was searched for</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(isset($details))
                                <div class="row">
                                    <div class="col-md-12">
                                        <details>
                                            <summary>Details</summary>
                                            <table class="table">
                                                <tr>
                                                    <td>Mana Cost:</td>
                                                    <td id="mana">{{ $details->manaCost }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>{{ $details->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type:</td>
                                                    <td>{{ $details->type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Text:</td>
                                                    <td id="text">{!! nl2br(e($details->text)) !!}</td>
                                                </tr>
                                                @if($details->power != null)
                                                <tr>
                                                    <td>Power/Toughness</td>
                                                    <td>{{ $details->power }} / {{ $details->toughness }}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </details>

                                        @if(count($details->rulings) > 0)
                                            <details>
                                                <summary>Rulings</summary>
                                                <table class="table">

                                                    @if(count($details->rulings) == 1)
                                                    <tr>
                                                        <td class="col-md-2">{{ date('d-m-Y', strtotime($details->rulings->date)) }}</td>
                                                        <td>{{ base64_decode($details->rulings->text) }}</td>
                                                    </tr>

                                                    @else
                                                        @foreach($details->rulings as $r)
                                                            <tr>
                                                                <td class="col-md-2">{{ date('d-m-Y', strtotime($details->rulings->date)) }}</td>
                                                                <td>{{ base64_decode($details->rulings->text) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </details>
                                        @endif

                                        @if(count($details->legalities) > 0)
                                            <details>
                                                <summary>Legalities</summary>
                                                <table class="table">

                                                    @if(count($details->legalities) == 1)
                                                        <tr>
                                                            <td class="col-md-2">{{ $details->legalities->format }}</td>
                                                            <td>{{ $details->legalities->legality }}</td>
                                                        </tr>

                                                    @else
                                                        @foreach($details->legalities as $r)
                                                            <tr>
                                                                <td class="col-md-2">{{ $r->format }}</td>
                                                                <td>{{ $r->legality }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </details>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <br/>
                            <div class="row">
                                <div class="col-md-12" style="display: inline-block;">
                                    <div class="col-md-5"  style="display: inline-block;">
                                        @if(count($trades) == 0)
                                            <p>No trades started. Start one <a href="{{ action('TradeController@index') }}">here</a></p>
                                        @else
                                            <select class="selectpicker" id="tradePicker">
                                                @foreach($trades as $t)
                                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    @if(count($trades) == 0)
                                    @else
                                        <div class="col-md-2" style="display: inline-block;">
                                            <button type="submit" id="me_button" class="btn btn-success">Add to me</button>
                                        </div>
                                        <div class="col-md-2" style="display: inline-block;">
                                            <button type="submit" id="partner_button" class="btn btn-warning">Add to Partner</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-5"  style="display: inline-block;">
                                        @if(count($wishlists) == 0)
                                            <p>No wishlist created. Create one <a href="{{ action('WishlistController@index') }}">here</a></p>
                                        @else
                                            <select class="selectpicker" id="wishlistPicker">
                                                @foreach($wishlists as $w)
                                                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    @if(count($wishlists) == 0)
                                    @else
                                        <div class="col-md-2" style="display: inline-block;">
                                            <input type="number" class="form-control" id="wishlist_quantity" name="quantity" value="1" min="0" max="99"/>
                                        </div>
                                        <div class="col-md-1" style="display: inline-block;">
                                            <button type="submit" id="wishlist_button" class="btn btn-info">Add to Wishlist</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                                <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="return"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.selectpicker').selectpicker({
                style: 'btn-info',
                size: 4
            });

            replaceSymbols($("#mana"));
            replaceSymbols($("#text"));

        });

        $('#me_button').on('click', function(){
            var selected = $('#tradePicker').find("option:selected").val();
            var choice = 'me';
            var prices = {
                sell : '{{ $prices['sell'] }}',
                low : '{{ $prices['low'] }}',
                lowex : '{{ $prices['lowex'] }}',
                lowfoil : '{{ $prices['lowfoil'] }}',
                avg : '{{ $prices['avg'] }}',
                trend : '{{ $prices['trend'] }}'
            };


            tradeAjax(selected, choice, prices);
        });

        $('#partner_button').on('click', function(){
            var selected = $('#tradePicker').find("option:selected").val();
            var choice = 'partner';
            var prices = {
                sell : '{{ $prices['sell'] }}',
                low : '{{ $prices['low'] }}',
                lowex : '{{ $prices['lowex'] }}',
                lowfoil : '{{ $prices['lowfoil'] }}',
                avg : '{{ $prices['avg'] }}',
                trend : '{{ $prices['trend'] }}'
            };

            tradeAjax(selected, choice, prices);
        });

        $('#wishlist_button').on('click', function(){
            var selected = $('#wishlistPicker').find("option:selected").val();
            var quantity = $('#wishlist_quantity').val();

            wishlistAjax(selected, quantity);
        });

        function tradeAjax(selected, choice, prices){
            TableURL = '{{ action('TradeController@addCardToTrade') }}';
            var formData = {
                trade_id: selected,
                card_id: '{{ $card->id }}',
                choice: choice,
                prices: prices
            };

            $.ajax({
                url: TableURL,
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                success: function(data) {
                    $('div.return').html(data.html);
                },
                error: function (data) {
                    $('div.return').html('<div class="col-md-12"><p>Something went wrong adding this card to your trade. Please try again or contact the developer</p></div>');
                }
            });
        }

        function wishlistAjax(selected, quantity){
            TableURL = '{{ action('WishlistController@addCardToWishlist') }}';
            var formData = {
                wishlist_id: selected,
                card_id: {{ $card->id }},
                quantity: quantity
            };

            $.ajax({
                url: TableURL,
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                success: function(data) {
                    $('div.return').html(data.html);
                },
                error: function (data) {
                    $('div.return').html('<div class="col-md-12"><p>Something went wrong adding this card to your wishlist. Please try again or contact the developer</p></div>');
                }
            });
        }

        /**
         * Function written by Discord: Yuudaari#0356
         *
         * @param element
         */
        function replaceSymbols(element) {
            element.each(function () {
                this.innerHTML = this.innerHTML.replace(/\{(?:(\d+|G|P|R|W|U|B)(?:\/(\d+|G|P|R|W|U|B))?|(CHAOS|Q|C|T|X|E))\}/g, (m, c1, c2, c3) =>
                {
                    const img = "mana" + ((c1 || c3) + (c2 || "")).toLowerCase();
                return '<img style="display: inline-block; width: 25px; height: 25px;" src="https://raw.githubusercontent.com/scryfall/manamoji-discord/master/emojis/'+img+'.png" alt="${m}"/>'
                });
            })
        }



    </script>
@endsection