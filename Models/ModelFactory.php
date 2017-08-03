<?php

namespace JCC\Models;

class ModelFactory
{
    // Creates an instance of a specified model, and injects the needed PDO connection object.
    public static function make($modelName, $id = null)
    {
        $modelName = (file_exists(APPPATH . 'Models' . DIRECTORY_SEPARATOR . $modelName . '.php')) ? $modelName : $modelName . 'Model';

        try {
            $modelClassName = '\\JCC\\Models\\' . $modelName;
            $model = new $modelClassName(\JCC\Controllers\Database::connection());
        } catch (Exception $e) {
            error_log('ModelFactory::make() - ' . var_export($e,true));
        }

        if ($id && is_int($id) && $id > 0) {
            $model->id = $id;
            $model->read();
        }

        return $model;
    }
}