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
                    <h3>Cadastrar novo Cliente</h3>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-6'>
                {{ Form::open(array('route' => 'client.store','method' => 'post')) }}

                <div class="form-group">
                    {{ Form::label('companyName', 'Nome do empresa:') }}
                    {{ Form::text('companyName',null,array('class'=>'form-control','autofocus'))  }}
                </div>

                <div class="form-group">
                    {{ Form::label('cnpj', 'CNPJ:') }}
                    {{ Form::text('cnpj',null,array('class'=>'form-control','autofocus'))  }}
                </div>

                <div class="form-group">
                    {{ Form::label('telephone', 'Telefone:') }}
                    {{ Form::text('telephone',null,array('class'=>'form-control','autofocus'))  }}
                </div>

                <div class="form-group">
                    {{ Form::label('responsibleName', 'Nome do responsável:') }}
                    {{ Form::text('responsibleName',null,array('class'=>'form-control','autofocus'))  }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'E-mail:') }}
                    {{ Form::text('email',null,array('class'=>'form-control','autofocus'))  }}
                </div>

                <div class="row">
                    <div class='col-md-33' text-center>
                        <a href="{{ url('clients') }}" class="btn btn-dark">Voltar</a>
                    </div>
                    <div class="col-md-3">
                        {{ Form::submit('Cadastrar',array('class' => 'btn btn-success')) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
