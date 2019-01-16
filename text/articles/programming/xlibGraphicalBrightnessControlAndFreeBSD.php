 on <?php
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
    <small>Note: I am writing this well after the fact and so some of the information is a little incomplete. So hopefully there are no obvious errors :).</small>
    </p>







<pre>
<code class="c++ hljs cpp"><span class="hljs-comment">/* Main requires 1 or 2 command line argument's (this includes the program name)
   the 2nd argument must be either '+' or '-', if there are 2 arguments. */</span>
<span class="hljs-function"><span class="hljs-keyword">int</span> <span class="hljs-title">main</span><span class="hljs-params">(<span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> argc, <span class="hljs-keyword">const</span> <span class="hljs-keyword">char</span> * argv[])</span>
</span>{				<span class="hljs-comment">// BR_DEFAULT should be divisible by BR_INTERVAL_GRANULARITY!</span>
  <span class="hljs-keyword">constexpr</span> <span class="hljs-keyword">int</span> BR_RANGE_MIN {<span class="hljs-number">10</span>}, BR_RANGE_MAX {<span class="hljs-number">100</span>}, BR_INTERVAL_GRANULARITY {<span class="hljs-number">10</span>}, BR_DEFAULT {<span class="hljs-number">80</span>};
  <span class="hljs-keyword">constexpr</span> <span class="hljs-keyword">int</span> MAX_ARGC {<span class="hljs-number">2</span>}, MIN_ARGC {<span class="hljs-number">1</span>}, ARG_2_INDEX {<span class="hljs-number">1</span>}; <span class="hljs-comment">// ARG_1_INDEX {0}.</span>
  <span class="hljs-keyword">constexpr</span> <span class="hljs-keyword">char</span> brLevelFileName [] = <span class="hljs-string">"/usr/tmp/brLevel"</span>;
  <span class="hljs-keyword">int</span> brLevel {getIntFromFile(BR_DEFAULT, brLevelFileName)}; <span class="hljs-comment">// Attempt to get current brightness level.</span>

  <span class="hljs-keyword">if</span>(!checkBR_Val(BR_RANGE_MIN, BR_RANGE_MAX, BR_INTERVAL_GRANULARITY, brLevel))
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"Brightness level stored in \""</span>&lt;<brlevelfilename<<"\", not="" evenly="" divisible="" by="" "="" "br_interval_granularity="" ("<<br_interval_granularity<<")="" or="" was="" able="" to="" open="" file="" containing"="" brightness="" level.="" setting="" level="" dealfult="" ("<<br_default<<")\n";="" brlevel="BR_DEFAULT;" dowork(brlevel,="" brlevelfilename);="" }="" else="" {="" if(argc="=" max_argc)="" if(handle2ndarg(argv,="" br_range_min,="" br_range_max,="" br_interval_granularity,="" arg_2_index,="" brlevel))="" malformed="" input.="" printusage(argv[0]);="" min_argc)="" *="" set="" specified="" in="" brlevelfilename="" if="" that="" value="" is="" out="" of="" range="" br_default="" return="" 0;="" (exit_sucess);="" <="" pre=""></brlevelfilename<<"\",>&ltbrLevelFileName&lt;&lt;<span class="hljs-string">"\", not evenly divisible by "</span>
	<span class="hljs-string">"BR_INTERVAL_GRANULARITY ("</span>&lt;<br_interval_granularity<<") or="" was="" not="" able="" to="" open="" file="" containing"="" "="" brightness="" level.="" setting="" level="" dealfult="" ("<<br_default<<")\n";="" brlevel="BR_DEFAULT;" dowork(brlevel,="" brlevelfilename);="" }="" else="" {="" if(argc="=" max_argc)="" if(handle2ndarg(argv,="" br_range_min,="" br_range_max,="" br_interval_granularity,="" arg_2_index,="" brlevel))="" malformed="" input.="" printusage(argv[0]);="" min_argc)="" *="" set="" specified="" in="" brlevelfilename="" if="" that="" value="" is="" out="" of="" range="" br_default="" return="" 0;="" (exit_sucess);="" <="" pre=""></br_interval_granularity<<")>&ltBR_INTERVAL_GRANULARITY&lt&lt;<span class="hljs-string">") or was not able to open file containing"</span>
	<span class="hljs-string">" brightness level. Setting brightness level to dealfult ("</span>&lt;<br_default<<")\n"; brlevel="BR_DEFAULT;" dowork(brlevel,="" brlevelfilename);="" }="" else="" {="" if(argc="=" max_argc)="" if(handle2ndarg(argv,="" br_range_min,="" br_range_max,="" br_interval_granularity,="" arg_2_index,="" brlevel))="" malformed="" input.="" printusage(argv[0]);="" min_argc)="" *="" set="" brightness="" to="" level="" specified="" in="" brlevelfilename="" or="" if="" that="" value="" is="" out="" of="" range="" br_default="" return="" 0;="" (exit_sucess);="" <="" pre=""></br_default<<")\n";>&ltBR_DEFAULT&lt&lt<span class="hljs-string">")\n"</span>;
      brLevel = BR_DEFAULT;
      doWork(brLevel, brLevelFileName);      
    }
  <span class="hljs-keyword">else</span>
    {
      <span class="hljs-keyword">if</span>(argc == MAX_ARGC)
	{
	  <span class="hljs-keyword">if</span>(handle2ndArg(argv, BR_RANGE_MIN, BR_RANGE_MAX, BR_INTERVAL_GRANULARITY, ARG_2_INDEX, brLevel))
	    {
	      doWork(brLevel, brLevelFileName);
	    }
	  <span class="hljs-keyword">else</span>
	    {			   <span class="hljs-comment">// Malformed input.</span>
	      printUsage(argv[<span class="hljs-number">0</span>]);
	    }
	}
      <span class="hljs-keyword">else</span>
	<span class="hljs-keyword">if</span>(argc == MIN_ARGC)
	  { <span class="hljs-comment">/* Set brightness to level specified in brLevelFileName or if that value is out of
	       range set level to BR_DEFAULT */</span>
	    doWork(brLevel, brLevelFileName);
	    <span class="hljs-keyword">return</span> <span class="hljs-number">0</span>;
	  }
	<span class="hljs-keyword">else</span>
	  printUsage(argv[<span class="hljs-number">0</span>]);
    }

  <span class="hljs-keyword">return</span> (EXIT_SUCESS);
}
</code>
</pre>
    <!-- End Code section. -->    



