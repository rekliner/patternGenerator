<?php


parse_str( $_SERVER['QUERY_STRING'], $arrQS);
$format=$arrQS['format'];
$n=$arrQS['n'];settype($n,"integer");
$s=$arrQS['s'];settype($s,'integer');
$c=$arrQS['c'];settype($c,'integer');
$w=$arrQS['w'];settype($w,'integer');
$h=$arrQS['h'];settype($h,'integer');
$nTOc=$arrQS['nTOc'];settype($nTOc,'integer');
$nTOw=$arrQS['nTOw'];settype($nTOw,'integer');
$nTOh=$arrQS['nTOh'];settype($nTOh,'integer');
$e=$arrQS['e'];settype($e,'integer');
$t=$arrQS['t'];settype($t,'integer');
$margin=$arrQS['margin'];//settype($margin,'integer');

$pCFTop 		= array(	0 							, ($nTOc/3)					);
$pCFTopBack		= array(	0 							, 1							);
$cCFToNeck		= array(	.45*$n + $e					, ($nTOc/3)					);
$cCFToNeckBack	= array(	.49*$n + $e					, 1							);
$pNeck 			= array(	$n/2 + $e 					, 0							);
$cNeckToShoulder= array(	($n/2+(($s/2-$n/2)/2)) + $e	, 0							);
$pShoulder 		= array(	$s/2 + $e					, 0.5						);
$cShoulderToChest=array(	($n/2+(($s/2-$n/2)/3)) + $e	, 0.94*$nTOc				);
$pChest 		= array(	$c/4 + $e					, $nTOc						);
$cChestToWaist 	= array(	$w/4 + $e 					, $nTOw-(($nTOw-$nTOc)/2)	);
$pWaist 		= array(	$w/4 + $e 					, $nTOw						);
$cWaistToHip 	= array(	$w/4 + $e					, $nTOh-(($nTOh-$nTOw)/2)	);
$pHip 			= array(	$h/4 + $e					, $nTOh-1					);
$cHipToCF 		= array(	$h/8 + $e					, $nTOh						);
$pCFHip 		= array(	0							, $nTOh						);

$pUniWaist 		= array(	$w/4 + $e 					, $nTOw+(($nTOh-$nTOw)/4)	);
$pCFWaist 		= array(	0							, $pUniWaist[1]+1			);
$cCFToWaistOne 	= array(	$w/12 + $e					, $pUniWaist[1]+1			);
$cCFToWaistTwo 	= array(	$w/6 + $e					, $pUniWaist[1]				);
$pCFTaint		= array(	0							, $nTOh+$t					);
$cHipToTaint 	= array(	$h/12 + $e					, $nTOh+($t/6)				);
$pTaint			= array(	1.5							, $nTOh+$t					);
	

