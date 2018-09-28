
let unsavedChanges = false;
let swap = false;

function updateScreen(i){
  updatePreviewScreen(i+1);
  chordTransitionTimeouts = [];
  let gChordsTimeout = 0;

  if(song.tabs[i].chords == undefined){
    song.tabs[i].chords = [];
  }

  d3.select("#chords")
      .selectAll("#chords > span")
      .remove()
  d3.selectAll('.notify')
      .remove();

  let possibleDur=[0.25,0.5,1,1.5,2,3,4];


  d3.select("#chords")
      .each(function(){console.log(i);})
      .selectAll("span")
      .data(song.tabs[i].chords)
      .enter()
      .append("span")
      .attr("class","chord-span")
      .style("flex-grow", "1")
      .style("text-align", "center")
      .style("padding-top", "20px")
      .style("font-size", "20px")
      .text(function(d,i){return d.chord})
      .attr("id", function(d,j){return "chord"+j})
      //time
      .append("span")
      .attr("class", "edit_duration_span")
      .attr("pos", function(d,i){return i;})
      .selectAll("p")
      .data(function(d,x){return [song.tabs[i].chords[x]];})
      .enter()
      .append("p")
      .attr("class", "current_duration_p")
      .attr("id", function(d){
        return "current_duration"+this.parentNode.getAttribute("pos");
      })
      .text(function(chord,position) {

        d3.select(this.parentNode)
        .selectAll("p.possible_duration_p")
        .data(possibleDur)
        .enter()
        .append("p")
        .attr("class", "possible_duration_p")
        .text(function(d) { return d})
        .on('click',function(d,i){
          chord.duration = d;
          $("#current_duration"+this.parentNode.getAttribute("pos")).text(d);
        });

        return chord.duration;
      });



      let delDiv = $('#del-button-flex-container');
      delDiv.empty();
      for (var k = 0; k < song.tabs[i].chords.length; k++) {
        delDiv.append(function() {
          return $("<img>")
                  .attr("src","/img/delete.svg")
                  .attr("class", "del-button")
                  .click({k: k},function(event){
                    song.tabs[i].chords.splice(event.data.k, 1);
                    updateScreen(i);
                  });
        });
      }

      if(song.tabs[i].chords.length==0){
        notifyUser("Please enter a Chord or delete this part");
        delDiv.append(function() {
          return $("<div>").addClass("deleteAll")
                          .append($("<img>")
                                    .attr("src","/img/delete.svg")
                                    .attr("class", "del-button"))
                          .append($("<p>")
                                    .text("remove this part")
                                    .css("margin", "0"))
                          .click({k: k},function(event){
                            song.tabs.splice(i, 1);
                            updateScreen(i);
                          });
        });
      }

      let addDiv = $('#add-button-flex-container');
      addDiv.empty();
      for (var k = 0; k < song.tabs[i].chords.length+1; k++) {
        addDiv.append(function() {
          return $("<img>")
                  .attr("src","/img/add.svg")
                  .attr("class", "add-button")
                  .click({k: k},function(event){
                    let value = prompt("What Chord do you want to insert?");
                    song.tabs[i].chords.splice(event.data.k, 0, {"chord":value, "duration":1});
                    updateScreen(i);
                  });
        });
      }

      hideMenu();



      d3.select("#lyrics")
          .selectAll("p")
          .data([song.tabs[i]])
          .text(function(d){return d.lyrics})
          .enter()
          .append("p")
          .style("text-align", "center")
          .style("margin-top", "40px")
          .text(function(d){return d.lyrics})


}
function updatePreviewScreen(i){
  d3.select("#preview_chords")
      .selectAll("#preview_chords > span")
      .remove()

  d3.select("#preview_lyrics")
      .selectAll("#preview_lyrics > p")
      .text("")

  if(song.tabs[i]==undefined){
    return;
  }

  // otherwise d3 fails binding data
  if(song.tabs[i].chords == undefined){
    song.tabs[i].chords = [];
  }

  d3.select("#preview_chords")
      .selectAll("span")
      .data(song.tabs[i].chords)
      .enter()
      .append("span")
      .style("flex-grow", "1")
      .style("text-align", "center")
      .style("padding-top", "20px")
      .style("font-size", "20px")
      .style("color", "#6f6f6f")
      .text(function(d,i){return d.chord})
      .attr("id", function(d,j){return "preview_chord"+j})

  d3.select("#preview_lyrics")
      .selectAll("p")
      .data([song.tabs[i]])
      .text(function(d){return d.lyrics})
      .enter()
      .append("p")
      .style("text-align", "center")
      .style("margin-top", "40px")
      .style("color", "#6f6f6f")
      .text(function(d){return d.lyrics})

}

