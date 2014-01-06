﻿<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="content-language" content="ja">
<meta name="robots" content="noindex,nofollow,noarchive">
<title>pjax demo</title>
<style type="text/css">
/* reset */
/* -------------------------------------------------- */
html,body,div,p{
  margin: 0;
  padding: 0;
  border: 0;
}

/* default */
/* -------------------------------------------------- */
html,body{
  width: 100%;
  height: 100%;
}
h1{
  margin: 0;
}
p{
  font-size: xx-large;
}
form{
  text-align: center;
}
form p{
  display: inline;
}
select{
  height: 40px;
  font-size: 32px;
}

/* frame */
/* -------------------------------------------------- */
#container{
  width: 100%;
  height: 100%;
}
#header{
  height: 20%;
  background: #ee0;
}
#wrapper{
  position: relative;
  height: 60%;
  background: #e0e;
}
#wrapper div.layer{
  height: 100%;
}
div.primary{
  height: 100%;
  background: #e00;
}
div.secondary{
  display: none;
  height: 100%;
  background: #0e0;
}
div.tertiary{
  display: none;
  height: 100%;
  background: #00e;
}
#footer{
  height: 20%;
  background: #0ee;
}


/* -------------------------------------------------- */

/* new clearfix */
.clearfix:after {
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}
* html .clearfix             { zoom: 1; } /* IE6 */
*:first-child+html .clearfix { zoom: 1; } /* IE7 */
</style>
<script type="text/javascript" charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="http://sa-kusaku.sakura.ne.jp/lib/jquery.validator.js"></script>
<script type="text/javascript">
var validator = $.validator ? $.validator( {
  base: true ,
  name: 'base' ,
  debug: true ,
  report: true ,
  url: '/lib/jquery.validator.send.php' ,
  env: window.navigator.userAgent ,
  dom: function() { return document.documentElement.outerHTML ; }
} ) : false ;
//var validator = false ;
</script>
<script type="text/javascript" charset="utf-8" src="/lib/jquery.pjax.js"></script>
<script type="text/javascript">
$(function(){
  $.pjax({ area: 'div.pjax', form: 'form.pjax' });
});
</script>
</head>
<body>
  <div id="container">
    <div id="header">
      <div class="layout">
        <h1>pjax demo</h1>
        <p>これはpjaxのデモページです</p>
        <p>header3</p>
      </div>
    </div>
    <div id="wrapper" class="clearfix">
      <div class="layer">
        <div class="primary pjax">
          <div class="layout">
            <p>primary3</p>
            <p>pjax link: enable form: enable あアｱ亜</p>
            <ul>
              <li><a href="/pjax/test/form/">page1 enable</a></li>
              <li><a href="/pjax/test/form/2.php">page2 enable</a></li>
              <li><a href="/pjax/test/form/3.php">page3 enable</a></li>
              <li><a href="/pjax/test/form/4.php">page4 disable</a></li>
              <li><a href="/pjax/test/form/5.php">page5 disable</a></li>
            </ul>
            <p><?php echo htmlspecialchars(@$_POST['data'], ENT_QUOTES, mb_internal_encoding())?></p>
            <form class="pjax" method="get" action="/pjax/test/form/2.php">
              <input name="data" type="text" value="pjaxGET送信テスト">
              <input type="submit" value="送信">
            </form>
            <form class="pjax" method="post" action="/pjax/test/form/3.php">
              <input name="data" type="text" value="pjaxPOST送信テスト">
              <input type="submit" value="送信">
            </form>
            <form method="get" action="/pjax/test/form/4.php">
              <input name="data" type="text" value="通常GET送信テスト">
              <input type="submit" value="送信">
            </form>
            <form method="post" action="/pjax/test/form/5.php">
              <input name="data" type="text" value="通常POST送信テスト">
              <input type="submit" value="送信">
            </form>
          </div>
        </div>
        <div class="secondary">
          <div class="layout">
            <p>secondary3</p>
            <ul>
              <li><a href="/pjax/test/form/">page1 enable</a></li>
              <li><a href="/pjax/test/form/2.php">page2 enable</a></li>
              <li><a href="/pjax/test/form/3.php">page3 enable</a></li>
              <li><a href="/pjax/test/form/4.php">page4 disable</a></li>
              <li><a href="/pjax/test/form/5.php">page5 disable</a></li>
            </ul>
          </div>
        </div>
        <div class="tertiary">
          <div class="layout">
            <p>tertiary3</p>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <div class="layout">
        <p>footer3</p>
      </div>
    </div>
  </div>
</body>
</html>