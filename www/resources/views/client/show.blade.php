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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" align="center">Dados do cliente</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class='row'>
                            <div class='col-md-12'>
                                <table class="table">
                                    <thead>
                                    <th>Nome da Empresa</th>
                                    <th>CNPJ</th>
                                    <th>Nome do responsável</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Ação</th>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>{{$client['companyName']}}</td>
                                        <td>{{$client['cnpj']}}</td>
                                        <td>{{$client['responsibleName']}}</td>
                                        <td>{{$client['telephone']}}</td>
                                        <td>{{$client['email']}}</td>
                                        <td>
                                            <div>
                                                <a href="{{ url('client/edit/' . $client['idClient']) }}"
                                                   class="btn btn-primary btn-sm">Editar</a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="card-footer" align="center">Endereço do cliente</div>
                                <a href="{{ url('address/create/'. $client['idClient']) }}"
                                   class="btn btn-xs btn-success pull-right">Adicionar novo Endereço</a>

                                <table class="table">
                                    <thead>
                                    <th>CEP</th>
                                    <th>Logradouro</th>
                                    <th>Bairro</th>
                                    <th>Complemento</th>
                                    <th>Número</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Ação</th>
                                    </thead>

                                    @foreach($addresses as $address)
                                        <tbody>
                                        <tr>
                                            <td>{{$address['zipcode']}}</td>
                                            <td>{{$address['publicPlace']}}</td>
                                            <td>{{$address['neighbordhood']}}</td>
                                            <td>{{$address['complement']}}</td>
                                            <td>{{$address['number']}}</td>
                                            <td>{{$address['city']}}</td>
                                            <td>{{$address['state']}}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ url('address/'.$address['idAddress'] .'/edit') }}"
                                                       class="btn btn-primary btn-sm">Editar</a>
                                                </div>

                                                <div>
                                                    {{ Form::open(['method' => 'DELETE','route'=>['address.destroy',$address['idAddress'], $client['idClient']]]) }}

                                                    {{ Form::submit('Excluir',array('class' => 'btn btn-danger btn-sm')) }}

                                                    {{ Form::close() }}
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>

                            </div>
                        </div>

                        <div class="row">
                            <div class='col-md-33' text-center>
                                <a href="{{ url('clients') }}" class="btn btn-dark">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
