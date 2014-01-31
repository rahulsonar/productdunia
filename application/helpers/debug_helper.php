<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Debug Helper Functions to debug the development process
/**
 * Example call
 * $file = time().'_cimResponseData.log';
 * $cimResponseData = "chaitenya";
 * debugDummy($cimResponseData,$file);
 * 
 * print_debug($data,__FILE__,__LINE__,1);
 */
/**
 * Write the data into a text file
 * @param $filesname - Default file name is given, if you want you can pass specific file name.
 * @param $data - data to write into the file.
 */
function debugDummy($debugData,$filesname='debug.log')
{
	$path = "debuglog/";
	$file = fopen($path.$filesname, 'w');
	WriteData($file,$debugData);
	fclose($file);
}
function WriteData($file,$debugData){
	if(is_array($debugData)){
		foreach($debugData as $key => $value){
			if(is_object($value)){
				$value = (array)$value;
				WriteData($file,$value);
			}else if(is_array($value)){
				WriteData($file,$value);
			}else{
				fwrite($file,$key." --> ".$value."\n");
			}
		}
	}else{
		fwrite($file, $debugData."\n");
	}
}
function ReadData($filename){
	//$filename = "/usr/local/something.txt";
	//$path = "debuglog/";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	return $contents;

}
function print_debug($data,$flilename='',$linenumber='',$exit='0'){
	echo "\n\n<pre>";
	echo "\n<br/>------";
	echo $flilename. "  line number :".$linenumber ;
	echo "------<br/>\n";
	print_r($data);
	echo "\n<hr/>\n";
	echo "</pre>";
	if($exit){
		exit;
	}
}

function object_2_array($result)
{
    $array = array();
    foreach ($result as $key=>$value)
    {
        if (is_object($value))
        {
            $array[$key]=object_2_array($value);
        }
        elseif (is_array($value))
        {
            $array[$key]=object_2_array($value);
        }else{
            $array[$key]=$value;
        }
    }
    return $array;
}

function toArray($data) {
    if (is_object($data))
    	$data = get_object_vars($data);
    return is_array($data) ? array_map(__FUNCTION__, $data) : $data;
}

?>
