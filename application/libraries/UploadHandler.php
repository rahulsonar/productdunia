<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * jQuery File Upload Plugin PHP Example 5.2.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://creativecommons.org/licenses/MIT/
 */

class UploadHandler {

    private $options;
    public $upload_dir;
    public $upload_url;
    public $uploadTarget;
    public $targetCode;
    public $isMainImg;
    public $mainImg;
    public $defaultMainImg = 'noImage.png';
    public $target;
    public $imgData;
            
    function __construct($options = null, $upload_dir = null, $upload_url = null, $uploadTarget = null, $targetCode = null) {
        $this->CI = & get_instance();
        $this->upload_dir = $upload_dir . $uploadTarget . "/";
        $this->upload_url = $upload_url . $uploadTarget . "/";
        $this->target = $uploadTarget;
        $this->targetCode = $targetCode;
        $this->options = array(
            'script_url' => $_SERVER['PHP_SELF'],
            'upload_dir' => $this->upload_dir,
            'upload_url' => $this->upload_url,
            'param_name' => 'files',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => null,
            'min_file_size' => 1,
            'accept_file_types' => '/.+$/i',
            'max_number_of_files' => null,
            'discard_aborted_uploads' => true,
            'image_versions' => array(
                // Uncomment the following version to restrict the size of
                // uploaded images. You can also add additional versions with
                // their own upload directories:

                'original' => array(
                    'upload_dir' => $this->upload_dir,
                    'upload_url' => $this->upload_url,
                    'max_width' => 1200,
                    'max_height' => 1200
                ),
                'thumbnail' => array(
                    'upload_dir' => $this->upload_dir . '/thumbnails/',
                    'upload_url' => $this->upload_url . '/thumbnails/',
                    'max_width' => 164,
                    'max_height' => 164
                ),
                'large' => array(
                    'upload_dir' => $this->upload_dir . '/large/',
                    'upload_url' => $this->upload_url . '/large/',
                    'max_width' => 270,
                    'max_height' => 270
                ),
                'stamp' => array(
                    'upload_dir' => $this->upload_dir . '/stamp/',
                    'upload_url' => $this->upload_url . '/stamp/',
                    'max_width' => 42,
                    'max_height' => 42
                )
            )
        );
        if ($options) {
            $this->options = array_merge_recursive($this->options, $options);
        }
    }

    private function get_file_object($file_name) {
        $file_path = $this->options['upload_dir'] . $file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {
            $file = new stdClass();
            $file->name = $file_name;
            $file->isMainImg = ($this->mainImg == $file_name) ? (1) : (0);
            $file->imgTitle = (isset($this->imgData[$file_name]['imgTitle']))?($this->imgData[$file_name]['imgTitle']):('');
            $file->size = filesize($file_path);
            $file->url = $this->options['upload_url'] . rawurlencode($file->name);
            foreach ($this->options['image_versions'] as $version => $options) {
                if (is_file($options['upload_dir'] . $file_name)) {
                    $file->{$version . '_url'} = $options['upload_url']
                            . rawurlencode($file->name);
                }
            }
            $file->delete_url = $this->options['script_url']
                    . '?file=' . rawurlencode($file->name);
            $file->delete_type = 'DELETE';

            $file->mainImg_url = $this->options['script_url']
                    . '?file=' . rawurlencode($file->name);
            $file->mainImg_type = 'MAINIMG';
            return $file;
        }
        return null;
    }

    private function get_file_objects() {
        $this->getMainImg();                
        $this->getImgData();
        $scandir = $this->getImages($this->targetCode, $this->target);
        return array_values(array_filter(array_map(
                                array($this, 'get_file_object'), $scandir
        )));
    }

