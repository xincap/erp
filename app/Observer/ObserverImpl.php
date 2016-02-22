<?php

namespace XinGroup\Observer;

use XinGroup\Observer\ObserverInterface;
use Illuminate\Database\Eloquent\Model;

class ObserverImpl implements ObserverInterface {
    
    public function created(Model $model) {
        return true;
    }

    public function creating(Model $model) {
        return true;
    }

    public function deleted(Model $model) {
        return true;
    }

    public function deleting(Model $model) {
        return true;
    }

    public function restored(Model $model) {
        return true;
    }

    public function restoring(Model $model) {
        return true;
    }

    public function saved(Model $model) {
        return true;
    }

    public function saving(Model $model) {
        return true;
    }

    public function updated(Model $model) {
        return true;
    }

    public function updating(Model $model) {
        return true;
    }


}
