$(function(){
  $(".haccordion > li").hover(
    function(){
      var $this = $(this);
      $this.stop().animate({"width": "400px"},500);
      $('.heading', $this).stop(true,true).fadeOut();
      $('.bgDescription', $this).stop(true,true).slideDown(500);
      $('.description',$this).stop(true,true).fadeIn();
    },
    function(){
      var $this = $(this);
      $this.stop().animate({"width": "200px"},500);
      $('.heading', $this).stop(true,true).fadeIn();
      $('.bgDescription', $this).stop(true,true).slideUp(500);
      $('.description',$this).stop(true,true).fadeOut();
    }
  )
});