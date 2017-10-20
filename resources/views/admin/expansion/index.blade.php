@extends('admin.layouts.app', ['pageid' => 'home'])
@section('pagetitle', 'Home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Expansions</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="display table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Abbreviation</th>
                                            <th>Icon Abbr.</th>
                                            <th>Amount of Cards</th>
                                            <th>Last Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expansions as $ex)
                                        <tr>
                                            <td><i class="ss-common ss ss-{{ strtolower($ex->mcm_abbr) }}" ></i> <a href="{{ action('Admin\ExpansionController@details', $ex->id) }}">{{ $ex->name }}</a></td>
                                            <td>{{ $ex->mcm_abbr }}</td>
                                            <td>{{ $ex->icon_abbr }}</td>
                                            <td>{{ count($ex->cards) }}</td>
                                            <td>{{ $ex->updated_at }}</td>
                                        </tr>
                                    @endforeach
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
