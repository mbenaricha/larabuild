@extends('_layouts.app')

@section('title'){{ __('Welcome') }}@endsection

@section('description'){{ __('Welcome') }}@endsection

@section('content')
  <section class="jumbotron">
    <div class="container-fluid">
      <h1 class="display-4">Visualiser</h1>
      <p class="lead">This is a simple &laquo; information by applications &raquo;</p>
      <hr class="my-4">

      <table id="table" class="table table-striped table-dark">
        <thead>
        <tr>
          <th>Appli</th>
          <th>Constant Name</th>
          <th>Constant Value</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($informationsByApplication as $appliName => $appli)
          @foreach ($appli["constant"] as $constName => $constValue)
            <tr>
              <td>{{$appliName}}</td>
              <td>{{$constName}}</td>
              <td>{{$constValue}}</td>
            </tr>
          @endforeach
        @endforeach
        </tbody>
      </table>
      </div>
    </section>
@endsection
