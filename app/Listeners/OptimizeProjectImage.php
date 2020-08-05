<?php

namespace App\Listeners;

use App\Events\ProjectSaved;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class OptimizeProjectImage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param ProjectSaved $event
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle(ProjectSaved $event)
    {
        $image = Image::make(Storage::get($event->project->image))
            ->widen(600)
            ->limitColors(255)
            ->encode();
        Storage::put($event->project->image, (string) $image);
    }
}
