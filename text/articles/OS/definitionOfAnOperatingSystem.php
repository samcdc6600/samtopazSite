<?php
require_once("./common/tools.php");
top_module_and_left_side_nav("Definition of An Operating System", "null", true, "null");
?>

<main class="inset_shadow">
	<div id="position_main_part_of_main">
<?php
    heading("DEF OF AN OS");
?>
	
	<article id="main_tag_in_main_min_height">
    	    <br><br><h4>We All Know What An Operating System Is Don't We?</h4>
    <p>
    There is one definition of operating systems that is prevalent.<br> People assume they know what an operating system is and yet many have not really looked into it or thought about it, but of course they know what it is. They are in fact probably right depending of what definition you go by. The common definition is however somewhat nebulous, it defines a modern operating system to be the software running in kernel space as well as the userspace software such as sh that comes with a system by default. In GNU + Linux this would be the Linux kernel which is generally found in the vmlinuz file under the /boot directory on GNU + Linux distributions such as Ubuntu and the GNU core utils as well as some other things. I say this definition is nebulous because it is hard to draw a clear line between what should be considered part of an operating system and what should not. If a program that is not shipped with a system in one version is included in the next version is it now part of the operating system? Should a text editor such as ed be considered part of an operating system? Is it essential to the system? This definition is clearer with the BSDs then it is with distributions of GNU + Linux. The BSDs are generally developed as one cohesive package whereas GNU + Linux distributions are an amalgamation of the results of separate less coupled projects. It is still nebulous however. There is another definition that I consider to be more exact and useful, it states that an operating system should provide two functions, it should provide abstraction to applications programs and it should provide resource management. This means that the shell is not part of an operating system for example. The operating system is for the most part the program that runs in kernel space (depending on the organization of the system) by this definition.
        </p>
            <strong>Relevant reading:</strong>
    <ul>
    <li><a href="https://en.wikipedia.org/wiki/Operating_system#Kernel" target="_blank">https://en.wikipedia.org/wiki/Operating_system#Kernel</a></li>
    <li><a href="https://www.amazon.com/Modern-Operating-Systems-Andrew-Tanenbaum/dp/013359162X" target="_blank">https://www.amazon.com/Modern-Operating-Systems-Andrew-Tanenbaum/dp/013359162X</a></li>
    <li><a href="http://www.man7.org/tlpi/" target="_blank">http://www.man7.org/tlpi/</a></li>
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
	bottom_module_and_right_side("definitionOfAnOperatingSystem.html", true, true, "OS", "operatingSystemArticles.html");
?>
  
</body>
</html>
