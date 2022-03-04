<!DOCTYPE html>

<head>

</head>

<body>
    <div id="vf"></div>

    <script src="https://unpkg.com/vexflow/releases/vexflow-min.js" type="text/javascript"></script>
    <script>
        let chord = {!! json_encode($chord) !!};
        let chNames = {!! json_encode($chNames) !!};
        console.log(chord);

        const majorScales = {
            'c': ['c/4', 'd/4', 'e/4', 'f/4', 'g/4', 'a/4', 'b/4'],
            'g': ['g/4', 'a/4', 'b/4', 'c/5', 'd/5', 'e/5', 'f#/5'],
            'd': ['d/4', 'e/4', 'f#/4', 'g/4', 'a/4', 'b/4', 'c#/5'],
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
        let rootNote = {!! json_encode($root) !!}
        // TODO handle others
        if (chord['type'] === 'min' || chord['type'] === 'dim' || chord['type'] === 'min7' || chord['type'] ===
            'min_maj7') {
            rootNote = minorToMajorRoot[rootNote];
        }

        console.log(rootNote);
        console.log(structure);
        console.log(majorScales[rootNote]);

        let offsetLookup = {
            'min': {
                3: {
                    'index': 4,
                    'append': 'b'
                }
            },
            'min7': {
                3: {
                    'index': 4,
                    'append': 'b'
                },
                10: {
                    'index': 11,
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
            },
            'dom7': {
                10: {
                    'index': 11,
                    'append': 'b'
                }
            },
            // TODO preglej ce gre skozi vse root note
            'min_maj7': {
                3: {
                    'index': 4,
                    'append': 'b'
                }
            },
            'dim7': {
                3: {
                    'index': 4,
                    'append': 'b'
                },
                6: {
                    'index': 7,
                    'append': 'b'
                },
                9: {
                    'index': 11,
                    'append': 'bb'
                }
            },
            'half_dim': {
                3: {
                    'index': 4,
                    'append': 'b'
                },
                6: {
                    'index': 7,
                    'append': 'b'
                },
                10: {
                    'index': 11,
                    'append': 'b'
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
        for (let curr of chord['integerNotation']) {
            let addToOctave = Math.floor(curr / 12);
            if (curr < 0) {
                addToOctave = -1;
                if (curr < -11)
                    console.log('INT NOTATION IS LESS THAN 11!')
            }
            console.log('curr: ' + curr + ' addToOctave: ' + addToOctave)


            let offset;
            curr = curr % 12;
            if (curr < 0) curr += 12;
            if (chordType = offsetLookup[[chord['type']]]) {
                offset = chordType[curr];
            }
            if (offset == undefined) {
                offset = {
                    'index': curr,
                    'append': ''
                };
            }

            let indexOfNote = structure.indexOf(offset['index']);
            let key = majorScales[rootNote][indexOfNote];

            // append b or # (if duplicate remove accidentals).
            if (offset['append'] == 'b') key = nizanje(key);
            else if (offset['append'] == 'bb') key = nizanje(nizanje(key));
            else if (offset['append'] == '#') key = visanje(key);

            key = key.substring(0, key.length - 1) + (parseInt(key[key.length - 1]) + addToOctave)
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

        let accidentals = [];

        for (key of keys) {
            accidentals.push(whichAccidental(key));
        }

        let razlozen = {!! json_encode($razlozen) !!};
        let tickables = [];

        if (razlozen) {
            let notes = [];
            for (key of keys) {
                notes.push(new VF.StaveNote({
                    keys: [key],
                    duration: 'w',
                }));
                if (whichAccidental(key) !== '')
                    notes[notes.length - 1].addAccidental(0, new VF.Accidental(whichAccidental(key)))
            }
            tickables.push(...notes);
        } else {
            let staveNote = new VF.StaveNote({
                keys: keys,
                duration: 'w'
            });
            for (let i = 0; i < accidentals.length; i++) {
                if (accidentals[i] == '') continue;
                staveNote.addAccidental(i, new VF.Accidental(accidentals[i]))
            }
            tickables.push(staveNote);
        }

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

        function whichAccidental(key) {
            if (key.includes('##')) {
                return '##';
            } else if (key.substring(1).includes('bb')) {
                return 'bb';
            } else if (key.includes('#')) {
                return '#';
            } else if (key.includes('b')) {
                if (key[0] !== 'b' || key.substring(1).includes('b')) {
                    return 'b';
                }
            }
            return '';
        }
    </script>
</body>

</html>
