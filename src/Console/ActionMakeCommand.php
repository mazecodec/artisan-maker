<?php

namespace Mazecodec\ArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Mazecodec\ArtisanMaker\Shared\Enums\ArtisanMakerTypes;

class ActionMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:action {name}';
    protected $description = 'Create an action class';

    public function __construct(Filesystem $files)
    {
        $this->type = ArtisanMakerTypes::Action->value;
        parent::__construct($files);
    }

}
