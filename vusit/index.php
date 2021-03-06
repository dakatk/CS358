<html>

<link rel="stylesheet" href="http://fujita.valpo.edu/web_style.css">

<head>

<script language="Javascript1.1">
//--- Preload graphic images.
//<img src="img.png" name="myImage" width=100 height=100>
//  you can address it through document.myImage or document.images["myImage"]. 

// imgFile is an array object containing the URL names of the images
// imgScr  is an array of Image objects  
//    the src property of imgSrc, imgSrc[i].src, is assigned the URL's from imgFile[i]
imgFile = new Array()
map_id="http://fujita.valpo.edu/~dgoines/vusit/images/ref_img";first_hour=1;fhr_incr=1;last_hour=30;millisec=100;millisecl=1300;
i=-1
for(fhr=first_hour;fhr<=last_hour;fhr+=fhr_incr) {
        i++
        var cfhr=fhr
        if (fhr < 10) {
                cfhr=fhr
        }
        imgFile[i]=map_id+cfhr+".png"
}
imgSrc=new Array()
for(i=0;i<imgFile.length;i++) {
        imgSrc[i]=new Image()
        // forces the image loading
        imgSrc[i].src=imgFile[i]
}
  
function checkTimer(){
        if (document.Timer.timerBox.checked){
                var newIndex = 0
                var gifName  = document.image1.src
                // identify the the 2 chars xx.png
                var index0=gifName.charAt(gifName.length-6)
                var index1=gifName.charAt(gifName.length-5)
                // var index2=gifName.charAt(gifName.length-5)
                var map_id_last=map_id.charAt(map_id.length-1)
                if (index0 != map_id_last) {
                        var fhr = Number(index0 + index1)
                } else {
                        var fhr = Number(index1)
                }
                var gifIndex=(fhr-first_hour)/fhr_incr
                if (gifIndex < imgSrc.length -1) {
                        newIndex = gifIndex +1
                }               
                document.image1.src=imgSrc[newIndex].src
                if (newIndex == last_hour-first_hour) {
                    var timeoutID = setTimeout("checkTimer()",millisecl)
                } else {
                    var timeoutID = setTimeout("checkTimer()",millisec)
                        }
        }
        else {return}
}

var reloading;

function checkReloading() {
    if (window.location.hash=="#autoreload") {
        reloading=setTimeout("window.location.reload();", 60000);
        document.getElementById("reloadCB").checked=true;
    }
}

function toggleAutoRefresh(cb) {
    if (cb.checked) {
        window.location.replace("#autoreload");
        reloading=setTimeout("window.location.reload();", 60000);
    } else {
        window.location.replace("#");
        clearTimeout(reloading);
    }
}

window.onload=checkReloading;
</SCRIPT>



<script language="JavaScript">
function readCookie(name){
return(document.cookie.match('(^|; )'+name+'=([^;]*)')||0)[2]
}
</script>

<body onScroll='document.cookie='ypos=' + window.pageYOffset' onLoad='window.scrollTo(0,readCookie('ypos'))'>
<div class="header"><img src="http://fujita.valpo.edu/images/title1.png"><p>
  Welcome to the Valparaiso University Online Weather Center!  This page is currently under construction.
</div>
<ul class="navbar">
  <li><a href="http://fujita.valpo.edu/">Home</a>
  <li><a href="http://www.valpo.edu/geomet/met/index.php">Departmental Page</a>
  <li><a href="http://fujita.valpo.edu/forecast">Valpo Forecast</a>
  <li><a href="http://fujita.valpo.edu/model">WRF Model</a>
  <li><a href="http://fujita.valpo.edu/ncep_models">GFS Model</a> 
  <li><a href="http://fujita.valpo.edu/radar">KLOT Radar</a>
  <li><a href="http://fujita.valpo.edu/soundings">KVUM Launches</a>
</ul>


<div class=sounding>

<br>
<br>
        <input type="checkbox" onclick="toggleAutoRefresh(this);" id="reloadCB">
        <span class="style2"> <font size="2">Auto Refresh (1 min)</font></span>
        <form name="Timer">
        <input type="checkbox" name="timerBox" onClick="checkTimer()">
        <span class="style2"><font size="2">Click to animate</font></span>
<!--
	<br>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[00].src>-1-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[01].src>-2-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[02].src>-3-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[03].src>-4-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[04].src>-5-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[05].src>-6-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[06].src>-7-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[07].src>-8-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[08].src>-9-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[09].src>-10-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[10].src>-11-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[11].src>-12-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[12].src>-13-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[13].src>-14-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[14].src>-15-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[15].src>-16-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[16].src>-17-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[17].src>-18-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[18].src>-19-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[19].src>-20-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[20].src>-21-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[21].src>-22-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[22].src>-23-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[23].src>-24-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[24].src>-25-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[25].src>-26-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[26].src>-27-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[27].src>-28-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[28].src>-29-</a>
        <a href="#picture" onmouseover=document.image1.src=imgSrc[29].src>-30-</a>
-->
        <br>
<img style="vertical-align:middle" name="image1" src="http://fujita.valpo.edu/~dgoines/vusit/images/ref_img_current.png" width=1000 >


<br>

<div class="radar" style="width:1000px;overflow:auto;">
        <img src="" name="animation"></td>
</div>
 
<!--  Delay (ms): <INPUT TYPE=text VALUE="" NAME="delay" SIZE=6> //-->
</form>
&nbsp;

</font>
</div>
</div>
</body>
</html>
