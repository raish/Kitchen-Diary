<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" href="main.css" rel="stylesheet" media="screen" /> 
	</head>
	<body>
		<div id="book">
			<canvas id="pageflip-canvas"></canvas>
			<div id="pages">
				<section>
					<div>
						<h2>Recipe 1</h2>
					</div>
				</section>
				<section>
					<div>
						<h2>Recipe 2</h2>
					</div>
				</section>
				<section>
					<div>
						<h2>Recipe 3</h2>
					</div>
				</section>
				<section>
					<div>
						<h2>Recipe 4</h2>						
					</div>
				</section>
			</div>
		</div>
		<div style ="position:absolute; left: 1100px; top: 600px;">
		<button type="button" id="button-prev1" onclick="javascript:BackPage();">Previous</button>
		<button type="button" id="button-next1" onclick="javascript:FrontPage();">Next</button>
		</div>
			
		<script type="text/javascript" src="pageflip.js"></script>
	</body>	
