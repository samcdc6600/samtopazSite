<?php
require_once("./common/tools.php");
top_module_and_left_side_nav("Background Chunk Editor For Side Scroller", "null", true, "samCustom.css");
?>

    <main class="inset_shadow scroll_style">
	<div id="position_main_part_of_main">
	<article id="main_tag_in_main_min_height">
	<?php
    	heading("CHUNKED");
	?>
    <br><br><h4>Background Chunk Editor For Side Scroller</h4>
        <p>
        We have been working on an Ncurses based side side scroller and it will
        require at least a couple of asset editing tools. This article is about
        one of them. Namely, <em>Chunked</em>! It is essentially a drawing tool
        for creating fixed sized character based images. It is written in C++
        and doesn't use any libraries apart from the standard library and
        Ncurses.
        </p>
        <p>
        Chunked deals with four types of files. These fall into two
        classes of files, namely composite files and (for lack of a better term)
        standard files.
        <br>
        These so called standard files have the extensions <em>.bgchunk</em> and
        <em>.crchunk</em>.
        <br>
    	The composite files have the extensions <em>.levbg</em> and
        <em>.levcr</em> and are
        composed of the concatenated contents of .bgchunk files and .crchunk
        files respectively. 
        <br>
        Chunked can be used to create a series of .bgchunk and .crchunk files
        (.bgchunk and .crchunk files are created / edited simultaneously.)
        <br>
        Once these files are created they can be compiled together into
        .levbg files and .levcr files.
        <br>
        .levbg files and .levcr will be referenceable from config files that the
        side scroller can read.
        </p>
        <p>
        .bgchunk files are essentially image files where the picture elements
        are a subset of extended ASCII characters with added colour information.
        They use a simple run-length encoding compression scheme.
        There is an eight byte header that is interpreted as a chunk coordinate
        this consists of two signed 32 bit numbers, y and x. After this is the
        image. Each run of pixels of equal value that is more than
        <em>bgCompressionAdvantagePoint</em> (3) is encoded using a run-length
        encoding.
        The pixels are represented by integers of type
        <em>backgroundChunkCharType</em>
        (unsigned short). This allows for all the combinations of characters and
        colours we need to represent all possible pixel values with some small
        space left over
        that we can use for a special constant
        (<em>bgRunLengthSequenceSignifier</em>)
        that will represent the start of a run length sequence (which consists
        of this special character, a length and a pixel.)
        Each pixel is encoded as an extended ASCII number minus
        <em>lowerUnusedASCIIChNum</em> (which is 32 -1) times a color pair
        number.

        The images are always of the same dimensions (<em>48</em>x<em>178</em>)
        so each run of 178 pixels (starting from the origin ((0, 0) top left))
        represents a horizontal line of pixels.
        <br>
        .crchunk files are similar except a small subset of ASCII characters are
        used for the pixels and there is no color information.
        </p>
        <p>
        .levbg files are used for level backgrounds. Level backgrounds consist
        of a series of images (chunks) that have coordinates.
        .levcr files are used for level boundaries and surfaces that the player
        can interact with. Currently there are only two types of boundaries /
        surfaces (AKA character rules). These are borders (represented by
        border
        characters '<em>b</em>'s) and platforms (represented by platform
        characters '<em>p</em>'s.)
        The player cannot move through border characters and can only move up
        through platform characters.
        There should be a rules chunk for each background chunk (even if the
        rules chunk contains no character rules. In which case it will contain
        only spaces (which have no effect on the player.))

        Chunked offers a number of modes. Basic info about the supported modes
        can be seen by starting Chunked with the -h switch. If you do this you
        will be presented with the following:
        </p>


       <pre><code class="c++ hljs cpp">
