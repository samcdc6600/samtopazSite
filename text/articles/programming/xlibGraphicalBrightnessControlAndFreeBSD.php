<?php
require_once("./common/tools.php");
top_module_and_left_side_nav("xlib and brightness control on lenovo x230 running FreeBSD", "null", true, "samCustom.css");
?>

<main class="inset_shadow">
	<div id="position_main_part_of_main">
	<article id="main_tag_in_main_min_height">
	<?php
    	heading("IS XLIB BRIGHT");
	?>
    <br><br><h4>Xlib and Brightness Control On Lenovo X230 Running FreeBSD</h4>
    <p>
    <small>Note: I am writing this well after the fact and so some of the information is a little incomplete. So hopefully there are no obvious errors :).</small>
    <br>
    I am currently running freebsd on my laptop an x230 ThinkPad (This has recently change and I am now running openBSD, although I haven’t worked everything out yet.) 
After the installation process I found that I was not able to change the brightness with any keys or combination of keys after I had completed the installation. More importantly I was not able to change the brightness by issuing any command (to my knowledge.) 
So I was faced with the problem of figuring out what needed to be done to change the brightness on my laptop. After this problem was solved it would be a simple matter of binding a combination of keys to a simple script or program (through the use of my i3 config file) that would run the command/s.
<br><br>
 I managed to solve the aforementioned problem and I was pleased with the results. However as time went by I found more and more that I desperately wanted visual feedback when adjusting the brightness (and also the volume.) So I wondered for a while how I might do this. Not knowing very much about how this sort of thing is done I thought about d menu and the I3 status bar. How did they draw to the screen? Sure there not transparent and don’t “hover” above the cursor, but I would be happy enough if I could get anything half decent working and I figured that the size of the code base of these programs would be small enough that I might be able to make some sense of them. So I looked at the source code for d menu. I had the source code for d menu 4.7 under <em>/usr/ports/x11/dmenu/work/dmenu-4.7</em> on my machine since I had compiled it from ports instead of installing it using the pkg install command so that I could change its default colours. I found that dmenu.c includes a number of things related to X11, including <em>X11/xlib.h</em>. So I decided to look into xlib and also how to write a simple X11 application. I found a couple of tutorials on creating windows under X11 using xlib and doing other simple things like printing text and shapes in the windows. I played around with these examples for a while and with the help of these tutorials and the xlib manual (<a href="https://tronche.com/gui/x/xlib/" target="_blank">https://tronche.com/gui/x/xlib/</a>) I figured out how to do what I wanted, that is to make a program that opened a window that I could display different coloured text and shapes in and that had no borders, an absolute position on the screen and was rendered in front of other windows (including the currently active window).
 <br><br>
<strong>Changing the Brightness</strong>
<br><br>
I did more then just execute the previously mentioned command (although I don’t know whether or not the other things I did where useful, I think they probably where. I <strike>did</strike> will say I was sketchy on the details :) .) I did this some time ago and thus am somewhat sketchy on the details. So it may not be an entirely accurate list of steps.
<br>
I added the following lines to <em>/etc/loader.conf:</em>
	<em>
		<br>
		&emsp;&emsp;#for brightness
		<br>
		&emsp;&emsp;acpi_ibm_load="YES"
		<br>
		&emsp;&emsp;acpi_call_load="YES"
		<br>
	</em>
