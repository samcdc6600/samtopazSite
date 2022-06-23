<?php
require_once("./common/tools.php");
top_module_and_left_side_nav("P R O J E C T S", "null", true, "null");
?>

<main class="inset_shadow scroll_style">
	<div id="position_main_part_of_main">	
	<article id="main_tag_in_main_min_height">
	<?php
    	heading("PROJECTS");
	?>
	<br><br><h4>Projects</h4>
	<p>
	  Here I have compiled some examples of projects I've worked on.
	  Not every one is finished, but they are for the most part.
	  <strong>Link:</strong>
	  <a href="https://github.com/samcdc6600" target="_blank"> samcdc6600 :^)</a>
	</p>
	<br>

	
	<div class="articleSection">
	  <h4>xFrog3D</h4>
	  <video class="float-right" controls autoplay loop>
	    <source src="media/videos/xFrog3dDemo.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	  </video>
	  <p>
	    This is something I made for a class I took at university. It's
	    supposed to be a 3D version of the arcade game Frogger.
	    It is written in C++ and uses OpenGL immediate mode as well as
	    FreeGLUT and also SOIL (for loading textures). You can see a video of
	    it to the right. Admittedly it needs a bit of work :).
	  </p>
	  <br>
	</div>

	
	<div class="articleSection">
	  <h4>NESEmu</h4>
	  <video class="float-right" controls autoplay loop>
	    <source src="media/videos/demoOfAlmostCompleated6502CoreForNESEmu.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	  </video>
	  <p>
	    Currently very much incomplete this program is intended to be an
	    NESEmulator. However it is currently just a mostly functional 6502
	    emulator. It will pass almost all of the tests in
	    6502_functional_test.asm. We think that the only thing currently
	    stopping it from working is a flag being incorrectly set by some of
	    the adc and sbc instructions. We plan to do more work on this in the
	    future. Hopefully one day it will be able to play an NES game.
	  </p>
	  <br>
	</div>

	
	<div class="articleSection">
	  <h4>Binary Clock</h4>

	  <div class="slideshowContainer">
	    <video class="float-right noJsSlideshow" controls
		   autoplay loop>
	      <source src="media/videos/binaryClockDemo.mp4" type="video/mp4">
		1 Your browsing software does not seem to support the video tag.
	    </video>
	    <img class="float-right noJsSlideshow"
		 src="media/images/binaryClockBreadboard.jpg"
		 alt="Binary clock breadboard.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/binaryClockRender.jpg"
		 alt="3D render of binary clock.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/binaryClockCircuit.jpg"
		 alt="Binary clock circuit.">
	  </div>

	  
	  <p>
	    A clock with binary digit's for hours minutes and seconds (note
	    that it is not a BCD clock.) The time is read from left to right
	    with the left most column representing hours. It uses an ATmega16 to
	    do most of the work. The output of a 1MHz crystal oscillator is fed
	    into a CD74HCT390E which is set up in a duel bi-quinary
	    configuration. In this way it will divide the signal by 100. Then
	    this chip is hooked up to an identical chip setup in the same
	    configuration and this next chip is again hooked up to one the same
	    as it and in the same configuration. Thus we end up with the 1MHz
	    signal being divided by 1,000,000. This is then fed into the micro
	    controller in such a way as to cause an interrupt and the chip
	    updates it's seconds counter (and the minutes and hours counters if
	    need be.) The chip was programmed in assembly language. The chip has
	    40 pins and so there is no need to multiplex the output and we can
	    directly drive each LED individually. I first built the circuit on a
	    few breadboards and then wrote the code that the micro controller
	    runs. Finally I designed a PCB using KiCad and had it manufactured.
	    There is a small bodge on the board as I originally had the
	    oscillator powered by a voltage regulator. However I made a mistake
	    when translating what I had on the bread board to the KiCad
	    schematic. Anyway it turns out that the oscillator runs fine off of
	    5V anyway (the data sheet was a bit confusing.) Not having much
	    electronics knowledge I feel this was a good project and I learnt a
	    bit (even if most of the time I spent on it was programming the
	    micro.)
	  </p>
	</div>

	
	<div class="articleSection">
	  <h4>Menger Sponge</h4>

	  <video class="float-right" controls autoplay loop>
	    <source src="media/videos/mengerSponge.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	  </video>	      
	  <p>
	    Nothing special just a simple menger sponge. It's written in C++ and
	    OpenGL.
	  </p>
	</div>


	<div class="articleSection">
	  <h4>SOLP</h4>

	  <video class="float-right" controls autoplay loop>
	    <source src="media/videos/mengerSponge.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	  </video>	      
	  <p>
	    Sleep FreeBSD On Low Power is a small shell script I've written to
	    check for low battery on my laptop. When the battery get's below a
	    certain percentage it will play a sound and generate a dialogue box
	    to warn of the situation as it stands. Then if things get worse and
	    the battery get's too low it will play a more ominous sound and
	    display a dialogue box with a count down timer. When the timer is up
	    the script will put the computer to sleep.
	    <br>
	    The script should be started when X11 starts because it generates
	    the aforementioned dialogue boxes. I always practically start X when
	    I boot up my laptop so this isn't a problem. It wakes up every few
	    seconds to check the battery level. This of course isn't optimal. I
	    may modify the script so that it can be used in such a way that
	    FreeBSD would call it when some event related to low battery is
	    generated. However I haven't yet looked into how this would be done.
	  </p>
	</div>

	
	<div class="articleSection">
	  <h4>F62 Model F Keyboard Solenoid Holder</h4>

	  <div class="slideshowContainer">
	    <img class="float-right noJsSlideshow"
		 src="media/images/modelF62SSolenoidHolderTop.jpg"
		 alt="A photo from the top of a solenoid holder for the Model
		      F62 reproduction keyboard.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/modelF62SSolenoidHolderAngle.jpg"
		 alt="A photo from an angle of a solenoid holder for the Model
		      F62 reproduction keyboard.">
	  </div>
	  
	  <p>
	    You can buy a solenoid and solenoid driver along with your new
	    production Model F64. However there is no standard way to mound
	    it. So I designed and 3D printed a mount for it (the solenoid that
	    is) along with the solenoid driver using FreeCAD.
	  </p>
	</div>


	<div class="articleSection">
	  <h4>Laptop Stand</h4>

	  <div class="slideshowContainer">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandFrontWithLaptop.jpg"
		 alt="Laptop stand from front with laptop.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandFront.jpg"
		 alt="Laptop stand from front.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandBottom.jpg"
		 alt="Laptop stand upside down.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandFreeCad.jpg"
		 alt="Part of the design for the laptop stand in FreeCAD.">
	  </div>
	  
	  <p>
	    A laptop stand I designed using FreeCAD. This took quite a long time
	    to design as it is not just a relatively complex shape it also has
	    over 20 parts, since my printer only has so much print volume.
	    The legs are detachable and although the height is not adjustable
	    I've used it on a couple of desks of different heights and it works
	    quite well. It is designed so that a relatively small keyboard can
	    fit under it and thus you don't have to have your keyboard too close
	    to you or your laptop too far away when your using them.
	  </p>
	</div>
	
	
        </article>
	
	<?php
	topOfPageButton();
	?>
    </div>
    </main>

      
<?php
	bottom_module_and_right_side("projects.html", true, true, "misc",
"miscArticles.html");
?>
