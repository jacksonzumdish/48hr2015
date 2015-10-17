// position and control
var posX = 0;
var posY = 0;
var deltaX = 0;
var deltaY = 0;
var flap = false;
var collapse = false;
var collapseSwitch = false;
var birdPosition = 0;
var feathering = 0;
var gameready = true;
var firstkeyhole = true;

var maxW = 1000;
var maxH = 700;
var soundOn = true;
var clipping = false;

var hasGP = false;
var repGP;

var toggleSquare = false;

function canGame() {
	return "getGamepads" in navigator;
}

function reportOnGamepad() {

	flap = false;
	collapse = false;

	if (hasGP) {
		var gp = navigator.getGamepads()[0];

		if ( gp.buttons[0].pressed ) { // X
			if ( !gameRunning && gameready ) {
				startGame();
			} else {
				flap = true;
			}
		}

		if ( gp.buttons[1].pressed ) { // ○
			collapse = true;
		} else {
			collapse = false;
		}

		if ( gp.buttons[2].pressed ) { // □
			//soundOn = true;
		}

		if ( gp.buttons[3].pressed ) { // ∆
			//if (soundOn) {
			//	soundOn = false;
			//} else if ( gameRunning ) {
			//	endGame();
			//}
		}

		/*
		var html = "";
			html += "id: "+gp.id+"<br/>";
		
		for(var i=0;i<gp.buttons.length;i++) {
			html+= "Button "+(i+1)+": ";
			if(gp.buttons[i].pressed) html+= " pressed";
			html+= "<br/>";
		}

		*/

		deltaX = gp.axes[0];
		deltaY = gp.axes[1];

		//$("#gamepadDisplay").text(deltaX);

	}
	
	if ( Key.isDown(Key.UP) ) {
		if ( !gameRunning && gameready ) {
			startGame();
		} else {
			flap = true;
			deltaX = 0;
		}
	}
	if ( Key.isDown(Key.DOWN) ) {
		collapse = true;
		deltaX = 0;
	}
	if ( Key.isDown(Key.LEFT) ) {
		deltaX = -0.5;
	}
	if ( Key.isDown(Key.RIGHT)) {
		deltaX = 0.5;
	}
	
	
}

function setupKeyboard () {
	window.addEventListener('keyup', function(event) { Key.onKeyup(event); }, false);
	window.addEventListener('keydown', function(event) { Key.onKeydown(event); }, false);
}





var gameRunning = false;
var currentIndex = 0;
var soundIndex = 0;
var currentLoop = "intro2";
var currentFrame = undefined;
var soundBeat = 4; // sound beats to game frames

var levelTimeIn, levelTimeOut;

