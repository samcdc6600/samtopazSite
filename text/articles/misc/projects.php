<?php
require_once("./common/tools.php");
top_module_and_left_side_nav("P R O J E C T S", "null", true, "samCustom.css");
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
	  <h4>Chunked</h4>

      <div class="slideshowContainer">
        <video class="float-right noJsSlideshow" controls
            autoplay loop>
            <source src="media/videos/singleChunkEditMode.webm" type="video/mp4">
            1 Your browsing software does not seem to support the video tag.
        </video>
        <video class="float-right noJsSlideshow" controls
            autoplay loop>
            <source src="media/videos/mapViewMode.webm" type="video/mp4">
            1 Your browsing software does not seem to support the video tag.
        </video>
      </div>

        <p>
            This is an asset creation/editing tool I created for an Ncurses
            based side-scroller I have been working on. It is for creating
            background chunks and rules chunks (it is essentially a simple
            drawing program albeit with some features that would be out of
            place in a normal drawing program.) See my
            <a href="chunked.html">article</a> on it for a bit
            more info.
        </p>
    </div>
	
	<div class="articleSection">
	  <h4>NESEmu</h4>
	  <video class="float-right" controls autoplay loop>
	    <source src="media/videos/demoOfAlmostCompleated6502CoreForNESEmu.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	  </video>
	  <p>
	    Currently very much incomplete this program is intended to be an
	    NES emulator. However it is currently just a mostly functional 6502
	    emulator. It will pass almost all of the tests in
	    6502_functional_test.asm. I think that the only thing currently
	    stopping it from working is a flag being incorrectly set by some of
	    the adc and sbc instructions. I plan to do more work on this in the
	    future. Hopefully one day it will be able to play an NES game.
	  </p>
	  <br>
	</div>

	
	<div class="articleSection">
	  <h4>Binary Clock</h4>

	  <div class="slideshowContainer">
	    <video class="float-right noJsSlideshow" controls
		   autoplay loop>
	      <source src="media/videos/binaryClockDemo.mp4" type="video/mp4">
		1 Your browsing software does not seem to support the video tag.
	    </video>
	    <img class="float-right noJsSlideshow"
		 src="media/images/binaryClockBreadboard.jpg"
		 alt="Binary clock breadboard.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/binaryClockRender.jpg"
		 alt="3D render of binary clock.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/binaryClockCircuit.jpg"
		 alt="Binary clock circuit.">
	  </div>

	  
	  <p>
	    A clock with binary digit's for hours minutes and seconds (note
	    that it is not a BCD clock.) The time is read from left to right
	    with the left most column representing hours. It uses an ATmega16 to
	    do most of the work. The output of a 1MHz crystal oscillator is fed
	    into a CD74HCT390E which is set up in a duel bi-quinary
	    configuration. In this way it will divide the signal by 100. Then
	    this chip is hooked up to an identical chip setup in the same
	    configuration and this next chip is again hooked up to one the same
	    as it and in the same configuration. Thus we end up with the 1MHz
	    signal being divided by 1,000,000. This is then fed into the micro
	    controller in such a way as to cause an interrupt and the chip
	    updates it's seconds counter (and the minutes and hours counters if
	    need be.) The chip was programmed in assembly language. It has
	    40 pins and so there is no need to multiplex the output and we can
	    directly drive each LED individually. I first built the circuit on a
	    few breadboards and then wrote the code that the micro controller
	    runs. Finally I designed a PCB using KiCad and had it manufactured.
	    There is a small bodge on the board as I originally had the
	    oscillator powered by a voltage regulator. However I made a mistake
	    when translating what I had on the bread board to the KiCad
	    schematic. Anyway it turns out that the oscillator runs fine off of
	    5V (the data sheet was a bit confusing.) Not having much
	    electronics knowledge I feel this was a good project and I learnt a
	    bit (even if most of the time I spent on it was programming the
	    micro.)
	  </p>
	</div>

	
	<div class="articleSection">
	  <h4>Menger Sponge</h4>

	  <video class="float-right" controls autoplay loop>
	    <source src="media/videos/mengerSponge.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	  </video>	      
	  <p>
	    Nothing special just a simple menger sponge. It's written in C++ and
	    OpenGL.
	  </p>
	</div> 	


	<div class="articleSection">
	  <h4>SOLP</h4>

	  <div class="slideshowContainer">
	    <img class="float-right noJsSlideshow"
		 src="media/images/solp1.png"
		 alt="SOLP warning message.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/solp2.png"
		 alt="SOLP sleep countdown timer.">
	    
	    <!-- ======================= CODE START ======================= -->
	    <pre class="float-right noJsSlideshow"><code class="shell hljs"><span class="hljs-meta">
