var elementsOrig	 = [];
var maxSlideHeight	 = [];
var minMaxSlideHeight	 = [];	// Used when viewportWidth < pageBodyMinWidht.
var onSlide		 = [];
var advanceSlideShow	 = [];	// Which slide shows are playing.
var slideshowIntervalTimers = []; // What times are they turning over.
var viewportWidth;
const slideshowIndexKey	= "slid3Sh0wInd3x";
const slideshowButtonSound = "media/audio/80921__justinbw__buttonchime02up.wav";
const slideshowButtonSoundVol = "0.2";
// This should be kept inline with the value for body in the css.
const pageBodyMinWidth	= 800;
const slideshowPrevButtonVertOffset	= 16;
const slideshowNextButtonVertOffset	= 68;
const slideshowPlayPauseButtonVertOffset = 120;
const slidesNumberOnOffset	= 170;
const slideAdvanceInterval	= 48000;


function sleep(ms)
{
    return new Promise(resolve => setTimeout(resolve, ms));
}


onload = handleInitalPageStuff();
async function handleInitalPageStuff()

{
    let elements = [];
    /* Call to wait for the page to render (we load the script at the end of the
       page however sometimes it seems it's still not fully rendered. */
    await sleep(32);

    let allElements = document.getElementsByTagName("*");
    // Get all div's using the slideshow class.
    for(let iter = 0; iter < allElements.length; ++iter)
    {
	if(allElements[iter].className == "slideshowContainer")
	{
	    elementsOrig.push(allElements[iter].cloneNode(true));
	    elements.push(allElements[iter]);
	}
    }

    /* Get viewport dimensions as we will use these to size elements when the
       window changes size. */
    viewportWidth = window.innerWidth;
    
    // Get the height of the tallest child for each div using the slideshow class.
    for(let iter = 0; iter < elements.length; ++iter)
    {
	let maxWidth;
	let maxHeight;
	maxWidth = 0;
	maxHeight = 0;

	for(let slideIter = 0; slideIter < elements[iter].children.length;
	    ++slideIter)
	{
	    maxWidth = (elements[iter].children[slideIter].clientWidth > maxWidth) ?
		elements[iter].children[slideIter].clientWidth: maxWidth;
	    maxHeight = (elements[iter].children[slideIter].clientHeight > maxHeight) ?
		elements[iter].children[slideIter].clientHeight: maxHeight;
	}
	maxSlideHeight.push(maxHeight);
    }

    // Will be populated when the page is resized.
    minMaxSlideHeight = Array(maxSlideHeight.length);

    /* Update each div using the slideshow class to be the height of it's
       tallest child and only show the first of it's elements as well as
       displaying next and previous buttons. */
    for(let iter = 0; iter < elementsOrig.length; ++iter)
    {
	advanceSlideShow.push(true); // All slide shows start of as automatic.
	// Math.random() returns a number x, where x is [0, 1).
	let interval;
	interval = Math.random() * slideAdvanceInterval;
	slideshowIntervalTimers.push(
	    setTimeout(function() {autoAdvanceSlide(iter, interval)}, interval));
	
	let newStyleHeight;
	newStyleHeight = "style=\"height: " +
	    parseInt(maxSlideHeight[iter]) + "px\">";

	onSlide[iter] = 0;
	
	elements[iter].outerHTML =
	    "<div class=\"slideshowContainer\" id=\"" + slideshowIndexKey + iter + "\">" +
	    elementsOrig[iter].firstElementChild.outerHTML.replace
	(">", newStyleHeight).replace("float-right", "") + 
	    "<a class=\"slideshowButton previous\" " +
	    "onclick=\"nextSlideshowImageLeftWithSound(this, false)\" style=\"top: " +
	    (maxSlideHeight[iter] - slideshowPrevButtonVertOffset) + "px\">" +
	    "</a>" +
	    "<a class=\"slideshowButton next\" " +
	    "onclick=\"nextSlideshowImageRightWithSound(this, false)\" style=\"top: " +
	    (maxSlideHeight[iter] - slideshowNextButtonVertOffset) + "px\">" +
	    "</a>" +
	    "<a class=\"slideshowButton pause\" " +
	    "onclick=\"pausePlaySlideshowWithSound(this)\" style=\"top: " +
	    (maxSlideHeight[iter] - slideshowPlayPauseButtonVertOffset) + "px\">" +
	    "</a>" +
	    "<div class=\"slideshowSlideNumberCounter\">"+ "<strong>" +
	    "<strong class=\"stronger\">" + 1 + "</strong>" +  "/" +
	    elementsOrig[iter].children.length + "</strong></div>" +
	    "</div>";
    }
}


