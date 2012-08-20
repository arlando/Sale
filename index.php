<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>SALE</title>
	<meta name="description" content="SALE Providence, RI">
	<meta name="author" content="Arlando Battle">

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
	body {
	  padding-top: 60px;
	  padding-bottom: 40px;
	}
	</style>
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
</head>
<body>
  <div class="container" style="padding-left:10px;">
      <h1>SALE</h1>
  </div>
  <div class="container">
  <div id="items-container">
      <?
      /*
      This code calls my Google Spreadsheet when a visitor comes to the sites and populates the relative fields with the require information.
      */
      $key = '0Au8Ja0LPR4TodGJUT0ZiX1F1UklsUVBoalg3MU13b2c';
      $url = "http://spreadsheets.google.com/feeds/list/".$key."/od6/public/values?alt=json";

      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      curl_setopt($ch,CURLOPT_USERAGENT,'Arlando\'s Script');
      $data = json_decode(curl_exec($ch),true); //dump json into an associative array
      curl_close($ch);
      $entries = $data["feed"]["entry"];


      foreach($entries as $entry){
        if($entry['gsx$sold']['$t']){
          //If sold we display this.
          echo '<div class="item"><img src="img/sold.png">'.$entry['gsx$itemname']['$t'].'</div>';
        } else {
              echo '<div class="item ';
              
              echo $entry['gsx$type']['$t'].'" data-category="'.$entry['gsx$type']['$t'].'">';
              echo '<h2 class="name">'.$entry['gsx$itemname']['$t'].'</h2>';
              if($entry['gsx$photosbool']['$t']){
                $photos = str_replace('BEGIN-','<img src="img/',$entry['gsx$photos']['$t']);
                $photos = str_replace(',','"><img src="img/',$photos);
                $photos = str_replace('-END','">',$photos);
                echo $photos;
              };
              echo '<br><br><a style="pull-left" href="'.$entry['gsx$link']['$t'].'" alt=""><h3>Link</a>';
              echo '<span class="price pull-right">'.$entry['gsx$cost']['$t'].'</h3></span>';
              echo '<br><div class="description" style="text-align:justify;">'.$entry['gsx$description']['$t'].'</div>';
              echo '</div>';
      }//end foreach
    }
      ?>
  </div> 
</div><!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>

<script src="js/libs/bootstrap/bootstrap.min.js"></script>

<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
<!--Isotope-->
<script src="js/libs/jquery.infinitescroll.min.js"></script>
<script src="js/libs/fake-element.js"></script>
<script src="js/libs/jquery.isotope.min.js"></script>
<script>
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<script>
$(window).load(function(){
$('#items-container').isotope({
    itemSelector: '.item'
  });
});
</script>

</body>
</html>