I believe I also installed a package related to IBM Thinkpads and ACPI that was suggested on a forum as part of the solution for getting brightness control to work. The post on the forum also listed a command that could then be used to change the brightness.
The command was something like the following (although not exactly the same. More on that in a second.)
“<em>acpi_call -p '\_SB.PCI0.VID.LCD0._BCM' -i $1</em>”. 
Where <em>$1</em> would be a number between 10 and 100 in increments of 10. 
It worked. The brightness level changed. But there was a problem that soon became apparent. Sometimes when issued the command would cause my computer to completely freeze up. Whether this would happen or not was seemingly random. But it would happen with a high probability (it would still be completely unacceptable even if the probability was extremely low.) This was <strong>CLEARLY</strong> not going to work as a solution. There was an ASCII text file on my system I was sure was related to part of this command and changing the brightness I can't recall why I thought this (maybe it was mentioned on the forum.) This file was very large for a text file. I started grepping through it looking for things related to brightness and changing the command slightly according to what variables I found that I thought were related. Most of them didn’t do anything. Some made my system crash. Eventually I found one that worked and seemingly has no side effects and thus I ended up with the previously listed command (“<em>acpi_call -p '\_SB.PCI0.VID.LCD0._BCM' -i $1</em>”). I have been using this to change the brightness on my computer (indirectly) ever since. I have included the file where I found the string “<em>\_SB.PCI0.VID.LCD0._BCM</em>” in the following link for your pleasure: <a href="media/text_files/dumpylist" target="_blank">dumpylist</a>
<br><br>
<strong>Programmatic Assistance and Pretty Graphics</strong>
<br><br>
<strong>Main()</strong>
<br>
The programs main function accepts either one or two arguments with one of those argument’s being the name of the program.
The program attempts to read in a single integer value in the range [<em>BR_RANGE_MIN</em>, <em>BR_RANGE_MAX</em>] from the file specified in brLevelFileName (“<em>/usr/tmp/brLevel</em>”.) If this value is successfully read in and is within range and is also evenly divisible by <em>BR_INTERVAL_GRANULARITY</em> (10) then the variable <em>brLevel</em> is set to the value read in, otherwise it is set to <em>BR_DEFAULT</em> (80). If the <em>brLevel</em> is set to <em>BR_DEFAULT</em> <em>doWork()</em> is called before the program exits.
If brLevel is not set to <em>BR_DEFAULT</em> then we check to see if argc is equal to <em>MAX_ARGC</em> (2). If it is then two command line arguments have been given with the second one presumably being one of the two characters ‘<em>+</em>’ or ‘<em>-</em>’. We test to see if it is one of these characters by checking the return value of <em>handle2ndArg()</em> if the return value is true then the second argument is not malformed and we call <em>doWork()</em> before exiting the program. If the second argument is malformed we call <em>printUsage()</em> before exiting the program. <em>handle2ndArg()</em> does more than just check if the second argument of argv is valid, it also adjusts the value of brLevel (which is passed to <em>handle2ndArg()</em> by reference so that it will also be changed in main). It will call <em>adjustBR_Val()</em> which will add its third argument (<em>BR_INTERVAL_GRANULARITY</em>) to its return value (it’s fifth argument brLevel) if it’s fourth argument is the ASCII character ‘<em>+</em>’. If it is the ASCII character ‘<em>-</em>’ it will subtract its third argument from the return value instead. However there is an exception for the two above described functions of the function, the function uses saturating arithmetic. So it will not subtract or add <em>BR_INTERVAL_GRANULARITY</em> if it would cause the return value to go out side of the range specified by its second and first arguments respectively [<em>BR_RANGE_MIN</em>, <em>BR_RANGE_MAX</em>].
    </p>
    <br>
   

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
<p>
<strong>DoWork()</strong>
<br>
<em>DoWork()</em> first calls the <em>system()</em> function (the <em>system()</em> function executes the command given to it in a shell) with the following string as it’s argument “<em>~/.config/brightness/brctl.sh LEVEL</em>” where <em>LEVEL</em> is the string returned by <em>std::to_string(level)</em>.
The <em>doWork()</em> function was called with the arguments <em>brLevel</em> and <em>brLevelFileName</em> (meaning the value of level is the same as the value of <em>brLevel</em>.)
<em>DoWork()</em> then calls the <em>saveIntToFile()</em> function which attempts to save it’s second argument “<em>level</em>” to the file specified by its first argument “<em>file</em>” (<em>brLevelFileName</em> in this case.)
The final thing <em>doWork()</em> does is to call the <em>display()</em> function with <em>level</em> as it’s argument.
The display function initialises and creates the window to which it will draw by calling the <em>init()</em> function.
It then runs through a for loop <em>con.SLEEP_TIMES</em>.
In this loop it calls <em>draw()</em>, this is where the work of actually drawing the graphics to the window is done.
After this it calls <em>XFlush()</em> to make sure that the graphics are actually actually drawn this time ;).
After this it calls the functions:
<br>
	&emsp;&emsp;<em>std::this_thread::sleep_for(</em>
	<em>std::chrono::milliseconds(X)).</em>
<br>
With the “<em>X</em>” argument in the inner function being the constant <em>con.SLEEP_TIME</em>.
The purpose of this for loop is of course to draw some bars to the window to represent the current brightness level, or at least that is the purpose of the <em>draw()</em> and <em>XFlush()</em> function calls in the loop.
The actual reason for having the loop is to have the graphics stay on the screen for <em>con.SLEEP_TIMES</em> * <em>con.SLEEP_TIME</em> millie seconds (about three seconds.)
This means that if some other window is drawn over our window (such as the one created by dmenu) the window may not “refresh” it’s graphics for up to <em>con.SLEEP_TIME</em> millie seconds.
The reason for doing it this way is to avoid using the select system call, which I believe could solve the problem, but which I am also sadly confused by :(.
There is using an xlib function call a way to have an xlib program go to sleep and then get a notification when it needs to be redrawn, however I don’t know of a way to have it do this and also wake up after a set amount of time.
<br>
<br>
I have set up my i3 config file so that when you press “<em>caps+X</em>”, “<em>caps+Y</em>” or “<em>caps+Z</em>” it will perform one of three actions and where <em>X</em>, <em>Y</em> and <em>Z</em> are function keys.
The actions that are performed are “<em>exec brctl</em>”, “<em>exec brctl +</em>” and “<em>exec brctl -</em>”, “<em>Exec brctl +</em>” and “<em>exec brctl -</em>” increase or decrease the brightness respectively and show it’s level visually and <em>brctl</em> is the name I have given the executable (which had to be in a path the shell would check, <em>/usr/bin</em> in this case.)
The current level is saved and retrieved every time the program is run as described.
When the computer is started up the program could be run to set the brightness to it’s last value by running <em>brctl</em> with no extra arguments.
</p>
<br>

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

<strong>So What Does it Look Like Anyway?</strong>
<br>
<p>
It appears in the top left hand	corner of the display and has a	gap of two pixels above	it so as not to	annoy when directing the mouse to the top of a window in i3 to click on it. The word brightness is reversed on purpose.
</p>

<img class="no_float" src="media/article_images/brctl.png" alt="image of brctl">
<br>

<strong>Links to Relevant Files</strong>
<ul>
    <li><a href="media/text_files/adjustBrightness.cpp" target="_blank">adjustBrightness.cpp</a></li>
    <li><a href="media/text_files/brctl.sh" target="_blank">brctl.sh</a></li>
    <li><a href="media/text_files/build.sh" target="_blank">build.sh</a></li>
    <li><a href="media/text_files/dumpylist" target="_blank">dumpylist</a></li>    
</ul>
<br>
<small>Date: 17/01/2019</small>
<br>
        </article>
 
	<?php
	topOfPageButton();
	?>
    </div>
    </main>

      
<?php
	bottom_module_and_right_side("xlibGraphicalBrightnessControlAndFreeBSD.html", true, true, "programming", "programmingArticles.html");
?>
  
</body>
</html>