<pre>
<code class="c++ hljs cpp"><span class="hljs-function"><span class="hljs-keyword">void</span> <span class="hljs-title">doWork</span><span class="hljs-params">(<span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> level, <span class="hljs-keyword">const</span> <span class="hljs-keyword">char</span> file [])</span>
</span>{
  <span class="hljs-built_in">std</span>::<span class="hljs-built_in">stringstream</span> command {};
  command&lt;&lt;<span class="hljs-string">"~/.config/brightness/brctl.sh "</span>&lt;&lt<span class="hljs-built_in">std</span>::to_string(level);
  system(command.str().c_str()); <span class="hljs-comment">// Change brightness level.</span>
  <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cout</span>&lt;&lt;<span class="hljs-string">"level = "</span>&lt;<level<<'\n'; saveinttofile(file,="" level);="" save="" brightness="" level.="" display(level);="" show="" }="" <="" pre=""></level<<'\n';>&ltlevel&lt;&lt;<span class="hljs-string">'\n'</span>;
  saveIntToFile(file, level); <span class="hljs-comment">// Save brightness level.</span>
  display(level);	<span class="hljs-comment">// Show brightness level.</span>
}
</code>
</pre>  
 

<pre>
<code class="c++ hljs cpp"><span class="hljs-function"><span class="hljs-keyword">bool</span> <span class="hljs-title">handle2ndArg</span><span class="hljs-params">(<span class="hljs-keyword">const</span> <span class="hljs-keyword">char</span> * argv [], <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> BR_RANGE_MIN, <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> BR_RANGE_MAX,
		  <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> BR_INTERVAL_GRANULARITY, <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> ARG_2_INDEX, <span class="hljs-keyword">int</span> &amp; brLevel)</span>
