<?php


namespace XinGroup\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Events\QueryExecuted;
use Log;
/**
 * Description of LogSql
 *
 * @author Administrator
 */
class LogSql implements ShouldQueue{
    
    use InteractsWithQueue;
    
    function handle(QueryExecuted $event){
        Log::error(var_export($event->bindings,true));
    }
}
