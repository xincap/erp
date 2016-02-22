<?php


namespace XinGroup\Listeners\Database;

use Illuminate\Database\Events\TransactionRolledBack;
use Log;
/**
 * Description of LogSql
 *
 * @author Administrator
 */
class RolledBack{
    
    function handle(TransactionRolledBack $event){
        Log::error($event->connection->getQueryLog());
    }
}
