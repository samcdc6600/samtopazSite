<?php

define("mainCss", "<link type=\"text/css\" rel=\"stylesheet\" href=\"./mainLayout.css\"/>");

function topOfPageButton()
{
	$htmlOut = <<<"OUTPUT"
			<a class="a_gui_element" id="position_to_top_of_page" onclick="toIdOnClick(this)">
			   <div id="to_top_of_page">
		     	   	<div id="text_align_to_top_of_page">To Top of Page</div>
		     	   </div>
			</a>
OUTPUT;
	echo $htmlOut;
}

function top_module_and_left_side_nav($pageTitle, $currentPage, $altLook, $cssForCode)
{    
    $htmlOut = <<<"OUTPUT"
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <title>$pageTitle</title>
    <link rel="icon" href="media/favicon.ico" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="./mainLayout.css"/>
    <script src="frivolous.js" async></script>
</head>
  <body>

    <header class="head_and_foot">
    </header>

  <div id="container">
      <div class="column LR main_page l">    <!--*******************Left side of the page (navigation and boarder)*******************-->
        <div class="column LR main_page  left_top"></div>
        <nav class="column left_middle">
          <ul class="menu_list l"><!--site navigation menu-->
            <li><a class=a_gui_element href="./index.html"><div class="menu_element l">My World Home</div></a></li>
            <li><a class=a_gui_element href="./about.html"><div class="menu_element l">About</div></a></li>
            <li><a class=a_gui_element href="./contact.html"><div class="menu_element l">Contact</div></a></li>
          </ul>
        </nav>
        <div class="column LR main_page left_bottom"></div>
      </div>

OUTPUT;
    echo adjustTopModuleAndLeftSideNavForPage($altLook, $currentPage, $htmlOut, $cssForCode);

}

//make page specific adjustment's to $htmlOut
    function adjustTopModuleAndLeftSideNavForPage($altLook, $currentPage, $htmlOut, $cssForCode)
{
    $htmlOut = altLookLeftSide($altLook, $htmlOut);
    $htmlOut = highlightLeftSidePageLink($currentPage, $htmlOut);
    $htmlOut = includeExtraCss($htmlOut, $cssForCode);
    return $htmlOut;
}

//enable alternative look if altLook set to true
function altLookLeftSide($altLook, $htmlOut)
{
    if($altLook)
	{
		$find = "LR main_page l";
		$htmlOut = str_replace($find, "LR l", $htmlOut);

		$find = "LR main_page  left_top";
		$htmlOut = str_replace($find, "LR left_top", $htmlOut);

		$find = "LR main_page left_bottom";
		$htmlOut = str_replace($find, "LR left_bottom", $htmlOut);
	}
    return $htmlOut;
}

//highlight the correct link on the left side of the page if applicable
function highlightLeftSidePageLink($currentPage, $htmlOut)
{
    if($currentPage != "null")
	{
		$find = $currentPage . "\"><div class=\"menu_element l\"";
		$htmlOut =	str_replace($find, "$currentPage\"><div class=\"menu_element l current_page\"", $htmlOut);
	}
    return $htmlOut;
}

function includeExtraCss($htmlOut, $cssForCode)
{
	if($cssForCode != "null")
		return str_replace(mainCss, " <link type=\"text/css\" rel=\"stylesheet\" href=\"" . $cssForCode . "\"/>" . mainCss, $htmlOut);
	return $htmlOut;
}

function heading($heading_text)
{
    $htmlOut = <<<"OUTPUT"
<div class="heading_oval">
<h1 class="oval">
$heading_text
</h1>
</div>
OUTPUT;
    echo $htmlOut;
}



function bottom_module_and_right_side($currentPage, $altLook, $article, $articleCatagory, $parentPage)
{
    $htmlOut = <<<"OUTPUT"
      <div class="column LR main_page r">       <!--*******************Right side of the page (boarder)*******************-->
        <div class="column LR main_page right_top"></div>
        <div class="column right_middle">
	        <nav class="column right_middle">
          <ul class="menu_list r"><!--site navigation menu-->
            	<li><a class=a_gui_element href="./allArticles.html"><div class="menu_element r">All Articles</div></a></li>            
            	<li><a class=a_gui_element href="./computerArchitectureArticles.html"><div class="menu_element r">Comp Arch</div></a></li>
		<li><a class=a_gui_element href="./operatingSystemArticles.html"><div class="menu_element r">Operating Sys</div></a></li>
            	<li><a class=a_gui_element href="./programmingArticles.html"><div class="menu_element r">Programming</div></a></li>			
          </ul>
        </nav>
	</div>
        <div class="column LR main_page right_bottom"></div>
      </div>

    </div>
    <footer class="head_and_foot">
    </footer>
OUTPUT;
    $htmlOut = adjustTopModuleAndRightSideNavForPage($currentPage, $altLook, $article, $htmlOut, $articleCatagory, $parentPage);
    echo $htmlOut;
}

//There is a lot of code duplication in the next three function's. This should be fixed at a latter date!
function adjustTopModuleAndRightSideNavForPage($currentPage, $altLook, $article, $htmlOut, $articleCatagory, $parentPage)
{
    $htmlOut = altLookRightSide($altLook, $htmlOut);
    $htmlOut = highlightRightSidePageLink($currentPage, $article, $articleCatagory, $htmlOut, $parentPage); 
    return $htmlOut;
}

