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
  top: -30px;
  left: -70px;
  width: 70px;
  height: 30px;
  background-color: #000000;
  color: #ffffff;
  text-align: center;
  font-weight: bold;
}

div#userBoxTitle span, div#userScoreTitle span {
  position: relative;
  top: 5px;
}

div.user, div.bar, div.score {
	width: 50px;
	float: left;
	margin-left: 10px;
}

div.score, div.user {
  background-color: #f8febd;
  margin: 5px 0 5px 10px;
  text-align: center;
}

div#titleContainer {
  margin: 0 auto 25px auto;
  display: block;
  height: 50px;
  color: #ffffff;
  width: 640px;
}

h1#title {
  margin: 0;
  background-color: #000000;
  width: 195px;
  height: 1.5em;
  padding-left: 10px;
  padding-top: 10px;
}

div#footer {
  padding: 5px 0;
  clear: left;
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
  width: 300px;
  height: 138px;
  background-color: #ffffff;
  display: none;
  z-index: 2;
}

div.userStats img {
  float: left;
  margin: 5px;
}

<?php

include 'global.css.inc.php';

generateUserCss();
