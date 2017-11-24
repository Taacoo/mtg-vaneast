@extends('layouts.app', ['pageid' => 'trade'])
@section('pagetitle', 'Search')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Trade Details - {{ $trade->name }}</div>
                    @if(Session::has('success'))
                        <div class="form-group">
                            <div class="alert alert-success">
                                <span>{!! session('success') !!}</span>
                            </div>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <span>{!! session('error') !!}</span>
                            </div>
                        </div>
                    @endif
                    <div class="panel-body">
                        <a style="float: left;" class="btn btn-default" href="{{ url('trade') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Back</a>
                        <h4 style="float:right" class="{{ (Trade::getTradeValue($trade->id) >= 0) ? 'green' : 'red' }}">&euro; {{ number_format(Trade::getTradeValue($trade->id), 2,',','.') }}</h4>
                        <br/>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <table class="display table">
                                        <thead>
                                        <tr>
                                            <th>Card</th>
                                            <th>Value</th>
                                            <th>Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trade->intrades as $i)
                                            @if($i->belongs_to == 1)
                                                <tr>
                                                    <td colspan="1"><a class="img-hover" data-image="https://magiccardmarket.eu{!! ltrim($i->card->img_path, '.') !!}" href="{{ url('card') . '/'. $i->card->id}}">{{ $i->card->name }}</a> <i class="{{ $i->card->rarity }} ss ss-{{ strtolower($i->card->expansion->mcm_abbr) }}" ></i></td>
                                                    <td colspan="1">&euro; {{ number_format($i->price_trend, 2,',', '.') }}</td>
                                                    <td colspan="1"><a href="{{ action('TradeController@removeFromTrade', ['id' => $i->id]) }}" id="remove" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                            <tr>
                                                <td><b>Total:</b></td>
                                                <td>{{ Trade::getMyTradeValue($trade->id) }}</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4>Partner</h4>
                                    <table class="display table">
                                        <thead>
                                        <tr>
                                            <th>Card</th>
                                            <th>Value</th>
                                            <th>Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trade->intrades as $i)
                                            @if($i->belongs_to != 1)
                                                <tr>
                                                    <td colspan="1"><a class="img-hover" data-image="https://magiccardmarket.eu{!! ltrim($i->card->img_path, '.') !!}" href="{{ url('card') . '/'. $i->card->id}}">{{ $i->card->name }}</a> <i class="{{ $i->card->rarity }} ss ss-{{ strtolower($i->card->expansion->abbreviation) }}" ></i></td>
                                                    <td colspan="1">&euro; {{ number_format($i->price_trend, 2,',', '.') }}</td>
                                                    <td colspan="1"><a href="{{ action('TradeController@removeFromTrade', ['id' => $i->id]) }}" id="remove" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td><b>Total:</b></td>
                                            <td>{{ Trade::getPartnerTradeValue($trade->id) }}</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
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
            $(".img-hover").mouseenter(function(){
                var image_name=$(this).data('image');
                var imageTag='<div style="position:absolute; z-index: 1; left: 150px;">'+'<img src="'+image_name+'" alt="image" height="250" />'+'</div>';
                $(this).parent('td).append(imageTag);
            });

            $(".img-hover").mouseleave(function(){
                $(this).parent('td').children('div').remove();
            });
        });
    </script>
@endsection