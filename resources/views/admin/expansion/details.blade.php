@extends('admin.layouts.app', ['pageid' => 'home'])
@section('pagetitle', 'Home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Expansion: <i class="ss-common ss ss-{{ strtolower($expansion->mcm_abbr) }}" ></i> {{ $expansion->name }}</div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
