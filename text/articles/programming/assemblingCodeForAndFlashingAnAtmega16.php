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
	You will need an Atmega16 (I have the 16A), breadboard, 5v PSU (at least for the 16A), USBASP v2.0, programmer (other programmer could be used) and of course electronic components (LEDs resistors etc...)
	<br>
	  Although the english is not the best we found <a href="https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html" target="_blank">this</a><sup class="refernce">1</sup> to be a good quick overview of our Atmega16A, for a much more compleate refernce see <a href="https://www.mouser.com/datasheet/2/268/Atmel-8154-8-bit-AVR-ATmega16A_Datasheet-1065799.pdf" target="_blank">this</a><sup class="refernce">2</sup>
	<br>
	    First we need to install an assembler.
	<br>
	  Our choice of assembler is avra (this was our choise because it was available.) We install avra by first searching for anything matching avr with "pkg serach avr", this returned the following results:
	        </p>
	  <pre>
	    <code class="c++ hljs cpp">arduino-avrdude-6.3_3          Program for programming the on-chip memory of Atmel AVR Arduino CPUs
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
simavr-1.3_1                   Simulator for several Atmel AVR chips</code>
	  </pre>
	      

      <strong>Usefule Links:</strong>
      <ul>
	<li><a href="https://www.instructables.com/id/Command-Line-Assembly-Language-Programming-for-Ard/" target="_blank">https://www.instructables.com/id/Command-Line-Assembly-Language-Programming-for-Ard/</a></li>
	<li><a href="https://github.com/samcdc6600/Atmega16a-avra-asm-stuff.git" target="_blank">https://github.com/samcdc6600/Atmega16a-avra-asm-stuff.git</a></li>
	<li><a href="https://github.com/DarkSector/AVR/tree/master/asm/include" target="_blank">https://github.com/DarkSector/AVR/tree/master/asm/include</a></li>
	<li><a href="https://avrlogic.blogspot.com/2014/11/programming-atmega16-led-blink.html" target="_blank">https://avrlogic.blogspot.com/2014/11/programming-atmega16-led-blink.html</a></li>
	<li><a href="https://artofcircuits.com/product/usbasp-v2-0-programmer-for-atmel-microcontrollers" target="_blank">https://artofcircuits.com/product/usbasp-v2-0-programmer-for-atmel-microcontrollers</a></li>
	<li><a href="https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html" target="_blank">https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html</a></li>
	<li><a href="https://www.avrfreaks.net/forum/problem-avra-avr" target="_blank">https://www.avrfreaks.net/forum/problem-avra-avr</a></li>
      </ul>
      <br>
      <strong>References:</strong>
      <ol>
	<li class="refernce"><a href="https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html" target="_blank">https://www.theengineeringprojects.com/2018/06/introduction-to-atmega16.html</a></li>
	<li class="refernce"><a href="https://www.mouser.com/datasheet/2/268/Atmel-8154-8-bit-AVR-ATmega16A_Datasheet-1065799.pdf" target="_blank">https://www.mouser.com/datasheet/2/268/Atmel-8154-8-bit-AVR-ATmega16A_Datasheet-1065799.pdf</a></li>
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