#</span><span class="bash">!/bin/sh</span>
<span class="hljs-meta">

#</span><span class="bash"><span class="hljs-comment">###############################################################################</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">###############################################################################</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##									     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##	Program Name:			Sleep On Low Power		     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##	File:				solp				     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##	Author:				Samual G Brown			     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##	Date of Creation:		31/10/2020			     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##	Late Modified:			31/10/2020			     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##	Purpos:				To warn the user when the machines   ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					battery level is below some certain  ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					percentage and to put the machine    ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					to sleep if the machines battery     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					level is below some certain	     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					percentage independent of the	     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					previously mentioned percentage.     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					This script should be run after X11  ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##					has been started.		     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">##									     ###</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">###############################################################################</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">###############################################################################</span></span>
<span class="hljs-meta">

#</span><span class="bash"><span class="hljs-comment">################################ Program paths ################################</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">###############################################################################</span></span>
SYSCTL_PROG="/sbin/sysctl"
ZENITY_PROG="/usr/local/bin/zenity"
ECHO_PROG="/bin/echo"
BC_PROG="/usr/bin/bc"
SLEEP_PROG="/bin/sleep"
TOUCH_PROG="/usr/bin/touch"
RM_PROG="/bin/rm"
MPV_PROG="/usr/local/bin/mpv"
<span class="hljs-meta">

#</span><span class="bash"><span class="hljs-comment">################################## Constants ##################################</span></span>
<span class="hljs-meta">#</span><span class="bash"><span class="hljs-comment">###############################################################################</span></span>
TRUE="1"
FALSE="0"
WARNING_THRESHOLD="15"
SLEEP_THRESHOLD="8"
CARGING_OFF="0"			# 1 if machine is charging 0 if not.
UPDATE_RATE="30"		# Check status every $UPDATE_RATE seconds
CURRENT_CHARGING_STATUS=$($SYSCTL_PROG -n hw.acpi.acline)
BATTERY_LEVEL=$($SYSCTL_PROG -n hw.acpi.battery.life)



dialogueDisplayed()
{	# The following arguments should be passed
    # "dialogue displayed info dir", where dialogue displayed info dir is the
    # directory of the sentinal file that will indicate wheather or not a
    # dialogue box should possibly be displayed.
    if [ -f "${1}" ]
    then
	RET=$TRUE
    else
	RET=$FALSE
    fi
    $ECHO_PROG $RET
}


playSound()
{
    $MPV_PROG --volume=90 -audio-display=no --profile=low-latency "${1}" &gt; \
	      /dev/null &amp;
}


cowntdown()
{	# The following arguments should be passed "sleep interval",
    # "sleep message" and "window title" their order should be as seen here.
    # Where sleep interval is the time spent sleeping between status bar updates
    # (for example if sleep interval was 0.6 then the status bar would take one
    # minute to complete as 0.6*100 = 60).
    STATUS_BAR_MIN="0"
    STATUS_BAR_MAX="100"
    
    (for iter in $(seq $STATUS_BAR_MIN $STATUS_BAR_MAX)
     do
	 timeLeft=$($ECHO_PROG "( ${STATUS_BAR_MAX} - ${iter} ) * \
<span class="hljs-meta">$</span><span class="bash">{1}<span class="hljs-string">" | <span class="hljs-variable">$BC_PROG</span>);</span></span>
<span class="hljs-meta">
	 #</span><span class="bash"><span class="hljs-string"> Check charging status and return if charging.</span></span>
	 if [ "$("${SYSCTL_PROG}" -n hw.acpi.acline)" -ne $CARGING_OFF ]
	 then			# We are now charging
	     break
	 fi
	 
<span class="hljs-meta">	 $</span><span class="bash"><span class="hljs-string">ECHO_PROG "</span><span class="hljs-variable">${2}</span><span class="hljs-variable">${timeLeft}</span>s<span class="hljs-string">"</span></span>
<span class="hljs-meta">	 $</span><span class="bash"><span class="hljs-string">ECHO_PROG "</span><span class="hljs-variable">${iter}</span><span class="hljs-string">"</span></span>
<span class="hljs-meta">	 $</span><span class="bash"><span class="hljs-string">SLEEP_PROG "</span><span class="hljs-variable">${1}</span><span class="hljs-string">"</span></span>
     done) | zenity --progress --title "${3}" --auto-close --no-cancel \
		    --display=:0.0

    # Reset CURRENT_CHARGING_STATUS as it may have changed. This should be
    # checked for after this function is run.
    CURRENT_CHARGING_STATUS=$(${SYSCTL_PROG} -n hw.acpi.acline)
}


