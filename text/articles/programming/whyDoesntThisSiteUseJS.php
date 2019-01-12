<?php
require_once("./common/tools.php");
top_module_and_left_side_nav("Why this site doesn't use JS", "null", true, "null");
?>

<main class="inset_shadow">
	<div id="position_main_part_of_main">
<?php
    heading("WHY NO JS?");
?>
	
	<article id="main_tag_in_main_min_height">
    <br><br><h4>Javascript and Its Overuse and Abuse</h4>
    <p>
    According to an article on bbc.co.uk from the 5th of December 2006 a survey found that 73% of sites relied on JavaScript for important functionality! In 2006! I believe that it is almost certain that most of these sites could have gone without the use of JS yet people insist on using it for "important" features. Since 2006 there have been additions and improvements to the HTML and CSS standards that would further reduce the need for JS in many cases.  When firefox was single threaded I would frequently experience the browser locking up due to JS scripts running on pages I had open. Regardless of how well firefox was implemented that should not have been a common phenomenon, yet it was. People deploy poorly designed and maintained scripts on sites all over the net and in the end it's the user's who suffer. JS is also poorly designed in my opinion. For example it is weakly typed meaning that you do not specify the type of a variable when declaring it. Errors relating to the type of variables are allowed to propage more easily because of java's weak typing rules. I believe things should be made static wherever possible, if dynamic content is needed it should be implemented server side and only then if there is no other option dynamic content should be done client side. JS is supposedly safe because it is sandboxed. But bugs are always present in large software and hardware systems with good code achieving around 1 bug per 1000 lines of code. So in reality it is more than likely that sand boxed JS scripts are not secure. To be clear I am not entirely against scripts running client side in browsers. I do however think that JS is poorly designed and is used far far too often. It should only be used when required for something that is absolutely essential to a site.
    </p>
    <strong>References:</strong>
    <ul>
    <li><a href="https://stackoverflow.com/questions/2815628/what-percent-of-web-sites-use-javascript" target="_blank">https://stackoverflow.com/questions/2815628/what-percent-of-web-sites-use-javascript</a></li>
        <li><a href="http://news.bbc.co.uk/2/hi/technology/6210068.stm" target="_blank">http://news.bbc.co.uk/2/hi/technology/6210068.stm</a></li>
    <li><a href="https://en.wikipedia.org/wiki/Strong_and_weak_typing#Definitions_of_%22strong%22_or_%22weak%22" target="_blank">https://en.wikipedia.org...</a></li>

    </ul>
    
        </article>

	</div>
	
	<div id="position_to_top_of_page">
    <a href="#"><div id="to_top_of_page">
    <div id="text_align_to_top_of_page">To Top of Page</div>
    </div></a>
    </div>
    </main>

      
<?php
	bottom_module_and_right_side("whyDoesntThisSiteUseJS.html", true, true, "programming", "programmingArticles.html");
?>
  
</body>
</html>
