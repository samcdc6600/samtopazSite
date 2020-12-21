<?php
  require_once("./common/tools.php");
  top_module_and_left_side_nav("Automatically Sleep Computer On Low Power", "null", true, "samCustom.css");
?>





<main class="inset_shadow scroll_style">
  <div id="position_main_part_of_main">
    <article id="main_tag_in_main_min_height">
      <?php
       heading("SLEEP COMP");
       ?>
      <br><br><h4>Automatically Put Computer To Sleep When On Low Power</h4>
      <p>
	I was playing COD2 on my laptop when all of a sudden it turned off. It had run out of power. This was something that had happened before, a number of times. It was somewhat ifuriating and finally I decided to do something about it. What did I do? Well I wrote a script of course! I will give a short description of what this script does and how it works below...
      </p>
      
      <pre><code class="shell hljs cpp">
	  #!/bin/sh


################################################################################
################################################################################
###									     ###
###	Program Name:			Sleep On Low Power		     ###
###	File:				solp				     ###
###	Author:				Samual G Brown			     ###
###	Date of Creation:		31/10/2020			     ###
###	Late Modified:			31/10/2020			     ###
###	Purpos:				To warn the user when the machines   ###
###					battery level is below some certain  ###
###					percentage and to put the machine    ###
###					to sleep if the machines battery     ###
###					level is below some certain	     ###
###					percentage independent of the	     ###
###					previously mentioned percentage.     ###
###					This script should be run after X11  ###
###					has been started.		     ###
###									     ###
################################################################################
################################################################################


################################# Program paths ################################
################################################################################
SYSCTL_PROG="/sbin/sysctl"
ZENITY_PROG="/usr/local/bin/zenity"
ECHO_PROG="/bin/echo"
BC_PROG="/usr/bin/bc"
SLEEP_PROG="/bin/sleep"
TOUCH_PROG="/usr/bin/touch"
RM_PROG="/bin/rm"
MPV_PROG="/usr/local/bin/mpv"


################################### Constants ##################################
################################################################################
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
    $MPV_PROG --volume=90 -audio-display=no --profile=low-latency "${1}" > \
	      /dev/null &
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
${1}" | $BC_PROG);

	 # Check charging status and return if charging.
	 if [ "$("${SYSCTL_PROG}" -n hw.acpi.acline)" -ne $CARGING_OFF ]
	 then			# We are now charging
	     break
	 fi
	 
	 $ECHO_PROG "${2}${timeLeft}s"
	 $ECHO_PROG "${iter}"
	 $SLEEP_PROG "${1}"
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
		 "${2}" --display=:0.0 &
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
	if [ \( ! -f "${1}" \) ] && [ \( "${CURRENT_CHARGING_STATUS}" -eq \
					 "${CARGING_OFF}" \) ]
	then			# If the file doesn't exist and we are not
	    $TOUCH_PROG "$1"
	fi
    else			# If the battery level is greater than.
	if [ \( -f "${1}" \) ] && [ \( "${CURRENT_CHARGING_STATUS}" -ne \
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
	    
	    if [ \( "${BATTERY_LEVEL}" -le "${SLEEP_THRESHOLD}" \) ] && \
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
		if [ \( "${BATTERY_LEVEL}" -le "${WARNING_THRESHOLD}" \) ] && \
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

	# Recorde whether or not dialogues have already been displayed since
	# entering the relevant battery percentages.
	setDialogueDisplayed $SLEEP_DIALOGUE_DISPLAYED_INFO_DIR $SLEEP_THRESHOLD
	setDialogueDisplayed $WARNING_DIALOGUE_DISPLAYED_INFO_DIR \
			     $WARNING_THRESHOLD

	$SLEEP_PROG "${UPDATE_RATE}"
    done
}


main
      </code></pre>



      <strong>Usefule Links:</strong>
      <ul>
      <li class="reference"><a href="laksdjfl" target="_blank">laksdjflksdaj</a></li>
      </ul>
      <br>
      <strong>References:</strong>
      <ol>
	<li class="refernce"><a href="lsakdjf" target="_blank"></a></li>
      </ol>
      <br>
	<small>Date: 03/05/2020</small>
      <br>
    </article>

    <?php
      topOfPageButton();
    ?>
  </div>
</main>

<?php
  bottom_module_and_right_side("automaticallySleepComputerOnLowPower.html", true, true, "programming", "programmingArticles.html");
?>

</body>
</html>
