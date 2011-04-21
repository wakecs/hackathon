/**************************
 * Page Related Constants *
 **************************/

var SCORE_BASE = 0;
var SCORE_WEIGHT = 1;
var HEIGHT_WEIGHT = 18;
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
        animateUserBar(val[0], val[1]);
        var userIdStats = "#user" + val[0] + "stats";
        $(userIdStats + " span.hacks").text(val[2]);
        $(userIdStats + " span.hacked").text(val[3]);
        $(userIdStats + " span.lasthack").text(val[4]);
        $(userIdStats + " span.lasthacked").text(val[5]);
        $(userIdStats + " img").attr("src", val[6]);
      }
    }
  });
}

function displayUserStats(numId, mouseY) {
  var user = $("div#user" + numId);
  var userInfo = $("div#user" + numId + "stats");
  if(userInfo.is(':visible')) {
    return;
  } else {
    var top = mouseY + 15;
    var left = user.offset().left + user.width() / 2 - userInfo.width() / 2;
    userInfo.css({'left' : left, 'top' : top }).fadeIn(STAT_DELAY);
  }
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
        updateUserStats(); }, 
        value*1000);
  });
  
  // kick off timer with default value
  var value = $("select#timerDelay option:selected").val();
  PAGE_TIMER_ID = window.setInterval(function() {
    updateUserStats(); },
    value*1000);
  
  // bind click event to user bars for testing purposes
  //$("div.bar").bind('click', function() {
  //  var numId = ($(this).attr('id').substring(4));
  //  var score = parseInt($("div#score" + numId).html())/SCORE_WEIGHT - SCORE_BASE;
  //  var userId = $(this).attr('id');
  //  animateUserBar(userId.substring(4), score-8);
  //});
  
  // bind hover event to display user stats
  $("div.bar").bind('mouseover', function(e) {
    var numId = ($(this).attr('id').substring(4));
    displayUserStats(numId, e.pageY);
  });
 
  $("div.bar").bind('mouseout', function(e) {
    var numId = ($(this).attr('id').substring(4));
    var userInfo = $("div#user" + numId + "stats");
    var left = $(this).offset().left;
    var right = left + $(this).width();
    var top = userInfo.offset().top;
    var bottom = top + userInfo.height();
    if (e.pageX < left || e.pageX > right ||
        e.pageY < top  || e.pageY > bottom)
    {
      hideUserStats(numId);
    }
  });
  
  $("div.userStats").bind('mouseout', function(e) {
    var elemId = ($(this).attr('id').replace('stats',''))
    var userBar = $("div#" + elemId);
    var left = userBar.offset().left;
    var right = left + userBar.width();
    var top = $(this).offset().top;
    var bottom = top + $(this).height();
    if (e.pageX < left || e.pageX > right || 
        e.pageY < top  || e.pageY > bottom)
    {
       $(this).fadeOut(STAT_DELAY);
    }
  });

  // Unicorns and rainbows, oh my! (U,U,D,D,L,R,L,R,b,a)
  var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
  $(document).keydown(function(e) {
    kkeys.push( e.keyCode );
    if ( kkeys.toString().indexOf( konami ) >= 0 ){
      $(document).unbind('keydown',arguments.callee);
      $.getScript('http://www.cornify.com/js/cornify.js',function(){
        cornify_add();
        $(document).keydown(cornify_add);
      });          
    }
  });
});
