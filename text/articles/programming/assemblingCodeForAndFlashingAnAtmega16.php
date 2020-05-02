<?php
  require_once("./common/tools.php");
  top_module_and_left_side_nav("Assembling Code for and Flashing an Atmega16", "null", true, "samCustom.css");
?>

<main class="inset_shadow scroll_style">
  <div id="position_main_part_of_main">
    <article id="main_tag_in_main_min_height">
      <?php
	heading("ATMEGA16");
      ?>
      <br><br><h4>Assembling Code for and Flashing an Atmega16 </h4>
      <p>
	You will need an Atmega16 (I have the 16A), breadboard, 5v PSU (at least for the 16A), USBASP v2.0, programmer (other programmer could be used) and of course electronic components (LEDs, resistors, wires, etc,..)
	<br>
	  Although the english is not the best we found <a href="https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html" target="_blank">this</a><sup class="refernce">1</sup> to be a good quick overview of our Atmega16A, for a much more compleate refernce see <a href="https://www.mouser.com/datasheet/2/268/Atmel-8154-8-bit-AVR-ATmega16A_Datasheet-1065799.pdf" target="_blank">this</a><sup class="refernce">2</sup>
	<br>
	    First we need to install an assembler.
	<br>
	  Our choice of assembler is <em>avra</em> (this was our choise because it was available.) We install avra by first searching for anything matching avr with "pkg serach avr", this returned the following results:
	        </p>
	  <pre><code class="c++ hljs cpp">arduino-avrdude-6.3_3          Program for programming the on-chip memory of Atmel AVR Arduino CPUs
avr-binutils-2.32_1,1          GNU binutils for AVR cross-development
avr-gcc-9.1.0                  FSF GCC for Atmel AVR 8-bit RISC cross-development
avr-gdb-7.3.1_6                GNU GDB for the AVR target
avr-libc-2.0.0_2,1             C and math library for the Atmel AVR controller family
avra-1.3.0_1                   Macro Assembler for Atmel AVR microcontrollers
avrdude-6.3_3                  Program for programming the on-chip memory of Atmel AVR CPUs
avro-1.9.0                     Data serialization system
avro-c-1.9.1                   C library for Apache Avro
avro-cpp-1.9.1                 C++ library for Apache Avro
libpololu-avr-151002_1         Support libraries for Pololu robots
py27-avro-1.9.1                Data serialization system for python
py36-avro-1.9.1                Data serialization system for python
rubygem-avro-1.9.1             Ruby library for Apache Avro
simavr-1.3_1                   Simulator for several Atmel AVR chips</code></pre>
	  <p>
	    We see the avra assembler and install it with:
	  </p>
	  <pre><code class="c++ hljs cpp">doas pkg install avra-1.3.0_1</code></pre>
	  <p>(of course here one could use sudo in place of doas, or just be root.)
	    <br>
	      We need to include <em>m16Adef.inc</em> in our program (this file specifically is for use with the Atmega16A with avra, there is another assembler avr-as.) I found the .inc file <a href="https://github.com/DarkSector/AVR/tree/master/asm/include" target="_blank">here</a><sup class="refernce">3</sup>. .inc files for other atmel controllers can also be found at that link, these .inc files contain usefull definitions.
	    <br>
	      For some reason a couple of the lines in the m16Adef.inc file cause fatal errors when trying to assemble our code. We comment out the line (47), which causes the following error:
	    </p>
	    <pre><code class="c++ hljs cpp">./include/m16Adef.inc(47) : Error   : Unknown device: ATmega16A</code></pre>
	    <p>The second error is caused by a line that is too long (this comment is somewhere around line 533), so we breakup the comment at the end of this line so that it spans multiple lines. We can now assemble our program.<br>
	      We think that our m16Adef.inc file might be intended for use with a different version of our assembler. We found the following on a forum <a href="https://www.avrfreaks.net/forum/problem-avra-avr" target="_blank">thread</a><sup class="refernce">4</sup> regarding this issue (our version of m16Adef.inc is about 30K): <em>"Note that one is about 10K and one is about 30K. I think avra is compatible with the original Atmel assembler (which uses the 10K versions) and not Assembler2 (which uses the 30K version).
