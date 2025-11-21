<?php
require('fpdf.php');

class PDF_Code39 extends FPDF
{
function Code39($xpos2, $ypos2, $code2, $baseline2=0.5, $height2=5){

	$wide2 = $baseline2;
	$narrow2 = $baseline2 / 3 ; 
	$gap2 = $narrow2;

	$barChar2['0'] = 'nnnwwnwnn';
	$barChar2['1'] = 'wnnwnnnnw';
	$barChar2['2'] = 'nnwwnnnnw';
	$barChar2['3'] = 'wnwwnnnnn';
	$barChar2['4'] = 'nnnwwnnnw';
	$barChar2['5'] = 'wnnwwnnnn';
	$barChar2['6'] = 'nnwwwnnnn';
	$barChar2['7'] = 'nnnwnnwnw';
	$barChar2['8'] = 'wnnwnnwnn';
	$barChar2['9'] = 'nnwwnnwnn';
	$barChar2['A'] = 'wnnnnwnnw';
	$barChar2['B'] = 'nnwnnwnnw';
	$barChar2['C'] = 'wnwnnwnnn';
	$barChar2['D'] = 'nnnnwwnnw';
	$barChar2['E'] = 'wnnnwwnnn';
	$barChar2['F'] = 'nnwnwwnnn';
	$barChar2['G'] = 'nnnnnwwnw';
	$barChar2['H'] = 'wnnnnwwnn';
	$barChar2['I'] = 'nnwnnwwnn';
	$barChar2['J'] = 'nnnnwwwnn';
	$barChar2['K'] = 'wnnnnnnww';
	$barChar2['L'] = 'nnwnnnnww';
	$barChar2['M'] = 'wnwnnnnwn';
	$barChar2['N'] = 'nnnnwnnww';
	$barChar2['O'] = 'wnnnwnnwn'; 
	$barChar2['P'] = 'nnwnwnnwn';
	$barChar2['Q'] = 'nnnnnnwww';
	$barChar2['R'] = 'wnnnnnwwn';
	$barChar2['S'] = 'nnwnnnwwn';
	$barChar2['T'] = 'nnnnwnwwn';
	$barChar2['U'] = 'wwnnnnnnw';
	$barChar2['V'] = 'nwwnnnnnw';
	$barChar2['W'] = 'wwwnnnnnn';
	$barChar2['X'] = 'nwnnwnnnw';
	$barChar2['Y'] = 'wwnnwnnnn';
	$barChar2['Z'] = 'nwwnwnnnn';
	$barChar2['-'] = 'nwnnnnwnw';
	$barChar2['.'] = 'wwnnnnwnn';
	$barChar2[' '] = 'nwwnnnwnn';
	$barChar2['*'] = 'nwnnwnwnn';
	$barChar2['$'] = 'nwnwnwnnn';
	$barChar2['/'] = 'nwnwnnnwn';
	$barChar2['+'] = 'nwnnnwnwn';
	$barChar2['%'] = 'nnnwnwnwn';


    
	
	

	$code2 = '*'.strtoupper($code2).'*';
	for($i=0; $i<strlen($code2); $i++){
		$char2 = $code2{$i};
		if(!isset($barChar2[$char2])){
			$this->Error('Invalid character in barcode2: '.$char2);
		}
		$seq2 = $barChar2[$char2];
		for($bar2=0; $bar2<9; $bar2++){
			if($seq2{$bar2} == 'n'){
				$lineWidth2 = $narrow2;
			}else{
				$lineWidth2 = $wide2;
			}
			if($bar2 % 2 == 0){
				$this->Rect($xpos2, $ypos2, $lineWidth2, $height2, 'F');
			}
			$xpos2 += $lineWidth2;
		}
		$xpos2 += $gap2;
	}
}
}

?>