</span>{
  <span class="hljs-keyword">const</span> <span class="hljs-keyword">char</span> arg {argv[ARG_2_INDEX][<span class="hljs-number">0</span>]}; <span class="hljs-comment">// If there is only one argument argv[ARG_2_INDEX] should equal '\0' </span>
      
  <span class="hljs-keyword">if</span>(argv[ARG_2_INDEX][<span class="hljs-number">1</span>] == <span class="hljs-string">'\0'</span> &amp;&amp; (arg == <span class="hljs-string">'+'</span> || arg == <span class="hljs-string">'-'</span>))
    {			<span class="hljs-comment">// We have a well formed second argument.</span>
      brLevel = adjustBR_Val(BR_RANGE_MAX, BR_RANGE_MIN, BR_INTERVAL_GRANULARITY, arg, brLevel);
      <span class="hljs-keyword">return</span> <span class="hljs-literal">true</span>;
    }
  <span class="hljs-keyword">return</span> <span class="hljs-literal">false</span>;
}
</code>
</pre>


<pre>
<code class="c++ hljs cpp"><span class="hljs-function"><span class="hljs-keyword">void</span> <span class="hljs-title">printUsage</span><span class="hljs-params">(<span class="hljs-keyword">const</span> <span class="hljs-built_in">std</span>::<span class="hljs-built_in">string</span> name)</span>
</span>{
  <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cout</span>&lt;&lt;<span class="hljs-string">"error!\nusage: "</span>&lt;<name<<" [options]\noptions\n\t+\tincrease="" screen="" brightness\n\t-\tdecrease="" screen"="" "brightness\n";="" }="" <="" pre=""></name<<">&ltname&lt;&lt;<span class="hljs-string">" [options]\nOPTIONS\n\t+\tIncrease screen brightness\n\t-\tDecrease screen"</span>
    <span class="hljs-string">"brightness\n"</span>;
}
</code>
</pre>


<pre>
<code class="c++ hljs cpp"><span class="hljs-function"><span class="hljs-keyword">int</span> <span class="hljs-title">adjustBR_Val</span><span class="hljs-params">(<span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> rMax, <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> rMin, <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> iGran, <span class="hljs-keyword">const</span> <span class="hljs-keyword">char</span> sign, <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> a)</span>
</span>{
  <span class="hljs-keyword">switch</span>(sign)
    {
    <span class="hljs-keyword">case</span> <span class="hljs-string">'+'</span>:
      <span class="hljs-keyword">if</span>(a == rMax)
	<span class="hljs-keyword">break</span>;
      <span class="hljs-keyword">return</span> a + iGran;      
    <span class="hljs-keyword">case</span> <span class="hljs-string">'-'</span>:
      <span class="hljs-keyword">if</span>(a == rMin)
	<span class="hljs-keyword">break</span>;
      <span class="hljs-keyword">return</span> a - iGran;
    }
  <span class="hljs-keyword">return</span> a;
}
</code>
</pre>





<pre>
<code class="c++ hljs cpp"><span class="hljs-function"><span class="hljs-keyword">void</span> <span class="hljs-title">saveIntToFile</span><span class="hljs-params">(<span class="hljs-keyword">const</span> <span class="hljs-built_in">std</span>::<span class="hljs-built_in">string</span> f, <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> a)</span>
</span>{
  <span class="hljs-built_in">std</span>::<span class="hljs-function">ofstream <span class="hljs-title">out</span><span class="hljs-params">(f.c_str()</span>)</span>;
  <span class="hljs-keyword">if</span>(out.is_open())
    {
      out&lt;<a<<'\0'; out.close();="" }="" else="" {="" std::cerr<<"error="" cant="" open="" file="" \""<<f<<"\"="" for="" writing.\n";="" <="" pre=""></a<<'\0';>&lta&lt;&lt;<span class="hljs-string">'\0'</span>;    
      out.close();
    }
  <span class="hljs-keyword">else</span>
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"Error cant open file \""</span>&lt;<f<<"\" for="" writing.\n";="" }="" <="" pre=""></f<<"\">&ltf&lt;&lt;<span class="hljs-string">"\" for writing.\n"</span>;
    }
}
</code>
</pre>