I'll bet the file you are trying to use with avra is the 30K one. Suggest you get AVR Studio, install on a Windows machine or using wine (or a VM) in Linux then extract the copy you need (which probably violates the licence but you'll have to battle with your own conscience over that one!)
Cliff"</em>
	<br>We will keep using our fix however since it seems to be working fine for the most part and we only had to change one line that was not a comment.
	<br>We assemble the following code with the following command:
	</p>
	<pre><code class="c++ hljs cpp">avra hello.asm</code></pre>

	<pre><code class="c++ hljs cpp">	<span class="hljs-comment">;; Turn on an LED which is connnected to PC0</span>

	<span class="hljs-keyword">.include</span> "./include/m16Adef.inc" 

	<span class="hljs-keyword">ldi</span> <span class="hljs-params">r16</span>, <span class="hljs-params">0b00000001</span>
	<span class="hljs-keyword">out</span> <span class="hljs-params">DDRC</span>, <span class="hljs-params">r16</span>
	<span class="hljs-keyword">out</span> <span class="hljs-params">PortC</span>, <span class="hljs-params">r16</span>
<span class="hljs-params">Start:</span>
	<span class="hljs-keyword">rjmp</span> <span class="hljs-params">Start</span></code></pre>
	<p>
	The following output is generated after executing the above command to assemble the above code:
	</p>
	<pre><code class="c++ hljs cpp">AVRA: advanced AVR macro assembler Version 1.4.1
Copyright (C) 1998-2010. Check out README file for more info

   AVRA is an open source assembler for Atmel AVR microcontroller family
   It can be used as a replacement of 'AVRASM32.EXE' the original assembler
   shipped with AVR Studio. We do not guarantee full compatibility for avra.

   AVRA comes with NO WARRANTY, to the extent permitted by law.
   You may redistribute copies of avra under the terms
   of the GNU General Public License.
   For more information about these matters, see the files named COPYING.

Pass 1...
Warning : No .DEVICE definition found. Cannot make useful address range check !
Warning : No .DEVICE definition found. Cannot make useful address range check !
Warning : No .DEVICE definition found. Cannot make useful address range check !
Pass 2...
done


Assembly complete with no errors (3 warnings).
Segment usage:
   Code      :         4 words (8 bytes)
   Data      :         0 bytes
	EEPROM    :         0 bytes</code></pre>
	<p>
	  We see that there are a number of warnings of the same nature. We
	  couldn't find any information about these warnings but we think they
	  mean that we could use an address that is out of range. These warnings
	  may be related to the issues encountered with the m16Adef.inc file.
	  <br>
	  After assembling we end up with a number of files:
	</p>
	<pre><code class="c++ hljs cpp">hello.eep.hex, hello.hex, hello.obj</code></pre>
	<p>
	  We are interested in the .hex file. This is what we are going to flash
	  to our micro with.
	</p>
	<p>
	  <strong>Flashing Our Micro</strong>
	  <br><br>
	  Now that we have assembled our program we would like to flash our
	  micro with program.<br>We need to install a program called avrdude to
	  flash our micro. Again we search for this program using pkg search:
	</p>
	<pre><code class="c++ hljs cpp">pkg search avrdude</code></pre>
	<p>
	  Which results in the following output:
	</p>
	<pre><code class="c++ hljs cpp">arduino-avrdude-6.3_3          Program for programming the on-chip memory of Atmel AVR Arduino CPUs
