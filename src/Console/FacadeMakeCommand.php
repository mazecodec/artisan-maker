<?php

namespace Mazecodec\ArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Mazecodec\ArtisanMaker\Shared\Enums\ArtisanMakerTypes;

class FacadeMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:facade {name}';
    protected $description = 'Create a facade class';

    public function __construct(Filesystem $files)
    {
        $this->type = ArtisanMakerTypes::Facade->value;
        parent::__construct($files);
    }

    protected function getStub(): string
    {
        return __DIR__.'/stubs/facade.stub';
    }
}
