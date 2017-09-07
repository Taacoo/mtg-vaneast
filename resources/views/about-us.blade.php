@extends('layouts.app', ['pageid' => 'home'])
@section('pagetitle', 'Home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">About Vaneast Price Checker</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                Welcome to Vaneast and thank you for chosing this as your source for cardprice information and detailed information about formats and special rulings.<br/>
                                Vaneast is powered by 2 powerful API's. One of which is created by the leader in european card trading for not just Magic the Gathering but more TCG's like Pok&eacute;mon and Yu-Gi-Oh<br/>
                                Magic Card Market gives me daily updates of almost every card printed.<br/><br/>
                                The second API that Vaneast uses for its more detailed information like special ruling and formats is provided by <a target="_blank" href="https://andrewbackes.com/">Andrew Backes</a> of <a target="_blank" href="https://docs.magicthegathering.io/">Magic the Gathering API</a>
                                <br/><br/>
                                Myself? I created this project as a way for me and my playgroup to quickly fetch prices for trades. The idea was to create a simple tool to request price data. The tool became much more soon after I started development.<br/>
                                I added a system to keep track of trades and a way to create a wishlists. To always have access to a complete list of cards that you need and how much they'll cost you as a player.
                                <br/>
                                If you wish to contact me. You can contact me at <a href="mailto:support@vaneast.nl">support@vaneast.nl</a>
                                <br/><br/>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <a target="_blank" href="https://www.magiccardmarket.eu"><img class="center-block" src="{{ URL::asset('img/McmFullsizeBannerEN.jpg') }}" alt="Magic Card Market Banner" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