avrdude-6.3_3                  Program for programming the on-chip memory of Atmel AVR CPUs</code></pre>
	<p>
	  Since we are not using an ardwino we install avrdude with:
	</p>
	<pre><code class="c++ hljs cpp">doas pkg install avrdude-6.3_3</code></pre>
	<p>
	  Now that we have avrdude installed we can flash our device, we use the
	  following command:
	</p>
	<pre><code class="c++ hljs cpp">doas avrdude -p m16 -c usbasp -P /dev/ugen0.2 -U flash:w:hello.hex</code></pre>
	<p>
	  The meaning of the options are as follows:
	</p>
	<ul>
	  <li>"-p m16" tells avrdude that we are using an atmega16 device
	  (ours being the atmega16A specifically)</li>
	  <li>"-c usbasp" tells avrdude that we are using a usbasp flasher
	  (ours being the USBASP v2.0 specifically)</li>
	  <li>"-P /dev/ugen0.2" is the path to the device file for our
	  flasher (note the upper case p)</li>
	  <li>Finally "-U flash:w:hello.hex" tells avrdude that we want to
	  write the file hello.hex to our micro.</li>
	</ul>
	<p>
	  There is an option to set the baud rate, we leave it as the default.
	  <br>How do we know what the correct device file for our flasher is?
	  Well there of course would be a much better way to do this but we
	  simply used the following commands (attaching our USBASP v2.0 flasher
	  after running the first command):
	</p>
	<pre><code class="c++ hljs cpp">ls /dev/ > tmp0.txt<br>ls /dev/ > tmp1.txt<br>diff -p tmp0.txt tmp1.txt</code></pre>
	<p>
	  The output of the last command should look something like this:
	</P>
	<pre><code class="c++ hljs cpp">*** tmp0.txt	2020-05-02 22:40:25.595809000 +1000
--- tmp1.txt	2020-05-02 22:40:49.691898000 +1000
*************** ugen0.1
*** 119,124 ****
--- 119,125 ----
  ugen1.1
  ugen1.2
  ugen1.3
+ ugen1.4
  ugen2.1
  ugen3.1
  ugen3.2
	</code></pre>
	<p>
	  We see a line with a <em>"+"</em>, this is the device file we are
	  looking for (note that this example is from a different machine so the
	  device file name is different.)
	  <br>When we run the <em>avrdude</em> command as described above we see the
	  following output:
	</p>
	<pre><code class="c++ hljs cpp">amethyst@dream:~/softDev/tmp/tmp2 % doas avrdude -p m16 -c usbasp -P /dev/ugen0.2 -U flash:w:hello.hex
Password:

avrdude: warning: cannot set sck period. please check for usbasp firmware update.
avrdude: AVR device initialized and ready to accept instructions

Reading | ################################################## | 100% 0.00s

avrdude: Device signature = 0x1e9403 (probably m16)
avrdude: NOTE: "flash" memory has been specified, an erase cycle will be performed
         To disable this feature, specify the -D option.
avrdude: erasing chip
avrdude: warning: cannot set sck period. please check for usbasp firmware update.
avrdude: reading input file "hello.hex"
avrdude: input file hello.hex auto detected as Intel Hex
avrdude: writing flash (8 bytes):

Writing | ################################################## | 100% 0.08s

avrdude: 8 bytes of flash written
avrdude: verifying flash memory against hello.hex:
avrdude: load data flash data from input file hello.hex:
avrdude: input file hello.hex auto detected as Intel Hex
avrdude: input file hello.hex contains 8 bytes
avrdude: reading on-chip flash data:

Reading | ################################################## | 100% 0.06s

avrdude: verifying ...
avrdude: 8 bytes of flash verified

avrdude: safemode: Fuses OK (E:FF, H:99, L:E1)

