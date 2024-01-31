<?php

namespace Mazecodec\ArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Mazecodec\ArtisanMaker\Shared\Enums\ArtisanMakerTypes;

class InterfaceMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:interface {name}';
    protected $description = 'Create an interface contract';

    public function __construct(Filesystem $files)
    {
        $this->type = ArtisanMakerTypes::Interface->value;
        parent::__construct($files);
    }

    protected function getStub(): string
    {
        return __DIR__.'/stubs/interface.stub';
    }
}
