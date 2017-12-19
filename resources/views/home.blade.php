@extends('layouts.app', ['pageid' => 'home'])
@section('pagetitle', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="center">Welcome to [placeholder]</h3>
                    <br/>
                    <p>Start searching here!</p>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ action('SearchController@search') }}" class="search_form" method="post" autocomplete="off">
                                <div class="form-field">
                                    {{ csrf_field() }}
                                    <input type="text" name="card_search" class="form-control" placeholder="Search..." required/>
                                    </br>
                                    <button type="submit" class="search_button btn btn-custom btn-block">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="center">Welcome to [placeholder]</h3>
                    <br/>
                    <p>Start searching here!</p>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ action('SearchController@search') }}" class="search_form" method="post" autocomplete="off">
                                <div class="form-field">
                                    {{ csrf_field() }}
                                    <input type="text" name="card_search" class="form-control" placeholder="Search..." required/>
                                    </br>
                                    <button type="submit" class="search_button btn btn-custom btn-block">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="center">Welcome to [placeholder]</h3>
                    <br/>
                    <p>Start searching here!</p>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ action('SearchController@search') }}" class="search_form" method="post" autocomplete="off">
                                <div class="form-field">
                                    {{ csrf_field() }}
                                    <input type="text" name="card_search" class="form-control" placeholder="Search..." required/>
                                    </br>
                                    <button type="submit" class="search_button btn btn-custom btn-block">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
