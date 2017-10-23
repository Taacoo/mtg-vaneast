@extends('layouts.app', ['pageid' => 'wishlist'])
@section('pagetitle', 'Wishlist')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Wishlist Details - {{ $wishlist->name }}</div>
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
                        <a style="float: left;" class="btn btn-default" href="{{ url('wishlist') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Back</a>
                        <br/>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{ Auth::user()->name }}</h4>
                                <table class="display table">
                                    <thead>
                                    <tr>
                                        <th>Card</th>
                                        <th>Quantity</th>
                                        <th>Value</th>
                                        <th>Total Value</th>
                                        <th>Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wishlist->inwishlists as $i)
                                        <tr>
                                            <td colspan="1"><a href="{{ url('card') . '/'. $i->card->id}}">{{ $i->card->name }}</a> <i class="{{ $i->card->rarity }} ss ss-{{ strtolower($i->card->expansion->mcm_abbr) }}" ></i></td>
                                            <td colspan="1">{{$i->quantity }}</td>
                                            <td colspan="1">&euro; {{ number_format(Wishlist::getCardValue($i->card->id), 2,',', '.') }}</td>
                                            <td colspan="1">&euro; {{ number_format(Wishlist::getTotalCardValue($i->card->id, $i->id), 2,',', '.') }}</td>
                                            <td colspan="1"><a href="{{ action('WishlistController@removeFromWishlist', ['id' => $i->id]) }}" id="remove" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><b>Total:</b></td>
                                        <td colspan="1">&euro; {{ number_format(Wishlist::getWishlistValue($wishlist->id), 2,',', '.') }}</td>
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
@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection