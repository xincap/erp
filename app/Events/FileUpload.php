<?php

namespace XinGroup\Events;

use XinGroup\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FileUpload extends Event
{
    use SerializesModels;
    
    protected $filePath;
    
    protected $localPath;

    /**
     * 
     * @param string $filePath 文件相对Public路径
     */
    public function __construct($filePath)
    {
        $this->filePath = '/' . ltrim($filePath,'/');
        $this->localPath    = public_path() . $this->filePath;
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function getLocalPath() {
        return $this->localPath;
    }
    
    public function getRemotePath(){
        $domain   = config('filesystems.disks.qiniu.domain');
        return 'http://' . $domain . $this->getFilePath();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
