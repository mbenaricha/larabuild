@extends('layouts.app')

@section('title', 'Customers defined constantes')

@section('stylecss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
@endsection

@section('scriptjs')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>


    <script type="text/javascript">
        var t = $('#example').DataTable();
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
                    var select = document.getElementById("custidselect");
                    select.options.length = 0;
                    for (var index in cachedData['applis']) {
                        select.options[select.options.length] = new Option(index, index);
                    }

                    // constants list
                    for (var custid in cachedData['custumconsts']) {
                        // cachedData.push(custid);
                        for (setupvar in cachedData['custumconsts'][custid]) {
                            t.row.add([custid, setupvar, cachedData['custumconsts'][custid][setupvar]]).draw(false);
                        }
                    }
                }
            });
        });
    </script>



@endsection


@section('content')

    <form id="myform" class="my-4">
        <h1>List of defined constantes</h1>
        <div class="row">
            <div class="form-group col-6">
                <label for="custidlist">Customer ids filtering:</label>
                <select multiple class="form-control" id="custidselect">

                </select>
            </div>
        </div>

        <button type="button" class="btn btn-success btn-block" id='btnSubmit'>Load</button>
    </form>

    <hr class="my-5">


    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Custid</th>
            <th>Setup Var</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>Custid</th>
            <th>Setup Var</th>
            <th>Value</th>
        </tr>
        </tfoot>
    </table>
@endsection
