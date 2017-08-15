@extends('layouts.app', ['pageid' => 'trade'])
@section('pagetitle', 'Search')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Trade </div>
                    @if(Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-warning">
                                <span>{!! session('message') !!}</span>
                            </div>
                        </div>
                    @endif
                    <div class="panel-body">
                        <form action="{{ action('TradeController@createTrade') }}" class="search_form" method="post" autocomplete="off">
                            <div class="form-field">
                                <div class="col-md-10">
                                    {{ csrf_field() }}
                                    <input type="text" name="trade_name" class="form-control" placeholder="Trade..." required/>
                                </div>
                                <button type="submit" class="btn">Create Trade</button>
                            </div>
                        </form>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="display table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th># Cards</th>
                                            <th>My Value</th>
                                            <th>Partner Value</th>
                                            <th>Debt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trades as $t)
                                            <tr>
                                                <td><a href="{{ url('trade', $t->id) }}">{{ $t->name }}</a></td>
                                                <td>{{ count($t->intrades) }}</td>
                                                <td>{{ Trade::getMyTradeValue($t->id) }}</td>
                                                <td>{{ Trade::getPartnerTradeValue($t->id) }}</td>
                                                <td class="{{ (Trade::getTradeValue($t->id) >= 0) ? 'green' : 'red' }}">&euro; {{ number_format(Trade::getTradeValue($t->id), 2,',','.') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No trade started</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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