================================================================================
./chunked Help:
        ./chunked has seven modes. They are as follows.

    1st mode:
        The first mode is known as Single Chunk Edit Mode. If the files have the
        extensions ".bgchunk" and ".crchunk" respectively and the paths are
        valid. The program will enter Chunk Edit Mode. In this mode the
        background chunk file and the rules chunk file can be edited and saved.
        The files can be pre-existing files or they can be new files. If the
        files are pre-existing their pre-existing contents will be editable. If
        the files are new the user will be asked to supply a chunk coordinate
        for the files (If just one of the files is new the chunk coordinate will
        be read from the pre-existing file.) The coordinate of the chunks can
        also be changed in this mode.
            Example:
                ./chunked superGood.bgchunk superGood.crchunk

    2nd mode:
        The second mode is an alternative form of Single Chunk Edit mode.
        Instead of supplying the names of one ".bgchunk" file and one ".crchunk"
        file the names of two ".bgchunk" and two ".crchunk" files must be
        supplied. This second set of files will be viewable as a reference in
        the editor when editing the first set of file. Where the second set are
        the files that appear after a file with the same extension in the
        command.
            Example:
                ./chunked superGood.bgchunk superGoodReference.bgchunk superGood.crchunk superGoodReference.crchunk

    3rd mode:
        The third mode is known as Append Mode. In this mode the contents of a
        ".bgchunk" file will be appended to a ".levbg" file.
        Or alternatively the contents of a ".crchunk" file willbe appended to a
        ".levcr" file.
        Which action is performed depends of the file extensions of the
        arguments. If the file extensions of the arguments are ".bgchunk" and
        ".levbg" respectively then the first action will be performed.
        However if the file extensions of the arguments are ".crchunk" and
        ".levcr" respectively then the second action will be performed.
            Example:
                ./chunked superGood.bgchunk splendid.levbg

    4th mode:
        This mode is known as Extraction Mode. In this mode a chunk is removed
        from a .levbg file or a .levcr file and placed in a
        .bgchunk file or a .crchunk file. A .levbg file must be
        specified as the first argument. This should be followed by a .bgchunk
        file and finally by the desired y and x coordinate of the chunk to be
        extracted.
        Or alternatively a .levcr file must be specified as the first
        argument. This should be followed by a .crchunk file and finally by the
        desired y and x coordinate of the chunk to be extracted.
            Example:
                ./chunked splendid.levbg superGood.bgchunk 11 -3

    5th mode:
        This mode is known as Delete Mode. Chunks can be removed from ".levbg"
        and ".levcr" files. A valid chunk coordinate for a chunk to be removed
        should be supplied.
            Example:
                ./chunked splendid.levbg 11 -3

    6th mode:
        This mode is known as Map View Mode. In this mode a .levbg
        file or a .levcr file can be viewed in a zoomed out mammer,
        with one character corresponding to 1 chunk. If the layout is not
        viewable in this way within the view port. The user may use the arrow
        keys to move around. To enter this mode the user must supply a file as
        the soul argument. The file must either be a .levbg file. Or a
        .levcr file.
            Example:
                ./chunked splendid.levbg

    7th mode:
        This mode is known as Help Mode and does what it says on the tin.
                Example:
                ./chunked -h
                                           
       </code></pre>

       <p>
       Single Chunk Edit Mode and Map View Mode have help menus that can be
       accessed by pressing h. Each of these modes also have what we will call
       sub-modes. These modes have their own help menus.
       </p>

       <div class="articleSection">
	   <h4>Single Chunk Edit Mode</h4>
	   <video class="float-right" controls autoplay loop>
	    <source src="media/videos/singleChunkEditMode.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	   </video>
	   <p>
	    To the right is a video showing off some of the features of the Single
        Chunk Edit Mode.
	   </p>
	   <br>
	   </div>

       <div class="articleSection">
	   <h4>Map View Mode</h4>
	   <video class="float-right" controls autoplay loop>
	    <source src="media/videos/mapViewMode.webm" type="video/webm">
	      Your browsing software does not seem to support the video tag.
	   </video>
	   <p>
	    To the right is a video showing off some of the features of the
        Map View Mode and the Append Mode.
	   </p>
	   <br>
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
	bottom_module_and_right_side("chunked.html", true, true, "programming", "programmingArticles.html");
?>

