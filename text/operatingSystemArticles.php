<?php
  require_once("./common/tools.php");
top_module_and_left_side_nav("Operating System", "null", true, "null");
?>

      <main class="inset_shadow">
	<div id="position_main_part_of_main">
	  <?php
	    heading("OPERATING SYS");
	    ?>
	
	<article id="main_tag_in_main_min_height">
	    <br><br><h4>Links to All Articles Under Operating Systems</h4>
	    <p>
		Here you will find links to every article under the Operating Sys category in the right navigation menu. The links are listed below:
	    </p>
	    <?php
	      echoOneDirsLinks("OS");
	      ?>
	    <p><!-- Im just used for spaceing rn -->
	    </p>
	</article>

	</div>
	
	<div id="position_to_top_of_page">
	  <a class=a_gui_element href="#"><div id="to_top_of_page">
	      <div id="text_align_to_top_of_page">To Top of Page</div>
	</div>
	  </a>
	</div>

	
      </main>

      
      <?php
	bottom_module_and_right_side("operatingSystemArticles.html", true, false, "", "", "");
	?>
  
  </body>
</html>
