<?php

namespace Mazecodec\ArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Mazecodec\ArtisanMaker\Shared\Enums\ArtisanMakerTypes;

class ServiceMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:service {name} {--i|interface= : The name of the interface} {--a|action= : The name of the action}';
    protected $description = 'Create a service class';

    public function __construct(Filesystem $files)
    {
        $this->type = ArtisanMakerTypes::Service->value;

        parent::__construct($files);
    }

    protected function buildClass($name): string
    {
        if ($interfaceName = $this->option('interface')) {
            $stub = $this->addInterfaceOption($interfaceName);
        } else {
            $stub = $this->files->get($this->getStub());
        }

        if ($actionName = $this->option('action')) {
            $this->addActionOption($actionName);
        }

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * @param  bool|array|string  $interfaceName
     * @return string
     * @throws FileNotFoundException
     */
    public function addInterfaceOption(bool|array|string $interfaceName): string
    {
        $namespace = $this->namespaceFromConfig(ArtisanMakerTypes::Interface);
        $interfaceUseNamespace = "$namespace\\$interfaceName";

        if (!$this->checkInterfaceExists($interfaceUseNamespace)) {
            if ($this->confirm("The {$interfaceName} does not exist in ".$namespace.", do you want to create one?", true)) {
                $this->callSilently('make:interface', [
                    'name' => $interfaceName
                ]);
            }
        }

        $stub = $this->files->get($this->getClassImplementInterfaceStub());

        $this->replaceInterfaceUseNamespace($stub, $interfaceUseNamespace)->replaceInterfaceClass($stub, $interfaceName);

        return $stub;
    }

    protected function checkInterfaceExists($interfaceUseNamespace): bool
    {
        $paths = explode('\\', $interfaceUseNamespace);
        array_shift($paths);

        $filename = $this->laravel['path'].'/'.implode('/', $paths).'.php';

        return file_exists($filename);
    }

    protected function getClassImplementInterfaceStub(): string
    {
        return __DIR__.'/stubs/class-implement-interface.stub';
    }

    protected function replaceInterfaceClass(&$stub, $interfaceName): self
    {
        $stub = Str::replace("{{ interfaceName }}", $interfaceName, $stub);

        return $this;
    }

    protected function replaceInterfaceUseNamespace(&$stub, $interfaceUseNamespace): self
    {
        $stub = Str::replace("{{ interfaceUseNamespace }}", $interfaceUseNamespace, $stub);

        return $this;
    }

    /**
     * @param  bool|array|string  $actionName
     * @return void
     */
    public function addActionOption(bool|array|string $actionName): void
    {
        $namespace = $this->namespaceFromConfig(ArtisanMakerTypes::Action);
        $actionUseNamespace = "$namespace\\$actionName";

        if (!$this->checkInterfaceExists($actionUseNamespace)) {
            if ($this->confirm("The {$actionName} does not exist in ".$namespace.", do you want to create one?", true)) {
                $this->callSilently('make:action', [
                    'name' => $actionName
                ]);
            }
        }
    }
}
