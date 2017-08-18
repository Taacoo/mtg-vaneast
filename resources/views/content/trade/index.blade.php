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
                                <div class="input-group">
                                        {{ csrf_field() }}
                                        <input type="text" name="trade_name" class="form-control" placeholder="Trade..." required/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn">Create Trade</button>
                                    </span>
                                </div>
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
                                            <th>Remove</th>
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
                                                <td colspan="1"><a href="#" id="{{ $t->id }}" class="btn btn-danger trade_remove"><i class="fa fa-times" aria-hidden="true"></i></a></td>
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
        $(document).ready(function(){
            $('.trade_remove').on('click', function(){
                if (confirm('Are you sure you want to delete this?')) {
                    TableURL = '{{ action('TradeController@removeTrade') }}';
                    var formData = {
                        trade_id: this.id
                    };

                    $.ajax({
                        url: TableURL,
                        type: 'POST',
                        data: formData,
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function (data) {
                            $('div.return').html(data.html);
                        }
                    });
                }
            });
        });
    </script>
@endsection