<?php
  require_once("./common/tools.php");
top_module_and_left_side_nav("Misc", "null", true, "null");
?>

      <main class="inset_shadow scroll_style">
	<div id="position_main_part_of_main">	
	<article id="main_tag_in_main_min_height">
	    <?php
	    heading("MISC");
	    ?>
	    <br><br><h4>Links to All Articles Under Misc</h4>
	    <p>
		Here you will find links to every article under the misc category in the right navigation menu. The links are listed below:
	    </p>
	    <?php
	      echoOneDirsLinks("misc");
	      ?>
	    <p><!-- Im just used for spaceing rn -->
	    </p>
	</article>
	<?php
	topOfPageButton();
	?>
	</div>
	
      </main>

      
      <?php
	bottom_module_and_right_side("miscArticles.html", true, false, "", "", "");
	?>
