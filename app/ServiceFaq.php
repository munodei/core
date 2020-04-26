<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceFaq extends Model
{
    protected $table = 'service_faqs';
    protected $fillable = ['id', 'service_id', 'title', 'description', 'status', 'deleted_at', 'created_at', 'updated_at'];
    public function parentService(){
        return $this->belongsTo(Service::class);
    }

}
