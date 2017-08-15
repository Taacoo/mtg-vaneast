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
                               <br/>
                            <div class="row">
                               <div class="col-md-12">
                                   @if(count($trades) == 0)
                                       <p>No trades started. Start one <a href="{{ action('TradeController@index') }}">here</a></p>
                                   @else
                                       <select class="selectpicker" data-width="75%">
                                           @foreach($trades as $t)
                                               <option value="{{ $t->id }}">{{ $t->name }}</option>
                                           @endforeach
                                       </select>
                                   @endif

                               </div>
                            </div>
                               <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="me_button" class="btn btn-success">Add to me</button>
                                    <button type="submit" id="partner_button" class="btn btn-warning">Add to Partner</button>
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
        });

        $('#me_button').on('click', function(){
            var selected = $('.selectpicker').find("option:selected").val();
            var choice = 'me';
            var avg = {{ $prices['avg'] }};

            selectedAjax(selected, choice, avg);
        });

        $('#partner_button').on('click', function(){
            var selected = $('.selectpicker').find("option:selected").val();
            var choice = 'partner';
            var avg = {{ $prices['avg'] }};

            selectedAjax(selected, choice, avg);
        });

        function selectedAjax(selected, choice, avg){
            TableURL = '{{ action('TradeController@addCardToTrade') }}';
            var formData = {
                trade_id: selected,
                card_id: {{ $card->id }},
                choice: choice,
                avg: avg
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
    </script>
@endsection