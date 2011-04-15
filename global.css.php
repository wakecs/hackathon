<?php header("Content-type: text/css"); ?>

html, body {
   margin: 0;
   padding: 0;
   width: 100%;
   height: 100%;
   background-color: #b09f73;
   font-family: Arial, serif;
   font-size: 16px;
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
	min-height: 480px;
	margin: 0 auto;
	background-color: #f8febd;
}

div#userBox, div#scoreBox {
   height: 30px;
   background-color: #85604d;
   clear: left;
}

div#userBoxTitle, div#userScoreTitle {
   float: left;
   margin-left: -70px;
   width: 70px;
   height: 30px;
   background-color: #000000;
   color: #ffffff;
   text-align: center;
   font-weight: bold;
   border-radius: 5px 0 0 5px;
   -moz-border-radius: 5px 0 0 5px;
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

div.bar {
   border-radius: 0 0 5px 5px;
   -moz-border-radius: 0 0 5px 5px;
   margin-bottom: 1.75em;
}

div.score, div.user {
   background-color: #f8febd;
   margin: 5px 0 5px 10px;
   text-align: center;
   font-family: Arial, serif;
   font-size: 16px;
   border-radius: 5px;
   -moz-border-radius: 5px;
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
   font: 50px/65px 'Cabin Sketch', arial, serif;
   border-radius: 0 0 8px 8px;
   -moz-border-radius: 0 0 8px 8px;
}

div#footer {
   padding: 5px 0 75px 0;
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
   width: 375px;
   height: 138px;
   background-color: #ffffff;
   display: none;
   z-index: 2;
   border: 3px solid #c0c0c0;
   border-radius: 5px;
   -moz-border-radius: 5px;
   font-family: 'Droid Serif', arial, serif;
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

div.clear {
   clear: both;
}

<?php

include 'global.css.inc.php';

generateUserCss();
