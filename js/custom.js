/**************************
 * Page Related Constants *
 **************************/

var SCORE_BASE = 0;
var SCORE_WEIGHT = 1;
var HEIGHT_WEIGHT = 10;
var TOOL_DELAY = 1500;
var ANIM_DELAY = 350;
var STAT_DELAY = 250;
var PAGE_TIMER_ID;

/*****************************
 * Animated Graph Functions  *
 *****************************/

function animateUserBar(userId, score) {
  var prevScore = $("div#score" + userId).html();
  var user = $("div#user" + userId);
  var curHeight = HEIGHT_WEIGHT*(SCORE_BASE + parseInt(score));
  var curScore = SCORE_WEIGHT*(SCORE_BASE + parseInt(score));
  var change = curScore - prevScore;
 
  if(0 != change) {
    user.animate(
      { height: (0 == curHeight) ? HEIGHT_WEIGHT : Math.abs(curHeight) },
      ANIM_DELAY,
      function() {
        if(curHeight < 0)
          user.css({ 'background-color' : 'red' });
        else if(curHeight > 0)
          user.css({ 'background-color' : 'green' });
        else
          user.css({ 'background-color' : 'orange' });
    });

    var top = user.offset().top + ((0 == curHeight) ? HEIGHT_WEIGHT : Math.abs(curHeight)) + 5;
    var left = user.offset().left;
    var sign = change > 0 ? '+' : '';
    $("body").append("<div id=\"tooltip" + userId + "\" class=\"tooltip\">" + sign + change + "</div>");
    $("div#tooltip" + userId).css({ 'left' : left, 'top' : top }).fadeIn(TOOL_DELAY).fadeOut(TOOL_DELAY, function() {
      $(this).remove();
    }); 
    $("div#score" + userId).html(curScore);
  }
}

function updateUserBars() {
  $.post("api.php", { method: "getUserScores" }, function(data) {
    var result = data.split(";");
    if(0 == result[0]) {
      result = result[1].split(",");
      for(var i=0; i < result.length; ++i) {
        var val = result[i].split(":");
        animateUserBar(val[0], val[1]);
      }
    }
  });
}

/********************************
 * User Stats Related Functions *
 ********************************/

function updateUserStats() {
  $.post("api.php", { method: "getUserStats" }, function(data) {
    var result = data.split(";");
    if(0 == result[0]) {
      result = result[1].split(",");
      for(var i=0; i < result.length; ++i) {
        var val = result[i].split("|");
        var userIdStats = "div#user" + val[0] + "stats";
        $(userIdStats + " span.hacks").text(val[1]);
        $(userIdStats + " span.hacked").text(val[2]);
        $(userIdStats + " span.lasthack").text(val[3]);
        $(userIdStats + " img").attr("src", val[4]);
      }
    }
  });
}

function displayUserStats(numId) {
  var user = $("div#user" + numId);
  var userInfo = $("div#user" + numId + "stats");
  var top = user.offset().top + user.height() + 5;
  var left = user.offset().left + user.width() / 2 - userInfo.width() / 2;
  userInfo.css({'left' : left, 'top' : top }).fadeIn(STAT_DELAY);
}

function hideUserStats(numId) {
  var userInfo = $("div#user" + numId + "stats");
  userInfo.fadeOut(STAT_DELAY);
}

/***********************
 * Page Initialization *
 ***********************/

$(document).ready(function() {
  // bind change event to select list for page update interval
  $("select#timerDelay").change(function(){
    var value = $("select#timerDelay option:selected").val();
    window.clearInterval(PAGE_TIMER_ID);
    if('off' != value)
      PAGE_TIMER_ID = window.setInterval(function() {
        updateUserBars();
        updateUserStats(); }, 
        value*1000);
  });
  
  // kick off timer with default value
  var value = $("select#timerDelay option:selected").val();
  PAGE_TIMER_ID = window.setInterval(function() {
    updateUserBars();
    updateUserStats(); },
    value*1000);
  
  // bind click event to user bars for testing purposes
  $("div.bar").bind('click', function() {
    var numId = ($(this).attr('id').substring(4));
    var score = parseInt($("div#score" + numId).html())/SCORE_WEIGHT - SCORE_BASE;
    var userId = $(this).attr('id');
    animateUserBar(userId.substring(4), score-8);
  });
  
  // bind hover event to display user stats
  $("div.bar").bind('mouseover', function() {
    var numId = ($(this).attr('id').substring(4));
    displayUserStats(numId);
  });
  
  $("div.bar").bind('mouseout', function() {
    var numId = ($(this).attr('id').substring(4));
    hideUserStats(numId);
  });
});
