<?php

class Photo extends DatabaseObject
{
    protected static $dbTable = "photo";
    protected static $dbTableFields = array(
        'photo_id',
        'title',
        'description',
        'file_name',
        'type',
        'size'
    );

    public $photoID;
    public $title;
    public $description;
    public $fileName;
    public $type;
    public $size;

    public $tmpPath;
    public $uploadDir = "images";
    public $errors = array();
    public $uploadErrorsArray = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
    );

    /*
     * This is passing $_FILES['uploaded_file'] as an argument
     *
     * @param string $file file to check
     *
     */

    public function setFile($file)
    {
        if (empty($file) || ! $file || ! is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->uploadErrorsArray[$file['error']];
            return false;
        } else {
            $this->fileName = basename($file['name']);
            $this->tmpPath = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function picturePath()
    {
        return $this->uploadDir.DS.$this->fileName;
    }

    /*
     * Checks for any possible errors when photo is being saved
     */

    public function save()
    {
        if ($this->photoID) {
            $this->update();
        } else {
            if (!empty($this->errors)) {
                return false;
            }

            if (empty($this->fileName) || empty($this->tmpPath)) {
                $this->errors[] = "The file was not available";
                return false;
            }

            $targetPath = SITE_ROOT . DS . 'admin' . DS . $this->uploadDir . DS . $this->fileName;

            if (file_exists($targetPath)) {
                $this->errors[] = "The file {$this->fileName} already exists.";
                return false;
            }

            if (move_uploaded_file($this->tmpPath, $targetPath)) {
                if ($this->create()) {
                    unset($this->tmpPath);
                    return true;
                }
            } else {
                $this->errors[] = "The file directory probably doesn't have permission.";
                return false;
            }
        }
    }
}