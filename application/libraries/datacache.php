<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * class Datacache is used to store the data into file system in gzip form.
 * This class has dependency on session, it store data againt uniqueId which is created based on 
 * unique key passed by user.
 * @author chaitenya
 * $this->session->userdata('uniqueId');
 * $this->Obj->config->item('cachePath');
 *
 */
class Datacache {

    function __construct() {
        $this->Obj = get_instance();
        $this->Obj->load->helper('file');
    }

    function createUniqueId($username = "") {
        $uniqueId = md5($username + rand(1, 999) + time());
        return $uniqueId;
    }

    function saveCache($data, $username = "") {
        $this->garbageCollection();
        $uniqueId = $this->Obj->session->userdata('uniqueId');
        $uniqueId = ($uniqueId == "") ? ($this->createUniqueId($username)) : ($uniqueId);
        $this->Obj->session->set_userdata('uniqueId', $uniqueId);
        $cachePath = getcwd() . $this->Obj->config->item('cachePath');
        $fileName = $uniqueId . ".gz";

        $gz = gzopen($cachePath . '/' . $fileName, 'w');
        $data = serialize($data);
        gzwrite($gz, $data);
        gzclose($gz);
        return $uniqueId;
    }

    function appendCache($data, $uniqueId = "") {
        $uniqueId = ($uniqueId == "") ? ($this->Obj->session->userdata('uniqueId')) : ($uniqueId);
        $cachePath = getcwd() . $this->Obj->config->item('cachePath');
        $fileName = $uniqueId . ".gz";
        $gz = gzopen($cachePath . '/' . $fileName, 'w');
        $data = serialize($data);
        gzwrite($gz, $data);
        gzclose($gz);
    }

    function getCache($uniqueId = "") {
        $uniqueId = ($uniqueId == "") ? ($this->Obj->session->userdata('uniqueId')) : ($uniqueId);
        $cachePath = getcwd() . $this->Obj->config->item('cachePath');
        $fileName = $uniqueId . ".gz";
        if (!@file_exists($cachePath . '/' . $fileName)) {
            return false;
        }
        $lines = gzfile($cachePath . '/' . $fileName);
        $contents = implode($lines);
        $data = unserialize($contents);
        return $data;
    }

    function deleteCache($uniqueId = "") {
        $uniqueId = ($uniqueId == "") ? ($this->Obj->session->userdata('uniqueId')) : ($uniqueId);
        $cachePath = getcwd() . $this->Obj->config->item('cachePath');
        $fileName = $uniqueId . ".gz";
        if (@file_exists($cachePath . '/' . $fileName)) {
            @unlink($cachePath . '/' . $fileName);
            return true;
        }
        return false;
    }

    function garbageCollection() {
        if($this->Obj->config->item('garbageCollection')){
            $cachePath = getcwd() . $this->Obj->config->item('cachePath');
            $garbageFiles = get_dir_file_info($cachePath);
            if (count($garbageFiles) > 0) {
                foreach ($garbageFiles as $key => $file) {
                    if ($file['date'] <= strtotime($this->Obj->config->item('garbageCollection').' day')) {
                        if (@file_exists($file['server_path'])) {
                            @unlink($file['server_path']);
                        }
                    }
                }
            }
        }
    }

}

?>