<!DOCTYPE html>
    <head>
        
    </head>
    <body>
        <div id="vf"></div>

        <script src="https://unpkg.com/vexflow/releases/vexflow-min.js" type="text/javascript"></script>    
        <script>

            /* EXAMPLE */
            const scales = {
                'maj' : {
                    'c': ['c','d','e','f','g','a','h'],
                    'g': ['g','a','h','c','d','e','f#'],
                    'f#': ['f#', 'g#', 'a#', 'bb', 'c#', 'd#', 'e#']
                }
                
            };
            const structs = {
                'min': [0, 2, 3, 5, 7, 8, 10, 12],
                'maj': [0, 2, 4, 5, 7, 9, 11, 12]
            } ;

            const notes = ['cb', 'c', 'c#', 'db', 'd', 'd#', 'eb', 'e', 'e#', 'fb', 'f', 'f#', 'gb', 'g', 'g#',
            'ab', 'a', 'a#', 'bb', 'b', 'b#'];

            let chordType = 'maj';
            let noteNum = 11;

            let structure = structs[chordType];
            let noteName = notes[noteNum];
            let integerNotation = [0, 4, 7];

            console.log('f#maj');
            console.log(integerNotation);
            console.log(structure);
            console.log(scales[chordType][noteName]);


            let keys = [];
            for (let i = 0; i < integerNotation.length; i++) {
                let indexOfNote = structure.indexOf(integerNotation[i]);
                let key = scales[chordType][noteName][indexOfNote];
                if (key != 'c#')
                    keys.push(key+'/4');
                else
                    keys.push(key+'/5');
            }

            console.log(keys);

            // integer notation npr. [0, 3, 7] ali [3, 7, 12].
            // min, maj
            // int k = od 1 do 21 (c, cis, ces, ...)
            // 
            // 1. pogledas a je min ali maj
            // 3. ce mas min ali maj, se samo pomikas po strukturi s = [0, 2, 4, 5, 7, 9, 11, 12].
            //    -primer 1: F#... je maj. s.indexOf(0) = 0, s.indexOf(4) = 2, s.indexOf(7) = 5.
            //    ok to je izi.
            //    -primer 2: db... to pa je problem.


            VF = Vex.Flow;

            var div = document.getElementById("vf")
            var renderer = new VF.Renderer(div, VF.Renderer.Backends.SVG);

            renderer.resize(500, 500);
            var context = renderer.getContext();

            var trebleStave = new VF.Stave(10, 40, 400);
            var bassStave = new VF.Stave(10, 120, 400);

            trebleStave.addClef("treble");
            bassStave.addClef("bass");

            trebleStave.setContext(context).draw();
            bassStave.setContext(context).draw();

            accidentals = [];
            for (let i = 0; i < keys.length; i++) {
                
                if (keys[i].includes('#')) {
                    accidentals.push(i);
                }
            }

            staveNote = new VF.StaveNote({keys: keys, duration:'w'});
            for (let i = 0; i < accidentals.length; i++) {
                staveNote.addAccidental(accidentals[i], new VF.Accidental('#'));
            }

            let tickables = [];
            tickables.push(staveNote);
           
            var voices = [
                new VF.Voice({num_beats: 4,  beat_value: 4}).setMode(2).addTickables(tickables)     
            ]

            var formatter = new VF.Formatter().joinVoices(voices).format(voices, 400);

            voices.forEach(function(v) { v.draw(context, trebleStave); })
        </script>
    </body>
</html>

