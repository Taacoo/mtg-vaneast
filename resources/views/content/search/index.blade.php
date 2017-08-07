@extends('layouts.app', ['pageid' => 'search'])
@section('pagetitle', 'Search')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search</div>

                    <div class="panel-body">
                        <div class="col-md 12">
                            <form action="/search" class="search_form" method="get" autocomplete="off">
                                <div class="form-field">
                                    <input type="text" name="card_search" class="form-control" placeholder="Search..." required/>
                                    </br>
                                    <button type="submit" class="search_button btn btn-block">Search</button>
                                    <div id="result">

                                    </div>
                                </div>
                            </form>
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