avrdude done.  Thank you.</code></pre>
	<p>
	  Avrdude informs us that it <em>"cannot set sck period."</em> and that
	  we should <em>"check for a usbasp firmware update."</em> (our flasher
	  runs an atmal it's self and evidently it's firmware needs updating, if
	  this message is anything to go by.)
	  <br>The sck period is the period of the clock pulses <em>"which synchronize data transmission generated by the master"<sup class="refernce">5</sup></em>
	  <br>It seems our micro is being programmed via SPI.
	  The output shows that it has at least verified some of what was
	  written so it seems that it worked and of course this is verified when
	  we try out our newly programmed micro.
	</p>
	<p>
	  <strong>Circuit for our Hello World Program and the Atmega16A</strong>
	  <br>The micro requires 5V we use an ATX PSU (a bench powersupply would
	  be preferable.) Pin 10 is labeld <em>VCC</em> in the diagram below,
	  it is the pin we connect the positive side of our power supply to. VCC
	  stands for<em>Voltage at the Common Collector</em>
	  <sup class="refernce">6</sup>
	</p>
	<img class="no_float" src="media/article_images/avr-microcontroller-atmega16a-pu-dip.jpg" alt="image of Atmega16A pin out">
	<p>
	  Pin 31 is <em>GND</em> AKA ground, it is the pin we connect the
	  negative side our power supply to.
	  Finally once we have out micro hooked up to our PSU we need to add the
	  LED. We connect the positive side of the LED (long leg) to PC0 (pin22)
	  of our micro. LEDs are current driven devices
	  <sup class="refernce">7</sup> and therefore we need a resistor to
	  limit current through the LED or it will burn out. We use a resistor
	  with a value of around 460 k&#8486;'s. For more information on what
	  value to use see <a href="https://www.instructables.com/id/Choosing-The-Resistor-To-Use-With-LEDs/" target="_blank">this</a>
	  <sup class="refernce">7</sup>
	</p>

      <strong>Usefule Links:</strong>
      <ul>
	<li><a href="https://www.instructables.com/id/Command-Line-Assembly-Language-Programming-for-Ard/" target="_blank">https://www.instructables.com/id/Command-Line-Assembly-Language-Programming-for-Ard/</a></li>
	<li><a href="https://github.com/samcdc6600/Atmega16a-avra-asm-stuff.git" target="_blank">https://github.com/samcdc6600/Atmega16a-avra-asm-stuff.git</a></li>
	<li><a href="https://github.com/DarkSector/AVR/tree/master/asm/include" target="_blank">https://github.com/DarkSector/AVR/tree/master/asm/include</a></li>
	<li><a href="https://avrlogic.blogspot.com/2014/11/programming-atmega16-led-blink.html" target="_blank">https://avrlogic.blogspot.com/2014/11/programming-atmega16-led-blink.html</a></li>
	<li><a href="https://artofcircuits.com/product/usbasp-v2-0-programmer-for-atmel-microcontrollers" target="_blank">https://artofcircuits.com/product/usbasp-v2-0-programmer-for-atmel-microcontrollers</a></li>
	<li><a href="https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html" target="_blank">https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html</a></li>
	<li><a href="https://www.avrfreaks.net/forum/problem-avra-avr" target="_blank">https://www.avrfreaks.net/forum/problem-avra-avr</a></li>
	<li><a href="https://forum.allaboutcircuits.com/threads/leds-are-current-driven.39855/" target="_blank"></a></li>
      </ul>
      <br>
      <strong>References:</strong>
      <ol>
	<li class="refernce"><a href="https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html" target="_blank">https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html</a></li>
	<li class="refernce"><a href="https://www.mouser.com/datasheet/2/268/Atmel-8154-8-bit-AVR-ATmega16A_Datasheet-1065799.pdf" target="_blank">https://www.mouser.com/datasheet/2/268/Atmel-8154-8-bit-AVR-ATmega16A_Datasheet-1065799.pdf</a></li>
	<li class="refernce"><a href="https://github.com/DarkSector/AVR/tree/master/asm/include" target="_blank">https://github.com/DarkSector/AVR/tree/master/asm/include</a></li>
	<li class="refernce"><a href="https://www.avrfreaks.net/forum/problem-avra-avr" target="_blank">https://www.avrfreaks.net/forum/problem-avra-avr</a></li>
	<li class="refernce"><a href="https://www.arduino.cc/en/reference/SPI" target="_blank">https://www.arduino.cc/en/reference/SPI</a></li>
	<li class="refernce"><a href="https://acronyms.thefreedictionary.com/VCC" target="_blank">https://acronyms.thefreedictionary.com/VCC</a></li>
	<li class="refernce"><a href="https://www.instructables.com/id/Choosing-The-Resistor-To-Use-With-LEDs/" target="_blank">https://www.instructables.com/id/Choosing-The-Resistor-To-Use-With-LEDs/</a></li>
      </ol>
    </article>

    <?php
      topOfPageButton();
    ?>
  </div>
</main>

<?php
  bottom_module_and_right_side("whyDoesntThisSiteUseJS.html", true, true, "programming", "programmingArticles.html");
?>

</body>
</html>
