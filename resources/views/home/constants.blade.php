@extends('_layouts.app')

@section('title')
    Constants
@endsection

@section('description')
    Constants
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="display-4">Constant</h1>
        <p class="lead">This is a simple display of &laquo; constants &raquo;</p>
        <hr class="my-4">

        <table id="table" class="table table-striped table-dark">
            <thead>
            <tr>
                <th>Application</th>
                <th>Constant Name</th>
                <th>Constant Value</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($informationsByApplication as $applicationName => $appli)
                @foreach ($appli["constants"] as $constantName => $constantValue)
                    <tr>
                        <td>{{ $applicationName }}</td>
                        <td>{{ $constantName }}</td>
                        <td>{{ $constantValue }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
