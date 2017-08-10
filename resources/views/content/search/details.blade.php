@extends('layouts.app', ['pageid' => 'search'])
@section('pagetitle', 'Search')

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
                                                <img style="width: 200px;" class="center-block" src="https://magiccardmarket.eu{!! ltrim($card->img_path, '.') !!}" alt="{{ $card->name }}" />
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection