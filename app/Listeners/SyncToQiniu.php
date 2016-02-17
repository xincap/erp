<?php

namespace XinGroup\Listeners;

use XinGroup\Events\FileUpload;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use Storage;

class SyncToQiniu implements ShouldQueue
{
    use InteractsWithQueue;

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
     * Handle the event.
     *
     * @param  FileUpload  $fileUpload
     * @return void
     */
    public function handle(FileUpload $fileUpload)
    {
        if(!file_exists($fileUpload->getLocalPath())){
            Log::error('SyncToQiniu file ' .  $fileUpload->getLocalPath() .' not exits');
            return true;
        }
        $disk = Storage::disk('qiniu');
        $content    = file_get_contents($fileUpload->getLocalPath());
        $upload = $disk->put($fileUpload->getFilePath(), $content);
        if(!$upload){
            Log::error('SyncToQiniu file ' .  $fileUpload->getFilePath() .' upload error');
            return true;
        }
        Log::info('SyncToQiniu file ' .  $fileUpload->getRemotePath());
    }
}
