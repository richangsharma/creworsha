<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
class CustomUploadHandler extends UploadHandler
{
    protected function trim_file_name($file_path, $name, $size, $type, $error, $index, $content_range) {
        $name = parent::trim_file_name($file_path, $name, $size, $type, $error, $index, $content_range);
$ext = strrchr($name,".");
$enc = md5(time().uniqid());
$enc = md5($name.$enc);
$enc = md5($enc);
$name = $enc;
return $name.$ext;
    }
}

$upload_handler = new CustomUploadHandler();
