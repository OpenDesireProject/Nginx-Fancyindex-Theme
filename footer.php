<?php
/* Load */
$load = sys_getloadavg();
$cpu_usage = round($load[1] / 2, 1);

/* RAM - http://stackoverflow.com/a/22949393 */
$free = shell_exec('free');
$free = (string)trim($free);
$free_arr = explode("\n", $free);
$mem = explode(" ", $free_arr[1]);
$mem = array_filter($mem);
$mem = array_merge($mem);
$memory_usage = round(($mem[2] - $mem[4]) / $mem[1] * 100, 1);

/* Storage */
$storage_total = disk_total_space('/');
$storage_free = disk_free_space('/');
$storage_usage = round(($storage_total - $storage_free) / $storage_total * 100, 1);

/* Network */
$nfile = fopen('/tmp/network_utilization', 'r');
$net_past = explode(" ", fgets($nfile));
$net_now = explode(" ", fgets($nfile));
fclose($f);
$net_util = round(($net_now[2] - $net_past[2]) / ($net_now[0] - $net_past[0]) / 12500000 * 100, 1);
?>
<footer>
    <h2>| Load: <?php echo $cpu_usage; ?>% | RAM: <?php echo $memory_usage; ?>% | Storage: <?php echo $storage_usage; ?>% | Network: <?php echo $net_util; ?>% | <a href="/stats/index.html">Bandwidth Statistics</a> |</h2>
    <div class="note">
    <p><b>NOTE:</b> Zip file downloads are limited to 2 connections per IP address (i.e. you can download 2 files simultaneously). Please, don't use download managers that try to form multiple connections for the same file. If you keep hitting the limit constantly, you will receive a temporary ban for the whole server.</p>
</div>
    <div class="paypal">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
      <input type="image" src="/fancyindex/images/paypal-button.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
      <img alt="" border="0" src="/fancyindex/images/paypal-pixel.gif" width="1" height="1">
    </form>
    <p class="paypal">Every donation is appreciated! Server renewal 31/12/2016. Domain renewal 30/11/2016.</p>
    </div>
</footer>
<script>
  var loc = window.location.pathname;
  var segments = loc.split('/');
  var breadcrumbs = '';
  var currentPath = '/';
  for (var i=0; i<segments.length; i++) {
    if (segments[i] !== '') {
      currentPath += segments[i] + '/';
      breadcrumbs += '<a href="' +  currentPath + '">' + window.unescape(segments[i]) + '<\/a>';
    } else if (segments.length -1 !== i) {
      currentPath += '';
      breadcrumbs += '<a href="' + currentPath + '">Root<\/a>';
    }
  }
  document.getElementById('breadcrumbs').innerHTML = breadcrumbs;
</script>
<script src="/fancyindex/js/history.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57811033-2', 'auto');
  ga('send', 'pageview');
</script>
</body>
</html>
