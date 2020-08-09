@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" align="center">Lista de clientes</div>
                    <a href="{{ url('client/create') }}"
                       class="btn btn-xs btn-success pull-right">Adicionar novo Cliente</a>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class='row'>
                            <div class='col-md-12'>
                                <div class="table-responsive"/>
                                <table class="table">
                                    <thead>
                                    <th>Id</th>
                                    <th>Nome da Empresa</th>
                                    <th>CNPJ</th>
                                    <th>Nome do responsável</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Ação</th>
                                    </thead>

                                    @if(!empty($clients))
                                        @foreach ($clients as $client)
                                            <tbody>
                                            <tr>
                                                <td>{{$client['idClient']}}</td>
                                                <td>{{$client['companyName']}}</td>
                                                <td>{{$client['cnpj']}}</td>
                                                <td>{{$client['telephone']}}</td>
                                                <td>{{$client['responsibleName']}}</td>
                                                <td>{{$client['email']}}</td>
                                                <td>
                                                    <div>
                                                        <a href="{{ url('client/' . $client['idClient']) }}"
                                                           class="btn btn-xs btn-primary pull-right">Visualizar</a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ url('client/edit/' . $client['idClient']) }}"
                                                           class="btn btn-xs btn-warning pull-right">Edit</a>
                                                    </div>
                                                    <div>
                                                        {{ Form::open(['method' => 'DELETE','route'=>['client.destroy',$client['idClient']]]) }}

                                                        {{ Form::submit('Excluir',array('class' => 'btn btn-xs btn-danger pull-right')) }}

                                                        {{ Form::close() }}
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    @endif

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <div class="container">--}}

{{--        <h1>Laravel 5.8 Datatables Tutorial <br/> HDTuto.com</h1>--}}

{{--        <table class="table table-bordered data-table">--}}

{{--            <thead>--}}

{{--            <tr>--}}
{{--                <th>Email</th>--}}

{{--                <th width="100px">Action</th>--}}
{{--            </tr>--}}

{{--            </thead>--}}

{{--            <tbody>--}}

{{--            </tbody>--}}

{{--        </table>--}}

{{--    </div>--}}


{{--    <script type="text/javascript">--}}

{{--        $(function () {--}}

{{--            var table = $('.data-table').DataTable({--}}

{{--                processing: true,--}}

{{--                serverSide: true,--}}

{{--                ajax: "{{ route('clients.index') }}",--}}
{{--                data: [{'email':'rafael'}],--}}
{{--                columns: [--}}

{{--                    {data: 'email', name: 'email'},--}}

{{--                    {data: 'action', name: 'action', orderable: false, searchable: false},--}}
{{--                ]--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
@endsection
