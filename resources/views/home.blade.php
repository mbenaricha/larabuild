@extends('layouts.app')

@section('title', 'Builder infos home')

@section('stylecss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
@endsection

@section('scriptjs')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>


    <script type="text/javascript">
        var tconsts = $('#constsinfos').DataTable();
        var tvars = $('#varsinfos').DataTable();
        var cachedData = {};

        $(document).on('click', '#btnSubmit', function () {
            $(this).text('Loading...').attr('disabled', true);

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});

            $.ajax({
                url: "{{ url('/all') }}",
                type: 'GET',
                {{--        data: 'custid=dp2p&svar1=SETUP_EMAIL',--}}
                dataType: 'json',
                error: function (err) {
                    $('#btnSubmit').text('Load').attr('disabled', false);
                    console.error(err);
                },

                success: function (data) {
                    $('#btnSubmit').text('Load').attr('disabled', false);
                    cachedData = data;

                    // appli list
                    var select = document.getElementById("custidlist");
                    select.options.length = 0;
                    for (var index in cachedData['applis']) {
                        select.options[select.options.length] = new Option(index, index);
                    }

                    // constants list
                    for (var custid in cachedData['custumconsts']) {
                        for (setupvar in cachedData['custumconsts'][custid]) {
                            tconsts.row.add([custid, setupvar, cachedData['custumconsts'][custid][setupvar]]).draw(false);
                        }
                    }

                    // vars list
                    for (var custid in cachedData['custumvars']) {
                        for (varname in cachedData['custumvars'][custid]) {
                            tvars.row.add([custid, varname, cachedData['custumvars'][custid][varname]]).draw(false);
                        }
                    }
                }
            });
        });
    </script>



@endsection

@section('content')
    <form id="myform" class="my-4">
        <h1>List of defined Variables & Constantes</h1>
        <div class="row">
            <div class="form-group col-6">
                <label for="custidlist">Customer ids filtering:</label>
                <select multiple class="form-control" id="custidselect">

                </select>
            </div>
        </div>

        <button type="button" class="btn btn-success btn-block" id='btnSubmit'>Load</button>
    </form>



    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <hr class="my-5">
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#custids" role="tab" aria-controls="custids"
               aria-selected="false">Custids</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#constspane" role="tab"
               aria-controls="consts" aria-selected="true">Constantes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#varspane" role="tab" aria-controls="vars"
               aria-selected="false">Variables</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="custids" role="tabpanel" aria-labelledby="contact-tab">
            @include('part.custids')
        </div>
        <div class="tab-pane fade show active" id="constspane" role="tabpanel" aria-labelledby="consts-tab">
            @include('part.constants')
        </div>
        <div class="tab-pane fade" id="varspane" role="tabpanel" aria-labelledby="vars-tab">
            @include('part.variables')
        </div>
    </div>

@endsection
