@extends('_layouts.app')

@section('title'){{ __('Welcome') }}@endsection

@section('description'){{ __('Welcome') }}@endsection

@section('content')
    <section class="jumbotron">
      <div class ="container">
        <h1 class="display-4">Visualiser</h1>
        <p class="lead">This is a simple &laquo; information by applications &raquo;</p>
        {{-- <hr class="my-4"> --}}
        {{-- @php(dump($informationsByApplication)) --}}
        <div class="input-group col-3">
          <input id="constantNameInput" type="text" class="form-control" placeholder="Constant Name" aria-label="constantName">
        </div>
          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">Appli</th>
                <th scope="col">Constant Name</th>
                <th scope="col">Constant Value</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($informationsByApplication as $appliName => $appli)
              @foreach ($appli["constant"] as $constName => $constValue)
                <tr class="{{$constName}} constantRow">
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
