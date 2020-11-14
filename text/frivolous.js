function toIdOnClick(pageElement)
{
    pageElement.closest('div').parentNode.scrollTo({top: 0, left: 0, behavior: 'smooth'});
}

function changeColorOnMouseOver(pageElement)
{
    pageElement.firstElementChild.style.backgroundColor="#ffd9d9";
}

function changeColorOnMouseOut(pageElement)
{
    pageElement.firstElementChild.style.backgroundColor="#fe78fa";
}
