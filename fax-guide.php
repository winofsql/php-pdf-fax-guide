<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
// ************************************************
// セッションとキャッシュなし
// ************************************************
session_cache_limiter('nocache');
session_start();

define ('K_PATH_FONTS', "../tcpdf/");
require_once('../tcpdf/tcpdf.php');

$pdf = new TCPDF("P");
// ************************************************
// 設定
// ************************************************
$pdf->setFontSubsetting(false);		// 埋め込みフォントの場合部分埋め込みをしない
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(false);

// フォント選択
$fontname = "keifont";
$pdf->SetFont($fontname, '', 14);

// 印刷ページ追加
$pdf->AddPage();

/*
  印字コマンド例

   画像
  $pdf->Image($obj['f'], $obj['x'],$obj['y'],$obj['w'],$obj['h']);

  テキスト
  $pdf->SetFont('msmincho', '', $obj['s']);
  user_text( $pdf, $obj['x'],$obj['y'], $obj['t'] );

  四角
  $pdf->Rect($obj['x'],$obj['y'],$obj['w'],$obj['h']);

  横直線
  $pdf->Line($obj['x'],$obj['y'],$obj['x']+$obj['w'],$obj['y']);

  縦直線
  $pdf->Line($obj['x'],$obj['y'],$obj['x'], $obj['y']+$obj['h']);
*/

// 起点の設定( これを使用した関数またはクラスを作成するとメンテしやすい )
$bx = 9.3;
$by = 10;
$bw = 191;
$bh = 277;

// 余白線( 点線で白に近い灰色 )
$pdf->SetLineStyle(array('width' => 0.5,'cap' => 'round','join' => 'round','dash' => 0,'color' => array(0x00,0x00,0x00)));
$pdf->Rect( $bx, $by, $bw, $bh );

// 確認欄( 実践で黒 )
$pdf->SetLineStyle(array('width' => 0.1,'cap' => 'round','join' => 'round','dash' => 0,'color' => array(0x00,0x00,0x00)));

$pdf->Line( $bx + 20, $by + 20, $bx + 20 + 60 , $by + 20 );
$pdf->Line( $bx + 20, $by + 30, $bx + 20 + 60 , $by + 30 );
$pdf->Line( $bx + 20, $by + 40, $bx + 20 + 60 , $by + 40 );

$text = "様";
$size = 17;
$pdf->SetFont('', '', $size);			// フォントサイズ設定
$pdf->SetXY( $bx + 70, $by + 32 );		// 印字位置設定
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央

$text = "送信日:";
$size = 16;
$pdf->SetFont('', '', $size);			// フォントサイズ設定
$pdf->SetXY( $bx + 100, $by + 20 );		// 印字位置設定
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央

$size = 16;
$pdf->SetFont('', '', $size);			// フォントサイズ設定
$pdf->SetXY( $bx + 136, $by + 20 );		// 印字位置設定
$text = "年";
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央

$pdf->SetXY( $bx + 153, $by + 20 );		// 印字位置設定
$text = "月";
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央

$pdf->SetXY( $bx + 170, $by + 20 );		// 印字位置設定
$text = "日";
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央

$pdf->SetXY( $bx + 170, $by + 30 );		// 印字位置設定
$text = "枚";
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央


$text = "枚数(この用紙も対象):";
$pdf->SetXY( $bx + 100, $by + 30 );		// 印字位置設定
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央

$text = "FAX";
$size = 90;
$pdf->SetFont('', '', $size);		// フォントサイズ設定
$pdf->SetXY( 40, 80 );			// 印字位置設定
$pdf->Cell( 1, 0, $text, 0, 0, "L" );	// タイトル枠一つぶん : "C" は中央

$pdf->Line( $bx + 20, $by + 150, $bx + 20 + 150 , $by + 150 );
$pdf->Line( $bx + 20, $by + 151, $bx + 20 + 150 , $by + 151 );

for( $i = 0; $i < 9; $i++ ) {

  $pdf->Line( $bx + 20, $by + 170 + $i*10, $bx + 20 + 150 , $by + 170 + $i*10 );

}

// ブラウザへ PDF を出力します
$pdf->Output("test_output.pdf", "I");
?>
