<!DOCTYPE html>

<head>

</head>

<body>
    <form action="{{ route('api.harmony') }}" method="GET">

        <label for="ozka"> ozka / široka lega: </label> <br>
        <input type="range" name="ozka"> <br>
        <br>
        <label for="razlozen"> razložen akord: </label> <br>
        <input type="range" name="razlozen"> <br>
        <br>
        <table id="input_table">
            <tr>
                <th> ime </th>
                <th> teža </th>
                <th> obrati </th>
            </tr>
        </table>

        <script>
            const MIN = 'min';
            const MAJ = 'maj';
            const DIM = 'dim';
            const AUG = 'aug';
            const MIN7 = 'min7';
            const MAJ7 = 'maj7';
            const DOM7 = 'dom7';
            const MIN_MAJ7 = 'min_maj7';
            const DIM7 = 'dim7';
            const HALF_DIM = 'half_dim';

            const chordNames = [
                MIN,
                MAJ,
                DIM,
                AUG,
                MIN7,
                MAJ7,
                DOM7,
                MIN_MAJ7,
                DIM7,
                HALF_DIM
            ];

            let table = document.getElementById('input_table');

            let count = 0;
            for (cn of chordNames) {
                let tr = document.createElement('tr');

                let name = document.createElement('td');
                name.appendChild(document.createTextNode(cn));
                name.setAttribute('name', 'chord[' + cn + '][name]');

                tr.appendChild(name);

                let weightCell = document.createElement('td');
                let weight = document.createElement('input');
                weight.setAttribute('type', 'number');
                weight.setAttribute('min', 0);
                weight.setAttribute('value', 0);
                weight.setAttribute('size', 5);
                weight.setAttribute('name', 'chord[' + cn + '][exists]');
                weightCell.appendChild(weight);


                let legeCell = document.createElement('td');

                let lega1 = document.createElement('input');
                lega1.setAttribute('type', 'number');
                lega1.setAttribute('min', 0);
                lega1.setAttribute('size', 5);
                lega1.setAttribute('value', 1);
                lega1.setAttribute('name', 'chord[' + cn + '][lega1]');


                let lega2 = document.createElement('input');
                lega2.setAttribute('type', 'number');
                lega2.setAttribute('min', 0);
                lega2.setAttribute('size', 5);
                lega2.setAttribute('value', 0);
                lega2.setAttribute('name', 'chord[' + cn + '][lega2]');



                let lega3 = document.createElement('input');
                lega3.setAttribute('type', 'number');
                lega3.setAttribute('min', 0);
                lega3.setAttribute('size', 5);
                lega3.setAttribute('value', 0);
                lega3.setAttribute('name', 'chord[' + cn + '][lega3]');


                legeCell.appendChild(lega1);
                legeCell.appendChild(lega2);
                legeCell.appendChild(lega3);

                tr.appendChild(weightCell);
                tr.appendChild(legeCell);

                table.appendChild(tr);

                count++;
            }
        </script>
        <table>

        </table>

        <br>

        Meja: <input type="number" name="meja"> <br>
        <br>
        <input type="submit" value="generiraj">
    </form>
</body>

</html>

<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
    }

    td {
        border: 1px solid black;
        padding: 16px;
    }

</style>
