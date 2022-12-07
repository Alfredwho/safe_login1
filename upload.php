<?php


/**
 * Class upload
 * 文件上传类
 */
class upload {


    private $fileName;
    private $maxSize;
    private $allowMime;
    private $allowExt;
    private $uploadPath;
    private $imgFlag;
    private $error;
    private $ext;
    private $fileInfo;




    /**
     * upload constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->fileName = $config['fileName'];
        $this->maxSize = $config['maxSize'];
        $this->allowMime = $config['allowMime'];
        $this->allowExt = $config['allowExt'];
        $this->uploadPath = $config['uploadPath'];
        $this->imgFlag = $config['imgFlag'];
        $this->fileInfo = $_FILES[$this->fileName];
    }


    /**
     * @return mixed
     */
    public function getError() {
        return $this->error;
    }


    /**
     * @return bool
     */
    public function checkError() {
        if($this->fileInfo['error'] > 0) {
            switch ($this->fileInfo['error']){
                case 1:
                    $this->error =  'upload error<br/>';
                    break;
                case 2:
                    $this->error =  'upload error<br/>';
                    break;
                case 3:
                    $this->error =  'upload error<br/>';
                    break;
                case 4:
                    $this->error =  'upload error<br/>';
                    break;
                case 6:
                    $this->error =  'upload error<br/>';
                    break;
                case 7:
                    $this->error =  'upload error<br/>';
                    break;
                default:
                    $this->error =  'upload error<br/>';
                    break;
            }
            return false;
        }
        return true;
    }




    /**
     * @return bool
     */
    public function checkExt() {
        $this->ext = strtolower(pathinfo($this->fileInfo['name'],PATHINFO_EXTENSION));
        if(!in_array($this->ext,$this->allowExt)) {
            $this->error =  'upload error<br/>';
            return false;
        }
        return true;
    }


    /**
     * @return bool
     */
    public function checkSize(){
        if($this->fileInfo['size'] > $this->maxSize) {
            $this->error =  'upload error<br/>';
            return false;
        }
        return true;
    }




    /**
     * @return bool
     */
    public function checkMime() {
        if(!in_array($this->fileInfo['type'],$this->allowMime)) {
            $this->error =  'upload error<br/>';
            return false;
        }
        return  true;
    }




    public function checkTrueImage() {
        if($this->imgFlag === true) {
            if(!@getimagesize($this->fileInfo['tmp_name'])) {
                $this->error = 'upload error<br/>';
                return false;
            }
            return true;
        }
    }




    /**
     * @return bool
     */
    public function checkHttpPost() {
        if(!is_uploaded_file($this->fileInfo['tmp_name'])) {
            $this->error = 'upload error<br/>';
            return false;
        }
        return true;
    }




    /**
     * @return bool
     */
    public function checkUploadPath() {
        if(!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath,0777,true);
        }
        return true;
    }


    /**
     * @return bool|string
     */
    public function uploadFile() {
        if(!$this->checkError() || !$this->checkExt() || !$this->checkMime() || !$this->checkTrueImage() || !$this->checkHttpPost() || !$this->checkSize()) {
            return false;
        }
        $this->checkUploadPath();


        //随机产生一个文件名
        $allFile = $this->uploadPath.'/'.md5(md5(uniqid('file_',true))).'.'.$this->ext;


        if(!move_uploaded_file($this->fileInfo['tmp_name'],$allFile )) {
            $this->error = 'upload fail<br/>';
            return false;
        }


        return $allFile;
    }
}