<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;

class SongController extends Controller
{
    public function addSong(Request $request)
    {
      $request->validate([
        'title' => 'required',
        'artist' => 'required',
        'capo' => 'required',
        'numerator' => 'required',
        'denominator' => 'required',
        'bpm' => 'required',
      ]);

      $title = $request->input('title');
      $artist = $request->input('artist');
      $capo = $request->input('capo');
      $beat = $request->input('numerator');
      $base = $request->input('denominator');
      $bpm = $request->input('bpm');
      $chords = $request->input('chords');

      $tabs = self::parseChords($chords);

      $song = array('title' => $title,
                    'artist' => $artist,
                    'capo' => $capo,
                    'beat' => $beat,
                    'base' => $base,
                    'bpm' => $bpm,
                    'tabs' => $tabs
                  );

      $song_object = Song::create([
                'title' => $title,
                'artist' => $artist,
                'capo' => intval($capo),
                'beat' => intval($beat),
                'base' => intval($beat),
                'bpm' => intval($bpm),
                'tabs' => json_encode($tabs, JSON_HEX_APOS | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
      ]);

      // return view('edit', ['song' => $song_object]);
       return redirect('/edit/'.$song_object->id);
    }

    public function save(Request $request)
    {


      Song::where('id', ($request->input('song'))['id'])
             ->update(['tabs'=>json_encode($request->input('song')['tabs'], JSON_HEX_APOS | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                        'title' => $request->input('song')['title'],
                        'artist' => $request->input('song')['artist'],
                        'capo' => $request->input('song')['capo'],
                        'beat' => $request->input('song')['beat'],
                        'base' => $request->input('song')['base'],
                        'bpm' => $request->input('song')['bpm']
                      ]);



      return response()->json(['info' => ($request->input('song'))['id']]);
    }



    public function parseChords($input)
    {

      $words = preg_split("/[\s]+/",$input);
      $tabs = array();
      $i=0;
      // $re = '/ |^A$|^B$|^C$|^D$|^E$|^F$|^G$|^H$|^Am$|^Bm$|^Cm$|^Dm$|^Em$|^Fm$|^Gm$|^Hm$|^A7$|^B7$|^C7$|^D7$|^E7$|^F7$|^G7$|^H7$"/m';
      $re = '/ |^(C|C#|Db|D|D#|Eb|E|F|F#|Gb|G|G#|Ab|A|A#|Bb|B|H)(m)?(Major|Minor|Maj|Min|dim|aug|sus2|sus4|m|maj|min|add)?(6|7|9)?(\/(C|C#|Db|D|D#|Eb|E|F|F#|Gb|G|G#|Ab|A|A#|Bb|B|H))?$/m';

      while ($i < count($words)) {
        $chords = array();

          while ($i < count($words) && preg_match($re, $words[$i])) {
            $chord = $words[$i];
            array_push($chords, array('chord' => $chord, 'duration' =>1));
            $i++;

          }

        $text = "";
        while ($i < count($words) && !preg_match($re, $words[$i], $matches, 0)) {
          $text = $text." ".$words[$i];
          $i++;
        }
        addslashes($text);
        array_push($tabs,array('chords' => $chords,'lyrics' => $text));

      }


      return $tabs;

    }


}
