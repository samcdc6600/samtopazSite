<?php
  require_once("./common/tools.php");
top_module_and_left_side_nav("About", "about.html", true, "null");
?>

      <main class="inset_shadow">
	<div id="position_main_part_of_main">
	<article id="main_tag_in_main_min_height">
		<?php
		heading("ABOUT");
		?>

	    <br><br><h4>Some Things</h4>
	    <p>
		This site is run by Samuel Brown (pictured here)
	        <img src="./media/me.jpg" alt="A photo of the site owner" class="margin-left margin-top float_right">
		, a computing enthusiast.
		I am interested in many topics, including but not limited to computer architecture, operating systems and computer programming.
		<br><br>This site was created to provide a space to share ideas and practice writing about technical topics. As well as acting as a showcase for my work. I believe that I can improve my own understanding of ideas and topics by writing about them. I also hope that the site may help others to understand ideas and learn about topics in the future.
	    </P>
	</article>

	<?php
	topOfPageButton();
	?>
	</div>
	
      </main>

      
      <?php
	bottom_module_and_right_side("null", true, false, "", "");
	?>
  
  </body>
</html>
