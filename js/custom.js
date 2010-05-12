// JS constants for page
var SCORE_BASE = 14;
var SCORE_WEIGHT = 5;
var HEIGHT_WEIGHT = 10;
var TOOL_DELAY = 1500;
var ANIM_DELAY = 350;
var PAGE_TIMER_ID;

function animateUserBar(userId, score) {
  var prevScore = $("div#score" + userId).html();
  var user = $("div#user" + userId);
  var curHeight = HEIGHT_WEIGHT*(SCORE_BASE + parseInt(score));
  var curScore = SCORE_WEIGHT*(SCORE_BASE + parseInt(score));
  var change = curScore - prevScore;
 
  if(0 != change) {
    if(0 == curHeight) {
      user.animate(
        { height: 1 },
        ANIM_DELAY,
        function() {
          user.css({ 'visibility' : 'hidden' });
      });
    }
    else {
      user.css({ 'visibility' : 'visible' });
      user.animate(
        { height: Math.abs(curHeight) },
        ANIM_DELAY,
        function() {
          if(curHeight < 0)
            user.css({ 'background-color' : 'red' });
          else
            user.css({ 'background-color' : 'green' });
      });
    }

    var top = user.offset().top + Math.abs(curHeight) + 5;
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

$(document).ready(function() {
  // bind change event to select list for page update interval
  $("select#timerDelay").change(function(){
    var value = $("select#timerDelay option:selected").val();
    window.clearInterval(PAGE_TIMER_ID);
    if('off' != value)
      PAGE_TIMER_ID = window.setInterval('updateUserBars()', value*1000);
  });
  
  // kick off timer with default value
  var value = $("select#timerDelay option:selected").val();
  PAGE_TIMER_ID = window.setInterval('updateUserBars()', value*1000);
  
  // bind click event to user bars for testing purposes
  $("div.bar").bind('click', function() {
    var numId = ($(this).attr('id').substring(4));
    var score = parseInt($("div#score" + numId).html())/SCORE_WEIGHT - SCORE_BASE;
    var userId = $(this).attr('id');
    animateUserBar(userId.substring(4), score-8);
  });
});