    private function create_scaled_image($file_name, $options) {
        $file_path = $this->options['upload_dir'] . $file_name;
        $new_file_path = $options['upload_dir'] . $file_name;
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) {
            return false;
        }
        $scale = min(
                $options['max_width'] / $img_width, $options['max_height'] / $img_height
        );
        if ($scale > 1) {
            $scale = 1;
        }
        $new_width = $img_width * $scale;
        $new_height = $img_height * $scale;
        $new_img = @imagecreatetruecolor($new_width, $new_height);
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                break;
            case 'gif':
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                break;
            case 'png':
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                break;
            default:
                $src_img = $image_method = null;
        }
        $success = $src_img && @imagecopyresampled(
                        $new_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height
                ) && $write_image($new_img, $new_file_path);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }

    private function has_error($uploaded_file, $file, $error) {
        if ($error) {
            return $error;
        }
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            return 'acceptFileTypes';
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = filesize($uploaded_file);
        } else {
            $file_size = $_SERVER['CONTENT_LENGTH'];
        }
        if ($this->options['max_file_size'] && (
                $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
        ) {
            return 'maxFileSize';
        }
        if ($this->options['min_file_size'] &&
                $file_size < $this->options['min_file_size']) {
            return 'minFileSize';
        }
        if (is_int($this->options['max_number_of_files']) && (
                count($this->get_file_objects()) >= $this->options['max_number_of_files'])
        ) {
            return 'maxNumberOfFiles';
        }
        return $error;
    }

    private function getFileName($prefix, $ext) {
        $gid = $this->getMaxGid();
        #how many chars will be in the string
        $fill = 7;
        #the number
        $number = $gid + 1;
        #with str_pad function the zeros will be added
        $name = str_pad($number, $fill, '0', STR_PAD_LEFT);
        return $fileName = $prefix . $name . '.' . $ext;
    }

    private function getMaxGid() {
        $this->CI->db->select('max(galleryId) as gid');
        $query = $this->CI->db->get('master_gallery');
        foreach ($query->result() as $row) {
            $gid = $row->gid;
        };
        return $gid;
    }

    private function getImages($targetCode, $target) {
        $this->CI->db->where('targetCode', $targetCode);
        $this->CI->db->where('target', $target);
        $this->CI->db->select('*');
        $query = $this->CI->db->get('master_gallery');
        foreach ($query->result() as $row) {
            $images[] = $row->imgName;
        };
        return $images;
    }

    private function insertImg($fileName, $imgTitle) {        
        $galleryData['imgTitle'] = $imgTitle;
        $galleryData['imgName'] = $fileName;
        $galleryData['target'] = $this->target;
        $galleryData['targetCode'] = $this->targetCode;
        $this->CI->db->insert('master_gallery', $galleryData);
        return true;
    }

    private function deleteImg($fileName) {
        $this->CI->db->where('imgName', $fileName);
        $this->CI->db->delete('master_gallery');
        return true;
    }

    private function updateMainImg($fileName) {
        $galleryData['productImg'] = $fileName;
        $this->CI->db->where('productId', $this->targetCode);
        $this->CI->db->update('products', $galleryData);
        return true;
    }

    public function getMainImg() {
        $this->CI->db->where('productId', $this->targetCode);
        $this->CI->db->select('productImg');
        $query = $this->CI->db->get('products');
        $res = $query->row_array();
        $this->mainImg = $res['productImg'];
    }
    
    public function getImgData() {
        $resData = array();
        $this->CI->db->where('target', $this->target);
        $this->CI->db->where('targetCode', $this->targetCode);
        $this->CI->db->select('*');
        $query = $this->CI->db->get('master_gallery');
        $res = $query->result_array();
        foreach ($res as $key => $val){
            $resData[$val['imgName']] = $val;
        }
        $this->imgData = $resData;
    }
    
    private function handle_file_upload($uploaded_file, $name, $size, $type, $error, $imgTitle) {

        $file = new stdClass();
        $path_parts = pathinfo(stripslashes($name));
        //$file->name = basename(stripslashes($name));
        $file->name = $this->getFileName('IMG', $path_parts['extension']);
        $file->imgTitle = $imgTitle;
        $this->insertImg($file->name, $imgTitle);
        $file->size = intval($size);
        $file->type = $type;
        $error = $this->has_error($uploaded_file, $file, $error);
        if (!$error && $file->name) {
            if ($file->name[0] === '.') {
                $file->name = substr($file->name, 1);
            }
            $file_path = $this->options['upload_dir'] . $file->name;
            $append_file = is_file($file_path) && $file->size > filesize($file_path);
            clearstatcache();
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                // multipart/formdata uploads (POST method uploads)
                if ($append_file) {
                    file_put_contents(
                            $file_path, fopen($uploaded_file, 'r'), FILE_APPEND
                    );
                } else {
                    move_uploaded_file($uploaded_file, $file_path);
                }
            } else {
                // Non-multipart uploads (PUT method support)
                file_put_contents(
                        $file_path, fopen('php://input', 'r'), $append_file ? FILE_APPEND : 0
                );
            }
            $file_size = filesize($file_path);
            if ($file_size === $file->size) {
                $file->url = $this->options['upload_url'] . rawurlencode($file->name);
                foreach ($this->options['image_versions'] as $version => $options) {
                    if ($this->create_scaled_image($file->name, $options)) {
                        $file->{$version . '_url'} = $options['upload_url']
                                . rawurlencode($file->name);
                    }
                }
            } else if ($this->options['discard_aborted_uploads']) {
                unlink($file_path);
                $file->error = 'abort';
            }
            $file->size = $file_size;
            $file->delete_url = $this->options['script_url']
                    . '?file=' . rawurlencode($file->name);
            $file->delete_type = 'DELETE';
        } else {
            $file->error = $error;
        }
        return $file;
    }

    public function get() {
        $info = $this->get_file_objects();
        //print_r($info);exit;
        header('Content-type: application/json');
        echo json_encode($info);
    }

    public function post() {
        $upload = isset($_FILES[$this->options['param_name']]) ?
                $_FILES[$this->options['param_name']] : array(
            'tmp_name' => null,
            'name' => null,
            'size' => null,
            'type' => null,
            'error' => null
        );
        $info = array();
        if (is_array($upload['tmp_name'])) {
            foreach ($upload['tmp_name'] as $index => $value) {
                $info[] = $this->handle_file_upload(
                        $upload['tmp_name'][$index], isset($_SERVER['HTTP_X_FILE_NAME']) ?
                                $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index], isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                                $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index], isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                                $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index], $upload['error'][$index], $_POST['imgTitle'][$index]
                );
            }
        } else {
            $info[] = $this->handle_file_upload(
                    $upload['tmp_name'], isset($_SERVER['HTTP_X_FILE_NAME']) ?
                            $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'], isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                            $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'], isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                            $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'], $upload['error'], $_POST['imgTitle']
            );
        }
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) &&
                (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        echo json_encode($info);
    }

    public function delete() {
        $file_name = isset($_REQUEST['file']) ?
                basename(stripslashes($_REQUEST['file'])) : null;
        $file_path = $this->options['upload_dir'] . $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        $delete = $this->deleteImg($file_name);
        if ($this->mainImg == $file_name) {
            $this->updateMainImg($this->defaultMainImg);
        }
        if ($success) {
            foreach ($this->options['image_versions'] as $version => $options) {
                $file = $options['upload_dir'] . $file_name;
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        }
        header('Content-type: application/json');
        echo json_encode($success);
    }

    public function mainImg() {
        $file_name = isset($_REQUEST['file']) ?
                basename(stripslashes($_REQUEST['file'])) : null;
        $file_path = $this->options['upload_dir'] . $file_name;
        $success = $this->updateMainImg($file_name);
        header('Content-type: application/json');
        echo json_encode($success);
    }

}

?>