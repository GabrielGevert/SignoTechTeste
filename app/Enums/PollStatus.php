<?php 

namespace App\Enums;

enum  PollStatus : string {

    case NAO_INICIADA = 'Não iniciada';
    case EM_ANDAMENTO = 'Em andamento';
    case FINALIZADA = 'Finalizada';
}