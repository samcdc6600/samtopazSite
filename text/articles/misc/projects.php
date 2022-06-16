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

	  <div class="slideShow">
	    <video class="float-right slideShow" controls
		   autoplay loop>
	      <source src="media/videos/binaryClockDemo.mp4" type="video/mp4">
		1 Your browsing software does not seem to support the video tag.
	    </video>
	    <img class="float-right slideShow"
		 src="media/images/binaryClockRender.jpg"
		 alt="3D render of binary clock.">
	  </div>
	      
	  <p>
	    THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE
	    TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS
	    THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS
	    IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT!
	    THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE
	    TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS
	    THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS IS THE TEXT! THIS
	    IS THE TEXT! THIS IS THE TEXT!THIS IS THE TEXT! THIS IS THE TEXT! THIS
	    IS THE TEXT! 
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
  
</body>
</html>
