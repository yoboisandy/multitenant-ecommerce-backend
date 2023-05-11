<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Str;

class GenerateServiceRespository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:servicerepo {model} {--s : Generate a service class} {--r : Generate a repository class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genarate service and repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = $this->argument('model');

        if ($model) {
            if ($this->option('s') && $this->option('r')) {
                // create a repository file in app/Repositories
                $repositoryFile = app_path('Repositories/' . $model . 'Repository.php');
                if (file_exists($repositoryFile)) {
                    $this->error('Repository file already exists!');
                } else {
                    $this->createRepository($repositoryFile, $model);
                }
                // create a service file in app/Services
                $serviceFile = app_path('Services/' . $model . 'Service.php');
                if (file_exists($serviceFile)) {
                    $this->error('Service file already exists!');
                } else {
                    $this->createService($serviceFile, $model);
                }
            } elseif ($this->option('s')) {
                // create a service file in app/Services
                $serviceFile = app_path('Services/' . $model . 'Service.php');
                if (file_exists($serviceFile)) {
                    $this->error('Service file already exists!');
                } else {
                    $this->createService($serviceFile, $model, false);
                }
            } elseif ($this->option('r')) {
                // create a repository file in app/Repositories
                $repositoryFile = app_path('Repositories/' . $model . 'Repository.php');
                if (file_exists($repositoryFile)) {
                    $this->error('Repository file already exists!');
                } else {
                    $this->createRepository($repositoryFile, $model);
                }
            } else {
                $this->error('Please select service(-s) or repository(-r)');
            }
        }
    }

    /**
     * Create a service file in app/Services
     *
     * @param string $serviceFile
     * @param string $model
     * @param string $incRepo (optional)
     * @return void
     */
    protected function createService($serviceFile, $model, $incRepo = true)
    {
        $modelUc = Str::camel($model);
        $serviceTemplate = str_replace(
            [
                '$MODEL$',
                '$MODEL_UC$'
            ],
            [
                $model,
                $modelUc
            ],
            $incRepo ?
                $this->getStub('service.repo') :
                $this->getStub('service')
        );
        file_put_contents($serviceFile, $serviceTemplate);
        $this->info('Service created successfully.');
    }

    public function createRepository($repositoryFile, $model)
    {
        $modelUc = Str::camel($model);
        $repositoryTemplate = str_replace(
            [
                '$MODEL$',
                '$MODEL_UC$'
            ],
            [
                $model,
                $modelUc
            ],
            $this->getStub('repository')
        );
        file_put_contents($repositoryFile, $repositoryTemplate);
        $this->info('Repository created successfully.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @param string $type
     * @return string
     */
    protected function getStub($type)
    {
        return file_get_contents(base_path("stubs/$type.stub"));
    }
}