<pre>
<code class="c++ hljs cpp"><span class="hljs-function"><span class="hljs-keyword">void</span> <span class="hljs-title">init</span><span class="hljs-params">(context &amp; con)</span>
</span>{
  con.display = XOpenDisplay(<span class="hljs-literal">nullptr</span>);
  <span class="hljs-keyword">if</span>( !con.display )
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt; <span class="hljs-string">"Error can't open con.display."</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_ONE);
    }
				<span class="hljs-comment">// Get screen geometry.</span>
  con.screenNum = DefaultScreen(con.display);
  con.displayWidth = DisplayWidth(con.display, con.screenNum);
  con.displayHeight = DisplayHeight(con.display, con.screenNum);
  
  con.attribs.override_redirect = <span class="hljs-number">1</span>; <span class="hljs-comment">// Non bordered / decorated window.</span>

  <span class="hljs-comment">//con.windowLen = 683;</span>
  con.window = XCreateWindow(con.display, RootWindow(con.display, <span class="hljs-number">0</span>), con.displayWidth -con.WINDOW_LEN, con.Y_OFFSET,
			     con.WINDOW_LEN, con.WINDOW_HEIGHT, <span class="hljs-number">0</span>, CopyFromParent, CopyFromParent, CopyFromParent,
			     CWOverrideRedirect, &amp;con.attribs);
  XSetWindowBackground(con.display, con.window, <span class="hljs-number">0x1900ff</span>); <span class="hljs-comment">// 0x84ffdc cool colour.</span>
  XClearWindow(con.display, con.window );
  XMapWindow(con.display, con.window );	<span class="hljs-comment">// Make window appear.</span>

  XGCValues values;
  con.cmap = DefaultColormap(con.display, con.screenNum);
  con.gc = XCreateGC(con.display, con.window, <span class="hljs-number">0</span>, &amp;values);

  Status rc;
    rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Cyan"</span>, &amp;con.cyan, &amp;con.cyan);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'cyan' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_CYAN);
    }
      rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Purple"</span>, &amp;con.purple, &amp;con.purple);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'purple' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_PURPLE);
    }
      rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Blue"</span>, &amp;con.blue, &amp;con.blue);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'blue' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_BLUE);
    }
    rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Green"</span>, &amp;con.green, &amp;con.green);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'green' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_GREEN);
    }
  rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Yellow"</span>, &amp;con.yellow, &amp;con.yellow);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'yellow' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_YELLOW);
    }
    rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Orange"</span>, &amp;con.orange, &amp;con.orange);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'orange' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_ORANGE);
    }
    rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Red"</span>, &amp;con.red, &amp;con.red);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'red' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_RED);
    }
    rc = XAllocNamedColor(con.display, con.cmap, <span class="hljs-string">"Dark Red"</span>, &amp;con.darkRed, &amp;con.darkRed);
  <span class="hljs-keyword">if</span>(rc == <span class="hljs-number">0</span>)
    {
      <span class="hljs-built_in">std</span>::<span class="hljs-built_in">cerr</span>&lt;&lt;<span class="hljs-string">"XAllocNamedColor - failed to allocated 'dark red' color.\n"</span>;
      <span class="hljs-built_in">exit</span>(FATAL_ERROR_TWO_DARK_RED);
    }
}	
</code>
</pre>




