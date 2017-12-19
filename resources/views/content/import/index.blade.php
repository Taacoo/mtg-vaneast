@extends('layouts.app', ['pageid' => 'search'])
@section('pagetitle', 'Search')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if(Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-warning">
                                <span>{!! session('message') !!}</span>
                            </div>
                        </div>
                    @endif
                    <div class="panel-body">
                        <h3 class="center">Import</h3>
                        <span>Select a wishlist you would like to import to, or import to a new wishlist</span><br/>
                        <details class="importDetails">
                            <summary>Import details</summary>
                            <table class="table">
                                <tr>
                                    <td>Allowed files:</td>
                                    <td>.csv, .txt</td>
                                </tr>
                                <tr>
                                    <td>csv format:</td>
                                    <td>Quantity;Card;Set(Optional)</td>
                                </tr>
                                <tr>
                                    <td>txt format:</td>
                                    <td>1 Lightning Bolt<br/>2 Rift Bolt</td>
                                </tr>
                                <tr>
                                    <td>Max size:</td>
                                    <td>5MB.</td>
                                </tr>
                            </table>
                        </details>

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
                                        <button type="submit" class="search_button btn btn-custom btn-block">Import</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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