<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold">Todas as enquetes</h2>
                        <a href="{{ route('poll.create') }}" style="background-color: #10B981; color: #fff; padding: 0.75rem 1rem; border-radius: 0.375rem;">NOVA ENQUETE +</a>
                    </div>

                    
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left w-1/3">Titulo</th>
                                <th style="padding-right: 10px;" class="py-3 px-4 text-left w-1/3">Status</th> <!-- Mudado para padding-right -->
                                <th class="py-3 px-4 w-1/3" style="width: 33%;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($polls as $poll)
                        <tr class="border-t border-gray-200">
                            <td class="py-3 px-2 text-left w-1/3">{{$poll->title}}</td>
                            <td class="py-3 px-2 text-left w-1/3">{{$poll->status}}</td>
                                                        
                            <td class="py-3 px-4 w-1/3" style="text-align: right;"> 
                                <div class="flex justify-end" style="margin-right: 50px; margin-top: 5px">
                                    <a href="{{route('poll.edit', [$poll])}}" style="background-color: #3B82F6; color: #fff; padding: 0.5rem 0.75rem; border-radius: 0.375rem; margin-right: 10px;">Editar</a>
                                    <a href style="background-color: #F59E0B; color: #fff; padding: 0.5rem 0.75rem; border-radius: 0.375rem; margin-right: 10px;">Mostrar</a>
                                    <a href style="background-color: #EF4444; color: #fff; padding: 0.5rem 0.75rem; border-radius: 0.375rem;">Excluir</a>
                                </div>
                            </td> 
                        </tr> 
                        @endforeach
                        </tbody> 
                    </table> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
