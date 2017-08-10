@extends('layouts.app', ['pageid' => 'home'])
@section('pagetitle', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Vaneast Price Checker</div>

                <div class="panel-body">
                    <p>Start searching here!</p>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
