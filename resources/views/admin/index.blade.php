@extends('layouts.app', ['pageid' => 'Admin Panel'])
@section('pagetitle', 'Admin Panel')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Admin Panel</div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="card text-center" style="width: 20rem;">
                                        <i class="ss ss-bcore" style="font-size: 5em;"></i>
                                        <div class="card-block">
                                            <h4 class="card-title">Total Cards</h4>
                                            <p class="card-text">{{ Card::count() }}</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center" style="width: 20rem;">
                                        <i class="ss ss-lea" style="font-size: 5em;"></i>
                                        <div class="card-block">
                                            <h4 class="card-title">Card Details</h4>
                                            <p class="card-text">{{ CardDetails::count() }}</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center" style="width: 20rem;">
                                        <i class="fa fa-user fa-5x"></i>
                                        <div class="card-block">
                                            <h4 class="card-title">Users</h4>
                                            <p class="card-text">{{ User::count()-1 }}</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="card text-center" style="width: 20rem;">
                                        <i class="fa fa-columns fa-5x"></i>
                                        <div class="card-block">
                                            <h4 class="card-title">Trades</h4>
                                            <p class="card-text">{{ Trade::count() }}</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center" style="width: 20rem;">
                                        <i class="fa fa-money fa-5x"></i>
                                        <div class="card-block">
                                            <h4 class="card-title">Total Trade Value</h4>
                                            <p class="card-text">&euro; {{ number_format(Trade::allTradeValue(), 2, ',','.') }}</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="card text-center" style="width: 20rem;">
                                        <i class="fa fa-list fa-5x"></i>
                                        <div class="card-block">
                                            <h4 class="card-title">Wishlists</h4>
                                            <p class="card-text">{{ Wishlist::count() }}</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center" style="width: 20rem;">
                                        <i class="fa fa-money fa-5x"></i>
                                        <div class="card-block">
                                            <h4 class="card-title">Total Wishlist Value</h4>
                                            <p class="card-text">{{ Wishlist::allWishlistValue() }}</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
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

@endsection