<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class ResetPostsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Очистить таблицу posts и сбросить автоинкремент ID на 1';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('Вы уверены? Все посты будут удалены!')) {
            $this->info('Отменено.');
            return;
        }

        // Очистить таблицу и сбросить автоинкремент
        DB::table('posts')->truncate();
        $this->info('✓ Все посты удалены');
        $this->info('✓ Автоинкремент ID сброшен на 1');

        $this->info('');
        $this->line('✅ Таблица posts успешно сброшена!');
        $this->line('   Следующий пост получит ID = 1');
    }
}
