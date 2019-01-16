<?php
  require_once("./common/tools.php");
top_module_and_left_side_nav("Computer Architecture", "null", true, "null");
?>

      <main class="inset_shadow">
	<div id="position_main_part_of_main">
	  <?php
	    heading("COMP ARCH");
	    ?>
	
	<article id="main_tag_in_main_min_height">
	    <br><br><h4>Links to All Articles Under Computer Architecture</h4>
	    <p>
		Here you will find links to every article under the Comp Arch category in the right navigation menu. The links are listed below:
	    </p>
	    <?php
	      echoOneDirsLinks("compArch");
	      ?>
	    <p><!-- Im just used for spaceing rn -->
	    </p>
	</article>

	</div>
	
	<div id="position_to_top_of_page">
	  <a href="#"><div id="to_top_of_page">
	      <div id="text_align_to_top_of_page">To Top of Page</div>
	</div>
	  </a>
	</div>

	
      </main>

      
      <?php
	bottom_module_and_right_side("computerArchitectureArticles.html", true, false, "", "", "");
	?>
  
  </body>
</html>