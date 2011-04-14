<?php header("Content-type: text/css"); ?>

html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  background-color: #b09f73;
}

div#userBox, div#scoreBox, div#footer, div#userStatsBox {
  width:  640px;
  margin: auto auto;
}

div#userBox {
  border-radius: 0 8px 0 0;
  -moz-border-radius: 0 8px 0 0;
}

div#scoreBox {
   border-radius: 0 0 8px 0;
   -moz-border-radius: 0 0 8px 0;
}

div#graphBox {
	color: #000000;
	width: 640px;
	height: 480px;
	margin: 0 auto;
	background-color: #f8febd;
   clear: left;
}

div#userBox, div#scoreBox {
   height: 30px;
   background-color: #85604d;
}

div#userBoxTitle, div#userScoreTitle {
   position: relative;
   clear: left;
   top: -28px;
   left: -70px;
   width: 70px;
   height: 30px;
   background-color: #000000;
   color: #ffffff;
   text-align: center;
   font-weight: bold;
   border-radius: 5px 0 0 5px;
   -moz-border-radius: 5px 0 0 5px;
}

@-moz-document url-prefix()  {
   div#userBoxTitle, div#userScoreTitle {
      top: -29px;
   }
}
div#userBoxTitle span, div#userScoreTitle span {
   font-family: 'Neucha', arial, serif;
   position: relative;
   top: 6px;
}

div.user, div.bar, div.score {
	width: 50px;
	float: left;
   margin-left: 10px;
   font-weight: bold;
   text-shadow: 2px 2px 2px #c0c0c0;
}

div.user, div.score {
   border-radius: 5px;
   -moz-border-radius: 5px;
}

div.bar {
   border-radius: 0 0 5px 5px;
   -moz-border-radius: 0 0 5px 5px;
}

div.score, div.user {
  background-color: #f8febd;
  margin: 5px 0 5px 10px;
  text-align: center;
}

div#titleContainer {
  margin: 0 auto 40px auto;
  display: block;
  height: 50px;
  color: #ffffff;
  width: 640px;
}

h1#title {
  margin: 0;
  background-color: #000000;
  width: 298px;
  padding-left: 10px;
  padding-top: 10px;
  font: 50px/1.25em 'Cabin Sketch', arial, serif;
  border-radius: 0 0 8px 8px;
  -moz-border-radius: 0 0 8px 8px;
}

div#footer {
  padding: 5px 0;
  clear: left;
}

div#footer span {
   font-family: 'Neucha', arial, serif;
   font-weight: bold ;
   text-shadow: 1px 1px 2px #f0f0f0;
}

.tooltip {
  position: absolute;
  width: 50px;
  height: 1.5em;
  text-align: center;
  background-color: transparent;
  font-weight: bold;
  display: none;
  z-index: 1;
}

div.userStats {
  position: absolute;
  width: 350px;
  height: 138px;
  background-color: #ffffff;
  display: none;
  z-index: 2;
}

div.userStats img {
  float: left;
  margin: 5px;
}

div.userStats span.name {
  font-weight: bold;
  font-style: normal;
  font-size: 20pt;
}

div.userStats span {
  font-style: italic;
}

<?php

include 'global.css.inc.php';

generateUserCss();
