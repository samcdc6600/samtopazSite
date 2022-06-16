var elementsOrig = [];
var elements	 = [];
var slideNumbers = [];
var onSlide	 = [];

window.onload = function()
{
    // let allElements = document.getElementsByTagName("*");

    // for(let iter = 0; iter < allElements.length; ++iter)
    // {
    // 	if(allElements[iter].className == "slideShow")
    // 	{
    // 	    // console.log(allElements[iter].firstElementChild);
    // 	    elementsOrig.push(allElements[iter].cloneNode(true));
    // 	    elements.push(allElements[iter]);
    // 	    // console.log(elementsOrig[iter].firstElementChild.outerHTML);
    // 	    // elements[iter] = elementsOrig[iter].firstElementChild.outerHTML;
    // 	}
    // }

    // for(let iter = 0; iter < elementsOrig.length; ++iter)
    // {
    // 	console.log(elementsOrig[iter].cloneNode(true).firstElementChild.outerHTML);
    // 	// console.log(elements[iter].outerHTML);
    // 	elements[iter].innerHTML = elementsOrig[iter].cloneNode(true).firstElementChild.outerHTML;
    // }

    // elementsOrig.forEach((slideShow, index) =>
    // 	{
    // 	    console.log(`{index} : ${slideShow}`);
    // 	    console.log(slideShow.innerHTML);
    // 	});

    // elements = document.getElementsByClassName("slideShow");
    // elementsOrig = Array(elements.length);
    // // Number of slides for each "slide show".
    // slideNumbers = Array(elements.length);
    // // Side we are on for a given "slide show".
    // onSlide = Array(elements.length);

    // for(let iter = 0; iter < elements.length; ++iter)
    // {
    // 	elementsOrig[iter] = new DOMParser
    // 	().parseFromString(elements[iter].outerHTML, "text/html");
    // 	console.log(typeof(elementsOrig[iter]));
    // 	// console.log("innerHTML ===============================");
    // 	// console.log(elements[iter].outerHTML);
    // 	// elements[iter].innerHTML = elements[iter].firstChild.innerHTML;
    // }

    // console.log(typeof(elements));
    // Object.entries(elements).forEach((slideShowContent, index) =>
    // 	{
    // 	    console.log(`{index} : ${slideShowContent}`);
    // 	    console.log(slideShowContent.innerHTML);
    // 	});
    // console.log(slideNumbers.length);
    // console.log(elements);
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