function autoAdvanceSlide(slideIter, interval)
{
    if(interval != slideAdvanceInterval)
    {
	slideshowIntervalTimers[slideIter] =
	    (setInterval(function()
			 {autoAdvanceSlide(slideIter, slideAdvanceInterval)},
			 slideAdvanceInterval));
    }
    
    if(advanceSlideShow[slideIter])
    {
	nextSlideshowImageRight
	(document.getElementById(
	    slideshowIndexKey + slideIter).firstElementChild,
	 advanceSlideShow[slideIter], false);
    }
}


function nextSlideshowImageLeftWithSound(slide, dontStopAuto)
{
    playSound(slideshowButtonSound, slideshowButtonSoundVol);
    nextSlideshowImageLeft(slide, dontStopAuto);
}


function nextSlideshowImageLeft(slide, dontStopAuto)
{
    let slideshow = slide.parentElement;
    let slideshowNumberFirstIndex =
	slideshow.outerHTML.indexOf(slideshowIndexKey, 0) +
	slideshowIndexKey.length;
    let slideshowNumberSecondIndex =
	slideshow.outerHTML.indexOf("\"", slideshowNumberFirstIndex);
    let slideshowIndex =
	slideshow.outerHTML.substring(slideshowNumberFirstIndex,
				      slideshowNumberSecondIndex);

    // Update which slide we are on
    if(onSlide[slideshowIndex] == 0)
    {
	onSlide[slideshowIndex] = elementsOrig[slideshowIndex].children.length -1;
    }
    else
    {
	--onSlide[slideshowIndex];
    }

    // Stop auto advance?
    toggoleAutoAdvance(slideshowIndex, dontStopAuto);
    changeSlideTo(slideshowIndex, slideshow,
		  elementsOrig[slideshowIndex].children.length);
}


function nextSlideshowImageRightWithSound(slide, dontStopAuto)
{
    playSound(slideshowButtonSound, slideshowButtonSoundVol);
    nextSlideshowImageRight(slide, dontStopAuto);
}


function nextSlideshowImageRight(slide, dontStopAuto)
{
    let slideshow = slide.parentElement;
    let slideshowNumberFirstIndex =
	slideshow.outerHTML.indexOf(slideshowIndexKey, 0) +
	slideshowIndexKey.length;
    let slideshowNumberSecondIndex =
	slideshow.outerHTML.indexOf("\"", slideshowNumberFirstIndex);
    let slideshowIndex =
	slideshow.outerHTML.substring(slideshowNumberFirstIndex,
				      slideshowNumberSecondIndex);

    // Update which slide we are on
    if(onSlide[slideshowIndex] == (elementsOrig[slideshowIndex].children.length -1))
    {
	onSlide[slideshowIndex] = 0;	
    }
    else
    {
	++onSlide[slideshowIndex];
    }

    toggoleAutoAdvance(slideshowIndex, dontStopAuto);
    changeSlideTo(slideshowIndex, slideshow,
		  elementsOrig[slideshowIndex].children.length);
}


function toggoleAutoAdvance(slideshowIndex, dontStopAuto)
{
    if(!dontStopAuto)
    {
	clearInterval(slideshowIntervalTimers[slideshowIndex]);
    }
    advanceSlideShow[slideshowIndex] = dontStopAuto;
}


function pausePlaySlideshowWithSound(slide)
{
    playSound(slideshowButtonSound, slideshowButtonSoundVol);
    
    let slideshow = slide.parentElement;
    let slideshowNumberFirstIndex =
	slideshow.outerHTML.indexOf(slideshowIndexKey, 0) +
	slideshowIndexKey.length;
    let slideshowNumberSecondIndex =
	slideshow.outerHTML.indexOf("\"", slideshowNumberFirstIndex);
    let slideshowIndex =
	slideshow.outerHTML.substring(slideshowNumberFirstIndex,
				      slideshowNumberSecondIndex);

    let slideHeight = parseInt((viewportWidth > pageBodyMinWidth) ?
			       maxSlideHeight[slideshowIndex]:
	     minMaxSlideHeight[slideshowIndex]);
    let  sizeStyle = "style=\"top: " +
	(slideHeight - slideshowPlayPauseButtonVertOffset) + "px\">";

    if(advanceSlideShow[slideshowIndex])
    {
	clearInterval(slideshowIntervalTimers[slideshowIndex]);
	
	advanceSlideShow[slideshowIndex] = !advanceSlideShow[slideshowIndex];
	slide.outerHTML =
	    "<a class=\"slideshowButton play\" " +
	    "onclick=\"pausePlaySlideshowWithSound(this)\" " + sizeStyle +
	    "</a>";
    }
    else
    {
	slideshowIntervalTimers[slideshowIndex] =
	    (setInterval(function()
			 {autoAdvanceSlide(slideshowIndex, slideAdvanceInterval)},
			 slideAdvanceInterval));
	
	advanceSlideShow[slideshowIndex] = !advanceSlideShow[slideshowIndex];
	slide.outerHTML =
	    "<a class=\"slideshowButton pause\" " +
	    "onclick=\"pausePlaySlideshowWithSound(this)\" " + sizeStyle +
	    "</a>";
    }
}


