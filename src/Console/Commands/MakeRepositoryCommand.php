<?php

namespace Czim\Repository\Console\Commands;

use Czim\Repository\BaseRepository;
use Czim\Repository\RepositoryServiceProvider;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepositoryCommand extends GeneratorCommand
{
    /** @var string */
    protected $name = 'make:repository';

    /** @var string */
    protected $description = 'Create a new Eloquent model repository class';

    protected string $namespace = 'App\\Repositories';

    protected string $base = BaseRepository::class;

    protected string $suffix = 'Repository';

    protected string $models = 'App';

    /** @var string */
    protected $type = 'Repository';


    /**
     * @param Filesystem $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        $this->loadConfig();

        parent::__construct($fileSystem);
    }


    /**
     * Load the configuration for the command.
     */
    protected function loadConfig(): void
    {
        $this->namespace = config('repository.generate.namespace', $this->namespace);
        $this->base      = config('repository.generate.base', $this->base);
        $this->suffix    = config('repository.generate.suffix', $this->suffix);
        $this->models    = config('repository.generate.models', $this->models);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return RepositoryServiceProvider::$packagePath . '/stubs/repository.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    public function getDefaultNamespace($rootNamespace): string
    {
        return $this->namespace;
    }

    /**
     * Build the class with the given name.

     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);

        $modelName = $this->getModelClass($name);

        $this->replaceModelNamespace($stub, $modelName)
            ->replaceModelClass($stub, $modelName)
            ->replaceBaseRepositoryNamespace($stub, $this->base)
            ->replaceBaseRepositoryClass($stub, $this->base);

        return $stub;
    }

    /**
     * Replace the probable namespace for the given stub.
     */
    protected function replaceModelNamespace(string &$stub, string $name): self
    {
        $stub = str_replace('DummyModelNamespace', $name, $stub);

        return $this;
    }

    /**
     * Replace the probable model class name for the given stub.
     */
    protected function replaceModelClass(string &$stub, string $name): self
    {
        $names = explode('\\', $name);
        $class = array_pop($names);

        $stub = str_replace('DummyModelClass', $class, $stub);

        return $this;
    }

    /**
     * Get the class name of the probable associated model.
     */
    protected function getModelClass(string $name): string
    {
        $modelClass = $this->getModelNameInput();

        // Generate the model class from the repository class name if not explicitly set
        if (!$modelClass) {
            $repositoryClass = str_replace($this->getNamespace($name) . '\\', '', $name);
            $class           = str_replace($this->suffix, '', $repositoryClass);

            $modelClass = Str::singular($class);
        }

        // Append the expected model namespace if not namespaced yet
        if (!str_contains($modelClass, '\\')) {
            $modelClass = $this->models . '\\' . $modelClass;
        }

        return $modelClass;
    }

    /**
     * Replace the default base repository class namespace for the given stub.
     */
    protected function replaceBaseRepositoryNamespace(string &$stub, string $name): self
    {
        $stub = str_replace('BaseRepositoryNamespace', $name, $stub);

        return $this;
    }

    /**
     * Replace the default base repository class name for the given stub.
     */
    protected function replaceBaseRepositoryClass(string &$stub, string $name): self
    {
        $baseClass = str_replace($this->getNamespace($name) . '\\', '', $name);
        $stub      = str_replace('BaseRepositoryClass', $baseClass, $stub);

        return $this;
    }

    /**
     * Get the desired model class name from the input.
     */
    protected function getModelNameInput(): string
    {
        return trim($this->argument('model'));
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository class'],
            ['model', InputArgument::OPTIONAL, 'The name of the model class'],
        ];
    }
}