updateScreen(position);


// UI

  function hideMenu(){
    if(swap){
      $(".edit_duration_span").show();
      $("#del-button-flex-container").hide();
      $("#add-button-flex-container").hide();
    }else{
      $(".edit_duration_span").hide();
      $("#del-button-flex-container").show();
      $("#add-button-flex-container").show();
    }
  }
  function notifyUser(text){
    $('.main').prepend(
      $('<div>').addClass("notify")
                .append(
                    $('<p>').text(text)
                )
    );
    setTimeout(function () {
      $('.notify').addClass("red_back");
      setTimeout(function() {
          $('.notify').removeClass("red_back");
      },200);
    }, 100);
  }

// validity

function isSongValid(){
  for (var i = 0; i < song.tabs.length; i++) {
    if(song.tabs[i].chords.length==0){
      updateScreen(i);
      return false;
    }
  }
  return true;
}


// _______________________________ONLOAD_____________________

$(function() {

  // $('#title_artist').text(song.title + " - " +song.artist);
  //$('#capo_bpm').text("Capo: " + song.capo +"   bpm: " + song.bpm);

  $("#nav_forward_menu_button").click(function(){
    if(position+1<song.tabs.length){
      position++;
    }
    updateScreen(position);
  });

  $("#nav_back_menu_button").click(function(){
    if(position>0){
      position--;
    }
    updateScreen(position);
  });

  $("#nav_dropup_menu_button").click(function(){
    $('#dropup').show();
    $('#dropup').css("bottom", "0px");
    $("#nav_dropup_menu_button").hide();
    $("#nav_dropdown_menu_button").show();
  });

  $("#nav_dropdown_menu_button").click(function(){
    $('#dropup').css("bottom", "-600px");
    setTimeout(function(){$('#dropup').hide();}, 200);
    $("#nav_dropdown_menu_button").hide();
    $("#nav_dropup_menu_button").show();
  });

  hideMenu();

  $("#swap_button").click(function(){
    swap = !swap;
    hideMenu();
  });


  $("#nav_save_menu_button").click(function(e){

        if(!isSongValid()){
          return;
        }

        song.artist = $('#artist').val();
        song.title = $('#title').val();
        song.capo = parseInt($('#capo').val());
        song.beat = $('#numerator').val();
        song.base = $('#denominator').val();
        song.bpm = parseInt($('#bpm').val());
        console.log(song);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });


        e.preventDefault();

        $.ajax({

            type: "POST",
            url: "/save",
            data: {
               _token : $('meta[name="csrf-token"]').attr('content'),
               song:song
            },
            dataType: 'json',
            success: function (data) {
                $("#nav_save_menu_button").hide();
                $("#nav_save_menu_success").show();
                setTimeout(function(){
                  $("#nav_save_menu_button").show();
                  $("#nav_save_menu_success").hide();
                }, 1000);
            },
            error: function (data) {
              $("#nav_save_menu_button").hide();
              $("#nav_save_menu_fail").show();
              $("#nav_save_menu_button").after('<div class="error_span">Could not save! Try again later.</div>')
              setTimeout(function(){
                $("#nav_save_menu_button").show();
                $("#nav_save_menu_fail").hide();
                $('.error_span').remove();
              }, 3000);
            }
        });
  });
});

// Connections to other pages


//in order to get to the right play page
$('.hamburger').click(function(){

  $('#play-nav-entry').attr("href", '/play/'+song.id+'/'+position);

});


// Key listeners

// Right: 39
// Left: 37

$( "body" ).keyup(function( event ) {
  if ( event.which == 39 ) {
      if(position<song.tabs.length-1){
        position++;
      }
     updateScreen(position);
  }
  if ( event.which == 37 ) {
      if(position>0){
        position--;
      }
     updateScreen(position);
  }
});