function changeSlideTo(slideshowIndex, slideshow, slideshowLength)
{
    // If the window get's too small we use minMaxSlideHeight[slideshowIndex].
    let slideHeight =
	parseInt((viewportWidth > pageBodyMinWidth) ?
		 maxSlideHeight[slideshowIndex]:
		 minMaxSlideHeight[slideshowIndex]);
    let  sizeStyle = "style=\"height: " + slideHeight + "px\">";
    let  playPauseButton = advanceSlideShow[slideshowIndex] ? "pause": "play";

    let index = 0;
    for(let slide of elementsOrig[slideshowIndex].children)
    {
	if(index == onSlide[slideshowIndex])
	{
	    slideshow.outerHTML =
		"<div class=\"slideshowContainer withSlideshowButtons\" id=\""
		+ slideshowIndexKey + slideshowIndex + "\">" +
		slide.outerHTML.replace
	    (">", sizeStyle).replace("float-right", "") +
		"<a class=\"slideshowButton previous\" " +
		"onclick=\"nextSlideshowImageLeftWithSound(this, false)\" style=\"top: " +
		(slideHeight - slideshowPrevButtonVertOffset) + "px\">" +
		"</a>" +
		"<a class=\"slideshowButton next\" " +
		"onclick=\"nextSlideshowImageRightWithSound(this, false)\" style=\"top: " +
		(slideHeight - slideshowNextButtonVertOffset) + "px\">" +
		"</a>" +
		"<a class=\"slideshowButton " + playPauseButton +
		"\" onclick=\"pausePlaySlideshowWithSound(this)\" style=\"top: " +
		(slideHeight - slideshowPlayPauseButtonVertOffset) + "px\">" +
		"</a>" +
		"<div class=\"slideshowSlideNumberCounter\" style=\"top: " +
		(slideHeight - slidesNumberOnOffset) + "px\">" + "<strong>" +
		"<strong class=\"stronger\">" + (onSlide[slideshowIndex] + 1) +
		"</strong>" + "/" + slideshowLength + "</strong></div>" +
		"</div>";
	    break;
	}
	index ++;
    }
}


// Resize elements when window changes size (just slideshows for now.)
window.addEventListener('resize', function(event)
{
    let newViewportWidth = window.innerWidth;
    
    for(let iter = 0; iter < elementsOrig.length; ++iter)
    {
	maxSlideHeight[iter] = maxSlideHeight[iter] *
	    (newViewportWidth / viewportWidth);

	if(viewportWidth > pageBodyMinWidth)
	{
	    /* Store potential minimum slide height (this isn't optimal but is
	       only a small bit of code.) */
	    minMaxSlideHeight[iter] = maxSlideHeight[iter]
	}
	
	let heightStyle;
	heightStyle = "style=\"height: " +
	    parseInt(maxSlideHeight[iter]) + "px\">";

	changeSlideTo(iter, document.getElementById(slideshowIndexKey + iter),
		      elementsOrig[iter].children.length)
    }

    viewportWidth = newViewportWidth;
});


function playSound(filePath, volume)
{
    var sound = new Audio(filePath);
    sound.volume = volume;
    sound.loop = false;
    sound.play(); 
}


function toIdOnClick(pageElement)
{
    pageElement.closest('div').parentNode.scrollTo(
	{top: 0,
	 left: 0,
	 behavior: 'smooth'});
}


function changeColorOnMouseOver(pageElement)
{
    pageElement.firstElementChild.style.backgroundColor="#ffd9d9";
}


function changeColorOnMouseOut(pageElement)
{
    pageElement.firstElementChild.style.backgroundColor="#fe78fa";
}
