$('#search-input').on('focus', function(){

  $('#add_div').hide();

})

$('#search-input').blur(function(){

  $('#add_div').show();
});

// list all

  d3.selectAll("#results > p")
    .remove();

    $.getJSON("/list", function(data){
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
