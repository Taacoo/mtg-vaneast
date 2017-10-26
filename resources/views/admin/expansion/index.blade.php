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
                                            <td><i class="ss-common ss ss-{{ strtolower($ex->icon_abbr) }}" ></i> <a href="{{ action('Admin\ExpansionController@details', $ex->id) }}">{{ $ex->name }}</a></td>
                                            <td>{{ $ex->mcm_abbr }}</td>
                                            <td class="col-md-2"><input type="text" class="form-control icon_abbr_input" name="icon_abbr" id="{{ base64_encode($ex->id) }}" value="{{ $ex->icon_abbr }}"/></td>
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

@section('scripts')
    <script>
        $(".icon_abbr_input").keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == '13') {
                if (confirm('Weet u zeker dat u deze waarde wilt opslaan?')) {
                    var TableURL = '{{ action('Admin\ExpansionController@saveIconAbbr') }}';

                    var formData = {
                        value: this.value,
                        id: this.id
                    };

                    $.ajax({
                        url: TableURL,
                        type: 'POST',
                        data: formData,
                        success: function(data) {
                            alert('succes');
                        },
                        error: function (data) {
                            alert('error');
                        }
                    });
                }else{

                }
            }
        });
    </script>
@endsection
