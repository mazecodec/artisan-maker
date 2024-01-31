<?php

namespace Mazecodec\ArtisanMaker\Console;

use Illuminate\Support\Str;
use Mazecodec\ArtisanMaker\Shared\Enums\ArtisanMakerTypes;

trait FileGenerable
{
    protected function getStub(): string
    {
        return __DIR__.'/stubs/class.stub';
    }

    protected function replaceClass($stub, $name): string
    {
        $className = Str::replace($this->getNamespace($name).'\\', '', $name);

        $replace = [
            '{{ className }}' => $className,
        ];

        return Str::replace(array_keys($replace), array_values($replace), $stub);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->namespaceFromConfig();
    }

    private function namespaceFromConfig(?ArtisanMakerTypes $type = null): string
    {
        $type = Str::lower($type->value ?? $this->type);

        return config("artisan-maker.namespaces.{$type}");
    }

    protected function rootNamespace(): string
    {
        return $this->rootNamespaceFromConfig() ?: $this->laravel->getNamespace();
    }

    private function rootNamespaceFromConfig(?ArtisanMakerTypes $type = null): string
    {
        $rootNamespace = config("artisan-maker.namespace") ?? null;

        if (is_string($rootNamespace)) {
            return trim($rootNamespace).'\\';
        }

        $type = Str::lower($type->value ?? $this->type);
        $rootNamespace = config("artisan-maker.namespaces.{$type}");

        if (is_string($rootNamespace)) {
            $rootNamespaces = explode('\\', trim($rootNamespace));

            if (is_array($rootNamespaces) && count($rootNamespaces) >= 1) {
                array_pop($rootNamespaces);
                $rootNamespace = implode("\\", $rootNamespaces);
            }
        }

        return $rootNamespace.'\\';
    }

    protected function getPath($name)
    {
        $path = $this->directoryFromConfig();

        return $this->laravel->basePath().'/'.$path.'/'.$this->getNameInput().'.php';
    }

    private function directoryFromConfig(?ArtisanMakerTypes $type = null): string
    {
        $type = Str::lower($type->value ?? $this->type);

        return config("artisan-maker.directories.{$type}");
    }
}