zzzSleep()
{	# Lock the computer and put it to sleep.
    "${HOME}"/.config/i3/configdir/lock.sh
}


displayWarningMessage()
{	# The following arguments should be passed "window title" and
    # "warning message"
    $ZENITY_PROG --warning --title "${1}" --width 300 --text \
		 "${2}" --display=:0.0 &amp;
}


setDialogueDisplayed()
{	# The following arguments should be passed
    # "dialogue displayed info dir" and "dialogue threshold", where dialogue
    # displayed info dir is the directory of the sentinal file that will
    # indicate wheather or not a dialogue box should possibly be displayed, and
    # dialogue threshold is the battery level at which the dialouge should be
    # displayed.
    if [ "${BATTERY_LEVEL}" -le "${2}" ]
    then			# If the battery level is less than.
	if [ \( ! -f "${1}" \) ] &amp;&amp; [ \( "${CURRENT_CHARGING_STATUS}" -eq \
					 "${CARGING_OFF}" \) ]
	then			# If the file doesn't exist and we are not
	    $TOUCH_PROG "$1"
	fi
    else			# If the battery level is greater than.
	if [ \( -f "${1}" \) ] &amp;&amp; [ \( "${CURRENT_CHARGING_STATUS}" -ne \
				       "${CARGING_OFF}" \) ]
	then			# If it exists and we are charging remove it.
	    $RM_PROG "${1}"
	fi
    fi
}


main()
{ 
    SLEEP_DIALOGUE_DISPLAYED_INFO_DIR="/tmp/sleepDialogueDisplayed"
    WARNING_DIALOGUE_DISPLAYED_INFO_DIR="/tmp/sleepWarningDialogueDisplayed"

    while [ $TRUE ]
    do
	CURRENT_CHARGING_STATUS=$(${SYSCTL_PROG} -n hw.acpi.acline)
	BATTERY_LEVEL=$(${SYSCTL_PROG} -n hw.acpi.battery.life)

	
	if [ "${CURRENT_CHARGING_STATUS}" -eq "${CARGING_OFF}" ]
	then			# We are on battery power.
	    # UI alert sound dirs (one is light harted and two is ominous!).
	    ALERT_SOUND_ONE="${HOME}/.uiSoundResources/541560__sieuamthanh__\
chuong-6e.wav"
	    ALERT_SOUND_TWO="${HOME}/.uiSoundResources/541605__erokia__msfxp9\
-49-one-shot.wav"
	    
	    if [ \( "${BATTERY_LEVEL}" -le "${SLEEP_THRESHOLD}" \) ] &amp;&amp; \
		   [ \( "$(dialogueDisplayed \
"${SLEEP_DIALOGUE_DISPLAYED_INFO_DIR}")" -eq $FALSE \) ]
	    then	# The battery level is below $SLEEP_THRESHOLD.
		SLEEP_INTERVAL="0.6"
		SLEEP_MESSAGE="# Battery at or below (${BATTERY_LEVEL}%). \
Computer will sleep in "
		WINDOW_TITLE="WARNING LOW BATTERY (${BATTERY_LEVEL}%)"

		playSound "${ALERT_SOUND_ONE}"
		playSound "${ALERT_SOUND_TWO}"
		cowntdown "${SLEEP_INTERVAL}" "${SLEEP_MESSAGE}" \
			  "${WINDOW_TITLE}"
		if [ "${CURRENT_CHARGING_STATUS}" -eq "${CARGING_OFF}" ]
		then		# We are still not charging.
		    zzzSleep
		fi
	    else
		if [ \( "${BATTERY_LEVEL}" -le "${WARNING_THRESHOLD}" \) ] &amp;&amp; \
		       [ \( "$(dialogueDisplayed \
"${WARNING_DIALOGUE_DISPLAYED_INFO_DIR}")" -eq $FALSE \) ]
		then		# The battery level is above $SLEEP_THRESHOLD
		    # but below $WARNING_THRESHOLD.
		    WINDOW_TITLE="Warning Low Battery (${BATTERY_LEVEL}%)"
		    WARNING_MESSAGE="It has been detected that your machines \
batterry level is ${BATTERY_LEVEL}% which is at or below ${WARNING_THRESHOLD}%!\
 The machine will automatically be put to sleep when it is detected that the \
battery level is at or below ${SLEEP_THRESHOLD}%!"


		    playSound "${ALERT_SOUND_ONE}"
	    	    displayWarningMessage "${WINDOW_TITLE}" "${WARNING_MESSAGE}"
		fi
	    fi
	fi
<span class="hljs-meta">
	#</span><span class="bash"><span class="hljs-string"> Recorde whether or not dialogues have already been displayed since</span></span>
<span class="hljs-meta">	#</span><span class="bash"><span class="hljs-string"> entering the relevant battery percentages.</span></span>
	setDialogueDisplayed $SLEEP_DIALOGUE_DISPLAYED_INFO_DIR $SLEEP_THRESHOLD
	setDialogueDisplayed $WARNING_DIALOGUE_DISPLAYED_INFO_DIR \
			     $WARNING_THRESHOLD
<span class="hljs-meta">
	$</span><span class="bash"><span class="hljs-string">SLEEP_PROG "</span><span class="hljs-variable">${UPDATE_RATE}</span><span class="hljs-string">"</span></span>
    done
}


