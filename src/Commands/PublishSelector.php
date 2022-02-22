<?php

namespace Jbohme\LaravelEnvironmentSelector\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PublishSelector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish-env-selector';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modify app/bootstrap.php by enabling the environment selector.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(): void
    {
        $this->newBootstrap();
        return;
    }

    /**
     * Modify app/bootstrap.php by enabling the environment selector.
     * @return void
     */
    private function newBootstrap(): void
    {
        if (!File::exists(base_path('env-selector.json'))) {
            $this->warn('First you have to run "php artisan vendor:publish --tag=laravel-env-selector".');
            return;
        }
        $config = json_decode(file_get_contents(base_path('env-selector.json')), true);
        if ($config['publish']) {
            $this->warn('The bootstrap/app.php has already been modified.');
            return;
        }
        $file_path = base_path('bootstrap/app.php');
        try {
            if (!File::exists($file_path)) {
                $this->warn("{$file_path} does not exist.");
                return;
            }

            $file = file($file_path);
            $needle = false;
            $count = count($file) - 1;
            for ($i = $count; $i >= ($count - 5); --$i) {
                if (false !== stripos($file[$i], 'return')) {
                    $needle = $i;
                }
                if (is_int($needle)) {
                    break;
                }
            }

            if (!is_int($needle)) {
                $this->warn('Could not find return statement in app.php.');
            } else {
                $selector = file(dirname(__DIR__) . '/Stubs/selector.stub');

                array_splice($file, $needle, 0, $selector);
                if (!File::put($file_path, $file)) {
                    $this->error('Could not bootstrap app.php');
                } else {
                    $this->comment('App.php bootstrapped');
                    $config['publish'] = true;
                    File::put(base_path('env-selector.json'), json_encode($config, JSON_PRETTY_PRINT));
                }
            }
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());
            Log::critical($exception->getMessage(), ['Exception' => $exception]);
        }
    }
}
