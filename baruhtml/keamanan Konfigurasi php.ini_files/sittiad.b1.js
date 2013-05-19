var webName = document.location.href;
var myurl = 'http://ads.sittiad.com/serving/ad.php';

try{
if(sitti_ad_number==null){
  sitti_ad_number = "2";
}
}catch(err){
  var sitti_ad_number = "2";
}
var mtrack_sapiers_rand = parseInt(Math.random()*999999999999999);
var mtrack_sapiers_modurl = myurl+"?rand="+mtrack_sapiers_rand+'&sitti_pub_id='+sitti_pub_id+'&type='+sitti_ad_type+'&sitti_ad_number='+sitti_ad_number+"&d="+sitti_dep_id;
var mtrack_sapiers_show_ads = '<iframe src="'+mtrack_sapiers_modurl+'" width="'+sitti_ad_width+'" height="'+sitti_ad_height+'" marginwidth="0" marginheight="0" vspace="0" hspace="0" scrolling="no" frameborder="0" style="margin:0px 0px 0px 0px;padding:0px;display:inline;">\n<p>Your browser does not support iframes.</p>\n</iframe>';
document.write(mtrack_sapiers_show_ads);
