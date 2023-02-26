// Copyright (C) 2020-2022 FoxxiBot
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

var wins = 0;
var losses = 0;
var winRatio = "-";

function win() {
    wins = wins + 1;
    $('#wins').text(wins);
    ratio();
}

function loss() {
    losses = losses + 1;
    $('#losses').text(losses);
    ratio();
}

function ratio() {
    winRatio = losses ? Math.round(wins/(wins+losses) * 100) + '%' : "100%";
    $('#ratio').text(winRatio);
}

function reset() {
    wins = 0;
    losses = 0;
    winRatio = "-";

    $('#wins').text(0);
    $('#losses').text(0);
    $('#ratio').text("-");
}

// Save the Data to the Database
$(" #save" ).submit(function(e) {

	e.preventDefault(); // avoid to execute the actual submit of the form.

	var form = $(this);
	var actionUrl = form.attr('action');
		
	$.ajax({
		type: "POST",
		url: actionUrl,
           data: {
            'wins' : wins,
			'losses' : losses,
			'ratio' : winRatio,
           },
    	success: function(data)
		{
            Toast.fire({
                icon: 'success',
                title: 'Win/Loss Data Saved to the Database'
            })
		}
	});
		
});