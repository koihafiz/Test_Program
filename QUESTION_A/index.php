<!DOCTYPE html>
<html>
<head>
<title>Playing Card</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<h1>Playing Card</h1>
<button onclick="main()">Re-draw</button>
<div id="players"></div>

<script type="text/javascript">

	$(document).ready(function(){ 
	  main();				// start find players
	});

	function main()
	{
		swal({
		  text: 'Enter No. of player(s): ',
		  content: "input",
		  button: {
		    text: "Go",
		    closeModal: false,
		  },
		})
		.then(noPlayer => {
		  if (!noPlayer || noPlayer < 1 || isNaN(parseInt(noPlayer))) {
		  	swal("Oops!", "Input value does not exist or value is invalid!", "error");
		  	throw null;
		  }

		  return fetch(`Card.php?noPlayer=${noPlayer}`);
		})
		.then(results => {
		  return results.json();
		})
		.then(json => {
		  const cards_per_player = json;

		  
		 
		  if (cards_per_player.length < 1) {
		    return swal("No Player was found!");
		  }

		  const players = [];
		  $('#players').html('');

		  for (var i = 0; i < cards_per_player.length; i++) {
		  	let row = cards_per_player[i].toString();
		  	$("#players").append(" <p>Player"+(i+1)+": "+row+"</p>");
		  }

		  swal({
		    title: "Players Set!",
		    text: 'So Let\'s Play The Game',
		    icon: "success",
		  });
		})
		.catch(err => {
		  if (err) {
		  	console.log(err);
		    swal("Oh noes!", `The AJAX request failed! ${err}`, "error");
		  } else {
		    swal.stopLoading();
		    swal.close();
		  }
		});
	}
	

</script>
</body>
</html>
