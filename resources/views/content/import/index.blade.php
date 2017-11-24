@extends('layouts.app', ['pageid' => 'search'])
@section('pagetitle', 'Search')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Import</div>
                    @if(Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-warning">
                                <span>{!! session('message') !!}</span>
                            </div>
                        </div>
                    @endif
                    <div class="panel-body">
                        <span>Select a wishlist you would like to import to, or import to a new wishlist</span>
                        <form action="{{ action('ImportController@process') }}" class="search_form" method="post" autocomplete="off" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row" style="margin-top:20px;">
                                <div class="col-md-12">
                                    <div class="col-md-6 form-group">

                                        @if(count($wishlists) == 0)
                                            <p>No wishlist created. Create one <a href="{{ action('WishlistController@index') }}">here</a></p>
                                        @else
                                            <select class="selectpicker" id="wishlistPicker" name="wishlistPicker">
                                                @foreach($wishlists as $w)
                                                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                                                @endforeach
                                                <option value="0">New wishlist</option>
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="file" name="uploadFile" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="newWishlist" id="newWishlist" class="form-control hiddenWishlist" placeholder="Wishlist..." disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Import" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="result">
                                    @if(isset($result))
                                        @foreach($result as $r)
                                            <span><a class="searched" data-image="https://magiccardmarket.eu{!! ltrim($r->img_path, '.') !!}" href="{{ url('card') . '/'. $r->id}}">{{ $r->name }} <i class="{{ $r->rarity }} ss ss-{{ strtolower($r->expansion->icon_abbr) }}" ></i></a></span></br>
                                        @endforeach
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
        $(document).ready(function(){
            $("#wishlistPicker").change(function(){
                if($("#wishlistPicker").val() == 0){
                    $('#newWishlist').show();
                    $("#newWishlist").prop('disabled', false);
                }else{
                    $('#newWishlist').hide();
                    $("#newWishlist").prop('disabled', true);
                }
            });
        });
    </script>
@endsection