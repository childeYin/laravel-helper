 这个是依赖于 laravel 的,
  
 工作总使用到关于图片上传的,简单的写了一下, 


    use Helper\FileHelper;

文件上传

    FileHelper::upload($file, $filePath, $folderMode = 0777, $fileName = '', $algo = 'md5');

设置文件类型:
    
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

    FileHelper::setFileType($mimeType);

设置上传文件大小:

    FileHelper::setFileSize($fileSize);

检查文件类型

    FileHelper::testFileType($file);

检查文件大小:

     FileHelper::testFileSize($file);

生成新的文件名称:

    FileHelper::generateFileName($file, $algo = 'md5');

