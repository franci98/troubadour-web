<!DOCTYPE html>

<head>

</head>

<body>
    <div id="vf"></div>

    <script src="https://unpkg.com/vexflow/releases/vexflow-min.js" type="text/javascript"></script>
    <script>
        let chord = {!! json_encode($chord) !!};
        console.log(chord);

        const majorScales = {
            'c': ['c/4', 'd/4', 'e/4', 'f/4', 'g/4', 'a/4', 'b/4'],
            'g': ['g/4', 'a/4', 'b/4', 'c/5', 'd/5', 'e/5', 'f#/5'],
            'd': ['d/4/', 'e/4', 'f#/4', 'g/4', 'a/4', 'b/4', 'c#/5'],
            'a': ['a/4', 'b/4', 'c#/5', 'd/5', 'e/5', 'f#/5', 'g#/5'],
            'e': ['e/4', 'f#/4', 'g#/4', 'a/4', 'b/4', 'c#/5', 'd#/5'],
            'b': ['b/4', 'c#/5', 'd#/5', 'e/5', 'f#/5', 'g#/5', 'a#/5'],
            'f#': ['f#/4', 'g#/4', 'a#/4', 'b/4', 'c#/5', 'd#/5', 'e#/5'],
            'db': ['db/4', 'eb/4', 'f/4', 'gb/4', 'ab/4', 'bb/4', 'c/5'],
            'ab': ['ab/4', 'bb/4', 'c/5', 'db/5', 'eb/5', 'f/5', 'g/5'],
            'eb': ['eb/4', 'f/4', 'g/4', 'ab/4', 'bb/4', 'c/5', 'd/5'],
            'bb': ['bb/4', 'c/4', 'd/5', 'eb/5', 'f/5', 'g/5', 'a/5'],
            'f': ['f/4', 'g/4', 'a/4', 'bb/4', 'c/5', 'd/5', 'e/5']
        };

        const minorToMajorRoot = {
            'a': 'c',
            'e': 'g',
            'b': 'd',
            'f#': 'a',
            'c#': 'e',
            'g#': 'b',
            'd#': 'f#',
            'bb': 'db',
            'f': 'ab',
            'c': 'eb',
            'g': 'bb',
            'd': 'f'
        };

        const majorStruct = [0, 2, 4, 5, 7, 9, 11, 12];

        let structure = majorStruct;
        let noteName = {!! json_encode($root) !!}
        // TODO handle others
        if (chord['type'] === 'min' || chord['type'] === 'dim') {
            noteName = minorToMajorRoot[noteName];
        }

        console.log(noteName);
        console.log(structure);
        console.log(majorScales[noteName]);

        let offsetLookup = {
            'min': {
                3: {
                    'index': 4,
                    'append': 'b'
                }
            },
            'dim': {
                3: {
                    'index': 4,
                    'append': 'b'
                },
                6: {
                    'index': 7,
                    'append': 'b'
                }
            },
            'aug': {
                8: {
                    'index': 7,
                    'append': '#'
                }
            }
        };

        function hasAccidental(ch) {
            if (ch.includes('#')) return '#';
            if (ch.substring(1).includes('b')) return 'b';
            return false;
        }

        function nizanje(key) {
            let acc = hasAccidental(key);
            if (!acc || acc === 'b') {
                return key.slice(0, key.length - 2) + 'b' + key.slice(key.length - 2, key.length);
            }
            return key.replace('#', '');
        }

        function visanje(key) {
            let acc = hasAccidental(key);
            if (!acc || acc === '#') {
                return key.slice(0, key.length - 2) + '#' + key.slice(key.length - 2, key.length);
            }
            return key[0] + key.substring(1).replace('b', '');
        }

        let keys = [];
        for (let i = 0; i < chord['integerNotation'].length; i++) {
            // POZENI SKOZI MAPPING
            // ce je minor: 3->4, dodaj flat v key.
            let current = chord['integerNotation'][i];

            let offset = offsetLookup[chord['type']][current];
            if (offset == undefined) {
                offset = {
                    'index': current,
                    'append': ''
                };
            }

            let indexOfNote = structure.indexOf(offset['index']);

            let key = majorScales[noteName][indexOfNote];

            // append b or # (if duplicate remove accidentals).
            if (offset['append'] == 'b') key = nizanje(key);
            else if (offset['append'] == '#') key = visanje(key);

            keys.push(key);
        }
        console.log(keys);

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

        let sharps = [];
        let flats = [];
        let doubleSharps = [];
        let doubleFlats = [];
        for (let i = 0; i < keys.length; i++) {
            if (keys[i].includes('##')) {
                doubleSharps.push(i);
            }
            else if (keys[i].substring(1).includes('bb')) {
                doubleFlats.push(i);
            }
            else if (keys[i].includes('#')) {
                sharps.push(i);
            } else if (keys[i].includes('b')) {
                if (keys[i][0] !== 'b' || keys[i].substring(1).includes('b')) {
                    flats.push(i);
                }
            }
        }

        staveNote = new VF.StaveNote({
            keys: keys,
            duration: 'w'
        });


        /// TODO polepsaj
        for (let i = 0; i < sharps.length; i++) {
            staveNote.addAccidental(sharps[i], new VF.Accidental('#'));
        }
        for (let i = 0; i < flats.length; i++) {
            staveNote.addAccidental(flats[i], new VF.Accidental('b'));
        }
        for (let i = 0; i < doubleSharps.length; i++) {
            staveNote.addAccidental(doubleSharps[i], new VF.Accidental('##'));
        }
        for (let i = 0; i < doubleFlats.length; i++) {
            staveNote.addAccidental(doubleFlats[i], new VF.Accidental('bb'));
        }

        let tickables = [];
        tickables.push(staveNote);

        var voices = [
            new VF.Voice({
                num_beats: 4,
                beat_value: 4
            }).setMode(2).addTickables(tickables)
        ];

        var formatter = new VF.Formatter().joinVoices(voices).format(voices, 400);

        voices.forEach(function(v) {
            v.draw(context, trebleStave);
        });
    </script>
</body>

</html>