if ($format=='svg') {

	
	function pp(array $arrIn) {
			$strReturn =  (is_int($arrIn[0])) ? $arrIn[0] : number_format($arrIn[0],2); 
			$strReturn .= ',';
			$strReturn .=  (is_int($arrIn[1])) ? $arrIn[1] : number_format($arrIn[1],2);
			$strReturn .= ' ';
			return $strReturn;
	}
	function tp(array $arrIn) {
			return 'x="'. (($arrIn[0]*90)+10) .'" y="'. (($arrIn[1]*90)+45)  .'"';
	}
	function cp(array $arrIn) {
			return 'cx="'. (($arrIn[0]*90)) .'" cy="'. (($arrIn[1]*90)+45)  .'"';
	}

	$bodicePathText = 'M'. pp($pCFTop) .'Q'. pp($cCFToNeck) .' '. pp($pNeck) .' '. pp($cNeckToShoulder) .' '. pp($pShoulder) . 
		pp($cShoulderToChest) . pp($pChest) . pp($cChestToWaist) . pp($pWaist) . pp($cWaistToHip) . pp($pHip) . pp($cHipToCF) . pp($pCFHip) . ' z';
	$bodiceBackNeckPathText = 'M'. pp($pCFTopBack) .'Q'. pp($cCFToNeckBack) .' '. pp($pNeck);// .' '. pp($cNeckToShoulder) .' '. pp($pShoulder) . 
	//	pp($cShoulderToChest) . pp($pChest) . pp($cChestToWaist) . pp($pWaist) . pp($cWaistToHip) . pp($pHip) . pp($cHipToCF) . pp($pCFHip) . ' z';
	//            cf            curve          neck                         curve       shoulder                          curve                       chest                   curve                                     waist                   curve                                       hip                      curve           cf
	//$pathText = 'M0,2 Q'. 0.45*$n .',2 '. $n/2 .',0 ' .($n/2+(($s/2-$n/2)/2)) .',0 '. $s/2 .',0.5 '. ($n/2+(($s/2-$n/2)/3)) .','. .94*$nTOc .' '. $c/4 .','. $nTOc .' '. $w/4 .','. ($nTOw-(($nTOw-$nTOc)/2)) .' '. $w/4 .','. $nTOw .' '. $w/4 .','. ($nTOh-(($nTOh-$nTOw)/2)) .' '. $h/4 .','. ($nTOh-1) .' '. $h/8 .','. $nTOh .' 0,'. $nTOh .' z';

	$uniPathText = 'M'. pp($pCFWaist).'C'. pp($cCFToWaistOne). pp($cCFToWaistTwo) . pp($pUniWaist).'Q'. pp($cWaistToHip) . pp($pHip) . pp($cHipToTaint). pp($pTaint). 'L'. pp($pCFTaint). ' z';

	//echo $pathText;
	//<path transform="scale(90,90)"     style="fill:none;fill-rule:evenodd;stroke:#000000;stroke-width:.02px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1"       d="M0,2 Q4,2 4.5,0 6.5,0 8.25,0.5 6,8.5 9,9 7.5,14 7.5,19 7.5,22 8.675,25 4,26 0,26 z" />

	


	
	header('Content-type: image/svg+xml');
	header('Content-disposition: inline; filename=pattern.svg');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
	echo '<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"   xmlns:svg="http://www.w3.org/2000/svg"   xmlns="http://www.w3.org/2000/svg"    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"  xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"  xmlns:xlink="http://www.w3.org/1999/xlink"';
	echo ' width="' . ($c/4+2) . 'in"   height="' . ($nTOh+$t+1) .'in"   viewBox="0 0 ' . (($c/4+2)*90) . ' ' . (($nTOh+$t+1)*90) . '"   id="svg2"   version="1.1">';
	echo ' <sodipodi:namedview inkscape:document-units="in" />';
?>
	<defs>
		<pattern id="smallGrid" width="9" height="9" patternUnits="userSpaceOnUse">
		  <path d="M 9 0 L 0 0 0 9" fill="none" stroke="gray" stroke-width="0.5"/>
		</pattern>
		<pattern id="grid" width="90" height="90" patternUnits="userSpaceOnUse">
		  <rect width="90" height="90" fill="url(#smallGrid)"/>
		  <path d="M 90 0 L 0 0 0 90" fill="none" stroke="gray" stroke-width="1"/>
		</pattern>
	</defs>
	<!--<rect width="100%" height="100%" fill="url(#grid)" />-->
<?
	//a much less efficient grid
	echo '<g>'.PHP_EOL;
	for ($markings = 1;$markings <=($nTOh+$t+1);$markings++) {
			echo '<path d="M 0 '. (($markings*90)-45) .'L '. ($c/4+2)*90 .' '. (($markings*90)-45) .'" fill="none" stroke="gray" stroke-width="1"/>';			
			echo '<text x="22" y="'. (($markings*90) -40) .'">' . ($markings-1) .'</text>'.PHP_EOL;
	}
	for ($markings = 1;$markings <($c/4+3);$markings++) {
			echo '<text y="25" x="'. (($markings*90) - 5) .'">' . $markings .'</text>'.PHP_EOL;
			echo '<path d="M '. ($markings*90) .' 0 L '. ($markings*90) .' '. (($nTOh+$t+1)*90) .'" fill="none" stroke="gray" stroke-width="1"/>';			
	}
	echo '</g>'.PHP_EOL.PHP_EOL;

	echo '<path transform="scale(90,90) translate(0,.5)" style="fill:none;stroke:#000000;stroke-width:.03px;" d="' . $bodicePathText . '" id="bodice" />'.PHP_EOL;
	echo '<path transform="scale(90,90) translate(0,.5)" style="fill:none;stroke:#000066;stroke-width:.03px;" d="' . $bodiceBackNeckPathText . '" id="backNeck" />'.PHP_EOL;

	echo '<path transform="scale(90,90) translate(0,.5)" style="fill:none;stroke:#006600;stroke-width:.03px;" d="' . $uniPathText . '" id="briefs" />'.PHP_EOL;

	echo '<a xlink:href="'. $_SERVER["REDIRECT_SCRIPT_URI"] . '?' . htmlspecialchars(substr($_SERVER['QUERY_STRING'],0,-11)) .'">'.PHP_EOL;
	echo '<text x="0" y="13" fill="#0000FF">edit measurements</text></a>';
	echo '<text x="230" y="13" fill="#000000">BODICE PATTERN GENERATOR</text>'.PHP_EOL;
	echo '<text '. tp($pNeck) .'>Neck '. pp($pNeck) .'</text>' . '<circle r="5" '. cp($pNeck) .' />'.PHP_EOL;
	echo '<text '. tp($pShoulder) .'>Shoulder '. pp($pShoulder) .'</text>' . '<circle r="5" '. cp($pShoulder) .' />'.PHP_EOL;
	echo '<text '. tp($pCFTop) .'>Front Neck Line</text>'.PHP_EOL;
	echo '<text '. tp($pCFTopBack) .'>Back Neck Line</text>'.PHP_EOL;
	echo '<text '. tp($pChest) .'>Chest '. pp($pChest) .'</text>' . '<circle r="5" '. cp($pChest) .' />.PHP_EOL';
	echo '<text '. tp($pWaist) .'>Waist '. pp($pWaist) .'</text>' . '<circle r="5" '. cp($pWaist) .' />.PHP_EOL';
	echo '<text '. tp($pHip) .'>Hip '. pp($pHip) .'</text>' . '<circle r="5" '. cp($pHip) .' />.PHP_EOL';
	echo '<text '. tp($pTaint) .'>Taint '. pp($pTaint) .'</text>' . '<circle r="5" '. cp($pTaint) .' />.PHP_EOL';

	echo '</svg>';

	//END SVG CALL
	
} elseif ($format=='pdf') {
	
	
	require_once($_SERVER["DOCUMENT_ROOT"] . '/tcpdf/tcpdf.php');	
	// create new PDF document
	$page_format = array(
		'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => (($c/4+1)), 'ury' => (($nTOh+$t+1)) ),
		'CropBox' => array ('llx' => $margin, 'lly' => 0, 'urx' => (($c/4+1)), 'ury' => (($nTOh+$t+1))),
		//'BleedBox' => array ('llx' => $margin, 'lly' => 0, 'urx' => (($c/4+1)), 'ury' => (($nTOh+$t+1))),
		//'TrimBox' => array ('llx' => $margin, 'lly' => 0, 'urx' => (($c/4+1)), 'ury' => (($nTOh+$t+1))),
		//'ArtBox' => array ('llx' => 0, 'lly' => 0, 'urx' => (($c/4+1)), 'ury' => (($nTOh+$t+1))),
		
		'Rotate' => 0,
		
	);

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'in', $page_format, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetTitle('Pattern Generator');
	$pdf->SetSubject('Pattern Generator');
	$pdf->SetKeywords('pdf,bodice,pattern,generator');
	$pdf->SetMargins(0, 0, 0);
	$pdf->SetSubject('Pattern Generator');
	$pdf->SetAutoPageBreak(false, 0);

	$pdf->SetFont('Helvetica', '', 10);

	// add a page
	$pdf->AddPage();

	$pdf->ImageSVG($file=$_SERVER["REDIRECT_SCRIPT_URI"] . '?' . substr($_SERVER['QUERY_STRING'],0,-3) . 'svg', $x=0, $y=0, 
		$w='11', $h='', $link=$_SERVER["REDIRECT_SCRIPT_URI"] . '?' . substr($_SERVER['QUERY_STRING'],0,-3) . 'save', 
		$align='T', $palign='L', $border=0, $fitonpage=false);

	$pdf->Write(0, $txt, '', 0, 'L', false, 0, false, false, 0,0,array ('left' => 0, 'top' => 0, 'right' => 0, 'bottom' => 0 ));

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('pattern.pdf', 'I'); //d for file
	//end PDF call
} else {
	//present the input form
?>
<?
	

	
function writeInputBox($txtName,$aQS) {
	echo '<input name="'. $txtName .'" value="'. $aQS[$txtName] .'" size="5" /> ';
}
?>
<html>
<body>

   <path transform="scale(90)"
       style="fill:none;fill-rule:evenodd;stroke:#000000;stroke-width:.02px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1"
       d="M0,2 Q4,2 4.5,0 6.5,0 8.25,0.5 6,8.5 9,9 7.5,14 7.5,19 7.5,22 8.675,25 4,26 0,26 z"
	   q="cf-2   c   Neck   c   shoulder   c  chest  c     waist   c     hip      c    cf "
	   q="cf-2 .9n,2  n+((s-n)/2),0   n+((s-n)/2),.94c  c,c+((w-c)/2)  c,w+((h-w)/2)  .5h,h+1   0,h+1 "
       id="path4138"
       inkscape:connector-curvature="0" />
	   
    <path transform="scale(90) translate(0,10)"
       style="fill:none;fill-rule:evenodd;stroke:#ff0000;stroke-width:.02px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1"
       d="M0,36 4,36 Q5,28 7,14 8,11 10.5,8 7,7 8.5,-1 C0,-2 -3.5,-4.5 -6.5,-4.5 Q-7,7 -10.5,8  -8,11  -7,14 -5,28 -4,36 z"
	   q="cf-w2a .5ank c .5knee  c   .5thig  c    fr    c        c       rr         c   .5thig    c    .5knee   c   .5ank"
       id="path4138"
       inkscape:connector-curvature="0" />
<form id="measuremetsForm">
 <a href="catsuit.htm">return to main page</a>
<h1>Bodice pattern calculator</h1>
(All measurements in inches)<br>
neck:<? writeInputBox("n",$arrQS) ?> <br>
measure from the middle point where your neck meets your shoulder on each side letting the tape drape in front of your neck. 8-11".  <br>
This is also the start point for the "neck to" measurements below<br><br>
shoulder:<? writeInputBox("s",$arrQS) ?><br>
measure from the points where your shoulder creases when you raise your arm to the side. Again tape drapes in front of your neck.<br><br>
chest circumference:<? writeInputBox("c",$arrQS) ?> neck to chest line:<? writeInputBox("nTOc",$arrQS) ?><br>
waist circumference:<? writeInputBox("w",$arrQS) ?> neck to waist line:<? writeInputBox("nTOw",$arrQS) ?> <br>
measure at thinnest point, near bellybutton<br><br>
hip circumference:<? writeInputBox("h",$arrQS) ?>  neck to hip line:<? writeInputBox("nTOh",$arrQS) ?> <br>
hip line to taint<? writeInputBox("t",$arrQS) ?>  <br>
ease :<? writeInputBox("e",$arrQS) ?> <br>
ease is extra circumference to make it looser<br>
0 for skin tight, about 2 for t-shirt looseness, -1 for compression<br><br>

Margin<input name="margin" value="0.25"><br>
(affects PDF only, to allow the center fold line to align with the side of the page)<br><br>
Format: PDF<input type="radio" name="format" value="pdf" id="formatPDF"> or 
<input type="radio" name="format" value="svg" checked="checked" id="formatSVG">SVG  <br>
SVG is best for viewing and editing your patterns. <a href="http://inkscape.org/" target="_blank">Inkscape</a> is a great free program for doing so. <br>
Use PDF when ready to print. <a href="https://www.foxitsoftware.com/downloads/" target="_blank">Foxit Reader</a> is a good free program for printing large PDFs with page tiles. <br>
<br>
<input type="submit" value="Generate Pattern!"> <input type="submit" value="save measurements to a bookmarkable link" onClick="document.getElementById('formatSVG').checked=false;document.getElementById('formatPDF').checked=false;">
</form>
</body>
</html>

<!-- script>
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
var n=getQueryVariable("n");
var s=getQueryVariable("s");
var c=getQueryVariable("c");
var w=getQueryVariable("w");
var h=getQueryVariable("h");
var nTOc=getQueryVariable("nTOc");
var nTOw=getQueryVariable("nTOw");
var nTOh=getQueryVariable("nTOh");
//              cf            curve       neck                       curve      shoulder                       curve                      chest                curve                                  waist                curve                                   hip                    curve           cf
var pathText = 'M0,2 Q'+ .45*n +',2 '+ n/2 +',0 ' +(n/2+((s/2-n/2)/2)) +',0 '+ s/2 +',0.5 '+ (n/2+((s/2-n/2)/3)) +','+ .94*nTOc +' '+ c/4 +','+ nTOc +' '+ w/4 +','+ (nTOw-((nTOw-nTOc)/2)) +' '+ w/4 +','+ nTOw +' '+ w/4 +','+ (nTOh-((nTOh-nTOw)/2)) +' '+ h/4 +','+ (nTOh-1) +' '+ h/8 +','+ nTOh +' 0,'+ nTOh +' z';

//document.write('<xml version="1.0" encoding="UTF-8" standalone="no">');
document.write('<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"   xmlns:svg="http://www.w3.org/2000/svg"   xmlns="http://www.w3.org/2000/svg"   width="11in"   height="8.5in"   viewBox="0 0 900.00002 2700.0001"   id="svg2"   version="1.1">');
document.write('<path transform="scale(-90,90)" style="fill:none;stroke:#00ff00;stroke-width:.02px;" d="'+ pathText + '" id="path4139" />');
document.write('<path transform="scale(-90,90)"     style="fill:none;fill-rule:evenodd;stroke:#000000;stroke-width:.02px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1"       d="M0,2 Q4,2 4.5,0 6.5,0 8.25,0.5 6,8.5 9,9 7.5,14 7.5,19 7.5,22 8.675,25 4,26 0,26 z" />');
document.write('</svg>');

 
document.write( pathText);

</script>	   
    
<!-->
<?
}
?>
