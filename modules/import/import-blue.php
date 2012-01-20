<?php

define('DRUPAL_ROOT', '/var/www/projectxgames.com/excuses');
$_SERVER['REMOTE_ADDR'] = "localhost"; // Necessary if running from command line
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$root = '/var/www/projectxgames.com/excuses/sites/excuses/modules/import';

$file = 'excuses-blue-excuses.csv';

$in_path = "$root/$file";

ini_set('auto_detect_line_endings', 1);
$lines = file($in_path);
ini_set('auto_detect_line_endings', 0);

// skip the first line
array_shift($lines);

foreach ($lines as $line) {

  if (strlen($line) > 0) {
    $data = csvstring_to_array($line, ',', '"', "\r");

    $node = new StdClass();
    node_object_prepare($node);
    $node->type = 'blue_excuse';
    $node->uid = 1;
    $node->name = 'admin';

    $node->title = $data[1];
    $node->field_card_id['und'][0]['value'] = $data[0];

    $node->status = 1;
    $node->language = LANGUAGE_NONE;
    $node->created = time();
    $node->changed = $node->created;

    //    print_r($node);
    node_submit($node);
    node_save($node);
  }
}


/**                                                                                                                                         
 * Convert a CSV string to an array.                                                                                                        
 *                                                                                                                                          
 * fgetcsv isn't RFC-compliant.                                                                                                             
 *                                                                                                                                          
 * using a different implementation, based on comments at:                                                                                  
 *   http://php.net/manual/en/function.fgetcsv.php                                                                                          
 */

function csvstring_to_array(&$string, $CSV_SEPARATOR = ';', $CSV_ENCLOSURE = '"', $CSV_LINEBREAK = "\n") {
  $o = array();

  $cnt = strlen($string);
  $esc = false;
  $escesc = false;
  $num = 0;
  $i = 0;
  while ($i < $cnt) {
    $s = $string[$i];

    if ($s == $CSV_LINEBREAK) {
      if ($esc) {
        $o[$num] .= $s;
      } else {
        $i++;
        break;
      }
    } elseif ($s == $CSV_SEPARATOR) {
      if ($esc) {
        $o[$num] .= $s;
      } else {
        $num++;
        $esc = false;
        $escesc = false;
      }
    } elseif ($s == $CSV_ENCLOSURE) {
      if ($escesc) {
        $o[$num] .= $CSV_ENCLOSURE;
        $escesc = false;
      }

      if ($esc) {
        $esc = false;
        $escesc = true;
      } else {
        $esc = true;
        $escesc = false;
      }
    } else {
      if ($escesc) {
        $o[$num] .= $CSV_ENCLOSURE;
        $escesc = false;
      }

      $o[$num] .= $s;
    }

    $i++;
  }

  //  $string = substr($string, $i);                                                                                                        
  return $o;
}