main	
	    </code></pre>
	    <!-- ======================= CODE START ======================= -->
	    
	  </div>
	  
	  <p>
	    Sleep FreeBSD On Low Power is a small shell script I've written to
	    check for low battery on my laptop. When the battery get's below a
	    certain percentage it will play a sound and generate a dialogue box
	    to warn of the situation as it stands. Then if things get worse and
	    the battery get's too low it will play a more ominous sound and
	    display a dialogue box with a count down timer. When the timer is up
	    the script will put the computer to sleep.
	    <br>
	    The script should be started when X11 starts because it generates
	    the aforementioned dialogue boxes. I practically always start X when
	    I boot up my laptop so this isn't a problem. It wakes up every few
	    seconds to check the battery level. This of course isn't optimal. I
	    may modify the script so that it can be used in such a way that
	    FreeBSD would call it when some event related to low battery is
	    generated. However I haven't yet looked into how this would be done.
	  </p>
	</div>

	
	<div class="articleSection">
	  <h4>F62 Model F Keyboard Solenoid Holder</h4>

	  <div class="slideshowContainer">
	    <img class="float-right noJsSlideshow"
		 src="media/images/modelF62SSolenoidHolderTop.jpg"
		 alt="A photo from the top of a solenoid holder for the Model
		      F62 reproduction keyboard.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/modelF62SSolenoidHolderAngle.jpg"
		 alt="A photo from an angle of a solenoid holder for the Model
		      F62 reproduction keyboard.">
	  </div>
	  
	  <p>
	    You can buy a solenoid and solenoid driver along with your new
	    re-production Model F64. That is if you get one (which is
	    recommended). However there is no standard way to mound it. So I
	    designed and 3D printed a mount for it (the solenoid that is) along
	    with the solenoid driver using FreeCAD.
	  </p>
	</div>


	<div class="articleSection">
	  <h4>Laptop Stand</h4>

	  <div class="slideshowContainer">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandFrontWithLaptop.jpg"
		 alt="Laptop stand from front with laptop.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandFront.jpg"
		 alt="Laptop stand from front.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandBottom.jpg"
		 alt="Laptop stand upside down.">
	    <img class="float-right noJsSlideshow"
		 src="media/images/laptopStandFreeCad.jpg"
		 alt="Part of the design for the laptop stand in FreeCAD.">
	  </div>
	  
	  <p>
	    A laptop stand I designed using FreeCAD. This took quite a long time
	    to design as it is not just a relatively complex shape it also has
	    over 20 parts, since my printer only has so much print volume.
	    The legs are detachable and although the height is not adjustable
	    I've used it on a couple of desks of different heights and it works
	    quite well. It is designed so that a relatively small keyboard can
	    fit under it and thus you don't have to have your keyboard too close
	    to you or your laptop too far away when your using it.
	  </p>
	</div>

	<br>
	<small>Date: 02/12/2023</small>
	<br>
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
