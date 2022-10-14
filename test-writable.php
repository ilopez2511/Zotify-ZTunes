<?php
// test-writable.php: check if a file can be created in the writable directory
//
$file = './writable/data.txt';
if (file_put_contents($file, 'hi')) {
  echo 'The writable directory works.' . PHP_EOL;
  unlink($file);
} else {
  //echo <<< MSG
//The writable directory doesn't work.<br/>
//Please contact the CS tech support for a possible permission problem.
//MSG;
echo "write doesn't work." . PHP_EOL;
}
?>