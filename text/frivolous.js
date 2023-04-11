var elementsOrig	 = [];
var maxSlideHeight	 = [];
var minMaxSlideHeight	 = [];	// Used when viewportWidth < pageBodyMinWidht.
var onSlide		 = [];
var advanceSlideShow	 = [];	// Which slide shows are playing.
var slideshowIntervalTimers = []; // What times are they turning over.
var viewportWidth;
const slideshowIndexKey	= "slid3Sh0wInd3x";
const slideshowButtonSound = "media/audio/80921__justinbw__buttonchime02up.wav";
const slideshowButtonSoundVol = "0.33";
// This should be kept inline with the value for body in the css.
const pageBodyMinWidth	= 800;
const slideshowPrevButtonVertOffset	= 16;
const slideshowNextButtonVertOffset	= 68;
const slideshowPlayPauseButtonVertOffset = 120;
const slidesNumberOnOffset	= 170;
const slideAdvanceInterval	= 32000;
// Cookie related variables.
const themeCookieKey	= "siteTheme";
/* This should be the index of the main css theme element in the object returned
   by: document.getElementsByTagName("link").item(cssLinkIndex) */
// const cssLinkIndex	= 1;
// const cookieObjKey	= "cookie"
// const cookieFound	= "found"
const themeTagName	= "#p@geTheme#"
const theme1Name	= "theme1.css"
const theme2Name	= "theme2.css"


window.addEventListener
("load", function handleInitalPageStuff()
 {
     applyThemeBasedOnCookie();
     setThemeSwitchToRightState();
     
     let elements = [];
     // /* Call to wait for the page to render (we load the script at the end of the
     //    page however sometimes it seems it's still not fully rendered. */
     // await sleep(32);

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
	     if(elements[iter].children[slideIter].tagName !== "PRE")
	     {
		 maxWidth = (elements[iter].children[slideIter].clientWidth > maxWidth) ?
		     elements[iter].children[slideIter].clientWidth: maxWidth;
		 maxHeight = (elements[iter].children[slideIter].clientHeight > maxHeight) ?
		     elements[iter].children[slideIter].clientHeight: maxHeight;
	     }
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
	 (">", newStyleHeight).replace("float-right", "").replace("noJsSlideshow", "slideshow") + 
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
     // Load other button assets after rendering slide show.
     preloadButtonAssets();
 });


function changeTheme()
{
    let cookie = getCookie(themeCookieKey);

    if(cookie != "")
    {
	/* Cookie found. Change theme value stored in cookie. */
	if(cookie === theme1Name)
	{
	    createGlobalThemeCookie(themeCookieKey, theme2Name)
	}
	else
	{
	    createGlobalThemeCookie(themeCookieKey, theme1Name)
	}
    }
    
    applyThemeBasedOnCookie()
}


function setThemeSwitchToRightState()
{
    let cookie = getCookie(themeCookieKey);
    /* We don't need to check if there is a cookie here (just if it isn't
       theme1Name) because the switch will be in the right position if there
       isn't a cookie or it is theme1Name. */
    if(cookie !== theme1Name)
    {
	let toggleSwitch = document.getElementById("themeSwitchInput");
	toggleSwitch.checked = toggleSwitch.checked == true? false: true;
    }
}


function applyThemeBasedOnCookie()
{
    let cookie = getCookie(themeCookieKey);

    if(cookie != "")
    {
	applyTheme(cookie);
    }
    else
    {
	createGlobalThemeCookie(themeCookieKey, theme1Name);
	applyTheme(getCookie(themeCookieKey));
    }

    /* Here we assume that one cannot be mousing over the "to top of page"
       button and changing the theme at the same time. */
    changeColorOnMouseOut(document.getElementById("to_top_of_page").parentElement);
}


function applyTheme(theme)
{
    let head = document.getElementsByTagName("head")[0];
    let foundTheme = false;

    // Search for child element of <head> with an id of themeTagName.
    for (let i = 0; i < head.children.length; i++)
    {
	if (head.children[i].id === themeTagName)
	{
	    foundTheme = true;
	    let oldCssLinkElement = head.children[i];
	    let newCssLinkElement = document.createElement("link");
	    newCssLinkElement.setAttribute("rel", "stylesheet");
	    newCssLinkElement.setAttribute("type", "text/css");
	    newCssLinkElement.setAttribute("href", theme);
	    newCssLinkElement.setAttribute("id", themeTagName);
	    document.getElementsByTagName("head").item(0).
		replaceChild(newCssLinkElement, oldCssLinkElement);
	    
	    break;
	}
    }

    if(!foundTheme)
    {
	console.log("Error: theme link tag not found!")
    }
}


// This function is taken from: https://www.w3schools.com/js/js_cookies.asp
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


// Creates (update) a cookie that is not page relative.
function createGlobalThemeCookie(key, theme)
{
    document.cookie = key + "=" + theme + "; path=/";
}


function preloadButtonAssets()
{
    // Images to preload
    let imageUrls =
	["media/misc/purpuleOrbLeftArrowButtonSmallWithDropShadow.png",
	 "media/misc/lighterPurpuleOrbLeftArrowButtonSmallWithDropShadow.png",
	 "media/misc/purpuleOrbRightArrowButtonSmallWithDropShadow.png",
	 "media/misc/lighterPurpuleOrbRightArrowButtonSmallWithDropShadow.png",
	 "media/misc/smallPauseButtonWithDropShadow.png",
	 "media/misc/lighterSmallPauseButtonWithDropShadow.png",
	 "media/misc/greenPlayButtonWithDropShadow.png",
	 "media/misc/lighterGreenPlayButtonWithDropShadow.png"];
    let imageSoundUrls =
	[slideshowButtonSound]

        /* Create Image and sound objects. */
    var images = [];
    var sounds = [];

    /* Set their src attributes to preload
       the images and sounds. */
    for (let i = 0; i < imageUrls.length; i++)
    {
	images[i] = new Image();
	images[i].src = imageUrls[i];
    }
    for (let i = 0; i < imageSoundUrls.length; i++)
    {
	sounds[i] = new Audio();
	sounds[i].src = imageSoundUrls[i];
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
    /* If the page was loaded with a viewport less then pageBodyMinWidth
       minMaxSlideHeight[x] will or at least may be NaN. */
    slideHeight =
	!isNaN(slideHeight) ?
	slideHeight:
	maxSlideHeight[slideshowIndex];
    
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

    /* If the page was loaded with a viewport less then pageBodyMinWidth
    minMaxSlideHeight[x] will or at least may be NaN. */
    slideHeight =
	!isNaN(slideHeight) ?
	slideHeight:
	maxSlideHeight[slideshowIndex];
	
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
		slide.outerHTML.replace(">", sizeStyle).
		replace("float-right", "").
		replace("noJsSlideshow", "slideshow") +
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
    /* #to_top_of_page must be updated in one or both of the themes CSS files if
       either of these are changed. */
    if(getCookie(themeCookieKey) == theme1Name)
    {
	pageElement.firstElementChild.style.backgroundColor="#baeaff";
    }
    else
    {
	pageElement.firstElementChild.style.backgroundColor="#ffd9d9";
    }
}


function changeColorOnMouseOut(pageElement)
{
    /* #to_top_of_page must be updated in one or both of the themes CSS files if
       either of these are changed. */
    if(getCookie(themeCookieKey) == theme1Name)
    {
	pageElement.firstElementChild.style.backgroundColor="#000762";
    }
    else
    {
	pageElement.firstElementChild.style.backgroundColor="#fe78fa";
    }
}
