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
                    <h1>Criar Enquete</h1>
                    <form method="post" action="{{route('poll.store')}}">

                    @csrf
                        <div class="form-group">
                            <div class="form-group-title">
                                <label for="title">Título da Enquete</label>
                                <input required type="text" id="title" name="title" placeholder="Digite o título da enquete">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="datetime-group">
                                <label for="start-date">Data de Inicio</label>
                                <input required type="date" id="start_date" name="start_date">
                            </div>
                            <div class="datetime-group">
                                <label for="start-time">Horário de Inicio</label>
                                <input required type="time" id="start_time" name="start_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="datetime-group">
                                <label for="end-date">Data de finalização</label>
                                <input required type="date" id="end_date" name="end_date">
                            </div>
                            <div class="datetime-group">
                                <label for="end-date">Horário de finalização</label>
                                <input required type="time" id="end_time" name="end_time">
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h2>Opções</h2>
                        <div class="options">
                            <div class="option">
                                <label for="option1">Opção 1</label>
                                <div class="option-content">
                                    <input type="text" required name="option[1][content]" placeholder="Digite uma opção">
                                </div>
                            </div>
                            <div class="option">
                                <label for="option2">Opção 2</label>
                                <div class="option-content">
                                    <input type="text" required name="option[2][content]" placeholder="Digite uma opção">
                                </div>
                            </div>
                            <div class="option">
                                <label for="option3">Opção 3</label>
                                <div class="option-content">
                                    <input type="text" required name="option[3][content]" placeholder="Digite uma opção">
                                </div>
                            </div>
                            <button type="button" class="add-option">Adicionar Opção</button>
                        </div>
                        <button type="submit" class="create-poll">Criar Enquete</button>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
    </x-app-layout>
</body>
</html>
