<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
            function truncate($str, $width) {
                return current(explode("\n", wordwrap($str, $width, "...\n")));
            }
?>
