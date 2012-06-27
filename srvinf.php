<?php
if (isset($_GET['auth']) && $_GET['auth'] == '276d27212d29744c434b7a452334506f484142695225325c7144683531') {
  phpinfo();

  print '<h1>Functions</h1>';
  print '<pre>';
  print_r(get_defined_functions());
  print '</pre>';
}
else {
  die('No access!');
}
?>