function altLookRightSide($altLook, $htmlOut)
{
    if($altLook)
	{
		$find = "LR main_page r";
		$htmlOut =	str_replace($find, "LR r", $htmlOut);
		$find = "LR main_page right_top";
		$htmlOut =	str_replace($find, "LR right_top", $htmlOut);
		$find = "LR main_page right_bottom";
		$htmlOut =	str_replace($find, "LR right_bottom", $htmlOut);
    }
    return $htmlOut;
}

function highlightRightSidePageLink($currentPage, $article, $articleCatagory, $htmlOut, $parentPage)
{
    if($currentPage != "null")
    {
        if($article)
        {            
            $find = $parentPage . "\"><div class=\"menu_element r\"";
            $htmlOut = addArticleLink($currentPage, $articleCatagory, $find, $htmlOut);
            $htmlOut =	str_replace($find, "$parentPage\"><div class=\"menu_element r current_parent_page\"", $htmlOut);

        }
        else
        {
            $find = $currentPage . "\"><div class=\"menu_element r\"";
            $htmlOut = str_replace($find, "$currentPage\"><div class=\"menu_element r current_page\"", $htmlOut);
        }
    }
        return $htmlOut;
}

function addArticleLink($currentPage, $articleCatagory, $find, $htmlOut)
{//all of this code is terrible I know :(
    $afterReplace = strpos($htmlOut, "</li>", strpos($htmlOut, $find));
    if($endOfNew = strpos($htmlOut, "<li>", $afterReplace))
    {}//if <li> is found
    else//else we are to insert after the last element in the list
    {$endOfNew = strpos($htmlOut, "</ul>", $afterReplace);}
    
    $postfix = substr($htmlOut, $endOfNew);
    $prefix = substr($htmlOut, 0, $afterReplace);
    $center = "</li><li><a class=a_gui_element href=\"" . $currentPage . "\"><div class=\"menu_element r current_page\">" . substr(getLinkText(rmHTMLExtension("articles/" . $articleCatagory . "/" . $currentPage) . ".php"), 0, 12) . "</div></a></li>";
    return $prefix . $center . $postfix;
}

function echoAllLinks()
{
    define("one", 1);
    //NOTE: THESE PATHS MUST BE RELATIVE TO THE PHP_ALL.SH SCRIPT NOT THIS FILE!
    $dirs = array("articles/OS", "articles/compArch", "articles/programming");    
    $dirArray = getAllDirsArr($dirs);//get list of files and store as an array in the dirArray array
    //count elements in array
    $count = count($dirArray);
    sort($dirArray);

    //print the directory contents
    echo("<ul>");
    for($iter = 0; $iter < $count; ++$iter)
    {
        if(strpos($dirArray[$iter], ".php"))//only output if the $direArray contains the substring .html
        {
            $linkText = getLinkText($dirArray[$iter]);//remove postfix ".html"
            echo "<li class=\"articleLink\"><a href=\"", rmPathPrefix(rmPHPExtension($dirArray[$iter])) . ".html", "\">", $linkText, "</a></li>";
        }
    }
    echo("</ul>");
}

//removes everything upto and including the last "/" in the argument dir
function rmPathPrefix($dir)
{//strrpos (last occuence of...)
    return substr($dir, strrpos($dir, "/") +1);//account for off by one error and also remove "/"
}


function echoOneDirsLinks($dir)
{   
    define("dirPrefix", "articles/");
    //    define("dirPrefix2", "articles/");
    $dirArray = getDirArr(dirPrefix . $dir);//get list of files and store as an array in the dirArray array
    //count elements in array
    $count = count($dirArray);
    sort($dirArray);
    
    //print the directory contents
    echo("<ul>");
    for($iter = 0; $iter < $count; ++$iter)
    {        
        $path = dirPrefix . $dir . "/" . $dirArray[$iter];
        if(strpos($path, ".php"))//only output if the $direArray contains the substring .php
        {
            $linkText =  getLinkText($path);
            echo "<li class=\"articleLink\"><a href=\"", rmPHPExtension($dirArray[$iter]) . ".html", "\">", $linkText, "</a></li>";
        }
    }
    echo("</ul>");
    
}

//get a list of all the .php files in all subdirectories of articles.
function getAllDirsArr($dirs)
{
    $allDirListings = [];//the list of files will be stored here as an array
    foreach($dirs as $dir)
    {
        $dirList = getDirArr($dir);//store directory content's into dirList array
        $dirList = addPrefixToAll($dir, $dirList);
        $allDirListings = array_merge($allDirListings, $dirList);//add the dirList array's contents to the allListings array
    }
    return $allDirListings;
}

//takes a directory and returns the list of files in that directory
function getDirArr($dir)
{
    $openDir = opendir((string)$dir);
    //get each entery
    while($entryName = readdir($openDir))
    {
        $dirArray[] = $entryName;
    }
    //close directory
    closedir($openDir);
    return $dirArray;
}

//add's the first part of the path to the file name to make the full path.
function addPrefixToAll($dir, $dirList)
{
    foreach($dirList as $element)
    {
        $retDirList[] = $dir . "/" . $element;
    }
    return $retDirList;
}

function rmHTMLExtension($fileName)
{
    $chPos = strpos($fileName, ".html");
    return substr($fileName, 0, $chPos);
}

function rmPHPExtension($fileName)
{
    $chPos = strpos($fileName, ".php");
    return substr($fileName, 0, $chPos);
}


function getLinkText($fileName)
{
    $file = fopen($fileName, "r");
    $fileContents = fread($file, filesize($fileName));//read in the file
    fclose($file);
    $start = strpos($fileContents, "<h4>", 0);
    $end = strpos($fileContents, "</h4>", 0);
    return substr($fileContents, $start +4, $end -$start -4);//+4 & -5 are to account for the opening and closing tags
}
?>
