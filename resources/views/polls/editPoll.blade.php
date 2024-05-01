<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Enquete</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <x-app-layout>
        <div class="page-wrapper">
            <div class="container-card">
                <div class="card">
                    <h1>Editar Enquete</h1>
                    <h2> {{$poll->title}} </h2>
                    <form method="post" action="{{route('poll.update', [$poll])}}">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <div class="form-group-title">
                                <label for="title">Título da Enquete</label>
                                <input required type="text" id="title" name="title" placeholder="Digite o título da enquete" value="{{$poll->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="datetime-group">
                                <label for="start-date">Data de Inicio</label>
                                <input required type="date" id="start_date" name="start_date" value="{{$poll->start_date}}">
                            </div>
                            <div class="datetime-group">
                                <label for="start-time">Horário de Inicio</label>
                                <input required type="time" id="start_time" name="start_time" value="{{$poll->start_time}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="datetime-group">
                                <label for="end-date">Data de finalização</label>
                                <input required type="date" id="end_date" name="end_date" value="{{$poll->end_date}}">
                            </div>
                            <div class="datetime-group">
                                <label for="end-date">Horário de finalização</label>
                                <input required type="time" id="end_time" name="end_time" value="{{$poll->end_time}}">
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h2>Opções</h2>
                        <div class="options" x-data="{
                                optionsNumber: {{count($poll->options)}},
                                options: {{json_encode($poll->options)}}
                            }">
                            <template x-for="option, i in options">
                                <div class="option">
                                    <label></label>
                                    <div class="option-content">
                                    <input required="required" name="option[@{{ i }}][content]" id="title" type="text" class="validate" :placeholder="`Opção ` + (i + 1)" :value="option.content">
                                        <span class="remove-option" @click="options.splice(i, 1)">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            </template>
                            <button type="button" class="add-option">Adicionar Opção</button>
                        </div>
                        <button 
                        class="create-poll"
                        x-on:click="optionsNumber >= 3 ? optionsNumber-- : alert('A enquete deve ter no minimo 3 opções')"
                        type="submit"> Editar Enquete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
    </x-app-layout>
</body>
</html>
