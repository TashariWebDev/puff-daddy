<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Storage;

class DeleteDocumentsDailyCommand extends Command
{
    protected $signature = 'delete:documents-daily';

    protected $description = 'Delete documents daily to maintain server disk usage';

    public function handle(): void
    {
        File::cleanDirectory(Storage::disk('public')->path('documents'));
    }
}
