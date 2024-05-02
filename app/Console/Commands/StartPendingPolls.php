<?php

namespace App\Console\Commands;

use App\Enums\PollStatus;
use App\Models\Poll;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log; // Importe a classe Log

class StartPendingPolls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poll:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'starts pending polls';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pendingPoll = Poll::query()->where([
            ['start_at', '<=' , now()],
            ['end_at', '>=' , now()],
            ['status', PollStatus::NAO_INICIADA->value]
        ])->update(['status'=> PollStatus::EM_ANDAMENTO->value]);        

        return Command::SUCCESS;
    }
}