<pre>
<code class="c++ hljs cpp"><span class="hljs-function"><span class="hljs-keyword">void</span> <span class="hljs-title">draw</span><span class="hljs-params">(context &amp; con, <span class="hljs-keyword">const</span> <span class="hljs-keyword">int</span> brLevel)</span>
</span>{				<span class="hljs-comment">// Black magic numbers in this function :'( (Can't be bothered to fix rn.)</span>
  <span class="hljs-built_in">std</span>::<span class="hljs-built_in">stringstream</span> textInfo {};
  <span class="hljs-comment">/*  if(brLevel &lt; 10)//it never goes below 20!
      textInfo&lt;&lt;"  ";*/</span>
  <span class="hljs-keyword">if</span>(brLevel &lt; <span class="hljs-number">100</span>)
    textInfo&lt;&lt;<span class="hljs-string">' '</span>;
  textInfo&lt;&lt;<span class="hljs-string">"%"</span>&lt;<brlevel<<" :ssenthgirb";="" everything="" to="" the="" left="" of="" brlevel="" bar's="" xsetforeground(con.display,="" con.gc,="" con.cyan.pixel);="" set="" forground="" colour="" xdrawstring(con.display,="" con.window,="" con.window_len="" -con.str_x_offset,="" con.str_y,="" textinfo.str().c_str(),="" textinfo.str().size());="" -con.minus_x_offset,="" con.minus_y,="" "-",="" 1);="" con.plus_x,="" con.plus_y,="" "+",="" *="" from:="" "https:="" tronche.com="" gui="" x="" xlib="" graphics="" drawing="" xdrawarc.html"="" for="" an="" arc="" specified="" as="" [="" x,="" y,="" width,="" height,="" angle1,="" angle2="" ],="" angles="" must="" be="" in="" effectively="" skewed="" coordinate="" system="" ellipse="" (for="" a="" circle,="" and="" systems="" are="" identical).="" relationship="" between="" these="" expressed="" normal="" screen="" (as="" measured="" with="" protractor)="" is="" follows:="" skewed-angle="atan" (="" tan="" normal-angle="" )="" width="" height="" +="" adjust="" xdrawarc(con.display,="" -con.minus_arc_x_offset,="" con.minus_arc_y,="" con.arc_width,="" con.arc_height,="" con.arc_angle_1,="" con.arc_angle_2);="" right="" circle="" around="" "-"="" con.plus_arc_x,="" con.plus_arc_y,="" "+".="" drawbars(con,="" brlevel);="" draw="" bars="" }="" <="" pre=""></brlevel<<">&ltbrLevel&lt;&lt;<span class="hljs-string">" :ssenthgirB"</span>;<span class="hljs-comment">//everything to the left of the brLevel bar's    </span>
  XSetForeground(con.display, con.gc, con.cyan.pixel);<span class="hljs-comment">//set forground colour</span>
  XDrawString(con.display, con.window, con.gc, con.WINDOW_LEN -con.STR_X_OFFSET, con.STR_Y, textInfo.str().c_str(),
	      textInfo.str().size());
  XDrawString(con.display, con.window, con.gc, con.WINDOW_LEN -con.MINUS_X_OFFSET, con.MINUS_Y, <span class="hljs-string">"-"</span>, <span class="hljs-number">1</span>);
  XDrawString(con.display, con.window, con.gc, con.PLUS_X, con.PLUS_Y, <span class="hljs-string">"+"</span>, <span class="hljs-number">1</span>);
  <span class="hljs-comment">/* FROM: "https://tronche.com/gui/x/xlib/graphics/drawing/XDrawArc.html"
    For an arc specified as [ x, y, width, height, angle1, angle2 ], the angles must be specified in the
    effectively skewed coordinate system of the ellipse (for a circle, the angles and coordinate systems are
    identical). The relationship between these angles and angles expressed in the normal coordinate system of the
    screen (as measured with a protractor) is as follows:
    skewed-angle = atan ( tan ( normal-angle ) * width / height ) + adjust */</span>
  XDrawArc(con.display, con.window, con.gc, con.WINDOW_LEN -con.MINUS_ARC_X_OFFSET,
	   con.MINUS_ARC_Y, con.ARC_WIDTH, con.ARC_HEIGHT, con.ARC_ANGLE_1,
	   con.ARC_ANGLE_2); <span class="hljs-comment">// Right circle around "-"</span>
  XDrawArc(con.display, con.window, con.gc, con.PLUS_ARC_X, con.PLUS_ARC_Y, con.ARC_WIDTH, con.ARC_HEIGHT,
	   con.ARC_ANGLE_1, con.ARC_ANGLE_2); <span class="hljs-comment">// Left circle around "+".</span>
  drawBars(con, brLevel);  <span class="hljs-comment">//draw the brLevel bars                                    </span>
}
</code>
</pre>    
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
