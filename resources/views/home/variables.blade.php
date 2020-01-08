@extends('_layouts.app')

@section('title')
    Variables
@endsection

@section('description')
    Variables
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="display-4">Variables</h1>
        <p class="lead">This is a simple display of &laquo; variables &raquo;</p>
        <hr class="my-4">

        <table id="table" class="table table-striped table-dark table-responsive">
            <thead>
            <tr>
                <th>Application</th>
                <th>Variable Name</th>
                <th>Variable Value</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($informationsByApplication as $applicationName => $information)
                @foreach ($information["variables"] as $variableName => $variableValue)
                    <tr>
                        <td>{{ $applicationName }}</td>
                        <td>{{ $variableName }}</td>
                        <td>{{ print_variable_value($variableValue) }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
