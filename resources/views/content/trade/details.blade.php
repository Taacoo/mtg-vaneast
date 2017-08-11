@extends('layouts.app', ['pageid' => 'search'])
@section('pagetitle', 'Search')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Trade Details - {{ $trade->name }}</div>
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trade->intrades as $i)
                                            @if($i->belongs_to == 1)
                                                <tr>
                                                    <td colspan="1"><a href="{{ url('card') . '/'. $i->card->id}}">{{ $i->card->name }}</a> <i class="{{ $i->card->rarity }} ss ss-{{ strtolower($i->card->expansion->abbreviation) }}" ></i></td>
                                                    <td colspan="1">{{ $i->price_avg }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                            <tr>
                                                <td><b>Total:</b></td>
                                                <td>{{ Trade::getMyTradeValue($trade->id) }}</td>
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trade->intrades as $i)
                                            @if($i->belongs_to != 1)
                                                <tr>
                                                    <td colspan="1"><a href="{{ url('card') . '/'. $i->card->id}}">{{ $i->card->name }}</a> <i class="{{ $i->card->rarity }} ss ss-{{ strtolower($i->card->expansion->abbreviation) }}" ></i></td>
                                                    <td colspan="1">{{ $i->price_avg }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td><b>Total:</b></td>
                                            <td>{{ Trade::getPartnerTradeValue($trade->id) }}</td>
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

    </script>
@endsection