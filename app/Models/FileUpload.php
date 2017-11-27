<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 27.11.2017
 * Time: 20:29
 */

namespace App\Models;

/**
 * Class FileUpload
 * @package App\Models
 */
class FileUpload
{
    /**
     * Получение пути для сохранения файла
     * @param $name
     * @return string
     */
    public static function getPath($name)
    {
        $path = substr(md5($name), -1) . DIRECTORY_SEPARATOR .  substr(md5($name), -2) . DIRECTORY_SEPARATOR;
        return DIRECTORY_SEPARATOR .'thumb' . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * Получение имени файла
     * @param $name
     * @return string
     */
    public static function getFileName($name)
    {
        $ext = explode('.', $name);
        $ext = $ext[count($ext ) - 1];
        $file = md5($name);
        return $file . '.' . $ext;
    }
}