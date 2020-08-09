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
                        <a href="{{ URL::previous() }}" class="btn btn-dark">Voltar</a>
                    </div>
                    <div class="col-md-3">
                        {{ Form::submit('Cadastrar',array('class' => 'btn btn-success')) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Adicionando Javascript -->
    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#publicPlace").val("");
                $("#neighbordhood").val("");
                $("#city").val("");
                $("#state").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#zipcode").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#publicPlace").val("...");
                        $("#neighbordhood").val("...");
                        $("#city").val("...");
                        $("#state").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#publicPlace").val(dados.logradouro);
                                $("#neighbordhood").val(dados.bairro);
                                $("#city").val(dados.localidade);
                                $("#state").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>
@endsection
