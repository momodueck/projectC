let songTimout;
let chordTransitionTimeouts = [];
const sum = (sum, chord) => sum + parseFloat(chord.duration);

let playing = false;
let countIn = false;

function recLoop(i){
  if(!playing){
    return;
  }
  position = i;
  updateScreen(i);
  if(song.tabs[i+1]!=undefined){
    console.log(getTimeInMillis(song.tabs[i].chords.reduce(sum, 0)));
    songTimout = setTimeout(function() {
      recLoop(i+1)
    }, getTimeInMillis(song.tabs[i].chords.reduce(sum, 0)));
  }
}

function getTimeInMillis(duration){
  return (60000/parseInt(song.bpm))*duration*parseInt(song.beat);
}

function updateScreen(i){

  updatePreviewScreen(i+1);
  $("#scroll_menu_slider").val(i);
  chordTransitionTimeouts = [];
  let chordTimeoutInMs = 0;

  // otherwise d3 fails binding data
  if(song.tabs[i].chords == undefined){
    song.tabs[i].chords = [];
  }

  //clear the chords area
  d3.select("#chords")
      .selectAll("#chords > span")
      .remove()

  // refill with current values for chords
  d3.select("#chords")
      .selectAll("span")
      .data(song.tabs[i].chords)
      .enter()
      .append("span")
      .style("flex-grow", "1")
      .style("text-align", "center")
      .style("padding-top", "20px")
      .style("font-size", "20px")
      .text(function(d,i){return d.chord})
      .attr("id", function(d,j){return "chord"+j})
      .each(function(d,j){
        if(playing){
          chordTransitionTimeouts.push(
            setTimeout(function(){
              d3.selectAll(".highlightChord")
                .remove()

              d3.select("#chord"+j)
                .append("svg")
                .classed("highlightChord", true)
                .style("position", "fixed")
                .style("overflow", "visible")
                .append("path")
                .attr("d", "M31.5594,4.50269c0,-2.48677 -2.01593,-4.50269 -4.50269,-4.50269l-22.554,0c-2.48677,0 -4.50269,2.01593 -4.50269,4.50269c0,2.48677 2.01593,4.50269 4.50269,4.50269l22.554,0c2.48677,0 4.50269,-2.01593 4.50269,-4.50269Z")
                .attr("transform", "translate(-20 25)")
                .style("fill", "#25acff");

              d3.select("#progress_bar_g")
                .attr("transform","translate(0,0)")
                .transition()
                .duration(getTimeInMillis(parseFloat(d.duration))-30)
                .ease(d3.easeLinear)
                .attr("transform", "translate(600,0)")


            }, chordTimeoutInMs)
          );
        }
        chordTimeoutInMs += getTimeInMillis(parseFloat(d.duration));
      })

      //clear lyrics area
      d3.select("#lyrics > p")
          .remove();

      //fill lyrics area
      d3.select("#lyrics")
          .selectAll("p")
          .data([song.tabs[i]])
          .enter()
          .append("p")
          .style("text-align", "center")
          .style("margin-top", "40px")
          .text(function(d){return d.lyrics})
}

function updatePreviewScreen(i){

  d3.select("#preview_chords")
      .selectAll("#preview_chords > span")
      .remove();

  d3.select("#preview_lyrics")
      .selectAll("#preview_lyrics > p")
      .remove();

  if(song.tabs[i]==undefined){
    return;
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
      .enter()
      .append("p")
      .style("text-align", "center")
      .style("margin-top", "40px")
      .style("color", "#6f6f6f")
      .text(function(d){return d.lyrics})

}

function pause() {
  playing = false;
  $('#play_pause_button').attr('src','/img/play.png');

  clearTimeout(songTimout);
  for (var i = 0; i < chordTransitionTimeouts.length; i++) {
    clearTimeout(chordTransitionTimeouts[i]);
  }

  d3.selectAll(".highlightChord")
    .remove()

  $('#progress_bar_div').css("opacity","0");
  d3.select("#progress_bar_g")
    .transition()
    .attr("transform","translate(0,0)");


}

function play(){
  playing = true;
  $('#play_pause_button').attr('src','/img/pause.png');
  $('#progress_bar_div').css("opacity","1");
  if(!countIn){
    recLoop(position);
  }else{
    countBeat();
    setTimeout(function(){recLoop(position)},getTimeInMillis(1));
  }


}

function countBeat() {
  let drum = document.getElementById("drum");
  for (var i = 0; i < parseInt(song.beat); i++) {
    setTimeout(function(){drum.play(); console.log(getTimeInMillis(i/parseInt(song.beat)));},getTimeInMillis(i/parseInt(song.beat)));
  }

}


function toggle(){
  if(playing){
    pause();
  }else{
    play();
  }
}


// UI

// _______________________________ONLOAD_____________________

$(function() {

          updateScreen(position);

          $('#scroll_menu_slider').attr("max", song.tabs.length-1);
          $("#tempo_menu_bpm_value").text(parseInt(song.bpm));
          $('#play_pause_button').click(function(){
            toggle();

          });

        // _______________________________SCROLL_____________________

        $("#nav_scroll_menu_button").click(function() {
          $('#scroll_menu').show();
          $('#scroll_menu_slider')[0].value=position;
          pause();
        });

        $('#scroll_menu_slider').on('input',function(){
          pause();
          let value = parseInt($('#scroll_menu_slider')[0].value);
          updateScreen(value);
          position = value;
        });

        $('#scroll_menu_close').click(function() {
          $('#scroll_menu').hide();
        })

        // _______________________________TEMPO_____________________

        $("#nav_tempo_menu_button").click(function() {
          $('#tempo_menu').show();
        });

        $("#tempo_menu_plus").click(function() {
          song.bpm = parseInt(song.bpm)+2;
          $("#tempo_menu_bpm_value").text(song.bpm);
        });

        $("#tempo_menu_minus").click(function() {
          song.bpm = parseInt(song.bpm)-2;
          $("#tempo_menu_bpm_value").text(song.bpm);
        });

        $('#tempo_menu_close').click(function() {
          $('#tempo_menu').hide();
        })

        // _______________________________COUNT_____________________

        $("#nav_count_menu_button").click(function() {
          $('#nav_count_menu_button').toggleClass("toggled");
          if($('#nav_count_menu_button').hasClass("toggled")){
            countIn = true;
          }else{
            countIn = false;
          }
        });


        // Connections to other pages


        //in order to get to the right edit page
        $('.hamburger').click(function(){
          pause();
          $('#edit-nav-entry').attr("href", '/edit/'+song.id+'/'+position);
        });


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

  if(event.which == 32){
    toggle();
  }
});
