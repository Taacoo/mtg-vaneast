@extends('layouts.app', ['pageid' => 'search'])
@section('pagetitle', 'Search')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Search</div>
                    @if(Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-warning">
                                <span>{!! session('message') !!}</span>
                            </div>
                        </div>
                    @endif
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ action('SearchController@search') }}" class="search_form" method="post" autocomplete="off">
                                    <div class="form-field">
                                        {{ csrf_field() }}
                                        <input type="text" name="card_search" class="form-control" placeholder="Search..." required/>
                                        </br>
                                        <button type="submit" class="search_button btn btn-block">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="result">
                                    @if(isset($result))
                                        @foreach($result as $r)
                                            <span><a class="searched" data-image="https://magiccardmarket.eu{!! ltrim($r->img_path, '.') !!}" href="{{ url('card') . '/'. $r->id}}">{{ $r->name }} <i class="{{ $r->rarity }} ss ss-{{ strtolower($r->expansion->icon_abbr) }}" ></i></a></span><span class="subText"> - {{ $r->expansion->name }}</span></spam></br>
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
            $(".searched").mouseenter(function(){
                var image_name=$(this).data('image');
                var imageTag='<div style="position:absolute; z-index: 1; left: 150px;">'+'<img src="'+image_name+'" alt="image" height="250" />'+'</div>';
                $(this).parent('span').append(imageTag);
            });

            $(".searched").mouseleave(function(){
                $(this).parent('span').children('div').remove();
            });
        });
    </script>
@endsection