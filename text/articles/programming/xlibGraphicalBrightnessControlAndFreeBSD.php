<?php
require_once("./common/tools.php");
top_module_and_left_side_nav("xlib and brightness control on lenovo x230 running FreeBSD", "null", true, "samCustom.css");
?>

<main class="inset_shadow">
	<div id="position_main_part_of_main">
<?php
    heading("IS XLIB BRIGHT");
?>
	
	<article id="main_tag_in_main_min_height">
    <br><br><h4>Xlib and Brightness Control On Lenovo X230 Running FreeBSD (THIS ARTICLE IS UNDER CONSTRUCTION)</h4>
    <p>












    what variables I found that I thought were related. Most of them t do anything. Some made my system crash. Eventually I found one that worked and seemingly has no side effects and thus I ended up with the previously listed acpi_call -p '\_SB.PCI0.VID.LCD0._BCM' -i $). I have been using this to change the brightness on my computer (indirectly) ever since.

        Programmatic assistance:


        The main function (the entry point for the program) could take no aruments if it was declared int main() or int main(void), however for this program it takes 2 arguments, argc and argv[]. Argc is an integer that holds the number of arguments passed on the commandline
    </p>
<pre><code class="c++ hljs cpp">
<span class="hljs-function"><span class="hljs-keyword">int</span> <span class="hljs-title">main</span><span class="hljs-params">(<span class="hljs-keyword">int</span> argc, <span class="hljs-keyword">char</span> * argv[])</span>
</span>{<span class="hljs-comment">//this program requires 2 and only 2 command line argument's (this includes the program name)</span>
  <span class="hljs-comment">//the 2nd argument must be + or -</span>
  <span class="hljs-comment">//maximum brightness value, minimum brightness value, granularity of brightnes level's (intervals)</span>
  <span class="hljs-comment">//and the default value should the value read not be good</span>
  <span class="hljs-keyword">constexpr</span> <span class="hljs-keyword">int</span> BR_RANGE_MAX {<span class="hljs-number">100</span>}, BR_RANGE_MIN {<span class="hljs-number">10</span>}, BR_INTERVAL_GRANULARITY {<span class="hljs-number">10</span>}, BR_DEFAULT {<span class="hljs-number">80</span>};
  <span class="hljs-keyword">const</span> <span class="hljs-built_in">std</span>::<span class="hljs-built_in">string</span> fileName {<span class="hljs-string">"/usr/tmp/brLevel"</span>}; <span class="hljs-comment">//"/usr/home/cyan/.config/brightness/brLevel"      </span>
  <span class="hljs-keyword">int</span> brLevel {getIntFromFile(BR_DEFAULT, fileName)};
  
  <span class="hljs-keyword">if</span>(argc == <span class="hljs-number">2</span>)
    {
      <span class="hljs-keyword">char</span> arg {};
      arg = argv[<span class="hljs-number">1</span>][<span class="hljs-number">0</span>];<span class="hljs-comment">//this is safe since even if there is only one argumen argv[1] shoud equal '\0'</span>
      
      <span class="hljs-keyword">if</span>(argv[<span class="hljs-number">1</span>][<span class="hljs-number">1</span>] == <span class="hljs-string">'\0'</span> &amp;&amp; (arg == <span class="hljs-string">'+'</span> || arg == <span class="hljs-string">'-'</span>))
	{
	  brLevel = adjustBR_Val(BR_RANGE_MAX, BR_RANGE_MIN, BR_INTERVAL_GRANULARITY, arg, brLevel);
	  <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cout</span>&lt;&lt;<span class="hljs-string">"level = "</span>&lt;&lt;brLevel&lt;&lt;<span class="hljs-built_in">std</span>::<span class="hljs-built_in">endl</span>;
	  <span class="hljs-keyword">if</span>(brLevel == <span class="hljs-number">-1</span>)
	    <span class="hljs-keyword">return</span> brLevel;<span class="hljs-comment">//arg did not match any case</span>
	  <span class="hljs-keyword">if</span>(!checkBR_Val(BR_RANGE_MAX, BR_RANGE_MIN, BR_INTERVAL_GRANULARITY, brLevel))
	    brLevel = BR_DEFAULT;<span class="hljs-comment">//if we did not get a good brightness value from getIntFromFile	  </span>
	  <span class="hljs-built_in">std</span>::<span class="hljs-built_in">stringstream</span> command {};
	  command&lt;&lt;<span class="hljs-string">"/usr/home/cyan/.config/brightness/brctl.sh "</span>&lt;&lt;<span class="hljs-built_in">std</span>::to_string(brLevel);
	  system(command.str().c_str());
	  saveIntToFile(fileName, brLevel);
	  display(brLevel);
	  <span class="hljs-keyword">return</span> <span class="hljs-number">0</span>;
	}
	<span class="hljs-keyword">else</span>
	  printUsage(argv[<span class="hljs-number">0</span>]);
    }
  <span class="hljs-keyword">else</span>
    <span class="hljs-keyword">if</span>(argc == <span class="hljs-number">1</span>)
      {
	<span class="hljs-keyword">if</span>(!checkBR_Val(BR_RANGE_MAX, BR_RANGE_MIN, BR_INTERVAL_GRANULARITY, brLevel))
	  brLevel = BR_DEFAULT;<span class="hljs-comment">//if we did not get a good brightness value from getIntFromFile</span>
	    
	<span class="hljs-built_in">std</span>::<span class="hljs-built_in">stringstream</span> command {};
	command&lt;&lt;<span class="hljs-string">"/usr/home/cyan/.config/brightness/brctl.sh "</span>&lt;&lt;<span class="hljs-built_in">std</span>::to_string(brLevel);
	system(command.str().c_str());
	<span class="hljs-built_in">std</span>::<span class="hljs-built_in">cout</span>&lt;&lt;<span class="hljs-string">"level = "</span>&lt;&lt;brLevel&lt;&lt;<span class="hljs-built_in">std</span>::<span class="hljs-built_in">endl</span>;
	saveIntToFile(fileName, brLevel);
	display(brLevel);
	<span class="hljs-keyword">return</span> <span class="hljs-number">0</span>;
      }
    <span class="hljs-keyword">else</span>
      printUsage(argv[<span class="hljs-number">0</span>]);
  
  <span class="hljs-keyword">return</span> <span class="hljs-number">-1</span>;
}
</code></pre>
                                                                                                                                                                                                                                                                                                                                                                       


    
        </article>







                                                                                                                                                                                                                                                                                                                                                                       

	</div>
	
	<div id="position_to_top_of_page">
    <a href="#"><div id="to_top_of_page">
    <div id="text_align_to_top_of_page">To Top of Page</div>
    </div></a>
    </div>
    </main>

      
<?php
	bottom_module_and_right_side("xlibGraphicalBrightnessControlAndFreeBSD.html", true, true, "programming", "programmingArticles.html");
?>
  
</body>
</html>
