@extends('layouts.app')

@section('title', 'Customers defined constantes')

@section('stylecss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
@endsection

@section('scriptjs')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>


    <script type="text/javascript">

        $(document).ready(function () {
            var table = $('#tableinfos').DataTable();
            var cachedData = {};

            $(document).on('click', '#btnSubmit', function () {
                $(this).text('Loading...').attr('disabled', true);

                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});

                $.ajax({
                    url: "{{ url('/all') }}",
                    type: 'GET',

                    dataType: 'json',
                    error: function (err) {
                        $('#btnSubmit').text('Load').attr('disabled', false);
                        // console.error(err);
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

                        // vars list
                        for (var custid in cachedData['custumvars']) {
                            // cachedData.push(custid);
                            for (varname in cachedData['custumvars'][custid]) {
                                table.row.add([custid, varname, cachedData['custumvars'][custid][varname]]).draw(false);
                            }
                        }
                    }
                }); // ajax
            }); // onclick
        }); // document ready

    </script>



@endsection


@section('content')

    <form id="myform" class="my-4">
        <h1>defined vars/constantes</h1>
        <div class="row">
            <div class="form-group col-6">
                <label for="custidselect">Customer ids filtering:</label>
                <select multiple class="form-control" id="custidselect">

                </select>
            </div>
        </div>

        <button type="button" class="btn btn-success btn-block" id='btnSubmit'>Load</button>
    </form>

    <hr class="my-5">


    <table id="tableinfos" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Custid</th>
            <th>Var</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>Custid</th>
            <th>Var</th>
            <th>Value</th>
        </tr>
        </tfoot>
    </table>

@endsection
