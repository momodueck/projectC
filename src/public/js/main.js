$(function(){
  var hamburger = $('.hamburger'),
      overlay = $('.overlay'),
      sidebar_wrapper = $('.sidebar-wrapper'),
      is_menu_open = false;

    hamburger.click(function () {
      if (is_menu_open) {
        closeMainMenu();
        is_menu_open=false;
      } else {
        showMainMenu();
        is_menu_open=true;
      }
    });

    $('.close_overlay').click(function(){
      closeMainMenu();
      is_menu_open=false;
    });

    function showMainMenu(){
      overlay.show();
      setTimeout(function(){
        overlay.removeClass('invisible');
        hamburger.removeClass('is-closed').addClass('is-open');
        sidebar_wrapper.addClass('nav-open');
      }, 10);

    }
    function closeMainMenu(){
      setTimeout(function functionName() {
      overlay.hide();
      }, 500);
      overlay.addClass('invisible');
      hamburger.removeClass('is-open').addClass('is-closed');
      sidebar_wrapper.removeClass('nav-open');

    }
});

//search

$('#search-input').on('input',function(){

  d3.selectAll("#results > p")
    .remove();
  let term = $('#search-input').val()
  if(term.trim() != ""){
    $.getJSON("/search/"+term.trim(), function(data){
        console.log(data);
        d3.select('#results')
          .selectAll('p')
          .data(data.songs)
          .enter()
          .append('p')
          .attr("class", "search_item_p")
          .text(function(d,i){return d.title+ " - "+d.artist})
          .on('click',function(d,i){
            console.log(d.id);
            window.location.href="/play/"+d.id+"/0";
          });
    });
  }
});
