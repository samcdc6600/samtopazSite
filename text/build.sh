#!/bin/sh

# Make the directory if it dosen't exist
mkdir ~/www.samtopaz.com
# Clear target dir's ===========================================================
rm -r ~/www.samtopaz.com/*

# gen article pages
# NOTE: this must be done after clearing the destination directory's but before generating the article link
# pages. In order to generate the link's on those pages for the articles the articles must first exist!
# We must also make sure there are no files left by emacs. Files ending in "~" appear to be added as articles.
# So they must be removed.

# compArch =====================================================================
# remove crud at articles/compArch
rm articles/compArch/*~ articles/compArch/*#
php articles/compArch/tomasulosAlgorithm.php > ~/www.samtopaz.com/tomasulosAlgorithm.html;

# OS ===========================================================================
# remove crud at articles/OS
rm articles/OS/*~ articles/OS/*#
php articles/OS/microKernels.php > ~/www.samtopaz.com/microKernels.html;
php articles/OS/definitionOfAnOperatingSystem.php > ~/www.samtopaz.com/definitionOfAnOperatingSystem.html;
php articles/OS/meme1.php > ~/www.samtopaz.com/meme1.html;

# programming ==================================================================
# remove crud at articles/programming
rm articles/programming/*~ articles/programming/*#
php articles/programming/whyDoesntThisSiteUseJS.php > ~/www.samtopaz.com/whyDoesntThisSiteUseJS.html;
php articles/programming/xlibGraphicalBrightnessControlAndFreeBSD.php > ~/www.samtopaz.com/xlibGraphicalBrightnessControlAndFreeBSD.html;
php articles/programming/myGitHub.php > ~/www.samtopaz.com/myGitHub.html;
php articles/programming/assemblingCodeForAndFlashingAnATmega16.php > ~/www.samtopaz.com/assemblingCodeForAndFlashingAnATmega16.html;

# Misc =========================================================================
# remove crud at articles/misc
rm articles/misc/*~ articles/misc/*#
cp -r articles/misc/media ~/www.samtopaz.com/ # Copy media for misc articles.\
php articles/misc/projects.php > ~/www.samtopaz.com/projects.html;

# copy stylesheet/s
java -jar yuicompressor-2.4.8.jar --type css mainLayout.css > ~/www.samtopaz.com/mainLayout.css;
java -jar yuicompressor-2.4.8.jar --type css theme1.css > ~/www.samtopaz.com/theme1.css;
java -jar yuicompressor-2.4.8.jar --type css theme2.css > ~/www.samtopaz.com/theme2.css;
java -jar yuicompressor-2.4.8.jar --type css codeHighlight/styles/samCustom.css > ~/www.samtopaz.com/samCustom.css;

# copy font/s
cp  TypographyTimes.ttf ~/www.samtopaz.com/TypographyTimes.ttf;

# copy js script
cp frivolous.js ~/www.samtopaz.com/frivolous.js;

# copy media
# +----------------------------------------------------------------------------+
# | 		NOTE: THAT THIS FOLDER IS NOW CONSIDERED DEPRECATED	       |
# | 	 AND WE SHOULD MIGRATE ALL ARTICLE MEDIA TO "articles/xxx/media",      |
# | 			WHERE xxx IS THE ARTICLE CATEGORY.		       |
# +----------------------------------------------------------------------------+
cp -r ./media ~/www.samtopaz.com/

# gen main pages
# remove crud
rm *~ *#
php index.php > ~/www.samtopaz.com/index.html;
php about.php > ~/www.samtopaz.com/about.html;
php contact.php > ~/www.samtopaz.com/contact.html;

# gen article link pages =======================================================
php allArticles.php > ~/www.samtopaz.com/allArticles.html;
php operatingSystemArticles.php > ~/www.samtopaz.com/operatingSystemArticles.html;
php computerArchitectureArticles.php > ~/www.samtopaz.com/computerArchitectureArticles.html;
php programmingArticles.php > ~/www.samtopaz.com/programmingArticles.html;
php miscArticles.php > ~/www.samtopaz.com/miscArticles.html

