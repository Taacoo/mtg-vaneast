@extends('layouts.app', ['pageid' => 'wishlist'])
@section('pagetitle', 'Wishlist')

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
                        <h3 class="center">Wishlist</h3>
                        <br/>
                        <form action="{{ action('WishlistController@createWishlist') }}" class="search_form" method="post" autocomplete="off">
                            <div class="form-field">
                                <div class="input-group">
                                    {{ csrf_field() }}
                                    <input type="text" name="wishlist_name" class="form-control" placeholder="Wishlist..." required/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-custom" style="padding:6px 20px 6px 20px;">Create Wishlist</button>
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
                                        <th>Total Value</th>
                                        <th>Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($wishlists as $w)
                                        <tr>
                                            <td><a href="{{ action('WishlistController@wishlistDetails', $w->id) }}">{{ $w->name }}</a></td>
                                            <td>{{ count($w->inwishlists)  }}</td>
                                            <td colspan="1">&euro; {{ number_format(Wishlist::getWishlistValue($w->id), 2,',', '.') }}</td>
                                            <td colspan="1"><a href="#" id="{{ $w->id }}" class="btn btn-danger wishlist_remove"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">You have no wishlists</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="return">

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
            $('.wishlist_remove').on('click', function(){
                if (confirm('Are you sure you want to delete this?')) {
                    TableURL = '{{ action('WishlistController@removeWishlist') }}';
                    var formData = {
                        wishlist_id: this.id,
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