function heartbeat() {

	reportOnGamepad();

	// play next beat
	//console.log(loops[ currentLoop ]);
	if (soundBeat == 0) {
		loops[ currentLoop ][ soundIndex ].forEach(function(entry) {
			if (soundOn) {
				sfx[ entry ](); // play each sound through seperate channel
			}
		});
		soundBeat = 4;
		soundIndex++;
	} else {
		soundBeat--;
	}

	// happen every frame

			// move bird
			if ( gameRunning ) {
			
				if (flap) {
					TweenMax.to(birdModelGroup.rotation, 0.2, { x: -1 });
					posY += 100;
				} else {
					TweenMax.to(birdModelGroup.rotation, 1, { x: -1.5 });
					posY -= 20; // gravity
				}

				if (collapse) {
					if (!collapseSwitch) {
						posY += 500; // initial jump
						//TweenMax.to(birdModelGroup.rotation, 0.4, { y:+6.28319 });
						TweenMax.to(birdModelGroup.scale, 0.2, { x: 0.5 });
						TweenMax.to(meshWingLeft.rotation, 0.1, { x: 2.14159 });
						TweenMax.to(meshWingRight.rotation, 0.1, { x: 4.14159 });
						TweenMax.to(meshTailGroup.scale, 0.2, { x: 2 });
						collapseSwitch = true;
					}
					posY -= 30; // gravity
				} else {
					if (collapseSwitch) {
						TweenMax.to(birdModelGroup.scale, 0.2, { x: 2 });
						TweenMax.to(meshWingLeft.rotation, 0.1, { x: 3.14159 });
						TweenMax.to(meshWingRight.rotation, 0.1, { x: 0 });
						TweenMax.to(meshTailGroup.scale, 0.5, { x: 1 });
						collapseSwitch = false;
					}
				}
			}

			if (deltaX > 0.03 || deltaX < -0.03) { // stop controller drift
				posX += (deltaX*200);
			}
			/*
			if (deltaY > 0.03 || deltaY < -0.03) { // stop controller drift
				posY -= (deltaY*200);
			}
			*/
			TweenMax.to(meshWingLeft.rotation, 0.1, { x: 3.14159-(Math.random()*feathering) });
			TweenMax.to(meshWingRight.rotation, 0.1, { x: 3.14159-(Math.random()*feathering) });

			// boundarys
			if (posX > maxW) {
				posX = maxW; // right
			}
			if (posX < -maxW) {
				posX = -maxW; // left
			}
			if (posY > maxH) {
				posY = maxH; // top
			}
			if (posY < -maxH) {
				posY = -maxH; // bottom
				TweenMax.to(birdModelGroup.scale, 0.2, { x: 2 });
				TweenMax.to(meshWingLeft.rotation, 0.1, { x: 3.14159 });
				TweenMax.to(meshWingRight.rotation, 0.1, { x: 3.14159 });
				TweenMax.to(meshTailGroup.scale, 0.5, { x: 1 });
				
			}

			// get bird position
			birdPosition = 0; // top row
			if (posY < 0) {
				birdPosition += 1; // bottom row
			}
			if (posX < -333) {
				birdPosition += 0.1; // left col
			} else if (posX > 333) {
				birdPosition += 0.3; // right col
			} else {
				birdPosition += 0.2; // centre col
			}
			$("#locationDisplay").text(birdPosition);
 
			if ( gameRunning ) {
				TweenMax.to(birdModelGroup.position, 0.2, { x:posX });
				TweenMax.to(birdModelGroup.position, 0.3, { y:posY });

				TweenMax.to(birdModelGroup.rotation, 0.2, { y: deltaX });
				TweenMax.to(meshTailGroup.rotation, 0.2, { y: -deltaX });
				//TweenMax.to(camera.position, 1, { x: birdModelGroup.position.x*0.2, y: birdModelGroup.position.y*0.5 });
			}

	// 
	if ( soundIndex >= loops[ currentLoop ].length ) { // end of music sequence
		soundIndex = 0;

		// get speed tempo from beats
		levelTimeOut = levelTimeIn;
		levelTimeIn = new Date().getTime();

		// do game stuff for each music sequence
		if ( gameRunning ) {


			checkCollision( currentIndex-2 );
			currentFrame = level0[ currentIndex ];

			// set sound loop if any
			if ( currentFrame["loop"] != undefined ) {
				currentLoop = currentFrame["loop"];
			}

			// generate objects
			if ( currentFrame["boxes"] != undefined ) {
				rooms[ currentFrame["boxes"] ].forEach(function(entry) {
					//console.log( entry );
					addCube( entry[0], entry[1], entry[2], entry[3], entry[4], entry[5], entry[6], (levelTimeIn-levelTimeOut)*0.001, currentIndex )
				});
			}

			if ( currentFrame["killzones"] != undefined ) {
				currentFrame["killzones"].forEach(function(entry) {
					//console.log( entry );
					if ( entry == 0.1) {
						addCube( 700, 600, 100, -700, 300, 1, 0xff0000, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					} else if ( entry == 0.2) {
						addCube( 700, 600, 100, 0, 300, 1, 0xff0000, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					} else if ( entry == 0.3) {
						addCube( 700, 600, 100, 700, 300, 1, 0xff0000, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					} else if ( entry == 1.1) {
						addCube( 700, 600, 100, -700, -300, 1, 0xff0000, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					} else if ( entry == 1.2) {
						addCube( 700, 600, 100, 0, -300, 1, 0xff0000, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					} else if ( entry == 1.3) {
						addCube( 700, 600, 100, 700, -300, 1, 0xff0000, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					}
				});
			}

			if (currentFrame["keyholeinstruction"]) { // display the instructions
				TweenMax.to( $('#instruction_collapse'), 1, { alpha:1 });
			}
			if (currentFrame["keyholeinstruction_hide"]) { // display the instructions
				TweenMax.to( $('#instruction_collapse'), 1, { alpha:0 });
			}

			if ( currentFrame["keyhole"] != undefined ) {
				if ( currentFrame["keyhole"] == 0.1) {
					//addCube( 1001, 1202, 100, -1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, -1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
				} else if ( currentFrame["keyhole"] == 0.2) {
					addCube( 1001, 1202, 100, -1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					//addCube( 1001, 1202, 100, 0, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, -1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
				} else if ( currentFrame["keyhole"] == 0.3) {
					addCube( 1001, 1202, 100, -1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					//addCube( 1001, 1202, 100, 1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, -1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
				} else if ( currentFrame["keyhole"] == 1.1) {
					addCube( 1001, 1202, 100, -1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					//addCube( 1001, 1202, 100, -1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
				} else if ( currentFrame["keyhole"] == 1.2) {
					addCube( 1001, 1202, 100, -1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, -1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					//addCube( 1001, 1202, 100, 0, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
				} else if ( currentFrame["keyhole"] == 1.3) {
					addCube( 1001, 1202, 100, -1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 1001, 300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, -1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					addCube( 1001, 1202, 100, 0, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
					//addCube( 1001, 1202, 100, 1001, -300, 1, 0x0000ff, (levelTimeIn-levelTimeOut)*0.001, currentIndex );
				}
			}
			
			currentIndex++;

			// end game
			if ( currentFrame["crown"] != undefined ) {
				TweenMax.to(crownModelGroup.position, (levelTimeIn-levelTimeOut)*0.0025, { z: 0 });
			}

			if ( currentFrame["endgame"] != undefined ) {
				endGame(true);
			}

		}
	}

}

function startGame() {

	gameready = false;
	if (soundOn) {
		sfx.bass_crushed();
	}
	TweenMax.to(birdModelGroup.rotation, 1, { x: -1.5 });
	TweenMax.to(birdModelGroup.scale, 5, { y: 2, x: 2, ease: Linear.easeNone });
	meshWingLeft.material.color.setHex(0xffffff);
	meshWingRight.material.color.setHex(0xffffff);
	meshTail.material.color.setHex(0xffffff);
	renderer.setClearColor( 0x000000, 1);
	currentIndex = 0;
	gameRunning = true;
	feathering = 0.2;
	//
	TweenMax.to(crownModelGroup.scale, 2, { x: 1, y: 1, z: 1 });
	TweenMax.to(crownModelGroup.position, 7, { y: 0, z: -10000 });
	TweenMax.to( $('#instruction_fly'), 0, { alpha:0 });
	TweenMax.to( $('#instruction_fly'), 0, { delay:2.1, alpha:0 });
	TweenMax.to( $('#oliverlardner'), 0, { alpha:0 });
	TweenMax.to( $('#instruction_collapse'), 0, { alpha:0 });
}

function endGame(win) {
	if (win) {
		if (soundOn) {
			sfx.happy_chirp();
		}
		meshWingLeft.material.color.setHex(0xffeb40);
		meshWingRight.material.color.setHex(0xffeb40);
		meshTail.material.color.setHex(0xffeb40);
		renderer.setClearColor( 0xffcc00, 1);
		//
		TweenMax.to(crownModelGroup.scale, 7, { x: 0.5, y: 0.5, z: 0.5 });
		TweenMax.to(crownModelGroup.position, 7, { y: 300 });
		//
	} else {
		if (soundOn) {
			sfx.end2();
		}
		meshWingLeft.material.color.setHex(0x000000);
		meshWingRight.material.color.setHex(0x000000);
		meshTail.material.color.setHex(0x000000);
		renderer.setClearColor( 0xffffff, 1);
	}
	//
	feathering = 0;
	//
	TweenMax.to(birdModelGroup.position, 7, { x:0 });
	TweenMax.to(birdModelGroup.position, 7, { y:0 });
	if (win) {
		TweenMax.to(birdModelGroup.rotation, 0, { y:6.28319*3 });
		TweenMax.to(birdModelGroup.rotation, 5, { y:0, ease:Cubic.easeOut });
	} else {
		TweenMax.to(birdModelGroup.rotation, 7, { y:6.28319 });
	}
	TweenMax.to(birdModelGroup.rotation, 7, { x: 0 });
	TweenMax.to(meshTailGroup.scale, 1, { x: 1 });
	TweenMax.to(birdModelGroup.scale, 10, { y: 1, x: 1, onComplete: function(){
		gameready = true;
		if ( !gameRunning ) {
			TweenMax.to( $('#instruction_fly'), 2, { alpha:1 });
			currentLoop = "intro2";
		}
	} });
	TweenMax.to(meshTailGroup.rotation, 7, { y:0 });
	//
	gameRunning = false;
	currentIndex = 0;
	soundIndex = 0;
	currentLoop = "intro2";
}

// use date for accurate timings
var start = new Date().getTime(),  
    time = 0,  
    elapsed = '0.0',
    diff = 0;
function instance()  
{  
    time += 21;  
    elapsed = Math.floor(time / 21) / 10;  
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }  
    //document.title = elapsed;  
    diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (21 - diff));  

    heartbeat();

}  
window.setTimeout(instance, 25);

function addCube(h, w, d, x, y, del, col, speed, id) {
	//console.log(h);
	var geometry = new THREE.BoxGeometry( w, h, d );
	var material = new THREE.MeshBasicMaterial( {color: col } );
	var cube = new THREE.Mesh( geometry, material );
	cube.position.z = -8000;
	cube.position.x = x;
	cube.position.y = y;
	scene.add( cube );
	TweenMax.to(cube.position, speed, {z:0, delay:speed*del, ease:Linear.easeNone, onComplete:function(){
		scene.remove( cube );
	}});
}

function checkCollision(id) {
	if (gameRunning && level0[id] != undefined && clipping) {

		// check killzones
		if ( level0[id]["killzones"] != undefined ) {
			level0[id]["killzones"].forEach(function(entry) {
				console.log( entry, birdPosition );
				if ( birdPosition == entry ) {
					console.log( "hit: ", entry, birdPosition );
					endGame();
				}
			});
		}

		// check keyholes
		if ( level0[id]["keyhole"] != undefined ) {
			if ( level0[id]["keyhole"] != birdPosition ) { // not throug the keyhole
				console.log( "keyhole: ", level0[id]["keyhole"], birdPosition );
				endGame();
			} else if ( level0[id]["keyhole"] == birdPosition && !collapse) { // through the keyhole, not collapsed
				console.log( "not collapsed through keyhole: ", level0[id]["keyhole"], birdPosition );
				endGame();
			}
		}

	}
}

// tweenmax is more accurate for timing
//TweenMax.to(this, 0.2, {alpha:1, onRepeat:heartbeat, repeat:-1});
	
$(document).ready(function() {

	TweenMax.to( $('#instruction_fly'), 0, { alpha:0 });
	TweenMax.to( $('#instruction_fly'), 2, { alpha:1 });
	TweenMax.to( $('#oliverlardner'), 0, { alpha:0 });
	TweenMax.to( $('#oliverlardner'), 2, { alpha:1 });
	TweenMax.to( $('#instruction_collapse'), 0, { alpha:0 });

	setupKeyboard();

	if(canGame()) {

		var prompt = "To begin using your gamepad, connect it and press any button!";
		$("#gamepadPrompt").text(prompt);
		
		$(window).on("gamepadconnected", function() {
			hasGP = true;
			$("#gamepadPrompt").html("Gamepad connected!");
			console.log("connection event");
			//repGP = window.setInterval(reportOnGamepad,50);
		});

		$(window).on("gamepaddisconnected", function() {
			console.log("disconnection event");
			$("#gamepadPrompt").text(prompt);
			window.clearInterval(repGP);
		});

		//setup an interval for Chrome
		var checkGP = window.setInterval(function() {
			console.log('checkGP');
			if(navigator.getGamepads()[0]) {
				if(!hasGP) $(window).trigger("gamepadconnected");
				window.clearInterval(checkGP);
			}
		}, 500);
	}
	
});


// keybaord utility
var Key = {
  _pressed: {},

  LEFT: 37,
  UP: 38,
  RIGHT: 39,
  DOWN: 40,
  
  isDown: function(keyCode) {
    return this._pressed[keyCode];
  },
  
  onKeydown: function(event) {
    this._pressed[event.keyCode] = true;
  },
  
  onKeyup: function(event) {
    delete this._pressed[event.keyCode];
  }
};