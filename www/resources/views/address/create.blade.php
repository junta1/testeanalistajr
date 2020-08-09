@extends('layouts.app')
@section('content')
    @if (count($errors)> 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">

        <div class="row">
            <div class='col-md-6'>
                <div class='col-md-10'>
                    <h3>Cadastrar novo Endereço</h3>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-6'>
                {{ Form::open(array('route' => ['address.client', $client['idClient']],'method' => 'post')) }}

{{--                <form action="{{ route('address.client', ['idClient' => $client['idClient']]) }}" method="post">--}}

                    <div class="form-group">
                        {{ Form::label('zipcode', 'CEP:') }}
                        {{ Form::text('zipcode',null,array('class'=>'form-control','autofocus'))  }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('publicPlace', 'Logadouro:') }}
                        {{ Form::text('publicPlace',null,array('class'=>'form-control','autofocus'))  }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('neighbordhood', 'Bairro:') }}
                        {{ Form::text('neighbordhood',null,array('class'=>'form-control','autofocus'))  }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('complement', 'Complemento:') }}
                        {{ Form::text('complement',null,array('class'=>'form-control','autofocus'))  }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('number', 'Número:') }}
                        {{ Form::text('number',null,array('class'=>'form-control','autofocus'))  }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('city', 'Cidade:') }}
                        {{ Form::text('city',null,array('class'=>'form-control','autofocus'))  }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('state', 'Estado:') }}
                        {{ Form::text('state',null,array('class'=>'form-control','autofocus'))  }}
                    </div>

                    <div class="row">
                        <div class='col-md-33' text-center>
                            <a href="{{ url('client/' . $client['idClient']) }}"
                               class="btn btn-dark">Voltar</a>
                        </div>
                        <div class="col-md-3">
                            {{ Form::submit('Cadastrar',array('class' => 'btn btn-success')) }}

                            {{ Form::close() }}
                        </div>
                    </div>
{{--                </form>--}}
            </div>
        </div>

    </div>
@endsection
