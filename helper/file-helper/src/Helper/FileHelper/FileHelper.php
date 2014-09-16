<?php

namespace Helper\FileHelper;

class FileHelper{

    public static  $FILE_SIZE = 100000;

    public static $MINE_TYPE = array(

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            );

    /*
     * 上传文件
     *
     * @param file file resource
     *
     * @param filePath ,the place of file where to stored
     *
     * @param $folderMode folder's mode
     *
     * @param $fileName ,the new fileName,if it exists,not generate new file name
     *
     * @param $algo if fileName if not extist,we will use this algorithm to encrypt the file name
     *
     *
     */
    public static function upload($file,  $filePath, $folderMode = '0777',  $fileName='', $algo = 'md5')
    {

        if (!$file->isValid()) {
            return false;
        }

        $typeFlag = self::testFileType($file);
        if (!$typeFlag) {
            return false;
        }

        $sizeFlag = self::testFileSize($file);
        if (!$sizeFlag) {
            return false;
        }

        $oldFileName = $file->getClientOriginalName();

        if ($fileName == '') {
            $fileName = self::generateFileName($file, $algo);
        } else {
            $fileName = $oldFileName;
        }
        
        $floderFlag = self::createMultiDir($filePath, $folderMode);

        if (!$floderFlag) {
            return false;
        }

         $file->move($filePath, $fileName);

         return $fileName;
    }

    /*
     * set the file type of what you accepted
     *
     * @param mimeType array | string
     *
     */
    public static function setFileType($mimeType)
    {
        if (!is_array($mimeType)) {
            $mimeType = (array)$mimeType;
        }
        self::$MIME_TYPE = $mimeType;
    }

    /*
     *    
     * test the file's type,
     * if its's type  is not in FILE_TYPE    
     * return false;else return true 
     *    
     *   @param $file fileResource 
     *    
     *   @return bool 
     */
    public static function testFileType($file)
    {
        $type = $file->getClientMimeType();
        if (!array_search($type, self::$MINE_TYPE)) {
            return false;
        }
        return true;
    }


    /*
     * set the file size of what you accepted
     *
     * @param filesize int 
     *
     */
    public static function setFileSize($fileSize)
    {
        self::$FILE_SIZE = intval($fileSize);
    }


    /*
     *    
     * test the file's size,
     * if its's size is  less than FILE_SIZE
     * return false;else return true 
     *    
     *   @param $file fileResource 
     *    
     *   @return bool 
     */
    public static function testFileSize($file)
    {
        $size = filesize($file);
        if ($size>self::$FILE_SIZE) {
            return false;
        }
        return true;
    }

    /*
     *
     * 生成新的文件名
     *
     * @param $fileName, the upload file's name
     *
     * @param $algo , using an algorithm to encrypt file name
     *
     * @return string 
     *
     */
    public static function generateFileName($file, $algo = 'md5')
    {
        $ext = $file->getClientOriginalExtension();
        $fileName = $file->getClientOriginalName();
        $fileName = substr($fileName,0,strlen($fileName)-strlen($ext)-1);
        if (function_exists($algo)) {
            $fileName = $algo($fileName);
        } else {
            $fileName = md5($fileName);
        }
        $fileName .= '.'.$ext;
        return $fileName;
    }

    /*
     *
     * create directory 
     * 
     * @param $dirName string
     *
     * @param $mode  int
     *
     */
    public static  function createMultiDir($dirName, $mode = 0777)
    {
        if (is_dir($dirName) || @mkdir($dirName,$mode)) {
            return true;
        } else {
            $parent_dir = dirname($dirName);
            // Terminal case; there is no parent directory to create.
            if ($parent_dir == $dirName) {
                return true;
            }
            return (self::createMultiDir($parent_dir) && @mkdir($dirName,$mode));
        }
    }

}
