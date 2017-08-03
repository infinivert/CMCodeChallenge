<?php

namespace JCC\Models;

class CreditModel extends BaseModel
{
    // Every Model MUST have a table name and a list of database fields (besides an id field) defined. The id field is optional.
    public static $table = 'credits';
    public static $fields = ['label','bonus','cost'];

    public $label;
    public $bonus;
    public $cost;

}