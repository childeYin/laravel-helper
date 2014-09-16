  这个是依赖于 laravel 的,
  
  工作总使用到关于图片上传的,简单的写了一下, 


  use Helper\FileHelper;

文件上传

    FileHelper::upload($file, $filePath, $folderMode = 0777, $fileName = '', $algo = 'md5');


检查文件类型

    FileHelper::testFileType($file);

检查文件大小:

     FileHelper::testFileSize($file);

生成新的文件名称:

    FileHelper::generateFileName($file, $algo = 'md5');

